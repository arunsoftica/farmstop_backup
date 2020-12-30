
<div class="sec-pay">
<div id="container">

      <section id="memo">
       

        <div class="company-info">
          <span class="company-name"><img src="https://cdn.shortpixel.ai/client/to_webp,q_glossy,ret_img/https://www.softica.in/wp-content/uploads/2018/10/logo-1.png" width="181" /></span>
          <div class="separator less"></div>

          <span class="company-address">138 A, Vikas Nagar, Kanpur 
Uttar Pradesh</span>
          <span >India - 208024</span>

          <br>

          <span class="company-email">info@softica.co.in</span>
          <span class="company-mobile" >+91-8953729555</span>
        </div>
        <span style="float: right;color: #97c764;font-size: 34px;margin-right: 27px;margin-top: 45px;"><?php if($invoice_details['status'] == 0) echo 'Unpaid'; else echo 'Paid'; ?></span>
      </section>

      <section id="invoice-title-number">
      
        <span class="invoice_title">INVOICE</span>
        <div class="separator"></div>
        <span class="invoice-number"><?php echo '#'.$invoice_details['oid'] ?></span>
        
      </section>
      
      <div class="clearfix"></div>
      
      <section id="invoice-info">
        <div>
          <span>Invoice Date:</span>
          <span>Currency:</span>
        </div>
        
        <div>
          <span><?php 
          echo $newDate = date("d-m-Y", strtotime($invoice_details['date'])); ?></span>
          <span>Indian rupee</span>
        </div>
      </section>
      
      <section id="client-info">
        <span>Bill to: </span>
        <div>
          <span><?php echo $invoice_details['uaddress'] ?></span>
        </div>
        
        <div>
          <span><?php echo $invoice_details['udistrict'] ?>
        
        <div>
          <span><?php echo 'India,'.$invoice_details['uzipcode'] ?></span>
        </div>
        
        <div>
          <span><?php echo $get_user_details['mobile'] ?></span>
        </div>
        
        <div>
          <span><?php echo $get_user_details['email'] ?></span>
        </div>
      </section>
      
      <div class="clearfix"></div>
      
      <section id="items">
        
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
     
      <section id="items">
      
        
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

      <!--div class="bottom-circles">
        <section>
          <div>
            <div></div>
          </div>
          <div>
            <div>
              <div>
                <div></div>
              </div>
            </div>
          </div>
        </section>
      </div-->
    </div>
    </div>
    
    <style>
@import url("https://fonts.googleapis.com/css?family=PT+Sans:400,700&subset=latin,latin-ext,cyrillic,cyrillic-ext");
.separator {
height: 15px;
}
.separator.less {
height: 10px !important;
}
.sec-pay{font-family: "Open Sans","Helvetica Neue",Helvetica,Arial,Sans-serif;
background: white;
width: 100%;
max-width: 649px;
min-height: 1069px;
margin: 30px auto 30px auto;
-moz-box-shadow: 0px 0px 20px rgba(80,80,80,0.7);
-webkit-box-shadow: 0px 0px 20px rgba(80,80,80,0.7);
box-shadow: 0px 0px 20px rgba(80,80,80,0.7);}
#container {
font: normal 14px/1.4em 'PT Sans', Sans-serif;
margin: 0 auto;
padding: 25px 45px;
min-height: 1058px;
position: relative;
}

#memo {
min-height: 100px;
}
#memo .logo {
float: left;
margin-right: 20px;
}
#memo .logo img {
width: 150px;
height: 100px;
}
#memo .company-info {
float: left;
margin-top: 8px;
max-width: 515px;
}
#memo .company-info span {
color: #888;
display: inline-block;
min-width: 15px;
}
#memo .company-info > span:first-child {
color: black;
font-weight: bold;
font-size: 28px;
line-height: 1em;
}
#memo:after {
content: '';
display: block;
clear: both;
}
#invoice-title-number .invoice_title {
font-size: 50px;
color: #396E00;
}
#invoice-title-number span {
display: inline-block;
min-width: 15px;
line-height: 1em;
}

#invoice-info {
float: left;
margin-top: 20px;
}
#invoice-info > div {
float: left;
}
#invoice-info > div > span {
display: block;
min-width: 100px;
min-height: 18px;
margin-bottom: 3px;
}
#invoice-info > div:last-child {
margin-left: 10px;
}
#invoice-info:after {
content: '';
display: block;
clear: both;
}

#client-info {
float: right;
margin-top: 9px;
margin-right: 51px;
min-width: 220px;
}
#client-info > div {
margin-bottom: 3px;
}
#client-info span {
display: block;
}
#client-info .client-name {
font-weight: bold;
}

#invoice-title-number {
float: left;
margin: 60px 0 10px 0;
}
#invoice-title-number span {
display: inline-block;
min-width: 15px;
line-height: 1em;
}
#invoice-title-number #title {
font-size: 50px;
color: #396E00;
}
#invoice-title-number #number {
font-size: 22px;
}

#items {
margin-top: 40px;
}
#items table {
border-collapse: separate;
width: 100%;

}
#items table th span:empty, #items table td span:empty {
display: inline-block;
}
#items table th {
font-weight: bold;
padding: 10px;
border-bottom: 2px solid #898989;
}
#items table th:nth-child(2) {
width: 30%;
text-align: left;
}
#items table th:last-child {
text-align: right;
}
#items table td {
border-bottom: 1px solid #C4C4C4;
padding: 10px;
text-align: right;
}
#items table td:first-child {
text-align: left;
}
#items table td:nth-child(2) {
text-align: left;
}

#sums {
float: right;
margin-top: 10px;
page-break-inside: avoid;
}
#sums table tr th, #sums table tr td {
min-width: 100px;
padding: 10px;
text-align: right;
}
#sums table tr th {
text-align: left;
padding-right: 25px;
}
#sums table tr.amount-total th {
text-transform: uppercase;
color: #396E00;
}
#sums table tr.amount-total th, #sums table tr.amount-total td {
font-weight: bold;
font-size: 16px;
border-top: 2px solid #898989;
}
#sums table tr:last-child th {
text-transform: uppercase;
color: #396E00;
}
#sums table tr:last-child th, #sums table tr:last-child td {
font-size: 16px;
font-weight: bold;
}

#terms {
margin-top: 80px;
page-break-inside: avoid;
}
#terms > span {
font-weight: bold;
}
#terms > div {
color: #396E00;
font-size: 16px;
min-height: 70px;
width: 100%;
max-width: 500px;
}

.payment-info-invoice {
color: #888;
font-size: 12px;
margin-top: 20px;
width: 100%;
max-width: 440px;
}
.payment-info-invoice div {
display: inline-block;
min-width: 15px;
}

.bottom-circles {
width: 310px;
height: 215px;
-moz-background-size: 384px auto;
-o-background-size: 384px auto;
-webkit-background-size: 384px auto;
background-size: 384px auto;
position: absolute;
bottom: 0;
right: 0;
overflow: hidden;
}
.bottom-circles section {
position: relative;
}
.bottom-circles section div {
-moz-border-radius: 50%;
-webkit-border-radius: 50%;
border-radius: 50%;
display: inline-block;
position: absolute;
}
.bottom-circles section > div:first-child {
background: #396E00;
left: 3px;
width: 125px;
height: 125px;
top: 117px;
}
.bottom-circles section > div:first-child > div {
background: #88C213;
width: 60px;
height: 60px;
top: 32px;
left: 32px;
position: relative;
}
.bottom-circles section > div:last-child {
background: #396E00;
right: -65px;
width: 280px;
height: 280px;
}
.bottom-circles section > div:last-child > div {
background: #88C213;
top: 24px;
left: 24px;
width: 230px;
height: 230px;
}
.bottom-circles section > div:last-child > div > div {
background: #396E00;
top: 58px;
left: 58px;
width: 115px;
height: 115px;
}
.bottom-circles section > div:last-child > div > div > div {
background: #FFF;
top: 12px;
left: 12px;
width: 90px;
height: 90px;
}

.show-mobile {
display: none !important;
}

/**
 * If the printed invoice is not looking as expected you may tune up
 * the print styles (you can use !important to override styles)
 */
@media print {
  /* Here goes your print styles */
  .ib_invoicebus_fineprint {
    text-align: left;
    text-indent: 65px;
  }
}
	</style>
<script>
                    var sess_items  = "<?php echo $this->session->userdata('your_cart_item') ?>";
                    $.ajax({
                        type: "GET",
                        
                        url: "<?php echo base_url("Ajaxcontroller/delete_session_item_cart") ?>",
                        data: {sess_items:sess_items},
                        success: function (data) { 
                                var cart = 1;
                                
                                $.ajax({
                                    type: "GET",
                                    
                                    url: "<?php echo base_url("Ajaxcontroller/add_item_to_cart") ?>",
                                    data: {cart:cart},
                                    success: function (data) {
                                        
                                        $('#items').empty();
                                        $('#items').append(data);
                                    }
                                });
                            
                        }
                    });
    
</script>
