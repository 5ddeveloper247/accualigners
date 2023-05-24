function showMessage(id){
    $.ajax({
                url: base_url+"/show_message",
                method: 'POST',
                data: {
                    case_id: id
                },
            beforeSend: function(){
                    ajaxLoader();

                },
                success: function(response) {
                    $('#loader').fadeOut();
                    div_concern.empty();
                    $('#btnSend').data('id',id);
                    $.each(response, function(index, message) {
                        if(message.message_by == 'ADVISER'){
                            div_concern.append('<div class="row mt-3"><div class="col-md-1 mt-3 pb-3"><img src="https://accualigners.app/vendors/images/logo.png" width="30"></div><div class="col-md-10 mt-3 py-3" id="admin_msg"><span style="font-size:16px;" >'+message.message+'</span><br><span style="font-size:13px;color: #afafaf;">'+moment(message.created_at).format('h:mm A')+'</span></div></div>');
                        }else{
                            div_concern.append('<div class="row mt-3"><div class="col-md-1 mt-3 pb-3"><img src="https://accualigners.app/vendors/images/logo.png" width="30"></div><div class="col-md-10 mt-3 py-3" id="doctor_msg"><span style="font-size:16px;" >'+message.message+'</span><br><span style="font-size:13px;color: #afafaf;"> '+moment(message.created_at).format('h:mm A')+'</span></div></div>');
                        }
                    });
                    //scroll to bottom
                    div_concern.scrollTop(div_concern.prop('scrollHeight'));

                    //making send message active
                    $('#admin_response').removeAttr('readonly');
                    $('#btnSend').removeAttr('disabled');
                },
                error: function(xhr, status, error) {
                    $('#loader').fadeOut();
                    console.log('Error!', error);
                }
        });
}

/*__________send message__________*/
function sendMessage(btn){
    var id = $(btn).data('id');
    var message = $("#admin_response").val();
    if($('#admin_response').val()==''){
        toastr.error('PLease write some message', 'Empty', {timeOut: 2000});
        return;
    }
    $.ajax({
                url: base_url+"/send_message",
                method: 'POST',
                data: {
                    case_id: id,
                    message: message,
                    message_by:'ADVISER'
                },
            beforeSend: function(){
                    ajaxLoader();

                },
                success: function(response) {
                    $('#loader').fadeOut();
                    div_concern.empty();
                if(response[1].done == true)
                {
                    
                    toastr.success(response[1].msg, 'Success', {timeOut: 2000});
                    $.each(response[0], function(index, message) {
                        if(message.message_by == 'ADVISER'){
                            div_concern.append('<div class="row mt-3"><div class="col-md-1 mt-3 pb-3"><img src="https://accualigners.app/vendors/images/logo.png" width="30"></div><div class="col-md-10 mt-3 py-3" id="admin_msg"><span style="font-size:16px;" >'+message.message+'</span><br><span style="font-size:13px;color: #afafaf;">'+moment(message.created_at).format('h:mm A')+'</span></div></div>');
                        }else{
                            div_concern.append('<div class="row mt-3"><div class="col-md-1 mt-3 pb-3"><img src="https://accualigners.app/vendors/images/logo.png" width="30"></div><div class="col-md-10 mt-3 py-3" id="doctor_msg"><span style="font-size:16px;" >'+message.message+'</span><br><span style="font-size:13px;color: #afafaf;">'+moment(message.created_at).format('h:mm A')+'</span></div></div>');
                        }
                    });
                    //scroll to bottom
                    div_concern.scrollTop(div_concern.prop('scrollHeight'));
                    $("#admin_response").val('');

                    //making send message active
                    $('#admin_response').removeAttr('readonly');
                    $('#btnSend').removeAttr('disabled');
                }else{
                    toastr.error(response[1].msg, 'Error', {timeOut: 2000});
                }
                    
                },
                error: function(xhr, status, error) {
                    $('#loader').fadeOut();
                    console.log('Error!', error);
                }
        });
}

/*__________send notification__________*/
function sendNotification(){
    var id = $('#btnSend').data('id');
    if(id !='')
    {
            $.ajax({
                url: base_url+"/send_notification",
                method: 'POST',
                data: {
                    case_id: id
                },
            beforeSend: function(){
                    ajaxLoader();

                },
                success: function(response) {
                    
                    $('#loader').fadeOut();
                if(response.done == true)
                {
                    toastr.success(response.msg, 'Success', {timeOut: 2000});
                }else{
                    toastr.error(response.msg, 'Error', {timeOut: 2000});
                }
                    
                },
                error: function(xhr, status, error) {
                    console.log('Error!', error);
                    
                    $('#loader').fadeOut();
                }
        });
    }
}