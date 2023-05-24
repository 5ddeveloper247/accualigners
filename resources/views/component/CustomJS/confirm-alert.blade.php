
<script>

    $(document).ready(function() {

        //Active Alter
        $('body').on('click','.aeshaz-confirm-alert',function(){

            var getIDs = $(this).data("aeshaz-id");
            var action_type = $(this).data("aeshaz-type");
            var url = $(this).data("aeshaz-url");
            var ids = [];


            var rows = $('table > tbody > tr.selected');
            if(getIDs == 'all-selected' && rows.length > 0) {
                var cou = 0;
                $(rows).each(function(i,e){
                    ids[cou] = $(this).data("aeshaz-select-id");
                    cou++;
                });

            }else if(getIDs != 'all-selected' && getIDs != ''){
                ids[0] = getIDs;
            }

            if(ids.length < 1){
                swal({title: "Warning!", text: "Please select min any one", showConfirmButton: false , icon: "warning"});
            }else{

                swal({
                    title: action_type,
                    text: "Are you sure want to "+action_type+"?",
                    icon: "warning",
                    buttons: {
                        cancel: { text: "No", value: null, visible: true, className: "", closeModal: false,
                        },
                        confirm: { text: "Yes", value: true, visible: true, className: "", closeModal: false
                        }
                    }
                }).then(isConfirm => {
                    if (isConfirm) {

                        var data = {
                            _token: '{{csrf_token()}}',
                            ids: ids,
                            action_type: action_type
                        }

                        $.ajax({
                            url: (url != '' && url != null ? url : '{{url(Request()->path()."/action")}}'),
                            type:(action_type.toLowerCase() == 'delete' ? 'DELETE' : 'POST'),
                            dataType : 'json',
                            data: data,
                            success:function(responseCollection){

                                swal({title: action_type, text: responseCollection['successMessage'], showConfirmButton: false , icon: "success"});
                                setTimeout(location.reload.bind(location), 1000);

                            },error:function(e){
                                var responseCollection = e.responseJSON;
                                swal({title: "Error!", text:  responseCollection['errorMessage'], showConfirmButton: false , icon: "warning"});
                            }
                        }); //end of ajax

                    } else {
                        swal({title: "Cancelled", text: "Your request has been cancelled", timer: 2000, showConfirmButton: false , icon: "error"});
                    }
                });

            }

        });


        //Delete Alter
        $('body').on('click','.delete-confirm-alert',function(){

            var id = $(this).data("id");
            
                swal({
                    title: "Delete",
                    text: "Are you sure want to delete?",
                    icon: "warning",
                    buttons: {
                        cancel: { text: "No", value: null, visible: true, className: "", closeModal: false,
                        },
                        confirm: { text: "Yes", value: true, visible: true, className: "", closeModal: false
                        }
                    }
                }).then(isConfirm => {
                    if (isConfirm) {

                        var data = {
                            _token: '{{csrf_token()}}',
                            id: id
                        }

                        $.ajax({
                            url: '{{url(Request()->path())."/"}}' + id,
                            type: 'DELETE',
                            dataType : 'json',
                            data: data,
                            success:function(responseCollection){

                                swal({title: "Delete", text: responseCollection['message'], showConfirmButton: false , icon: "success"});
                                setTimeout(location.reload.bind(location), 1000);

                            },error:function(e){
                                var responseCollection = e.responseJSON;
                                swal({title: "Error!", text:  responseCollection['message'], showConfirmButton: false , icon: "warning"});
                            }
                        }); //end of ajax

                    } else {
                        swal({title: "Cancelled", text: "Your request has been cancelled", timer: 2000, showConfirmButton: false , icon: "error"});
                    }
                });

            

        });

    });

</script>
