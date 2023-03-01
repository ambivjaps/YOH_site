<?php 
    session_start();
    
    include("includes/dbh.inc.php");
    include("includes/functions.inc.php");
    include("includes/access.inc.php");

    require 'layouts/Header.php';

    /* slide carousel */
    $carousel = "SELECT * FROM slides ORDER BY slide_id LIMIT 5";
    $result = mysqli_query($con, $carousel);
    $slides = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);

    /* featured video */
	$feat_vid = "SELECT * FROM videos ORDER BY vid_id DESC LIMIT 3";
	$result = mysqli_query($con, $feat_vid);
	$videos = mysqli_fetch_all($result, MYSQLI_ASSOC);
	mysqli_free_result($result);
?>

<title> Home | Yarn Over Hook </title>

<body class="d-flex flex-column min-vh-100">

<?php require 'layouts/nav.php';?>

    <div id="yoh-slide" class="carousel slide" data-bs-ride="carousel">
        <ol class="carousel-indicators">
    		<button type="button" data-bs-target="#techtalk-slide" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    		<button type="button" data-bs-target="#techtalk-slide" data-bs-slide-to="1" aria-label="Slide 2"></button>
    		<button type="button" data-bs-target="#techtalk-slide" data-bs-slide-to="2" aria-label="Slide 3"></button>
    		<button type="button" data-bs-target="#techtalk-slide" data-bs-slide-to="3" aria-label="Slide 4"></button>
            <button type="button" data-bs-target="#techtalk-slide" data-bs-slide-to="4" aria-label="Slide 5"></button>
  		</ol>
        
        <div class="carousel-inner">
     		<?php $loop=0; foreach ($slides as $slide): ?>

  			<?php 
  				if ($loop==0) {
  					$status = "active"; 
  				} else { 
  					$status = ""; 
  				} 
  			?> 

            <div class='carousel-item <?php echo $status; ?>'>
                <img class="d-block w-100" src="<?php echo $slide['slide_img']; ?>" title="<?php echo $slide['slide_desc']; ?>" alt="<?php echo $slide['slide_desc']; ?>">
            </div>

        <?php $loop++; endforeach ?>

        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#yoh-slide" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#yoh-slide" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden"></span>
        </button>
    </div>
        
    <main class="page">
        <section class="clean-block about-us">
            <div class="container-xxl">
                <div class="block-heading">
                    <h2 class="text-info" style="font-size: 74px;font-family: Alata, sans-serif;margin-bottom: 18.2px;margin-top: -10px;">Yarn Over Hook</h2>
                    <p style="font-size: 43px;font-family: Actor, sans-serif;margin-bottom: -22px;margin-top: -16px;padding-top: 0px;padding-bottom: 0px;">About Us</p>
                </div>
                
                <div class="row justify-content-center">
                    <div class="owl-carousel owl-theme">
                        <div class="ml-2 mr-2">
                            <div class="card text-center clean-card">
                                <div class="card-thumbnail"> 
                                    <img class="card-img-top w-100 d-block" src="assets/img/home/IMG_7410.png">
                                </div>
                                <div class="card-body info">
                                    <h4 class="card-title">Create with a smile.</h4>
                                    <p>Be inspired, get passionate, and let's create!</p>
                                </div>
                            </div>
                        </div>
                        <div class="ml-2 mr-2">
                            <div class="card text-center clean-card">
                                <div class="card-thumbnail">    
                                    <img class="card-img-top w-100 d-block" src="assets/img/home/owner.jpg">
                                </div>
                                <div class="card-body info">
                                    <h4 class="card-title">Meet the owner..</h4>
                                    <p>Hi everyone and mabuhay! My name is Lia, and I am a 20 year old with 8 years of crochet experience.</p>
                                </div>
                            </div>
                        </div>
                        <div class="ml-2 mr-2">
                            <div class="card text-center clean-card">
                                <div class="card-thumbnail">     
                                    <img class="card-img-top w-100 d-block" src="assets/img/home/IMG_7411.png">
                                </div>
                                <div class="card-body info">
                                    <h4 class="card-title">Why Yarn Over Hook?</h4>
                                    <p>I want to take you guys in most of my crochet journeys. Also, I want to help you guys grow as crocheters and entrepreneurs.</p>
                                </div>
                            </div>
                        </div>
                        <div class="ml-2 mr-2">
                            <div class="card text-center clean-card">
                                <div class="card-thumbnail">     
                                    <img class="card-img-top w-100 d-block" src="assets/img/home/product.jpg">
                                </div>
                                <div class="card-body info">
                                    <h4 class="card-title">Our products are here to satisfy everyone.</h4>
                                    <p>Whether you're creating your own masterpiece or you just want to express, our products won't let you down! </p>
                                </div>
                            </div>
                        </div>
                        <div class="ml-2 mr-2">
                            <div class="card text-center clean-card">
                                <div class="card-thumbnail">     
                                    <img class="card-img-top w-100 d-block" src="assets/img/home/support.jpg">
                                </div>
                                <div class="card-body info">
                                    <h4 class="card-title">We'll guide fellow crocheters.</h4>
                                    <p>Do you want to learn how to crochet but you're unsure how to start? We have video tutorials for you!</p>
                                </div>
                            </div>
                        </div>
                        <div class="ml-2 mr-2">
                            <div class="card text-center clean-card">
                                <div class="card-thumbnail">     
                                    <img class="card-img-top w-100 d-block" src="assets/img/home/create.jpg">
                                </div>
                                <div class="card-body info">
                                    <h4 class="card-title">Let's start creating!</h4>
                                    <p>Come along with me on this journey bubs and don't forget to create with a smile :)</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mt-5">   
                        <center>
                            <h2> Nerdy and crafty safe space in the Philippines. </h2>
                            <p> Y.o.h.plus is a retail store located in the Philippines encompassing all things crochet, and occasionally knitting. The y.o.h. stands for ‘yarn over hook’ which is a term in crochet that is done before you complete a loop, and the plus is added with the goal of giving more to the business’ clients. </p>
                            <p> We hope you enjoy browsing our website. Whether you're availing our products or educating yourself about crochet, feel free to explore! </p>
                        </center>
                    </div>
                </div>

                <div class="block-heading">
                    <p style="font-size: 43px;font-family: Actor, sans-serif;margin-bottom: -22px;margin-top: -16px;padding-top: 0px;padding-bottom: 0px;">Our Products</p>
                </div>

                <div class="row justify-content-center g-1">
                    <div class="col-md-4 my-2">
                        <div class="h-100 p-5 text-white bg-dark rounded-1 yoh-card-ins" style="background-image: linear-gradient(to bottom, rgba(0,0,0,0.4) 0%,rgba(0,0,0,0.5) 100%), url('assets/img/home/IMG_7412.png');">
                            <h1 class="pt-5 my-3 lh-1" style="text-shadow: #000 1px 0 5px;"> Headwear </h1>
                            <p style="text-shadow: #000 1px 0 5px;">Express yourself with our headwear collection.</p>
                            <a class="btn btn-light mt-2" href="#" role="button">Explore <i class="fas fa-caret-right"></i></a>
                        </div>
                    </div>
                    <div class="col-md-4 my-2">
                        <div class="h-100 p-5 text-white bg-dark rounded-1 yoh-card-ins" style="background-image: linear-gradient(to bottom, rgba(0,0,0,0.4) 0%,rgba(0,0,0,0.5) 100%), url('assets/img/home/IMG_7409.PNG');">
                            <h1 class="pt-5 my-3 lh-1" style="text-shadow: #000 1px 0 5px;"> Minis </h1>
                            <p style="text-shadow: #000 1px 0 5px;">Get yourself a cute personal companion to accompany you through the day.</p>
                            <a class="btn btn-light mt-2" href="#" role="button">Explore <i class="fas fa-caret-right"></i></a>
                        </div>
                    </div>
                    <div class="col-md-4 my-2">
                        <div class="h-100 p-5 text-white bg-dark rounded-1 yoh-card-ins" style="background-image: linear-gradient(to bottom, rgba(0,0,0,0.4) 0%,rgba(0,0,0,0.5) 100%), url('assets/img/home/IMG_7413.PNG');">
                            <h1 class="pt-5 my-3 lh-1" style="text-shadow: #000 1px 0 5px;"> Accessories </h1>
                            <p style="text-shadow: #000 1px 0 5px;">Adorable accessories to attach to your personal belongings.</p>
                            <a class="btn btn-light mt-2" href="#" role="button">Explore <i class="fas fa-caret-right"></i></a>
                        </div>
                    </div>
                </div>

                <div class="block-heading">
                    <p style="font-size: 43px;font-family: Actor, sans-serif;margin-bottom: -22px;margin-top: -16px;padding-top: 0px;padding-bottom: 0px;">Latest Videos</p>
                </div>

                <div class="row justify-content-center">
                    <?php foreach($videos as $video): ?>
                    <div class="col-md-4">
                        <div class="youtube-player rounded-1" data-id="<?php echo $video['vid_url'] ?>"></div>
                        <h3> <?php echo $video['vid_title']; ?> </h3>
                        <span class="badge bg-dark"><?php echo $video['vid_cat']; ?></span><hr>
                        <p><?php echo $video['vid_desc']; ?></p>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
    </main>

    <?php require 'layouts/Footer.php';?>

    <script>
      $('.owl-carousel').owlCarousel({
        stagePadding:0,
        loop:false,
        margin:10,
        dots:true,
        nav:true,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:2
            },
            1000:{
                items:3
            }
          }
      })
    </script>