<section class="bg-light heading-bar">
	<div class="container">
        <div class="row">
        	<div class="col-sm-12">
            	<h2>blog</h2>
            </div>
        </div>
    </div>
</section>
<section>
<div class="container">
<div class="row">
	<!--<div class="col-xl-8 col-lg-8 col-md-9 col-sm-12 col-12">-->
	
	    <?php foreach($blogs as $blog){ ?>
	    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
          <div class="multiblog mb-3 mt-3">
      <div class="row">
       	<div class="col-xl-5 col-lg-5 col-md-5 col-sm-12 col-12">
        	<a class="" href="#">
    		<img class="img-fluid" src="<?php echo base_url('admin/uploads/blog_images/'.preg_replace('/\s+/', '_', $blog['image'])); ?>">
  		</a>
        </div>
        <div class="col-xl-7 col-lg-7 col-md-7 col-sm-12 col-12">
            <div class="media-body">
    		<h4 class="media-heading"><a href="<?php echo base_url('blog/'.$blog['slug']) ?>"><?php echo $blog['title'] ?></a></h4>
          <p><?php echo substr($blog['description'],0,100).'..' ?>
          [<a title="<?php echo $blog['title'] ?>" href="<?php echo base_url('blog/'.$blog['slug']) ?>">Read More</a>]
          </p>
          <ul class="list-inline">
  			<li><span><i class="fa fa-calendar"></i><?php echo date("d/M/Y", strtotime($blog['date'])) ?></span></li>
            <!--<li>|</li>
            <li>
                <span><i class="glyphicon glyphicon-comment"></i> 2 comments</span>
            </li>-->
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
  <?php } ?>
  		  
    
    <!--<div class="col-xl-4 col-lg-4 col-md-3 col-sm-12 col-12">
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
    </div>-->
</div>
</div>
 </section>   

