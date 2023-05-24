<h3>Total {{isset($reportByDate[0]->average_minuts) ? ROUND(collect($reportByDate)->sum('average_minuts'), 2) : '0'}} min</h3>

@foreach ($reportByDate as $byDay)
    <div class="bs-callout-primary callout-border-left callout-square callout-right p-1 mb-1">
        <strong><i class="ft-thumbs-up"></i> {{$byDay->average_minuts}} min</strong>
        <p>{{date('h:i a', $byDay->check_in)}} - {{date('h:i a', $byDay->check_out)}}</p>
    </div>    
@endforeach