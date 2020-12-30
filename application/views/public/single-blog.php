<section class="bg-light heading-bar">
	<div class="container">
        <div class="row">
        	<div class="col-sm-12">
            	<h2><?php echo $blogs['title'] ?></h2>
            </div>
        </div>
    </div>
</section>
<section>
<div class="container">
<div class="row">
	<div class="col-lg-8 offset-lg-2 col-sm-12 col-12">
          <div class="single-blog mb-3 mt-3">
         <div class="row">
       	<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        	<a class="" href="#">
    		<img class="img-fluid" src="<?php echo base_url('admin/uploads/blog_images/'.preg_replace('/\s+/', '_', $blogs['image'])) ?>">
  		</a>
        </div>
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="media-body">
            <h2 class="media-heading mt-3"><?php echo $blogs['title'] ?></h2>
    		<p class="media-heading mt-3"><?php echo $blogs['description'] ?></p>
          <ul class="list-inline">
  			<li><span><i class="fa fa-calendar"></i> <?php echo date("d/M/Y", strtotime($blogs['date'])) ?></span></li>
            <li>|</li>
            <li>
            <div class="social-media-color">
<a href="#" class="fa fa-facebook"></a>
<a href="#" class="fa fa-twitter"></a>
<a href="#" class="fa fa-linkedin"></a>
<a href="#" class="fa fa-instagram"></a>
</div>
            </li>
			</ul>
       </div>
        </div>
      	
  		
    </div>
  </div>
  		  
    </div>
    <!--div class="col-xl-4 col-lg-4 col-md-3 col-sm-12 col-12">
          	<div class="cat-box mb-3 mt-3">
          	<h3> Categories</h3>
          	<ul class="list-group">
                <li><a href="#">Entertainment <span class="badge badge-toggle-cat">4</span></a></li>
                <li><a href="#">News <span class="badge badge-toggle-cat">2</span></a></li>
                <li><a href="#">Games <span class="badge badge-toggle-cat">4</span></a></li>
                <li><a href="#">bollywood News <span class="badge badge-toggle-cat">4</span></a></li>
                <li><a href="#">Entertainment <span class="badge badge-toggle-cat">4</span></a></li>
                <li><a href="#">Entertainment <span class="badge badge-toggle-cat">4</span></a></li>
                <li><a href="#">News <span class="badge badge-toggle-cat">2</span></a></li>
                <li><a href="#">Games <span class="badge badge-toggle-cat">4</span></a></li>
                <li><a href="#">bollywood News <span class="badge badge-toggle-cat">4</span></a></li>
                <li><a href="#">Entertainment <span class="badge badge-toggle-cat">4</span></a></li>
</ul>
			</div>
    </div-->
</div>
</div>
 </section>   