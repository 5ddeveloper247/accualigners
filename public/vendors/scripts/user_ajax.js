/*_________________________Update and save ajax_________________________*/
		$("#frmuser").submit(function (event) {
			event.preventDefault();
			var data = new FormData(frmuser);
			var id = $("#ElementId").val();

/*_________________________Update ajax_________________________*/
			if(id != ''){
				
				if($('#txtname').val() === ""){
					toastr.error('Name is required', 'error', {timeOut: 2000});
					return;
				}

			   if($('#txt_roll_id').val() === ""){
				toastr.error('Roll must be Selected', 'error', {timeOut: 2000});
				return;
		    	}

			   if($('#txtemail').val() === ""){
				toastr.error('Email is required', 'error', {timeOut: 2000});
				return;

			  }
			 if($('#txtpass').val() != $('#confirm_password').val() ){
				toastr.error('Password doesnt Match', 'error', {timeOut: 2000});
				return;
			  }

 			 $.ajax({
			 type: "POST",
			 url: base_url+"/update_new_user",
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
	 }else{		
/*_________________________Save ajax_________________________*/
			$.ajax({
				type: "POST",
				url: base_url+"/user",
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
					$("#txtname").val('');
					$("#txtemail").val('');
					$("#txt_roll_id").val('first_index').prop('selected', true);
					$("#ElementId").val('');
					// $('.pop1').removeClass('d-none');
					$('.pop1').fadeIn('slow');
					$("#output").attr("src", img_asset+"/gallery.png");
					return;
		}
		$.ajax({
		type: 'GET',
		url: base_url+"/user/"+id+"/edit",
		data: {
		
		},
                 beforeSend: function(){
                  ajaxLoader();

                 },
		success: function (data) {
			$('#loader').fadeOut();
			if(data){
					$("#txtname").val(data['edit_values']['name']);
					$("#txtemail").val(data['edit_values']['email']);
					$("#txt_roll_id").val(data['edit_values']['role_id']);
					$("#ElementId").val(data['edit_values']['id']);
					$("#output").attr("src", data['edit_values']['picture']);
					// $('.pop1').removeClass('d-none');
					$('.pop1').fadeIn('slow');

			}else{
				toastr.error('some error','Error');
			}

		},
		error: function (message,error) {
			$('#loader').fadeOut();

			$.each( message['responseJSON'].errors, function( key, value ) {
				toastr.error(value, {timeOut: 3000});
			});
			// toastr.error('Something Went Wrong', 'Error');
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
				url: base_url+"/user/"+recordId,
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
			     $("#picture").click();
		 });
/*_________________________preview img_________________________*/
		$(document).on("change", "#picture", function () {
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
	