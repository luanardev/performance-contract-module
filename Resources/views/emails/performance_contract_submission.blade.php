@component('mail::message')
<h2>Dear {{$plan->appraiser->fullname()}}</h2>

<p>You are hereby notified that <strong>{{$plan->staff->fullname()}}</strong> who works as <strong>{{$plan->staff->employment->getPosition()}}</strong> has submitted {{$plan->staff->possessivePronoun()}} Performance Contract for <strong>{{$plan->financialYear->name}}</strong> Financial Year.</p>
<p>Please <a href="{{route('login')}}">login</a> to your staff account to review {{$plan->staff->possessivePronoun()}} performance contract.</p>

{{ config('app.name') }}
@endcomponent
