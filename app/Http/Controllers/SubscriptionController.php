<?php

namespace App\Http\Controllers;

use App\Http\Middleware\donotAllowUserToMakePayment;
use App\Http\Middleware\isEmployer;
use App\Mail\PurchaseMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Stripe\Checkout\Session;
use Stripe\Stripe;

class SubscriptionController extends Controller
{

    const Weekly_count = 20;
    const Monthly_count = 80;
    const Yearly_count = 200;
    const Currency = 'USD';

    public function __construct()
    {
        $this->middleware(['auth', isEmployer::class]);
        $this->middleware(['auth', isEmployer::class, donotAllowUserToMakePayment::class])->except('subscribe');
    }

    public function subscribe()
    {
        if (Auth::user()->status != 'paid') {
            return view('subscription.index');
        } else {
            return redirect()->route('dashboard')->with('terminated', 'Try afer the subscription is expired');
        }
    }
    public function initiatePayment(Request $request)
    {
        $plans = [
            'weekly' => [
                'name' => 'weekly',
                'description' => 'weekly payment',
                'amount' => self::Weekly_count * 100, // Stripe expects the amount in cents
                'currency' => self::Currency,
                'interval' => 'week', // Specify the interval for the subscription
            ],
            'monthly' => [
                'name' => 'monthly',
                'description' => 'monthly payment',
                'amount' => self::Monthly_count * 100, // Amount in cents
                'currency' => self::Currency,
                'interval' => 'month', // Specify the interval for the subscription
            ],
            'yearly' => [
                'name' => 'yearly',
                'description' => 'yearly payment',
                'amount' => self::Yearly_count * 100, // Amount in cents
                'currency' => self::Currency,
                'interval' => 'year', // Specify the interval for the subscription
            ],
        ];

        Stripe::setApiKey(config('services.stripe.secret'));

        try {
            $selectPlan = null;
            if ($request->is('pay/weekly')) {
                $selectPlan = $plans['weekly'];
                $billingEnds = now()->addWeek()->startOfDay()->toDateString();
            } elseif ($request->is('pay/monthly')) {
                $selectPlan = $plans['monthly'];
                $billingEnds = now()->addMonth()->startOfDay()->toDateString();
            } elseif ($request->is('pay/yearly')) {
                $selectPlan = $plans['yearly'];
                $billingEnds = now()->addYear()->startOfDay()->toDateString();
            }

            if ($selectPlan) {
                $successURL = URL::signedRoute('payment.success', [
                    'plan' => $selectPlan['name'],
                    'billing_ends' => $billingEnds,
                ]);

                $session = Session::create([
                    'payment_method_types' => ['card'],
                    'line_items' => [
                        [
                            'price_data' => [
                                'currency' => $selectPlan['currency'],
                                'product_data' => [
                                    'name' => $selectPlan['name'],
                                    'description' => $selectPlan['description'],
                                ],
                                'recurring' => [
                                    'interval' => $selectPlan['interval'], // Set the recurring interval
                                ],
                                'unit_amount' => $selectPlan['amount'],
                            ],
                            'quantity' => 1,
                        ],
                    ],
                    'mode' => 'subscription',
                    'success_url' => $successURL,
                    'cancel_url' => route('payment.cancel'),
                ]);
                return redirect($session->url);
            }
        } catch (\Exception $e) {
            return response()->json($e);
        }
    }

    public function paymentSuccess(Request $request)
    {
        $plan = $request->plan;
        $billingEnds = $request->billing_ends;
        User::where('id', auth()->user()->id)->update([
            'plan' => $plan,
            'billing_ends' => $billingEnds,
            'status' => 'paid'
        ]);

        try {
            Mail::to(auth()->user())->queue(new PurchaseMail($plan, $billingEnds));
        } catch (\Exception $e) {
            return response()->json();
        }

        return redirect()->route('dashboard')->with('success', 'Payment was successfully processed');
    }
    public function cancel()
    {
        return redirect()->route('dashboard')->with('error', 'Payment was unsuccessfully');
    }
}
