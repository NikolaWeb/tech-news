<div class="container text-center">
<h1>Checkout</h1>
  <div class="row">
	<div class='col-md-6 text-left'>
          <script src='https://js.stripe.com/v2/' type='text/javascript'></script>
          <form accept-charset="UTF-8" action="/" class="require-validation form-signin" data-cc-on-file="false" data-stripe-publishable-key="pk_bQQaTxnaZlzv4FnnuZ28LFHccVSaj" id="payment-form" method="post"><div style="margin:0;padding:0;display:inline"><input name="utf8" type="hidden" value="✓" /><input name="_method" type="hidden" value="PUT" /><input name="authenticity_token" type="hidden" value="qLZ9cScer7ZxqulsUWazw4x3cSEzv899SP/7ThPCOV8=" /></div>
            <div class='form-row'>
              <div class='col-xs-12 form-group required'>
                <label class='control-label sr-only'>Name on Card</label>
                <input class='form-control' size='4' type='text' placeholder="Name on card">
              </div>
            </div>
            <div class='form-row'>
              <div class='col-xs-12 form-group card required'>
                <label class='control-label sr-only'>Card Number</label>
                <input autocomplete='off' class='form-control card-number' size='20' type='text' placeholder="Card number">
              </div>
            </div>
            <div class='form-row'>
              <div class='col-xs-4 form-group cvc required'>
                <label class='control-label sr-only'>CVC</label>
                <input autocomplete='off' class='form-control card-cvc' placeholder='CVC (ex. 311)' size='4' type='text' placeholder="CVC">
              </div>
              <div class='col-xs-4 form-group expiration required'>
                <label class='control-label sr-only'>Expiration</label>
                <input class='form-control card-expiry-month' placeholder='MM' size='2' type='text' placeholder="Expiration">
              </div>
              <div class='col-xs-4 form-group expiration required'>
                <label class='control-label sr-only'>Expiry year</label>
                <input class='form-control card-expiry-year' placeholder='YYYY' size='4' type='text'>
              </div>
            </div>
            <div class='form-row'>
              <div class='col-md-12'>
                <div class='text-info total'>
                  Total:
				  <?php
						$total = 0;  
						foreach($_SESSION["shopping_cart"] as $keys => $values){
							$total = $total + ($values["item_price"]);
						}
					?>
                  <span class='amount'>$ <?php echo number_format($total, 2); ?></span>
                </div>
              </div>
            </div>
            <div class='form-row'>
              <div class='col-md-12 form-group'>
                <button class='form-control btn btn-primary submit-button' type='submit'>Pay »</button>
              </div>
            </div>
            <div class='form-row'>
              <div class='col-md-12 error form-group hide'>
                <div class='alert-danger alert'>
                  Please correct the errors and try again.
                </div>
              </div>
            </div>
          </form>
        </div>
	<div class="col-md-6">
		<?php   
			
		?>
		<div class="table-responsive">  
		  <table class="table table-bordered">  
			   <tr> <th width="10%">Thumbnail</th>   
					<th width="55%">Item Name</th>  
					
					<th width="20%">Price</th>  
					<th width="5%">Action</th>  
			   </tr>
		<?php
				 $total = 0;  
				 foreach($_SESSION["shopping_cart"] as $keys => $values)  {
		?>  
		
			   <tr>  
					<td><img class="img-thumbnail" src="<?php echo $values["item_image"]; ?>" /></td>  
					<td><?php echo $values["item_name"]; ?></td>  
				   
					<td>$ <?php echo $values["item_price"]; ?></td>  
					
					<td><a class="del-item" href="../index.php?page=5&action=delete&id=<?php echo $values["><span class="text-danger">Remove</span></a></td>  
			   </tr>  
			   <?php  
						 $total = $total + ($values["item_price"]);  
				  }  
			   ?>  
			   <tr>  
					<td colspan="3" align="right">Total</td>
					<td align="right">$ <?php echo number_format($total, 2); ?></td>  
					
			   </tr>  
			   
		  </table>  
		</div>
	</div>
  </div>
</div>
<script>
$(function() {
  $('form.require-validation').bind('submit', function(e) {
    var $form         = $(e.target).closest('form'),
        inputSelector = ['input[type=email]', 'input[type=password]',
                         'input[type=text]', 'input[type=file]',
                         'textarea'].join(', '),
        $inputs       = $form.find('.required').find(inputSelector),
        $errorMessage = $form.find('div.error'),
        valid         = true;

    $errorMessage.addClass('hide');
    $('.has-error').removeClass('has-error');
    $inputs.each(function(i, el) {
      var $input = $(el);
      if ($input.val() === '') {
        $input.parent().addClass('has-error');
        $errorMessage.removeClass('hide');
        e.preventDefault(); // cancel on first error
      }
    });
  });
});

$(function() {
  var $form = $("#payment-form");

  $form.on('submit', function(e) {
    if (!$form.data('cc-on-file')) {
      e.preventDefault();
      Stripe.setPublishableKey($form.data('stripe-publishable-key'));
      Stripe.createToken({
        number: $('.card-number').val(),
        cvc: $('.card-cvc').val(),
        exp_month: $('.card-expiry-month').val(),
        exp_year: $('.card-expiry-year').val()
      }, stripeResponseHandler);
    }
  });

  function stripeResponseHandler(status, response) {
    if (response.error) {
      $('.error')
        .removeClass('hide')
        .find('.alert')
        .text(response.error.message);
    } else {
      // token contains id, last4, and card type
      var token = response['id'];
      // insert the token into the form so it gets submitted to the server
      $form.find('input[type=text]').empty();
      $form.append("<input type='hidden' name='reservation[stripe_token]' value='" + token + "'/>");
      $form.get(0).submit();
    }
  }
})
</script>
<script language="JavaScript" src="../admin/scripts.js"></script>