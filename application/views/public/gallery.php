<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/jquery.fancybox.min.css" />
<script src="<?php echo base_url() ?>assets/js/jquery.fancybox.min.js"></script>

<section class="bg-light heading-bar">
	<div class="container">
        <div class="row">
        	<div class="col-sm-12">
            	<h2>Gallery</h2>
            </div>
        </div>
    </div>
</section>
<div class="bg-light popup-one form-text-color">
	<div class="container">
        <div class="row gallery-box">
            <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                <a href="<?php echo base_url(); ?>assets/images/g1.jpg" class="fancybox" rel="ligthbox">
                    <img  src="<?php echo base_url(); ?>assets/images/g1.jpg" class="zoom img-fluid "  alt="">
                   
                </a>
            </div>
            <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                <a href="<?php echo base_url(); ?>assets/images/g2.jpg" class="fancybox" rel="ligthbox">
                    <img  src="<?php echo base_url(); ?>assets/images/g2.jpg" class="zoom img-fluid "  alt="">
                   
                </a>
            </div>
            <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                <a href="<?php echo base_url(); ?>assets/images/g3.jpg" class="fancybox" rel="ligthbox">
                    <img  src="<?php echo base_url(); ?>assets/images/g3.jpg" class="zoom img-fluid "  alt="">
                   
                </a>
            </div>
            <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                <a href="<?php echo base_url(); ?>assets/images/g4.jpg" class="fancybox" rel="ligthbox">
                    <img  src="<?php echo base_url(); ?>assets/images/g4.jpg" class="zoom img-fluid "  alt="">
                   
                </a>
            </div>
        </div>
    </div>
</div>
<section class="heading-bar">
	<div class="container">
        <div class="row">
        	<div class="col-sm-12">
            	<h2>Video Gallery</h2>
            </div>
        </div>
    </div>
</section>
<div class="popup-one mb-5 form-text-color">
	<div class="container">
        <div class="row gallery-box">
            <div class="col-md-4 col-xs-6">
                <div class="videogallery">
                <iframe src="https://www.youtube.com/embed/4pio7lzEjQc" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>
                <p class="font-video">Earth worms</p>
            </div>
            <div class="col-md-4 col-xs-6">
                <div class="videogallery">
                <iframe src="https://www.youtube.com/embed/jc5rPJn0ADc" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>
                <p class="font-video">Tomatoes at Farmstop Organic farms</p>
            </div>
            <div class="col-md-4 col-xs-6">
                <div class="videogallery">
                <iframe src="https://www.youtube.com/embed/LCSkBQ19aRg" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>
                <p class="font-video">Cold Pressed Ground nut oil</p>
            </div>
            <div class="col-md-4 col-xs-6">
                <div class="videogallery">
                <iframe src="https://www.youtube.com/embed/X81D0JONvMs" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>
                <p class="font-video">Stream by Farmstop Organic farms</p>
            </div>
            <div class="col-md-4 col-xs-6">
                <div class="videogallery">
                <iframe src="https://www.youtube.com/embed/TPyV9UTD-j4" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>
                <p class="font-video">Preperations at paddy fields</p>
            </div>
            <div class="col-md-4 col-xs-6">
                <div class="videogallery">
                <iframe src="https://www.youtube.com/embed/EAau8pPymb4" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>
                <p class="font-video">A farmer named Venkataramana</p>
            </div>
            <div class="col-md-4 col-xs-6">
                <div class="videogallery">
                <iframe src="https://www.youtube.com/embed/Pl_m0QeRvCs" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>
                <p class="font-video">Paddy Harvest at Farmstop Organic Farms</p>
            </div>
            <div class="col-md-4 col-xs-6">
                <div class="videogallery">
                <iframe src="https://www.youtube.com/embed/aq04PASdv4c" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>
                <p class="font-video">Organic fertilizers - Panchagavya</p>
            </div>
            <div class="col-md-4 col-xs-6">
                <div class="videogallery">
                <iframe src="https://www.youtube.com/embed/c6k0uv5jPRQ" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>
                <p class="font-video">Paddy Harvest</p>
            </div>
            
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
  $(".fancybox").fancybox({
        openEffect: "none",
        closeEffect: "none"
    });
    
    $(".zoom").hover(function(){
		
		$(this).addClass('transition');
	}, function(){
        
		$(this).removeClass('transition');
	});
});
</script>
