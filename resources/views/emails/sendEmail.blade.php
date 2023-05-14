<x-mail::message>
    {{ $email['email_title'] }}

    {{ $email['email_body'] }}

    Thanks,
    {{ config('app.name') }}
</x-mail::message>
