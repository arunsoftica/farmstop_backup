
	<script src="<?php echo base_url() ?>assets/admin/js/jquery.min.js"></script>
	cart page
	<div id="view_cart" style="padding-left:50px;">
		
	</div>


<script >
            var cart = 3;
            
            $.ajax({
                type: "GET",
                
                url: "<?php echo base_url("Ajaxcontroller/add_item_to_cart") ?>",
                data: {cart:cart},
                success: function (data) {
                    
                    $('#view_cart').empty();
                    $('#view_cart').html(data);
                }
            });
    $(document).on('change', '.total_item', function (e) {
    if($(this).val() <= 0){
        $(this).val(1);
    }
    var ab = $(this).val();
    var a = $(this).parent().siblings('td').children('.total_prices').val();
    
    var aa = a * ab;
    $(this).parent().siblings('td').find('.total_price').val(aa);   
    });


   $(document).on('submit','#update_cart',(function(e){
    
    //$("#submit").addClass('disabled');
    //$("#submit").text('please wait....'); 
    e.preventDefault();
      $.ajax({
      url: "<?php echo base_url('Ajaxcontroller/update_item_to_cart') ?>",
      type: "POST",        
      data: new FormData(this),
      contentType: false,
      cache: false,
      processData:false,  
      success: function(data){
        
        //alert(data);
        alert('your cart updated successfully..');
        location.reload();

     }  
     });  
    }));
</script>
