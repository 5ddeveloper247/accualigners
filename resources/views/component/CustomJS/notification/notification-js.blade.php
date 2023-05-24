<script>

    $(document).ready(function () {

        $('body').on('click', '.notification-click', function () {

            var user_id = $(this).data('id');

            var data = {
                _token: '{{csrf_token()}}',
                user_id: user_id
            }

            $.ajax({
                url: '{{url("notification/markAsRead")}}',
                type:"POST",
                dataType : 'json',
                data: data,
                success:function(responseCollection){

                    //$('.notification-list').html('<p class="mt-3 text-center">Empty Notification</p>');
                    $('.notification-count').hide();

                },error:function(e){
                    var responseCollection = e.responseJSON;
                    swal({title: "Error!", text:  responseCollection['errorMessage'], showConfirmButton: false , icon: "warning"});
                }
            }); //end of ajax
        });

    });

</script>
