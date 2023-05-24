<script type="text/javascript" src="https://js.stripe.com/v2/"></script>

<script type="text/javascript">
    $(function () {
        var $form = $(".stripe-payment");
        $('form.stripe-payment').bind('submit', function (e) {
            var $form = $(".stripe-payment"),
                inputVal = ['input[type=email]', 'input[type=password]',
                    'input[type=text]', 'input[type=file]',
                    'textarea'
                ].join(', '),
                $inputs = $form.find('.required').find(inputVal),
                $errorStatus = $form.find('div.error'),
                valid = true;
            $errorStatus.addClass('hide');

            $('.has-error').removeClass('has-error');
            $inputs.each(function (i, el) {
                var $input = $(el);
                if ($input.val() === '') {
                    $input.parent().addClass('has-error');
                    $errorStatus.removeClass('hide');
                    e.preventDefault();
                }
            });

            if (!$form.data('cc-on-file')) {
                e.preventDefault();
                var cardExp = $('.card-expiry').val().split(" / ");
                var exp_month = cardExp[0];
                var exp_year = cardExp[1];
                Stripe.setPublishableKey($form.data('stripe-publishable-key'));
                Stripe.createToken({
                    number: $('.card-number').val(),
                    cvc: $('.card-cvc').val(),
                    exp_month: 12,
                    exp_year: 34
                }, stripeRes);
            }

            $.unblockUI();
            $(this).find("button[type='submit']").prop('disabled',false);

        });

        function stripeRes(status, response) {
            
            console.log(response);
            if (response.error) {
                /*$('.error')
                    .removeClass('hide')
                    .find('.alert')
                    .text(response.error.message);*/
                toastr.error(response.error.message,"Error!",{positionClass:"toast-bottom-left",containerId:"toast-bottom-left"});

            } else {
                var token = response['id'];
                $form.find('input[type=text]').empty();
                $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                // window.location.href="https://patient.wooloh.com/doctor";
                $form.get(0).submit();
            }
        }

    });
    
    $(document).ready(function(){
        // $(".stripeDiv").css("display", "none");
            $(".invoiceDiv").css("display", "none");
            
            $('.paymentSelect').on('change', function() {
            //   alert( this.value );
            //   $(".invoiceDiv").css("display", "block");
              
              if(this.value == "invoice"){
                  console.log("INVOICE");
                  $(".stripeDiv").css("display", "none");
                  $(".invoiceDiv").css("display", "block");
              }else{
                  console.log("STRIPE");
                  $(".stripeDiv").css("display", "block");
                  $(".invoiceDiv").css("display", "none");
              }
              
            });
    })

</script>
