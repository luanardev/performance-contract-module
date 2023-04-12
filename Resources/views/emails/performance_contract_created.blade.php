@component('mail::message')
<h2>Dear {{$plan->staff->fullname()}}</h2>

<p>You are hereby notified that your <strong>{{$plan->financialYear->name}}</strong> Performance Contract has been created</p>
<p>You can <a href="{{route('login')}}">login</a> to your staff account to check your plan.</p>

{{ config('app.name') }}
@endcomponent
