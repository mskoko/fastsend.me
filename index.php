<?php

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 *   file                 :  index.php
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 *   author               :  Muhamed Skoko - info@mskoko.me
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */

include_once($_SERVER['DOCUMENT_ROOT'].'/includes.php');

//////////////////////////

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php echo $Site->SiteConfig()['site_name']; ?></title>

	<?php include_once($_SERVER['DOCUMENT_ROOT'].'/assets/php/head.php'); ?>

	<!-- ld -->
	<script type="application/ld+json" src="/assets/json/ld.json"></script>
	<link rel="stylesheet" type="text/css" href="//unpkg.com/gijgo@1.9.13/css/gijgo.min.css">
</head>
<body>
	<div id="organization"></div><div id="webpage"></div>

	<div class="preloader"></div>

	<!-- Alerts -->
	<div id="msg_alert"><?php echo $Alert->PrintAlert(); ?></div>
	<script type="text/javascript">
		setTimeout(function() {
			document.getElementById('msg_alert').innerHTML = "<?php echo $Alert->RemoveAlert(); ?>";
		}, 5000);
	</script>

	<!-- Header -->
	<header class="header_area">
		<div class="sub_header">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-md-2 col-xl-6">
						<div class="logo">
							<a href="/home">
								<!--<img src="/assets/img/i/logo/logo_.png?<?php echo time(); ?>" alt="Logo" title="Logo" class="d-none d-lg-block" style="width:auto;height:50px;">

								<img src="/assets/img/i/logo/logo_.png?<?php echo time(); ?>" alt="Logo" title="Logo" class="d-block d-lg-none" style="width:100%;height:auto;">-->
								Fastsend.me
							</a>
						</div>
					</div>

					<div class="col-md-10 col-xl-6">
						<div class="sub_header_social_icon float-right">
							<?php if (!($User->IsLoged()) == false) { ?>
								<span style="display:inline-block;">
									<a href="/profile">
										Avatar
									</a>
								</span>


								<span style="display:inline-block;">
									<div class="dropdown show">
										<li class="nav-item" style="display:block;">
											<a class="js-scroll-trigger dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
												<i style="margin-left:5px;"><?php echo $User->UserData()['Name'].' '.$User->UserData()['Lastname']; ?></i>
											</a>
										</li>

										<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
											<a class="dropdown-item" href="/profile">Profile</a>
											<a class="dropdown-item" href="/logout.php">Logout</a>
										</div>
									</div>
								</span>
							<?php } else { ?>
								<li class="nav-item">
									<a class="nav-link js-scroll-trigger" href="/register">Sign up for free!</a>
								</li>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Navigation -->
		<?php include_once($url.'/assets/php/nav.php'); ?>
	</header> <!-- end Header -->

	<div class="space" style="margin-top:50px;"></div>
	<!-- Page content -->

    <div class="container">
    	<div class="row justify-content-center">
    		
	    	<div class="col-md-12">
	    		<form action="" method="POST" autocomplete="off">
	    			
					<div class="row">
						<div class="col-md-6">
							<div class="row">
								<div class="col-md-12">
									<h5>Upload form</h5> <hr>

									<label>File name: </label>
									<input type="text" name="fTitle" class="form-control">
								
									<br>
									<label>Select the file: </label>
									<input type="file" name="File" class="form-control">
								
									<br>
									<label>File protected?</label>
									<input type="password" name="Pass" placeholder="Type your password" class="form-control">
								
									<br>
									<button class="btn btn-success" style="width:100%;">
										<i class="fa fa-upload"></i> Upload file
									</button>
								</div>

							</div>						

						</div>

						<div class="col-md-6">
							<div class="row">
								<div class="col-md-12">
									<div class="start_upload">
										<h5>
											Fastsend.me <small>vam predstavlja!</small>
										</h5> <hr>

										<p>
											<strong>
												<i class="fa fa-angle-double-right"></i>
												Premium
											</strong>
											
											<br>

											<small>
												Nudimo vam upload fajla do <b>10GB</b> od jednom!
												<br>
												<i class="fa fa-angle-double-right"></i> Vidljivost linka: <b>24/7</b>
												<br>
												<i class="fa fa-angle-double-right"></i> Support: <b>24/7</b>
											</small>
										</p>

										<p>
											<strong>
												<i class="fa fa-angle-double-right"></i>
												Lite
											</strong>
											
											<br>

											<small>
												Nudimo vam upload fajla do <b>1GB</b> od jednom!
												<br>
												<i class="fa fa-angle-double-right"></i> Vidljivost linka: <b>24/7</b>
											</small>
										</p>

										<p>
											<strong>
												<i class="fa fa-angle-double-right"></i>
												Free
											</strong>
											
											<br>

											<small>
												Nudimo vam upload fajla do <b>100MB</b> od jednom  potpuno <b>besplatno</b>!
												<br>
												<i class="fa fa-angle-double-right"></i> Vidljivost linka: <b>10dana</b> <span style="text-decoration:underline;">nakon toga se automatcki brise!</span>
											</small>
										</p>

										<a href="" class="btn btn-primary" style="width:100%;">
											<i class="fa fa-info-circle"></i> Vise o cenama
										</a>
									</div>

									<div class="file_preview" style="display:none;">
										<h5>File preview </h5> <hr>

										<!-- View file image or icon this ext; -->
									</div>

								</div>
							</div>
						</div>
					</div>

	    		</form>
	    	</div>

		</div>
    </div>


    <footer>
    	<div class="container">
    		<div class="row justify-content-center">
    			<p>&copy; <?php echo date('Y'); ?> <?php echo $Site->SiteConfig()['site_link']; ?></p>
    		</div>
    	</div>
    </footer>

	<!-- Footer -->
	<?php include_once($_SERVER['DOCUMENT_ROOT'].'/assets/php/footer.php'); ?>
</body>
</html>
