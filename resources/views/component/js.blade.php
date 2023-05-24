@php($addedJS = [])
@foreach($componentsJsCss as $componentsJs)
    @foreach(trans('component.'.$componentsJs.'.js') as $jsFilePath)
        @if($jsFilePath != '' && !is_null($jsFilePath) && !in_array($jsFilePath,$addedJS))
            @php($addedJS[] = $jsFilePath)
            <script type="text/javascript" src="{{$jsFilePath}}"></script>
        @endif
    @endforeach

    @foreach(trans('component.'.$componentsJs.'.include.js') as $jsFilePath)
        @if($jsFilePath != '' && !is_null($jsFilePath))
            @include($jsFilePath)
        @endif
    @endforeach

@endforeach

@include('component.CustomJS.notification.notification-js')

<script>

    function showLoader(){
        $.blockUI({
            message: '<div class="ft-refresh-cw icon-spin font-medium-2"></div> Please Wait',
            //timeout: 2000, //unblock after 2 seconds
            overlayCSS: {
                backgroundColor: '#FFF',
                opacity: 0.8,
                cursor: 'wait'
            },
            css: {
                border: 0,
                padding: 0,
                backgroundColor: 'transparent'
            }
        });
    }

    function hideLoader(){
        $.unblockUI();
    }

    $(document).ready(function () {

        $(document).ajaxStart(function () {
            $.blockUI({
                message: '<div class="ft-refresh-cw icon-spin font-medium-2"></div><p class="progress-bar-ajax">0%</p>',
                overlayCSS: {
                    backgroundColor: '#FFF',
                    opacity: 0.8,
                    cursor: 'wait'
                },
                css: {
                    border: 0,
                    padding: 0,
                    backgroundColor: 'transparent'
                }
            });
        }).ajaxStop(function () {
            $.unblockUI();
        });

        $('form').submit(function() {
            //$(this)/*.find("button[type='submit']")*/.block({
            $.blockUI({
                message: '<div class="ft-refresh-cw icon-spin font-medium-2"></div> Please Wait',
                //timeout: 2000, //unblock after 2 seconds
                overlayCSS: {
                    backgroundColor: '#FFF',
                    opacity: 0.8,
                    cursor: 'wait'
                },
                css: {
                    border: 0,
                    padding: 0,
                    backgroundColor: 'transparent'
                }
            });
            $(this).find("button[type='submit']").prop('disabled',true);
        });

        $("a[data-action='reload']").on('click',function(){
            location.reload();
        });

        String.prototype.isNumber = function(){return /^\d+$/.test(this);}
        String.prototype.isNumeric = function(){return /^\d*\.?\d+$/.test(this);}
    });
</script>
