<x-mail::message>
# Introduction

Blood Bank Reset Password.

<x-mail::button :url="'http://ipda3.com'">
Reset
</x-mail::button>
your reset code is : {{$code}}
Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
