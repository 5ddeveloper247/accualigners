@isset($concern)
@php
$message_by = $concern->message_by == 'ADVISER' ?  'ADVISER' : 'Doctor';
@endphp
    <div class="col-12 mb-1 @if($concern->message_by == 'ADVISER') text-right @else text-left @endif ">
        <h5 class="card-title mb-1">{{ucfirst(strtolower($message_by))}}</h5>
        {!! $concern->message !!}<br>
         <small>{{date('h:i A', strtotime($concern->created_at))}}</small> 
        
    </div>    
@endisset
