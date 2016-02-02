<!DOCTYPE html>
<html lang="en">
	<?php include "_meta.php" ?>
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="panel panel-login">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-6">
								<a href="#" class="active" id="login-form-link">Login</a>
							</div>
							<div class="col-xs-6">
								<a href="#" id="register-form-link">Register</a>
							</div>
						</div>
						<hr>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-12">
								<form id="login-form" action="../user/login.php" method="post" role="form" style="display: block;">
									<div class="form-group">
										<input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="Username" value="">
									</div>
									<div class="form-group">
										<input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password" value="">
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-sm-6 col-sm-offset-3">
												<input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Log In">
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-lg-12">
												<div class="text-center">
												</div>
											</div>
										</div>
									</div>
								</form>
								<form id="register-form" action="../user/register.php" method="post" role="form" style="display: none;" data-fv-framework="bootstrap">

									<div class="form-group">
										<input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="Username" value="">
									</div>
									<div class="form-group">
										<input type="email" name="email" id="email" tabindex="1" class="form-control" placeholder="Email Address" value="">
									</div>
									<div class="form-group">
										<input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password">
									</div>
									<div class="form-group">
										<input type="password" name="confirm-password" id="confirm-password" tabindex="2" class="form-control" placeholder="Confirm Password">
									</div>
									<div class="form-group">
										<input type="text" name="first_name" id="first_name" tabindex="2" class="form-control" placeholder="First Name">
									</div>
									<div class="form-group">
										<input type="text" name="last_name" id="last_name" tabindex="2" class="form-control" placeholder="Last Name">
									</div>
									<div class="form-group">
										<input type="text" name="address" id="address" tabindex="2" class="form-control" placeholder="Address">
									</div>
									<div class="form-group">
										<input type="text" name="credit_card" id="credit_card" tabindex="2" class="form-control" placeholder="Credit Card Number">
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-sm-6 col-sm-offset-3">
												<input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Register Now">
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php include "_footer.php" ?>
</body>
<script type="text/javascript">
	$(document).ready(function() {
    $('#register-form')
        .formValidation({
            framework: 'bootstrap',
            icon: {
                valid: 'fa fa-check',
                invalid: 'fa fa-times',
                validating: 'fa fa-refresh'
            },
            fields: {
                cardType: {
                    validators: {
                        notEmpty: {
                            message: 'The type is required'
                        }
                    }
                },
                credit_card: {
                    validators: {
                        notEmpty: {
                            message: 'The credit card number is required'
                        },
                        creditCard: {
                            message: 'The credit card number is not valid'
                        }
                    }
                }
            }
        })
        .on('success.validator.fv', function(e, data) {
            // data.field     ---> The field name
            // data.validator ---> The validator name
            // data.fv        ---> The plugin instance

            // Whenever user changes the card type,
            // we need to revalidate the credit card number
            if (data.field === 'cardType') {
                data.fv.revalidateField('credit_card');
            }

            if (data.field === 'credit_card' && data.validator === 'creditCard') {
                // data.result.type can be one of
                // AMERICAN_EXPRESS, DINERS_CLUB, DINERS_CLUB_US, DISCOVER, JCB, LASER,
                // MAESTRO, MASTERCARD, SOLO, UNIONPAY, VISA

                var currentType = null;
                switch (data.result.type) {
                    case 'AMERICAN_EXPRESS':
                        currentType = 'Ae';         // Ae is the value of American Express card in the select box
                        break;

                    case 'MASTERCARD':
                    case 'DINERS_CLUB_US':
                        currentType = 'Master';     // Master is the value of Master card in the select box
                        break;

                    case 'VISA':
                        currentType = 'Visa';       // Visa is the value of Visa card in the select box
                        break;

                    default:
                        break;
                }

                // Get the selected type
                var selectedType = data.fv.getFieldElements('cardType').val();
                if (selectedType && currentType !== selectedType) {
                    // The credit card type doesn't match with the selected one
                    // Mark the field as not valid
                    data.fv.updateStatus('credit_card', data.fv.STATUS_INVALID, 'creditCard');
                }
            }
        });
});

</script>
</html>
