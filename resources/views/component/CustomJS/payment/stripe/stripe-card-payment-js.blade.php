<script src="https://js.stripe.com/v3/"></script>
<script>
    // Create a Stripe client.
    var stripe = Stripe(`{{ env('STRIPE_KEY') }}`);

    // Create an instance of Elements.
    var elements = stripe.elements();
    

    // Custom styling can be passed to options when creating an Element.
    var style = {
        base: {
            color: '#32325d',
            fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
            fontSmoothing: 'antialiased',
            fontSize: '16px',
            '::placeholder': {
                color: '#aab7c4'
            }
        },
        invalid: {
            color: '#fa755a',
            iconColor: '#fa755a'
        }
    };

    // Create an instance of the card Element.
    var card = elements.create('card', {
        style: style
    });

    // Add an instance of the card Element into the `card-element` <div>.
    card.mount('#card-element');
    // Handle real-time validation errors from the card Element.
    card.on('change', function(event) {
        var displayError = document.getElementById('card-errors');
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = '';
        }
    });

    // Handle form submission.
    var $form = document.getElementById('stripe-payment');
    $form.addEventListener('submit', function(event) {
        event.preventDefault();
        stripe.createToken(card).then(function(result) {
            if (result.error) {
                // Inform the user if there was an error.
                var errorElement = document.getElementById('card-errors');
                errorElement.textContent = result.error.message;
            } else {
                console.log(result.token);
                $('<input>', {
                    type: 'hidden',
                    id: 'stripeToken',
                    name: 'stripeToken',
                    value: result.token.id
                }).appendTo($form);
                 document.getElementById("stripe-payment").submit();
            }
        });
    });

    $(document).ready(function() {
        // $(".stripeDiv").css("display", "none");
        
        $(".invoiceDiv").css("display", "none");
        $('.paymentSelect').on('change', function() {
            //   alert( this.value );
            //   $(".invoiceDiv").css("display", "block");
            if (this.value == "invoice") {
                console.log("INVOICE");
                $(".stripeDiv").css("display", "none");
                $(".invoiceDiv").css("display", "block");
            } else {
                console.log("STRIPE");
                $(".stripeDiv").css("display", "block");
                $(".invoiceDiv").css("display", "none");
            }

        });
    })
</script>
