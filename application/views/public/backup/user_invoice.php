<section style="background: #9999990d;padding: 10px;">
<div class="sec-pay">
	<div id="container">
       <section id="memo">
            <div class="company-info">
              <span class="company-name" style="margin-top: 40px;"><img src="https://cdn.shortpixel.ai/client/to_webp,q_glossy,ret_img/https://www.softica.in/wp-content/uploads/2018/10/logo-1.png" width="181" /></span>
              <div class="separator less"></div>
            </div>
            <div class="" style="float: right;margin-top: 42px;margin-right: 25px;">
            <div class="separator"></div>
             <span class="company-address">138 A, Vikas Nagar,</span>
                <div class="separator"></div>
              <span > Kanpur 
    Uttar Pradesh, India - 208024</span>
              <div class="separator"></div>
              <span class="company-email">info@softica.co.in</span>
              <div class="separator"></div>
              <span class="company-mobile" >+91-8953729555</span>
              <div class="separator"></div>
            </div>
            <span style="position: absolute;color: #fff;font-size: 34px;width: 265px;right: -61px;
    transform: rotate(40deg);height: 52px;background: #97c764;border: 2px solid #97c764;
    line-height: 49px;text-align: center;"><?php if($invoice_details['status'] == 0) echo 'Unpaid'; else echo 'Paid'; ?></span>
       </section>
       	  <div class="clearfix"></div>			
       <section id="invoice-title-number">
            <span class="invoice_title">INVOICE  <span class="invoice-number">#<?php echo $invoice_details['oid']; ?></span></span>
            <div class="separator"></div>
            <span>Invoice Date: <?php echo date("l dS F,Y", strtotime($invoice_details['date'])); ?></span>
            
       </section>
          <div class="clearfix"></div>
       <section id="client-info">
            <span style="font-weight: bold;">Bill to: </span>
        <div>
          <span><?php echo $invoice_details['uaddress'] ?></span>
        </div>
        
        <div>
          <span><?php echo $invoice_details['udistrict'].' India,'.$invoice_details['uzipcode']; ?>
        </div>
        <div>
          <span><?php echo $get_user_details['name'];  ?></span>
        </div>
        
        <div>
          <span><?php echo $get_user_details['mobile'] ?></span>
        </div>
        
        <div>
          <span><?php echo $get_user_details['email'] ?></span>
        </div>
       </section>
          <div class="clearfix"></div>
       <section id="items-success">
            <table class="table-responsive" cellpadding="0" cellspacing="0">
            
              <tbody><tr>
                <th>S.No </th> 
                <th>Item</th>
                <th>Quantity</th>
                 <th>Price</th>
                
              </tr>
              <?php
           $count = 0;
          foreach($get_cart_items as $get_cart_item){
          ?>
              <tr data-iterate="item" style="">
                <td><span><?php echo $count = $count+1; ?></span></td> 
            <td><span><?php echo $get_cart_item['attributename'].'('.$get_cart_item['attribute_value'].')' ?></span></td>
            <td><span><?php echo $get_cart_item['total_item'] ?></span></td>
            <td><span><?php echo $get_cart_item['saleprice']*$get_cart_item['total_item'] ?></span></td>
              </tr>
              <?php } ?>
            </tbody></table>
       </section>
       	  <div class="clearfix"></div>
       <section id="sums">
            <table class="table-responsive" cellpadding="0" cellspacing="0">
          <tbody><tr>
            <th>Subtotal:</th>
            <td><?php echo $invoice_details['sub_total_cost'] ?></td>
          </tr>
          
          <tr>
            <th>Shipping:</th>
            <td><?php echo $invoice_details['shipping_cost'] ?></td>
          </tr>
          
          <tr class="amount-total">
            <th>Total:</th>
            <td><?php echo $invoice_details['total_cost'] ?></td>
          </tr>
          
          <tr>
            <th><?php if($invoice_details['status'] == 0) echo 'Unpaid'; else echo 'Paid'; ?>:</th>
            <td><?php echo $invoice_details['total_cost'] ?></td>
          </tr>
          
          
          
        </tbody></table>
       </section>
          <div class="clearfix"></div>
       <section id="items-success">
            <!--span style="font-weight: bold;">Indicates a taxed Item.</span-->
            <div>
            <table class="table-responsive" cellpadding="0" cellspacing="0">
        
          <tbody><tr>
            <th>Transaction Date</th> 
            <th>Payment Method</th>
            <th>Transaction Id</th>
             <th>Amount</th>
          </tr>
         
          <tr data-iterate="item" style="">
            <td><span><?php 
          echo date("l dS F,Y", strtotime($invoice_details['date'])); ?></span></td> 
            <td><span><?php
            if($invoice_details['payment_option'] == '1' || $invoice_details['payment_option'] == '4'){
                echo 'Credit Card/Debit Card/NetBanking';
            }else if($invoice_details['payment_option'] == '2'){
                echo 'Cash on delivery';
            }
            
            ?></span></td>
            <td><span><?php 
          echo $invoice_details['transaction_id']; ?></span></td>
            <td><span><?php echo $invoice_details['total_cost'] ?></span></td>
          </tr>
          
        </tbody></table>
            
            </div>
            
          </section>

    </div>
</div>
</section>
<style>
@import url("https://fonts.googleapis.com/css?family=PT+Sans:400,700&subse=latin,latin-ext,cyrillic,cyrillic-ext");
.separator {height: 7px;}
.separator.less {height: 10px !important;}
.sec-pay{font-family: "Open Sans","Helvetica Neue",Helvetica,Arial,Sans-serif;background: white;
width: 100%;max-width: 649px;min-height: 1069px;margin: 30px auto 30px auto;-moz-box-shadow: 0px 0px 20px rgba(80,80,80,0.7);-webkit-box-shadow: 0px 0px 20px rgba(80,80,80,0.7);box-shadow: 0px 0px 20px rgba(80,80,80,0.7);}
#container {overflow:hidden;font: normal 14px/1.4em 'PT Sans', Sans-serif;margin: 0 auto;padding:25px 45px;min-height: 1058px;position: relative;}#memo {min-height: 100px;}#memo .logo {float: left;margin-right: 20px;}#memo .logo img {width: 150px;height: 100px;}#memo .company-info {float:left;margin-top: 8px;max-width: 515px;}#memo .company-info span {color: #888;display:inline-block;min-width: 15px;}#memo .company-info > span:first-child {color: black;font-weight: bold;font-size: 28px;line-height: 1em;}#memo:after {content: '';display: block;clear: both;}
#invoice-title-number .invoice_title {font-size: 20px;color: #396E00;}#invoice-title-number span {display: inline-block;min-width: 15px;line-height: 1em;}#invoice-info {float: left;margin-top: 20px;}#invoice-info > div {float: left;}#invoice-info > div > span {display: block;min-width: 100px;min-height: 18px;margin-bottom: 3px;}#invoice-info > div:last-child {margin-left: 10px;}
#invoice-info:after {content: '';display: block;clear: both;}#client-info {margin-top: 9px;margin-right: 51px;}#client-info > div {margin-bottom: 3px;}#client-info span {display: block;}
#client-info .client-name {font-weight: bold;}#invoice-title-number {
float: left;margin: 20px 0 20px 0;padding:10px;background:#00000012;width:100%;} #invoice-title-number span {display: inline-block;min-width: 15px;line-height: 1em;}#invoice-title-number #title {font-size: 50px;color: #396E00;}#invoice-title-number #number {
font-size: 22px;}#items-success {margin-top: 40px;}#items-success table {border-collapse: separate;width: 100%;}#items-success table th span:empty, #items-success table td span:empty {
display: inline-block;}#items-success table th {font-weight: bold;padding: 10px;border-bottom: 2px solid #898989;}#items-success table th:nth-child(2) {width: 30%;text-align: left;}#items-success table td {border-bottom: 1px solid #C4C4C4;padding: 10px;}#items-success table td:first-child {text-align: left;}#items-success table td:nth-child(2) {text-align: left;}#sums {float: right;margin-top: 10px;page-break-inside: avoid;}#sums table tr th, #sums table tr td {
min-width: 100px;padding: 10px;text-align: right;}#sums table tr th {text-align: left;padding-right: 25px;}#sums table tr.amount-total th {text-transform: uppercase;color: #396E00;}
#sums table tr.amount-total th, #sums table tr.amount-total td {font-weight: bold;font-size: 16px;border-top: 2px solid #898989;}#sums table tr:last-child th {text-transform: uppercase;color: #396E00;}#sums table tr:last-child th, #sums table tr:last-child td {font-size: 16px;font-weight: bold;}#terms {margin-top: 80px;page-break-inside: avoid;}#terms > span {font-weight: bold;}
#terms > div {color: #396E00;font-size: 16px;min-height: 70px;width: 100%;max-width: 500px;}
.payment-info-invoice {color: #888;font-size: 12px;margin-top: 20px;width: 100%;max-width: 440px;}.payment-info-invoice div {display: inline-block;min-width: 15px;}
.show-mobile {
display: none !important;
}
@media print {
.ib_invoicebus_fineprint {
text-align: left;
text-indent: 65px;
}
}
	</style>
