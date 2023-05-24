    /*_________________________Update and save ajax_________________________*/
    $("#frmuser").submit(function (event) {
         event.preventDefault();
         var data = new FormData(frmuser);
         var id = $("#ElementId").val();

         if($('#sort_order').val() === ''){
            toastr.error('Sort Order is required', 'error', {timeOut: 2000});
            return;
         }
         $('#sort_order').on('contextmenu', function() {
            // Prevent the default context menu behavior
            return false;
          });
          $('#sort_order').on('paste', function(event) {
            // Prevent the default paste behavior
            event.preventDefault();
          });

    /*_________________________Update ajax_________________________*/
        if(id != ''){
        $.ajax({
        type: "POST",
        url: base_url+"/update_new_slider",
        data: data,
        processData: false,
        contentType: false,
        beforeSend: function(){
            ajaxLoader();

        },
        success: function (data) {
            $('#loader').fadeOut();

            if(data.done == true)
                {
                    toastr.success(data.msg, '', {timeOut: 2000});
                    // $('.pop1').addClass('d-none');          
                    $('.pop1').fadeOut('slow');

                    setTimeout(function () {location.reload(true)}, 1000);
                }else{
                    toastr.error(data.msg, '', {timeOut: 2000});
                }
        },
        error: function(message, error) 
        {
            $('#loader').fadeOut();

            $.each( message['responseJSON'].errors, function( key, value ) {

                    toastr.error(value, {timeOut: 3000});
                });
        }
        });}else{
            
    /*_________________________Save ajax_________________________*/
        $.ajax({
            type: "POST",
            url: base_url+"/slider",
            data: data,
            processData: false,
            contentType: false,
            beforeSend: function(){
                ajaxLoader();

            },
            success: function (data) {
                $('#loader').fadeOut();

                if(data.done == true)
                {
                    toastr.success(data.msg, '', {timeOut: 2000});
                    // $('.pop1').addClass('d-none');
                    $('.pop1').fadeOut('slow');

                    setTimeout(function () {location.reload(true)}, 1000);
                }else{
                    toastr.error(data.msg, '', {timeOut: 2000});
                }
            },
            error: function(message, error) 
            {
                $('#loader').fadeOut();

                $.each( message['responseJSON'].errors, function( key, value ) {
                    toastr.error(value, {timeOut: 3000});
                });
        }
        });
        }
    });


    /*_________________________Edit show ajax________________________*/
    function editFunction(id = '') {
    if(id=='')
    {
                $("#sort_order").val('');
                $("#ElementId").val('');
                // $('.pop1').removeClass('d-none');
                $('.pop1').fadeIn('slow');

                $("#output").attr("src", img_asset+"/gallery.png");
                return;
    }
    $.ajax({
    type: 'GET',
    url: base_url+"/slider/"+id+"/edit",
    data: {

    },
    beforeSend: function(){
        ajaxLoader();

    },
    success: function (data) {
        $('#loader').fadeOut();

        if(data){
                $("#sort_order").val(data['edit_values']['sort_order']);
                $("#ElementId").val(data['edit_values']['id']);
                $("#output").attr("src", data['edit_values']['slider_image']);
                // $('.pop1').removeClass('d-none');
                $('.pop1').fadeIn('slow');

        }else{
            toastr.error('some error','Error');
        }

    },
    error: function (data) {
        $('#loader').fadeOut();

        toastr.error('Something Went Wrong', 'Error');
    }
    });
    }

    /*_________________________Delete data ajax_________________________*/
    $(".deletebtn").click(function (event) {
        event.preventDefault();
        var recordId = [];
        var a = 0;
            for(i=1;i<records;i++)
            {
                if($("#a"+i).is(':checked')==true)
                {
                recordId[a] = $("#a"+i).val();
                a++;
                } 
            }

        if(recordId.length != 0)
        {
            $.ajax({
            type: 'DELETE',
            url: base_url+"/slider/"+recordId,
            data: {
            },
            beforeSend: function(){
                ajaxLoader();

            },
            success: function (data) {
                $('#loader').fadeOut();

                if(data){
                        if(data.done == true)
                        {
                            $(".pop2").addClass("d-none");  
                            toastr.success(data.msg, '', {timeOut: 2000});
                            setTimeout(function () {location.reload(true)}, 1000);
                        }else{
                            toastr.error(data.msg, '', {timeOut: 2000});
                        }
                }else{
                    toastr.error('some error','Error');
                }

            },
            error: function (data) {
                $('#loader').fadeOut();

                toastr.error('Something Went Wrong', 'Error');
            }
            });
    }
    });

    /*_________________________trigger file input_________________________*/
    $(".add_files_btn").unbind("click").bind("click", function () {
        $("#slider_image").click();
    });
    /*_________________________preview img_________________________*/
    $(document).on("change", "#slider_image", function () {
        var reader = new FileReader();
        reader.onload = function(){
        var output = document.getElementById('output');
        output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    });	


    /*____________________check all the boxes____________________*/
    var chkboxes = 0;
    $("#btnCheckAll").click(function () {
        if(chkboxes == 0)
        {
            for(i=1;i<records;i++)
            {
                $("#a"+i).prop('checked', true);
            }
            chkboxes = 1;
        }else{
            for(i=1;i<records;i++)
            {
                $("#a"+i).prop('checked', false);
            }
            chkboxes = 0;
        }
                
    });
