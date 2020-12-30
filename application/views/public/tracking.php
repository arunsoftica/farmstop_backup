<style>
    .disactive{}
    #tracking-order li.disactive:before {
    font-family: FontAwesome;
    content: "\f00d";
}
    #tracking-order li.disactive:before, #tracking-order li.disactive:after {
    background: #F44336;
}
</style>
<section class="bg-light heading-bar">
	<div class="container">
        <div class="row">
        	<div class="col-sm-12">
            	<h2>Track your Order</h2>
            </div>
        </div>
    </div>
</section>
<div class="container px-1 px-md-4 py-5 mx-auto">
    <div class="row d-flex justify-content-between px-3 top">
            <div class="d-flex">
                <h5>Order Number <span class="text-primary font-weight-bold"><?php echo $invoice_details['oid'] ?></span></h5>
            </div>
            <div class="d-flex flex-column text-sm-right">
                <h5>Cash on Delivery: Rs. <?php echo $invoice_details['total_cost'] ?></h5>
                <?php if($invoice_details['order_status'] != 5){ ?>
                <p class="mb-0">Expected Arrival <span><?php echo $invoice_details['delivery_date']; ?></span></p>
                <?php } ?>
            </div>
        </div> <!-- Add class 'active' to progress -->
        <div class="row d-flex justify-content-center">
            <div class="col-12">
                <ul id="tracking-order" class="text-center">
                    <li class="active step0"></li>
                    <li class="<?php if($invoice_details['order_status'] == 1 || $invoice_details['order_status'] == 3 || $invoice_details['order_status'] == 4) echo 'active'; ?> step0 <?php if($invoice_details['order_status'] == 5) echo 'disactive' ?>"></li>
                    <li class="<?php if($invoice_details['order_status'] == 3 || $invoice_details['order_status'] == 4) echo 'active'; ?> step0"></li>
                    <li class="<?php if($invoice_details['order_status'] == 4) echo 'active'; ?> step0"></li>
                </ul>
            </div>
        </div>
        <div class="row justify-content-between top">
            <div class="col-sm-3 col-3 icon-content-track"> 
                <div class="single-benefit text-center">
                    <div class="sb-icon">
                    <img src="<?php echo base_url() ?>assets/images/order1.png" class="icon-track img-fluid">
                    </div>
                    <div class="sb-texttrack d-none d-sm-block">
                    <h6>Order Placed</h6>
                    </div>
                </div> 
            </div>
            <div class="col-sm-3 col-3 icon-content-track">
                <div class="single-benefit text-center">
                    <div class="sb-icon">
                    <img src="<?php echo base_url() ?>assets/images/order2.png" class="icon-track img-fluid">
                    </div>
                    <div class="sb-texttrack d-none d-sm-block">
                    <h6>Produce Harvested</h6>
                    </div>
                </div> 
                
            </div>
            <div class="col-sm-3 col-3 icon-content-track"> 
                <div class="single-benefit text-center">
                    <div class="sb-icon">
                    <img src="<?php echo base_url() ?>assets/images/order4.png" class="icon-track img-fluid">
                    </div>
                    <div class="sb-texttrack d-none d-sm-block">
                    <h6>Order in Transit</h6>
                    </div>
                </div> 
            </div>
            <div class="col-sm-3 col-3 icon-content-track"> 
                <div class="single-benefit text-center">
                    <div class="sb-icon">
                    <img src="<?php echo base_url() ?>assets/images/order3.png" class="icon-track img-fluid">
                    </div>
                    <div class="sb-texttrack d-none d-sm-block">
                    <h6>Order Delivered</h6>
                    </div>
                </div> 
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <p>Contact us at info@farmstop.in</p>
            </div>
        </div>
</div>