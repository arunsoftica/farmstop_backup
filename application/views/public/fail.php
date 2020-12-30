<?php
echo 'Transaction Failed';
?>
<script>
                    var f = 1;
                    $.ajax({
                        type: "GET",
                        
                        url: "<?php echo base_url("Ajaxcontroller/failedUserPayment") ?>",
                        data: {f:f},
                        success: function (data) { 
                               if(data == 'fail'){
                                   
                               }
                            
                        }
                    });
    
</script>