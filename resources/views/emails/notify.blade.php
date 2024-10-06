<x-mail::message>
    # Introduction

    Congratulation! you are now a premium user
    <p>Your purchase details</p>
    <p>Plan: {{ $plan }}</p>
    <p>Plane Ends: {{ $billingEnds }}</p>
    <x-mail::button :url="''">
        Post a job
    </x-mail::button>

    Thanks,<br>
    {{ config('app.name') }}
</x-mail::message>
