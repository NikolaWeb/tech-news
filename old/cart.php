<div class="container text-center">
<h1>Cart</h1>
  <div class="row">
  
    <?php   
        if(!empty($_SESSION["shopping_cart"])):
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
                
                <td><a data-id="<?php echo $values["id_product"]; ?>" class="del-item" href="#"><span class="text-danger">Remove</span></a></td>
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
  <div class="row">
	<a href="?page=checkout" class="btn btn-lg btn-primary btn-block">Proceed to checkout</a>
  </div>
  <?php else: ?>
  <div class="row">
	<h2>Your cart is now empty :(</h2>
	<h3 class="glyphicon glyphicon-shopping-cart"></h3>
  </div>
  <?php endif; ?>
  
</div>
</div>
