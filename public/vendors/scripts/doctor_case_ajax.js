//global variable for managing add image operations
var manageAddImage = 2;
var b = 1;
var Attachment_Ids = [];
/*_________________________Update and save ajax_________________________*/
$("#frmcase2").submit(function (event) {
    if (!validationOfCase()) {
        event.preventDefault(); // prevent the default form submission
        return false; // prevent the execution of the submit event handler
    }
    event.preventDefault();
    var data = new FormData(frmcase2);
    for (var i = 0; i < Attachment_Ids.length; i++) {
        data.append('image_attachment_ids[]', Attachment_Ids[i]);
    }

    var id = $("#ElementId").val();
    /*_________________________Update ajax_________________________*/
    if (id != '') {

        $.ajax({
            type: "POST",
            url: base_url + "/update_new_case",
            data: data,
            processData: false,
            contentType: false,
            beforeSend: function () {
                ajaxLoader();
            },
            success: function (data) {
                $('#loader').fadeOut();
                if (data.done == true) {
                    toastr.success(data.msg, '', {timeOut: 2000});
                    // $('.pop1').addClass('d-none');
                    $('.pop1').fadeOut('slow');
                    setTimeout(function () {
                        location.reload(true)
                    }, 1000);
                } else if (data.done == false) {
                    toastr.error(data.msg, '', {timeOut: 2000});
                } else if (data) {
                    //  $('.pop1').addClass('d-none');
                    console.log(data);
                    $('#payment').removeClass('d-none');
                    $('#payment_price').text(' ');
                    $('#payment_price').text(data.case.processing_fee_amount + ' ' + data.settings.currency);

                    $('#order_payment').val(data.case.processing_fee_amount);
                    $('#order_case_id').val(data.case.id);
                    $('#order_currency').val(data.settings.currency);
                    $('#loader').fadeOut();
                    toastr.success('Case successfully Updated', '', {timeOut: 2000});

                } else {
                    $('#loader').fadeOut();
                    toastr.error('Something Went Wrong', '', {timeOut: 2000});
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

        /*_________________________Save ajax_________________________*/
        $.ajax({
            type: "POST",
            url: base_url + "/case/store/new",
            data: data,
            processData: false,
            contentType: false,
            beforeSend: function () {
                ajaxLoader();
            },
            success: function (data) {

                $('#loader').fadeOut();
                if (data.done == true) {
                    $('#payment').removeClass('d-none');
                    $('#payment_price').text(' ');
                    $('#payment_price').text(data.case.processing_fee_amount + ' ' + data.settings.currency);

                    $('#order_payment').val(data.case.processing_fee_amount);
                    $('#order_case_id').val(data.case.id);
                    $('#order_currency').val(data.settings.currency);
                    $('#loader').fadeOut();
                } else {
                    toastr.error(data.msg, '', {timeOut: 2000});
                }
                //  setTimeout(function () {location.reload(true)}, 1000);

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


var numberOfImages = 0;

/*_________________________Edit show ajax________________________*/
function editFunction(id = '') {
    // $(document).on("contextmenu",function(){
    //     return false;
    // });
    // $('.select_tag').attr('disabled', true);
    for (var x = 1; x <= 9; x++) {
        $('#conidion' + x).prop('disabled', true);
    }
    $('#dob , #address , #email , #phone_no , #name').prop('readonly', true);
    $('.disable_input , #prescription_comment, #additional_comment, #clinical_comment , #midline , #overbite , #overjet , #a_p_relationship , #arch_to_treat , #select1 , #select2').prop('disabled', true);
    $('.add_image , .remove_image').hide();

    var Attach_Img = $("#Attach_Img");
    Attach_Img.find("img.attach_img").remove();

    if (id == '') {
        $("#txtname").val('');
        $("#txtemail").val('');
        $("#ElementId").val('');
        $("#additional_msg").text('');
       
        // $('.pop1').removeClass('d-none');
        $('.pop1').fadeIn('slow');
        $("#output").attr("src", img_asset + "/gallery.png");
        return;
    }
    $.ajax({
        type: 'GET',
        url: base_url + "/case/" + id + "/edit",
        data: {},
        success: function (data) {


            if (data) {

                $("#name").val(data['edit_values']['name']);
                $("#email").val(data['edit_values']['email']);
                $("#embedded_url").val(data['edit_values']['embedded_url']);
                $("#phone_no").val(data['edit_values']['phone_no']);
                $("#address").val(data['edit_values']['address']);
                var date_format = data['edit_values']['dob'].substring(0, 10)
                $("#dob").val(date_format);
                $("#ElementId").val(data['edit_values']['id']);


                if (data['edit_values']['arch_to_treat'] == 'LOWER') {
                    $('#arch_to_treat').parent().addClass('btn-outline-secondary off').removeClass('btn-outline-primary');
                    $('#arch_to_treat').prop("checked", false);
                } else {
                    $('#arch_to_treat').parent().removeClass('btn-outline-secondary off').addClass('btn-outline-primary');
                    $('#arch_to_treat').prop("checked", true);
                }

                if (data['edit_values']['a_p_relationship'] == 'IMPROVE') {
                    $('#a_p_relationship').parent().addClass('btn-outline-secondary off').removeClass('btn-outline-primary');
                    $('#a_p_relationship').prop("checked", false);
                } else {
                    $('#a_p_relationship').parent().removeClass('btn-outline-secondary off').addClass('btn-outline-primary');
                    $('#a_p_relationship').prop("checked", true);
                }


                if (data['edit_values']['overjet'] == 'IMPROVE') {
                    $('#overjet').parent().addClass('btn-outline-secondary off').removeClass('btn-outline-primary');
                    $('#overjet').prop("checked", false);
                } else {
                    $('#overjet').parent().removeClass('btn-outline-secondary off').addClass('btn-outline-primary');
                    $('#overjet').prop("checked", true);
                }


                if (data['edit_values']['overbite'] == 'IMPROVE') {
                    $('#overbite').parent().addClass('btn-outline-secondary off').removeClass('btn-outline-primary');
                    $('#overbite').prop("checked", true);
                } else {
                    $('#overbite').parent().removeClass('btn-outline-secondary off').addClass('btn-outline-primary');
                    $('#overbite').prop("checked", true);
                }


                if (data['edit_values']['midline'] == 'IMPROVE') {
                    $('#midline').parent().addClass('btn-outline-secondary off').removeClass('btn-outline-primary');
                    $('#midline').prop("checked", false);
                } else {
                    $('#midline').parent().removeClass('btn-outline-secondary off').addClass('btn-outline-primary');
                    $('#midline').prop("checked", true);
                }


                $("#clinical_comment").val(data['edit_values']['clinical_comment']);
                $("#prescription_comment").val(data['edit_values']['prescription_comment']);
                $("#additional_comment").val(data['edit_values']['additional_comment']);


                /*____clinical conditions____*/
                if (data['caseClinicalConditions']) {
                    for (numberOfImages = 0; numberOfImages < data['caseClinicalConditions'].length; numberOfImages++) {
                        var index = data['caseClinicalConditions'][numberOfImages];
                        $("#conidion" + index).prop("checked", true);

                    }
                }
                manageAddImage = numberOfImages;
                b = 2;
                /*_____Images attached____*/
                if (data['attachments']['IMAGE']) {
                    for (var i = 0; i < data['attachments']['IMAGE'].length; i++) {
                        var sort_order = data['attachments']['IMAGE'][i].sort_order;
                        $("#IMAGE_" + (i + 1)).attr("src", data['attachments']['IMAGE'][i].full_path);
                        $(".IMAGE_" + (i + 1)).prop('disabled', true);
                        $(".add_new_" + (i + 1)).removeClass('d-none');
                        $("#img_id_" + (i + 1)).val(data['attachments']['IMAGE'][i].id);
                    }
                }
                /*_____Xray Images____*/
                if (data['attachments']['X_RAY']) {
                    for (var i = 0; i < data['attachments']['X_RAY'].length; i++) {
                        var sort_order = data['attachments']['X_RAY'][i].sort_order;
                        $("#X_RAY_" + sort_order).attr("src", data['attachments']['X_RAY'][i].full_path);
                        $("#xray_img_id_" + (i + 1)).val(data['attachments']['X_RAY'][i].id);
                    }
                }
                /*_____Other Images____*/
                if (data['attachments']['OTHER']) {
                    for (var i = 0; i < data['attachments']['OTHER'].length; i++) {

                        var sort_order = data['attachments']['OTHER'][i].sort_order;
                        $("#OTHER_" + sort_order).attr("src", 'https://accualigners.app/storage/images/file.png');
                    }
                } else {
                    $("#OTHER_1").attr("src", 'https://accualigners.app/link/files/app-assets/images/case/upload.png');
                    $("#OTHER_2").attr("src", 'https://accualigners.app/link/files/app-assets/images/case/upload.png');
                }

                /*_____Jaw Images____*/

                $('.disable_input').prop('disabled', true);
                $('.checkbox_form').prop('disabled', true);

                if (data['attachments']['LOWER_JAW']) {
                    for (var i = 0; i < data['attachments']['LOWER_JAW'].length; i++) {

                        var sort_order = data['attachments']['LOWER_JAW'][i].sort_order;
                        $("#select2").val(sort_order);
                        $("#LOWER_JAW_2").attr("src", data['attachments']['LOWER_JAW'][i].full_path);
                        $("#imgShow2").attr("src", data['attachments']['LOWER_JAW'][i].full_path);
                        // Get a reference to our file input
                        const fileInput = document.querySelector('input[type="file"]');

                        // Create a new File object
                        const myFile = new File(['Hello World!'], data['attachments']['LOWER_JAW'][i].full_path, {
                            type: 'image/*',
                            lastModified: new Date(),
                        });

                        // Now let's create a DataTransfer to get a FileList
                        const dataTransfer = new DataTransfer();
                        dataTransfer.items.add(myFile);
                        fileInput.files = dataTransfer.files;
                    }
                }
                if (data['attachments']['UPPER_JAW']) {
                    for (var i = 0; i < data['attachments']['UPPER_JAW'].length; i++) {

                        var sort_order = data['attachments']['UPPER_JAW'][i].sort_order;
                        $("#select1").val(sort_order);
                        $("#UPPER_JAW_1").attr("src", data['attachments']['UPPER_JAW'][i].full_path);
                        $("#imgShow1").attr("src", data['attachments']['UPPER_JAW'][i].full_path);
                        const fileInput = document.querySelector('input[type="file"]');

                        // Create a new File object
                        const myFile = new File(['Hello World!'], data['attachments']['UPPER_JAW'][i].full_path, {
                            type: 'image/*',
                            lastModified: new Date(),
                        });

                        // Now let's create a DataTransfer to get a FileList
                        const dataTransfer = new DataTransfer();
                        dataTransfer.items.add(myFile);
                        fileInput.files = dataTransfer.files;
                    }
                }
                // $('.pop1').removeClass('d-none');
                $('.pop1').fadeIn('slow');
            } else {
                toastr.error('some error', 'Error');
            }

        },
        error: function (data) {
            toastr.error('Something Went Wrong', 'Error');
        }
    });
}

/*_________________________Delete data ajax_________________________*/
$(".deletebtn").click(function (event) {
    event.preventDefault();

    var recordId = [];
    var a = 0;
    var b = 0;
    for (i = 1; i < records1; i++) {
        if ($("#a" + i).is(':checked') == true) {
            recordId[a] = $("#a" + i).val();
            a++;
        }

    }
    for (i = 1; i < records2; i++) {
        if ($("#b" + i).is(':checked') == true) {
            recordId[b] = $("#b" + i).val();
            b++;
        }
    }

    if (recordId.length != 0) {
        $.ajax({
            type: 'DELETE',
            url: base_url + "/case/" + recordId,
            data: {},
            beforeSend: function () {
                ajaxLoader();
            },
            success: function (data) {
                $('#loader').fadeOut();
                if (data) {
                    if (data.done == true) {
                        $(".pop2").addClass("d-none");
                        toastr.success('Success Message', data.msg, {timeOut: 2000});
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

/*_________________________preview img_________________________*/
function preViewImage(input) {
    //getting values in variables

    var file = input.files[0];

    var fileInput = $('#image_attach')[0];
    var files = fileInput.files;
    var sort = $(input).data('sort');
    var type = $(input).data('type');

    //appending form
    formData = new FormData();
    formData.append("_token", '{{csrf_token()}}');
    formData.append("case_id", case_id);
    formData.append("attachment", file);


    formData.append("sort_order", sort);
    formData.append("attachment_type", type);

    //preview image on front
    var reader = new FileReader();
    reader.onload = function () {
        var output = document.getElementById(type + '_' + sort);
        if (file.type === "application/pdf") {
            output.setAttribute("src", "https://accualigners.app/storage/images/file.png");
        } else {
            output.setAttribute("src", reader.result);
        }
        //output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);

    //getting id of attcahment image
    var id = $(input).siblings('.get_id').val();

    if (id != "") {
        formData.append("image_id", id);
    }
    $.ajax({
        type: "POST",
        url: base_url + "/case/upload-attachment",
        data: formData,
        processData: false,
        contentType: false,
        beforeSend: function () {
            ajaxLoader();
        },
        success: function (data) {
            $('#loader').fadeOut();
            var id = data['data']['id']
            toastr.success('Success Message', 'File Uploaded Successfully', {timeOut: 2000});
            var attachment_ids_field = $('#attachment_ids');
            var attachment_ids = attachment_ids_field.val();
            attachment_ids_field.val((attachment_ids != "" ? attachment_ids + ',' + id : id));

        },
        error: function (message, error) {
            $('#loader').fadeOut();
            $.each(message['responseJSON'].errors, function (key, value) {
                toastr.error('Error Message', value, {timeOut: 3000});
            });
        }
    });
}

/*_________________________preview img_________________________*/
function preViewImage2(input) {
    //getting values in variables
    // var file= [];
    // var file = input.files[0];

    var files = input.files;
    var lastfile = files[files.length - 1];
    var sort = $(input).data('sort');
    var type = $(input).data('type');

    //appending form
    formData = new FormData();
    formData.append("_token", '{{csrf_token()}}');
    formData.append("case_id", case_id);
    // formData.append("attachment[]", file);

    for (var i = 0; i < files.length; i++) {
        formData.append("attachment[]", files[i]);
    }

    formData.append("sort_order", sort);
    formData.append("attachment_type", type);


    //preview image on front
    var reader = new FileReader();
    reader.onload = function () {
        var output = document.getElementById(type + '_' + sort);
        if (lastfile.type === "application/pdf") {
            output.setAttribute("src", "https://accualigners.app/storage/images/file.png");
        } else {
            output.setAttribute("src", reader.result);
        }
    };
    reader.readAsDataURL(lastfile);
    //getting id of attcahment image
    var id = $(input).siblings('.get_id').val();

    if (id != "") {
        formData.append("image_id", id);
    }

    $.ajax({
        type: "POST",
        url: base_url + "/case/upload-attachment2",
        data: formData,
        processData: false,
        contentType: false,
        beforeSend: function () {
            ajaxLoader();
        },
        success: function (data) {
            $('#loader').fadeOut();
            $.each(data['data'], function (key, value) {
                Attachment_Ids.push(value.id);
            });
            console.log(Attachment_Ids);
            toastr.success('Success Message', 'Pictures Uploaded Successfully', {timeOut: 2000});
            // var attachment_ids_field = $('#attachment_ids');
            // var attachment_ids = attachment_ids_field.val();
            // attachment_ids_field.val((attachment_ids != "" ? attachment_ids+','+id : id));
        },
        error: function (message, error) {
            $('#loader').fadeOut();
            $.each(message['responseJSON'].errors, function (key, value) {
                toastr.error('Error Message', value, {timeOut: 3000});
            });
        }
    });


}

/*_________________________preview img_________________________*/
function preViewImage3(input) {
    //getting values in variables
    // var file= [];
    // var file = input.files[0];

    var fileInput = $('#upload_attach')[0];
    var files = fileInput.files;
    var sort = $(input).data('sort');
    var type = $(input).data('type');

    //appending form
    formData = new FormData();
    formData.append("_token", '{{csrf_token()}}');
    formData.append("case_id", case_id);
    // formData.append("attachment[]", file);

    for (var i = 0; i < files.length; i++) {
        formData.append("attachment[]", files[i]);
    }
    formData.append("sort_order", sort);
    formData.append("attachment_type", type);

    //preview image on front
    var reader = new FileReader();
    reader.onload = function () {
        var output = document.getElementById(type + '_' + sort);
        output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);

    $.ajax({
        type: "POST",
        url: base_url + "/case/upload-attachment2",
        data: formData,
        processData: false,
        contentType: false,
        beforeSend: function () {
            ajaxLoader();
        },
        success: function (data) {
            $('#loader').fadeOut();
            var id = data['data']['id']
            toastr.success('Success Message', 'Picture Uploaded Successfully', {timeOut: 2000});
            var attachment_ids_field = $('#attachment_ids');
            var attachment_ids = attachment_ids_field.val();
            attachment_ids_field.val((attachment_ids != "" ? attachment_ids + ',' + id : id));
        },
        error: function (message, error) {
            $('#loader').fadeOut();
            $.each(message['responseJSON'].errors, function (key, value) {
                toastr.error('Error Message', value, {timeOut: 3000});
            });
        }
    });


}


//onchange image
function preViewJawImage(input) {
    //getting values in variables
    var sort = $(input).data('sort');
    var type = $(input).data('type');

    var file = input.files[input.files.length - 1];
    //preview image on front
    var reader = new FileReader();
    reader.onload = function () {
        var output = document.getElementById(type + '_' + sort);
        var imgShow = document.getElementById('imgShow' + sort);
        if (file.type === "application/pdf") {
            output.setAttribute("src", "https://accualigners.app/storage/images/file.png");
            imgShow.setAttribute("src", "https://accualigners.app/storage/images/file.png");
        } else {
            output.setAttribute("src", reader.result);
            imgShow.setAttribute("src", reader.result);
        }
    };
    reader.readAsDataURL(file);

}

//onchange select
function saveJawImage(select, i, is) {

    ($(select).val() == 1) ? (type = 'UPPER_JAW') : (type = 'LOWER_JAW');
    var input = document.getElementById('jaw_' + i);
    var sort = $(input).data('sort');

    if (is) {
        var invertype = (i == 1) ? 2 : 1;
        var selectval = '<option selected="" value="" style="font-size: 10px;">Select Jaw</option>';
        selectval += ($(select).val() == 1) ?
            '<option value="2" style="font-size: 10px;">Lower</option>'
            :
            '<option value="1" style="font-size: 10px;">Upper</option>';
        $('#select' + invertype).html(selectval);
        $('#select' + invertype).attr('onchange', "saveJawImage(this," + invertype + ",false)");
    }


    //appending form
    var id = $("#ElementId").val();
    if ((typeof $('#jaw_' + i)[0].files[0] === 'undefined') && (id === 'undefined')) {
        toastr.error('Error MEssage', 'Please Upload Image First', {timeOut: 3000});

    }
    for (var j = 0; j < $('#jaw_' + i)[0].files.length; j++) {


        formData = new FormData();
        formData.append("_token", '{{csrf_token()}}');
        formData.append("case_id", case_id);
        formData.append("attachment", $('#jaw_' + i)[0].files[j]);
        formData.append("sort_order", sort);
        formData.append("attachment_type", type);
        formData.append("case_id", id);
        jawImageAJAX(formData, id);
    }

}

function jawImageAJAX(formData, id = '') {
    $.ajax({
        type: "POST",
        url: base_url + "/case/upload-attachment",
        data: formData,
        processData: false,
        contentType: false,
        beforeSend: function () {
            ajaxLoader();
        },
        success: function (data) {
            $('#loader').fadeOut();
            var id = data['data']['id']
            toastr.success('Success Message', 'Picture Uploaded Successfully', {timeOut: 2000});
            var attachment_ids_field = $('#attachment_ids');
            var attachment_ids = attachment_ids_field.val();
            attachment_ids_field.val((attachment_ids != "" ? attachment_ids + ',' + id : id));
        },
        error: function (message, error) {
            $('#loader').fadeOut();
            $.each(message['responseJSON'].errors, function (key, value) {
                toastr.error(value, {timeOut: 3000});
            });
        }
    });
}


/*____________________check all the boxes____________________*/
var chkboxes = 0;
$("#btnCheckAll").click(function () {
    if (chkboxes == 0) {
        for (i = 1; i < records1; i++) {
            $("#a" + i).prop('checked', true);
        }
        chkboxes = 1;
    } else {
        for (i = 1; i < records1; i++) {
            $("#a" + i).prop('checked', false);
        }
        chkboxes = 0;
    }

});


/*  _____________________Payment change_____________________  */
$('#payment_change').on('change', function () {
    var val = $(this).val();
    if (val == 'stripe') {
        $('.stripe-div').show();
        $('#pay_now_invoice').addClass('d-none');
    } else if (val == 'invoice') {
        $('.stripe-div').hide();
        $('#pay_now_invoice').removeClass('d-none');
    }
});

/*  _____________________Invoice Payment Ajax_____________________   */
$(document).on('click', '#pay_now_invoice', function (e) {
    e.preventDefault();
    var id = $('#order_case_id').val();
    var address_id = $('#address_id').val();

    if (address_id === "") {
        toastr.error('Please Select Clinic from the dropdown', {timeOut: 3000});
        return;
    }

    $.ajax({
        type: "POST",
        url: base_url + "/case/payment/invoice",
        beforeSend: function () {
            ajaxLoader();
        },
        data: {
            'id': id,
            'address_id': address_id,
        },
        success: function (data) {
            if (data.data = 'success') {
                $('#loader').fadeOut();
                toastr.success('Invoice Added Successfully', '', {timeOut: 2000});
                // $('.pop1').addClass('d-none');
                $('.pop1').fadeOut('slow');
                $('#payment').removeClass('d-none');
                //  $('#order_payment').val(data.case.processing_fee_amount);
                setTimeout(function () {
                    location.reload(true)
                }, 1000);
            } else {
                $('#loader').fadeOut();
                toastr.error('Something Went Wrong, Try Again', '', {timeOut: 2000});
            }
        },
        error: function (message, error) {
            $('#loader').fadeOut();
            $.each(message['responseJSON'].errors, function (key, value) {
                toastr.error(value, {timeOut: 3000});
            });
        }
    });
});

/*  Validation Input Fields */

$('.number_val').on('keyup', function (e) {
    var id = $(this).attr("id");
    var val = $(this).val();

    if (/^\d+$/.test(val) && val.length == 1) {
        $('#' + id).css('border', 'green 2px solid');
    } else {
        $('#' + id).css('border', 'red 2px solid');

    }
});
$('#month_year').on('keyup', function (e) {
    var id = $(this).attr("id");
    var val = $(this).val();
    var pattern = /^\d{1,2}\/\d{1,2}$/;

    if (pattern.test(val)) {
        $('#' + id).css('border', 'green 2px solid');
    } else {
        $('#' + id).css('border', 'red 2px solid');
    }
});

$('#csv').on('keyup', function (e) {
    var id = $(this).attr("id");
    var val = $(this).val();
    var pattern = /^\d+$/;
    var pattern2 = /^\d{3,4}$/;

    if (pattern.test(val) && pattern2.test(val)) {
        $('#' + id).css('border', 'green 2px solid');
    } else {
        $('#' + id).css('border', 'red 2px solid');
    }
});

function changeClass(id) {
    if (id == 1) {
        $('.addka').removeClass('activecase');
        $(".removeka").addClass('activecase');
    } else if (id == 2) {
        $('.removeka').removeClass('activecase');
        $(".addka").addClass('activecase');
    }
}


/*____________________Add_Case_Validation____________________*/
function validationOfCase() {
    //name validation
    var nameRegex = /^[a-zA-Z]+(([',. -][a-zA-Z ])?[a-zA-Z]*)*$/;
    var nameInput = $('input[name="name"]');
    var name = nameInput.val();
    if (!nameRegex.test(name)) {
        nameInput.css('border', '2px solid red');
        $('#name_v_msg').text('Name format not valid!');
        toastr.error('Name not given or format not valid!!', 'Validation Error', {timeOut: 5000});
        return false;
    } else {
        $('#name_v_msg').text('');
        nameInput.css('border', '1px solid #ced4da');
    }
    //clinical_comment
    if ($('#clinical_comment').val() == '') {
        $('#clinic_msg').text('Clinical comment cannot be left blank!');
        toastr.error('Clinical comment not given!', 'Validation Error', {timeOut: 5000});
        return false;
    } else {
        $('#clinic_msg').text('');
    }
    //Prescription Comment
    if ($('#prescription_comment').val() == '') {
        $('#prescription_msg').text('Prescription comment cannot be left blank!');
        toastr.error('Prescription comment not given!', 'Validation Error', {timeOut: 5000});
        return false;
    } else {
        $('#prescription_msg').text('');
    }

     //Additional Comment
     if ($('#additional_comment').val() == '') {
        $('#additional_msg').text('Additional comment cannot be left blank!');
        toastr.error('Additional comment not given!', 'Validation Error', {timeOut: 5000});
        return false;
    } else {
        $('#additional_msg').text('');
    }

    if($("#ElementId").val() == '') {
        //Image Attachment
        if ($('.image_attach').attr('src') == '') {
            toastr.error('Please attach Image atleast one image', 'Validation Error', {timeOut: 5000});
            return false;
        }
        // Jaw Scan(Upper/Lower)
        if ($('#select1').val() == '') {
            toastr.error('Please Select Jaw Scan(Upper/Lower) Image at least one image', 'Validation Error', {timeOut: 5000});
            return false;
        }
        // Jaw Scan(Upper/Lower)
        if ($('#select2').val() == '') {
            toastr.error('Please Select Image Jaw Scan(Upper/Lower) at least one image', 'Validation Error', {timeOut: 5000});
            return false;
        }
    }
    return true;
}

/*__________________validation on input___________*/

//phone number validation
var phoneRegex = /^\+?[0-9]{11,14}$/;
var phoneInput = $('input[name="phone_no"]');
phoneInput.on('input', function () {
    var phone = phoneInput.val();
    if (!phoneRegex.test(phone)) {
        phoneInput.css('border', '2px solid red');
        $('#phone_v_msg').text('Format not valid!');
    } else {
        phoneInput.css('border', '1px solid #ced4da');
        $('#phone_v_msg').text('');
    }
});

//email validation
var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
var emailInput = $('input[name="email"]');
emailInput.on('input', function () {
    var email = emailInput.val();
    if (!emailRegex.test(email)) {
        emailInput.css('border', '2px solid red');
        $('#email_v_msg').text('Email format not valid!');
    } else {
        emailInput.css('border', '1px solid #ced4da');
        $('#email_v_msg').text('');
    }
});

/*____________________Add_Case_Reset____________________*/
function resetAddCase() {

    $('#name, #email,#phone_no,#dob,#address,#clinical_comment,#prescription_comment,#embedded_url').val('');
    $('#arch_to_treat,#a_p_relationship,#overjet,#overbite,#midline').parent().addClass('btn-outline-secondary off').removeClass('btn-outline-primary');
    $('#arch_to_treat,#a_p_relationship,#overjet,#overbite,#midline,#conidion1,#conidion2,#conidion3,#conidion4,#conidion5,#conidion6,#conidion7').prop('checked', false);
    $('#X_RAY_1,#X_RAY_2,#UPPER_JAW_1,#LOWER_JAW_2,#OTHER_1,#OTHER_2,#imgShow1,#imgShow2').attr('src', 'https://accualigners.app/link/files/app-assets/images/case/upload.png');
    manageAddImage = 2;
    for (var a = 1; a <= 10; a++) {
        if (a != 1) {
            $(".add_new_" + a).addClass('d-none');
        }
        var src = $('#img_src_' + a).val();
        $('#IMAGE_' + a).attr('src', src)
    }
}

/*____________________Add_Case_image fields____________________*/

$(".add_image").click(function () {
    if (manageAddImage == 1) {
        manageAddImage = 2;
    }
    if (manageAddImage != 10) {
        $(".add_new_" + manageAddImage).removeClass('d-none');
        manageAddImage++;
    } else {
        toastr.error("Image limit Exceeded", "Limit Exceeded", {timeOut: 3000});
    }
    b = 1;
});
/*____________________Add_Case_image fields____________________*/

$(".remove_image").click(function () {
    if (b == 1) {
        manageAddImage = manageAddImage - 1;
    }
    if (manageAddImage == 1) {
        toastr.error("One Image must be attached", "Message", {timeOut: 3000});
    } else {
        $(".add_new_" + manageAddImage).addClass('d-none');
        $("#IMAGE_" + manageAddImage).attr("src", 'https://accualigners.app/link/files/app-assets/images/case/upload.png');
        manageAddImage--;
    }
    b = 2;

    //getting id of attcahment image
    var id = $("#img_id_" + manageAddImage).val();
    if (id != "") {
        var data = {
            id: id
        };

        $.ajax({
            type: "POST",
            url: base_url + "/delete_attachment",
            data: data,
            beforeSend: function () {
                ajaxLoader();
            },
            success: function (data) {
                $('#loader').fadeOut();
                if (data.done == true) {
                    toastr.success(data.message, '', {timeOut: 2000});
                } else {
                    toastr.error(data.message, '', {timeOut: 2000});
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
