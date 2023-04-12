@component('mail::message')
<h2>Dear {{$plan->staff->fullname()}}</h2>

<p>You are hereby notified that your <strong>{{$plan->financialYear->name}}</strong> Performance Contract has been submitted to <strong>{{$plan->appraiser->fullname()}}</strong></p>
<p>You can <a href="{{route('login')}}">login</a> to your staff account to check the status of your plan.</p>

{{ config('app.name') }}
@endcomponent
