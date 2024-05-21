<x-mail::message>
# A user has registered successfully

<h3>Name: {{$data['username']}}</h3>
<h3>Email: {{$data['email']}}</h3>



Thanks,<br>
{{ config('app.name') }} App
</x-mail::message>
