@isset($concern)
    <div class="col-12 mb-1 @if($concern->message_by == 'PATIENT') text-right @else text-left @endif ">
        <h5 class="card-title mb-1">Dentist</h5>
              {!! $concern->message !!} <br>
         <small>{{date('d-M-Y h:i', $concern->created_date)}}</small> 
    </div>    
@endisset
