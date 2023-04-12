@component('mail::message')
<h2>Dear {{$plan->receiver->fullname()}}</h2>

<p>You are hereby notified that <strong>{{$plan->sender->fullname()}}</strong> has shared {{$plan->sender->possessivePronoun()}} Performance Contract with you.</p>
<p>You can <a href="{{route('login')}}">login</a> to your staff account to view the shared plan</p>

{{ config('app.name') }}
@endcomponent
