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
