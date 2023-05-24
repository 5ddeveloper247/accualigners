<style>
        /**
            * The CSS shown here will not be introduced in the Quickstart guide, but shows
            * how you can use CSS to style your Element's container.
            */
        .StripeElement {
            box-sizing: border-box;

            height: 40px;
            width: 100%;
            padding: 10px 12px;

            border: 1px solid transparent;
            border-radius: 4px;
            background-color: #e6ebf1;

            box-shadow: 0 1px 3px 0 #e6ebf1;
            -webkit-transition: box-shadow 150ms ease;
            transition: box-shadow 150ms ease;
        }

        .StripeElement--focus {
            box-shadow: 0 1px 3px 0 #cfd7df;
        }

        .StripeElement--invalid {
            border-color: #fa755a;
        }

        .StripeElement--webkit-autofill {
            background-color: #fefde5 !important;
        }

        #card-errors {
            color: orangered
        }
</style>
<section class="createCard" id="createCard">
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">Card Detail</h4>
					<a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
        			<div class="heading-elements">
						<ul class="list-inline mb-0">
							<li><a data-action="collapse"><i class="ft-minus"></i></a></li>
							<li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
							<li><a data-action="expand"><i class="ft-maximize"></i></a></li>
							<li><a data-action="close"><i class="ft-x"></i></a></li>
						</ul>
					</div>
				</div>
				<div class="card-content">
					<div class="card-body">
                            
                            
                            <div class="row">
                                 
                                        
                                    
                                        <!--<div class="col-xl-6 col-lg-12">-->
                                        <!--    <div class='card-wrapper'></div>-->
                                        <!--</div>-->
                                        <!--<div class="col-xl-6 col-lg-12">-->
                                        <!--        <fieldset class="mb-1">-->
                                        <!--            <h5>Card Number</h5>-->
                                        <!--            <div class="form-group">-->
                                        <!--                <input type="text" class="form-control card-number" name="number" id="card-number" maxlength="19" placeholder="Card Number">-->
                                        <!--            </div>-->
                                        <!--        </fieldset>-->
                                        <!--        <fieldset class="mb-1">-->
                                        <!--            <h5>Card Name</h5>-->
                                        <!--            <div class="form-group">-->
                                        <!--                <input type="text" class="form-control card-name " name="name" id="card-name" placeholder="Card Holder Name">-->
                                        <!--            </div>-->
                                        <!--        </fieldset>-->
                                        <!--        <div class="row">-->
                                        <!--            <div class="col-md-6">-->
                                        <!--                <fieldset class="mb-1">-->
                                        <!--                    <h5>Expiry Date</h5>-->
                                        <!--                    <div class="form-group">-->
                                        <!--                        <input type="text" class="form-control card-expiry" name="expiry" id="card-expiry" placeholder="Card Expiry Date">-->
                                        <!--                    </div>-->
                                        <!--                </fieldset>-->
                                        <!--            </div>-->
                                        <!--            <div class="col-md-6">-->
                                        <!--                <fieldset class="mb-1">-->
                                        <!--                    <h5>Card Number</h5>-->
                                        <!--                    <div class="form-group">-->
                                        <!--                        <input type="text" class="form-control card-cvc" name="cvc" id="card-cvc" maxlength="16" placeholder="Card CVC Number">-->
                                        <!--                    </div>-->
                                        <!--                </fieldset>-->
                                        <!--            </div>-->
                                        <!--        </div>-->
                                        <!--</div>-->
                                        
                                            <div class="col-xl-6 col-lg-12">
                                                <div id="card-element">
                                                    <!-- A Stripe Element will be inserted here. -->
                                                </div>
                                                <!-- Used to display Element errors. -->
                                                <div id="card-errors" role="alert"></div>
                                            </div>
                                        
                                        
                                    
                            </div>
                            
                            

                            <div class="form-actions">
                                <button class="btn btn-success btn-lg btn-block col-6 mx-auto" type="submit">Pay Now</button>
                            </div>

					</div>
				</div>
			</div>
		</div>
	</div>
</section>