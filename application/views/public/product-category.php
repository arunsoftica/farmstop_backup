
<div class="row" style="padding-left:50px;">
<?php

foreach($variation as $var){ ?>



<div class="col-md-4">
	<?php
        $minPrice = $model2->getMinPrice($var['id']);


	 ?>
	<a href="<?php echo base_url('product/'.$var['attribute_slug']) ?>">
	<p><?php echo '<b>'.$var['attribute_name'].'</b>' ?></p>
    <p><?php echo 'Price: '.$minPrice['sp'].' Rs.' ?></p>
    
	</a>
	<p><button type="button" class="btn btn-info">Add to Cart</button></p>
</div>

<?php }

?>
</div>

