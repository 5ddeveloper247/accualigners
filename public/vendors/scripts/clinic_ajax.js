/*_________________________Update and save ajax for Clinic_________________________*/
$("#frmclinic").submit(function (event) {
    event.preventDefault();

    var data = new FormData(frmclinic);
    var id = $("#ElementId").val();

    /*_____Update ajax_____*/
    if (id) {
        $.ajax({
            type: "POST",
            url: base_url + "/update_new_clinic",
            data: data,
            processData: false,
            contentType: false,
            beforeSend: function () {
                ajaxLoader();
            },
            xhr: function() {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) {
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

                $.each(message['responseJSON'].errors, function (key, value) {
                    toastr.error(value, {timeOut: 3000});
                });
            }
        });
    } else {

        /*______Save ajax______*/
        $.ajax({
            type: "POST",
            url: base_url + "/add_clinic",
            data: data,
            processData: false,
            contentType: false,
            beforeSend: function () {
                ajaxLoader();
            },
            xhr: function() {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) {
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

                $.each(message['responseJSON'].errors, function (key, value) {
                    toastr.error(value, {timeOut: 3000});
                });
            }
        });
    }
});

/*_________________________Update and save ajax for doctor against clinic_________________________*/
$("#frmdoctor").submit(function (event) {
    event.preventDefault();
    var data = new FormData(frmdoctor);
    var id = $("#ElementId").val();
    var clinicDocId = $("#ClinicDocId").val();

    /*_______Update ajax______*/
    if (clinicDocId) {
        $.ajax({
            type: "POST",
            url: base_url + "/update_new_clinicDoc",
            data: data,
            processData: false,
            contentType: false,
            beforeSend: function () {
                ajaxLoader();
            },
            xhr: function() {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) {
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
                    $('.pop1').fadeOut('slow');
                    // $('.pop1').addClass('d-none');
                    setTimeout(function () {
                        location.reload(true)
                    }, 1000);
                } else {
                    toastr.error(data.msg, '', {timeOut: 2000});
                }
            },
            error: function (message, error) {
                $('#loader').fadeOut();
                $.each(message['responseJSON'].errors, function (key, value) {

                    toastr.error(value, {timeOut: 3000});
                });
            }
        });
    } else {

        /*_____Save ajax____*/
        $.ajax({
            type: "POST",
            url: base_url + "/add_clinic_doctor/" + id,
            data: data,
            processData: false,
            contentType: false,
            beforeSend: function () {
                ajaxLoader();
            },
            xhr: function() {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) {
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

                $.each(message['responseJSON'].errors, function (key, value) {
                    toastr.error(value, {timeOut: 3000});
                });
            }
        });
    }
});

/*_________________________Edit show ajax________________________*/
function editFunction(id = '') {
    if (id == '') {
        $("#name").val('');
        $("#ElementId").val('');
        $("#country_id").val('');
        $("#address").val('');
        $("#contact_person_name").val('');
        $("#contact_person_email").val('');
        $("#contact_person_number").val('');
        $('.pop1').fadeIn('slow');
        // $('.pop1').removeClass('d-none');

    } else {
        $.ajax({
            type: 'GET',
            url: base_url + "/edit_clinic/" + id,
            data: {},
            beforeSend: function(){
                ajaxLoadercount();
            },
            success: function (data) {
                if (data) {
                    getSpecificClinic(data);
                    $('.pop1').fadeIn('slow');
                    // $('.pop1').removeClass('d-none');
                    $('#associate_doctor').removeClass('d-none');
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
}

/*__________________Show doctors on click_____________________*/
function showDoctors(ClinicDocid, Clinicid) {
    $.ajax({
        type: 'POST',
        url: base_url + "/showDoctors",
        data: {
            'ClinicDocid': ClinicDocid,
            'Clinicid': Clinicid
        },
        beforeSend: function () {
            ajaxLoader();
        },
        xhr: function() {
            var xhr = new window.XMLHttpRequest();
            xhr.upload.addEventListener("progress", function(evt) {
                if (evt.lengthComputable) {
                    var percentComplete = evt.loaded / evt.total;
                    percentComplete = parseInt(percentComplete * 100);
                    ajaxLoaderprograss(percentComplete);
                }
            }, false);
            return xhr;
        },
        success: function (data) {


            $('.pop1').fadeIn('slow');
            // $('.pop1').removeClass('d-none');
            $('#associate_doctor').removeClass('d-none');
            $('#ClinicDocId').val(ClinicDocid);
            $('#doctor_id').val(data.doctor_id);
            var mondayTime = (data.monday_time == null) ? ['', ''] : data.monday_time.split('-');
            $('#monday_time_from').val(mondayTime[0]);
            $('#monday_time_to').val(mondayTime[1]);

            var tuesdayTime = (data.tuesday_time == null) ? ['', ''] : data.tuesday_time.split('-');
            $('#tuesday_time_from').val(tuesdayTime[0]);
            $('#tuesday_time_to').val(tuesdayTime[1]);

            var wednesdayTime = (data.wednesday_time == null) ? ['', ''] : data.wednesday_time.split('-');
            $('#wednesday_time_from').val(wednesdayTime[0]);
            $('#wednesday_time_to').val(wednesdayTime[1]);

            var thursdayTime = (data.thursday_time == null) ? ['', ''] : data.thursday_time.split('-');
            $('#thursday_time_from').val(thursdayTime[0]);
            $('#thursday_time_to').val(thursdayTime[1]);

            var fridayTime = (data.friday_time == null) ? ['', ''] : data.friday_time.split('-');
            $('#friday_time_from').val(fridayTime[0]);
            $('#friday_time_to').val(fridayTime[1]);

            var saturdayTime = (data.saturday_time == null) ? ['', ''] : data.saturday_time.split('-');
            $('#saturday_time_from').val(saturdayTime[0]);
            $('#saturday_time_to').val(saturdayTime[1]);

            var sundayTime = (data.sunday_time == null) ? ['', ''] : data.sunday_time.split('-');
            $('#sunday_time_from').val(sundayTime[0]);
            $('#sunday_time_to').val(sundayTime[1]);
            getSpecificClinic(data.clinic.original);

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
            url: base_url + "/clinic/" + recordId,
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
                    $('#loader').fadeOut();

                    toastr.error('some error', 'Error');
                }

            },
            error: function (data) {
                toastr.error('Something Went Wrong', 'Error');
            }
        });
    }
});

/*___________________delete clinic doctor__________________*/
function deleteClinicDoctor(id) {
    $.ajax({
        type: 'POST',
        url: base_url + "/delete_new_clinicDoc/" + id,
        data: {},
        beforeSend: function () {
            ajaxLoader();
        },
        xhr: function() {
            var xhr = new window.XMLHttpRequest();
            xhr.upload.addEventListener("progress", function(evt) {
                if (evt.lengthComputable) {
                    var percentComplete = evt.loaded / evt.total;
                    percentComplete = parseInt(percentComplete * 100);
                    ajaxLoaderprograss(percentComplete);
                }
            }, false);
            return xhr;
        },
        success: function (data) {

            if (data) {
                if (data.done == true) {
                    toastr.success(data.msg, '', {timeOut: 2000});
                    setTimeout(function () {
                        location.reload(true)
                    }, 1000);
                } else {
                    toastr.error(data.msg, '', {timeOut: 2000});
                }
            } else {
                $('#loader').fadeOut();
                toastr.error('some error', 'Error');
            }

        },
        error: function (data) {
            toastr.error('Something Went Wrong', 'Error');
        }
    });
}

/*_________________________trigger file input_________________________*/
$(".add_files_btn").unbind("click").bind("click", function () {
    $("#slider_image").click();
});
/*_________________________preview img_________________________*/
$(document).on("change", "#slider_image", function () {
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

/*_________________validating time_________________*/
$(".validateTime").keyup(function () {
    $(this).find('input').bind("cut copy paste", function (e) {
        e.preventDefault();
    });
    x = $(this).find('input').val();
    pattern = /^([0-9]|0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/;
    if (!pattern.test(x)) {
        $(this).find('input').css({'color': 'red'});
        $('#v_time_msg').css({'display': 'inline'});
        $('#v_time_msg').text('Please Enter Correct format of time');
    } else {
        $(this).find('input').css({'color': 'green'});
        $('#v_time_msg').css({'display': 'none'});
        $('#v_time_msg').text('');
    }
});

/*____________________assigning values to form____________________*/
function getSpecificClinic(data) {
    $("#name").val(data['edit_values']['name']);
    $("#ElementId").val(data['edit_values']['id']);
    if (data['edit_values']['address'] != null) {
        $("#country_id").val(data['edit_values']['address']['country_id']);
        $.each(data['states'], function (key, value) {
            var o = new Option(value.name, value.id);
            $(o).html(value.name);
            $("#state_id").append(o);
        });
        $.each(data['cities'], function (key, value) {
            var o = new Option(value.name, value.id);
            $(o).html(value.name);
            $("#city_id").append(o);
        });
        $("#state_id").val(data['edit_values']['address']['state_id']);
        $("#city_id").val(data['edit_values']['address']['city_id']);
        $("#address").val(data['edit_values']['address']['value']);
        $("#contact_person_name").val(data['edit_values']['address']['contact_person_name']);
        $("#contact_person_email").val(data['edit_values']['address']['contact_person_email']);
        $("#contact_person_number").val(data['edit_values']['address']['contact_person_number']);
    }
}
