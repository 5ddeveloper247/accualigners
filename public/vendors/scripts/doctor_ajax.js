/*_________________________Update and save ajax_________________________*/
$("#frmuser").submit(function (event) {
    event.preventDefault();

    var data = new FormData(frmuser);
    var id = $("#ElementId").val();

    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    var email = $("#txtemail").val();

    if (emailRegex.test(email)) {

    } else {
        toastr.error('Proper Email Format is Required', 'error', {timeOut: 2000});
        return;
    }

    if ($("#txtname").val() === '') {
        toastr.error('Name is Required', 'error', {timeOut: 2000});
        return;
    }
    if (email === '') {
        toastr.error('Email is Required', 'error', {timeOut: 2000});
        return;
    }

    /*_________________________Update ajax_________________________*/
    if (id != '') {
        $.ajax({
            type: "POST",
            url: base_url + "/update_new_doctor",
            data: data,
            processData: false,
            contentType: false,
            beforeSend: function () {
                ajaxLoader();

            },
            xhr: function () {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function (evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = evt.loaded / evt.total;
                        percentComplete = parseInt(percentComplete * 100);
                        ajaxLoaderprograss(percentComplete);
                    }
                }, false);
                return xhr;
            },
            success: function (data) {
               

                if (data.done == true) {
                    toastr.success(data.msg, '', {timeOut: 2000});
                    // $('.pop1').addClass('d-none');
                    $('.pop1').fadeOut('slow');

                    setTimeout(function () {
                        location.reload(true)
                    }, 1000);
                } else {
                    toastr.error(data.msg, '', {timeOut: 2000});
                }
            },
            error: function (message, error) {
                $('#loader').fadeOut();
                console.log(message);
                $.each(message['responseJSON'].errors, function (key, value) {
                    toastr.error(value, {timeOut: 3000});
                });
            }
        });
    } else {

        /*_________________________Save ajax_________________________*/
        $.ajax({
            type: "POST",
            url: base_url + "/doctor",
            data: data,
            processData: false,
            contentType: false,
            beforeSend: function () {
                ajaxLoader();
            },
            xhr: function () {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function (evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = evt.loaded / evt.total;
                        percentComplete = parseInt(percentComplete * 100);
                        ajaxLoaderprograss(percentComplete);
                    }
                }, false);
                return xhr;
            },
            success: function (data) {

               
                if (data.done == true) {
                    toastr.success(data.msg, '', {timeOut: 2000});
                    // $('.pop1').addClass('d-none');
                    $('.pop1').fadeOut('slow');

                    setTimeout(function () {
                        location.reload(true)
                    }, 1000);
                } else {
                    if (data.error) {
                        console.log(data);
                        toastr.error(data.error, '', {timeOut: 2000});
                    } else {
                        toastr.error(data.msg, '', {timeOut: 2000});
                    }
                }
            },
            error: function (message, error) {
                $('#loader').fadeOut();
                console.log(message);
                if (message['responseJSON']) {
                    $.each(message['responseJSON'].errors, function (key, value) {
                        toastr.error(value, {timeOut: 3000});
                    });
                } else {
                    console.log(message);
                    toastr.error(message, {timeOut: 3000});
                }
            }
        });
    }
});


/*_________________________Edit show ajax________________________*/
function editFunction(id = '') {

    $("#txtpass").val('');
    if (id == '') {
        $("#txtname").val('');
        $("#txtemail").val('');
        $("#ElementId").val('');
        // $('.pop1').removeClass('d-none');
        $('.pop1').fadeIn('slow');

        $("#output").attr("src", img_asset + "/gallery.png");
        return;
    }

    $.ajax({
        type: 'GET',
        url: base_url + "/doctor/" + id + "/edit",
        data: {},
        beforeSend: function () {
            ajaxLoadercount();
        },
        
        success: function (data) {
            $('#loader').fadeOut();
            console.log(id)
            if (data) {
                $("#txtname").val(data['edit_values']['name']);
                $("#txtemail").val(data['edit_values']['email']);
                $("#ElementId").val(data['edit_values']['id']);
                $("#output").attr("src", data['edit_values']['picture']);
                // $('.pop1').removeClass('d-none');
                $('.pop1').fadeIn('slow');

            } else {
                toastr.error('some error', 'Error');
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
    for (i = 1; i < records; i++) {
        if ($("#a" + i).is(':checked') == true) {
            recordId[a] = $("#a" + i).val();
            a++;
        }
    }

    if (recordId.length != 0) {
        $.ajax({
            type: 'DELETE',
            url: base_url + "/doctor/" + recordId,
            data: {},
            beforeSend: function () {
                ajaxLoadercount();

            },
          
            success: function (data) {
                $('#loader').fadeOut();

                if (data) {
                    if (data.done == true) {
                        $(".pop2").addClass("d-none");
                        toastr.success(data.msg, '', {timeOut: 2000});
                        setTimeout(function () {
                            location.reload(true)
                        }, 1000);
                    } else {
                        toastr.error(data.msg, '', {timeOut: 2000});
                    }
                } else {
                    toastr.error('some error', 'Error');
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
    $("#picture").click();
});
/*_________________________preview img_________________________*/
$(document).on("change", "#picture", function () {
    var reader = new FileReader();
    reader.onload = function () {
        var output = document.getElementById('output');
        output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
});


/*____________________check all the boxes____________________*/
var chkboxes = 0;
$("#btnCheckAll").click(function () {
    if (chkboxes == 0) {
        for (i = 1; i < records; i++) {
            $("#a" + i).prop('checked', true);
        }
        chkboxes = 1;
    } else {
        for (i = 1; i < records; i++) {
            $("#a" + i).prop('checked', false);
        }
        chkboxes = 0;
    }

});
