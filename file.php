<?php

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 *   file                 :  file.php
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 *   author               :  Muhamed Skoko - info@mskoko.me
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */

include_once($_SERVER['DOCUMENT_ROOT'].'/includes.php');

//////////////////////////

if (isset($_GET['id'])) {
	$FileID = $Secure->SecureTxt($_GET['id']);

	//File provera
	if (empty($Files->FileByID($FileID)['id'])) {
		header("Location: /home");
	}
} else {
	header("Location: /home");
}

//Add view on file
if ($Files->isViewThisFile($FileID, $User->UserData()['id'], $User->userIP(), $User->userHost()) == 0) {
	$Files->ViewThisFile($FileID, $User->UserData()['id'], $User->userIP(), $User->userHost());
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php echo $Site->SiteConfig()['site_name']; ?></title>

	<?php include_once($_SERVER['DOCUMENT_ROOT'].'/assets/php/head.php'); ?>
	
	<!-- Video css -->
	<link rel="stylesheet" type="text/css" href="/assets/video/dist/plyr.css?<?php echo time(); ?>">

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

	<div class="space" style="margin-top:25px;"></div>
	<div class="container">
    	<div class="row">
    		<div class="col-md-12">
				user > files > file
			</div>
		</div>
	</div>
	<div class="space" style="margin-top:25px;"></div>
	<!-- Page content -->

    <div class="container">
    	<div class="row justify-content-center">
    		<div class="col-md-12">
				<div class="row">
					<!-- Left content -->
					<div class="col-md-8">
						<div class="card">
							<h5 class="card-header">
								<i class="fa fa-file"></i> <?php echo $Secure->SecureTxt($Files->FileByID($FileID)['fTitle']); ?>
							</h5>

							<div class="card-body">
								<div class="file_view">
									<?php if (empty($Secure->SecureTxt($Files->FileByID($FileID)['fPinCode'])) || !($Files->IsPinCode($FileID)) == false || $Files->FileByID($FileID)['userID'] == $User->UserData()['id']) { ?>
										
										<!-- Detect format -->
										<?php if($Files->DetectFileExt($FileID) == 'v') { ?>
											<!-- Video -->
											<video class="vide_" id="video_id" id="player" onerror="failed(event)" playsinline controls>
												<source src="/file/v/v3.mp4" type="video/mp4" />
											</video>
										<?php } else if($Files->DetectFileExt($FileID) == 'i') { ?>
											<!-- Image -->
											<img src="/file/i/img.jpeg" alt="Image 1" class="file_img">
										<?php } else if($Files->DetectFileExt($FileID) == 'f') { ?>
											<!-- ZIP/RAR -->
											<div class="rar_zip">
												<img src="/assets/img/i/rar-flat.png" alt="RAR ext file">
												<img src="/assets/img/i/zip-flat.png" alt="ZIP ext file">
												
												<div class="space" style="margin-top:50px;"></div>
												<small><i class="fa fa-info-circle"></i> Ovaj format fajla mozete samo preuzeti</small>
											</div>
										<?php } else if($Files->DetectFileExt($FileID) == 'd') { ?>
											<!-- Doc -->
											<p><b>Lorem</b> <i>ipsum</i> dolor sit amet, consectetur adipisicing elit. Quod eos magnam labore repellat repudiandae inventore, id placeat esse nulla cupiditate delectus sapiente ullam atque hic aut nobis dolores facere sit?Lorem ipsum dolor sit amet, consectetur adipisicing elit. <br><br><br>Voluptas odio nulla non asperiores quia excepturi necessitatibus fugit, eius explicabo, numquam optio earum porro perferendis distinctio architecto dolores magni dolor atque?Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore fuga quae beatae labore nesciunt temporibus nam repellendus expedita eum eos ad quo id est officiis repudiandae nisi reiciendis culpa, aliquam.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab alias harum illum quaerat, nam rei<br><br>ciendis atque delectus quasi, dolore sint quia maiores reprehenderit soluta repellendus rerum modi, officia quisquam! Quas.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vitae natus commodi laudantium, sunt, debitis doloremque ratione, repellat nesciunt, iure fuga eos fugiat deserunt? Ex rem ipsum, nisi temporibus, mollitia veniam?</p>
										<?php } ?>

									<?php } else { ?>
										<!-- unlock this file -->
										<form action="/process?unlock_file" method="POST" autocomplete="off">
											<input type="text" name="fID" value="<?php echo $FileID; ?>" style="display:none;">

											<div class="row">
												<div class="col-md-12">
													<li style="display:inline-block;">
														<img src="/assets/img/i/shield-flat.png" alt="" style="width:55px;height:auto;">
													</li>

													<li style="display:inline-block;">
														<h3 style="position:absolute;margin-top:-15px;"><i>This file has ben locked!</i></h3>
													</li>
													
													<hr>
												</div>
												
												<div class="col-md-12">
													<label>Enter the password to unlock it.</label>
													<input type="password" name="PinCode" class="form-control" required="" placeholder="*****">
													<br>
													<button class="btn btn-sm btn-success" style="float:right;">
														<i class="fa fa-send"></i> Unlock
													</button>
												</div>
											</div>
										</form>
									<?php } ?>
								</div>

								<hr>

								<div class="file_stats">
									<div class="col-md-12">
										<div class="row">
											<div class="col-md-6">
												<div class="row">
													<div class="col-md-6">
														<div class="row">
															<div class="col-md-6">
																<img src="/assets/img/i/binocular-var-outline-filled.png" alt="">
															</div>
															<div class="col-md-6">
																<h1 style="font-size:22px;margin-top:15px;">
																	<?php echo $Secure->viewConverter($Files->ViewsThisFile($FileID)); ?>
																	<span style="position:absolute;">+</span>
																</h1>
															</div>
														</div>
													</div>

													<div class="col-md-6">
														<div class="row">
															<div class="col-md-6">
																<img src="/assets/img/i/share-outline-filled.png" alt="">
															</div>
															<div class="col-md-6">
																<h1 style="font-size:22px;margin-top:15px;">
																	<?php echo $Secure->viewConverter($Files->ViewsThisFile($FileID)); ?>
																	<span style="position:absolute;">+</span>
																</h1>
															</div>
														</div>
													</div>
												</div>
											</div>
										
											<div class="col-md-6">
												<div class="row">
													<div class="col-md-6"></div>

													<div class="col-md-6">
														<div class="row">
															<div class="col-md-6">
																<img src="/assets/img/i/download-flat.png" alt="">
															</div>
															<div class="col-md-6">
																<h1 style="font-size:22px;margin-top:15px;">
																	<?php echo $Secure->viewConverter($Files->ViewsThisFile($FileID)); ?>
																	<span style="position:absolute;">+</span>
																</h1>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>


								</div>

							</div>
						</div>
					</div>
					
					<!-- Right content -->
					<div class="col-md-4">
						<div class="card">
							<h5 class="card-header">
								<i class="fa fa-cog"></i> File action
							</h5>

							<div class="card-body">
								<div class="f_action">
									<?php if (empty($Secure->SecureTxt($Files->FileByID($FileID)['fPinCode'])) || !($Files->IsPinCode($FileID)) == false || $Files->FileByID($FileID)['userID'] == $User->UserData()['id']) { ?>	
										<li>
											<a href="" class="btn btn-info">
												<i class="fa fa-share"></i> Share this file
											</a>
										</li>

										<li>
											<a href="/download/<?php echo $FileID; ?>" class="btn btn-success">
												<i class="fa fa-download"></i> Download
											</a>
										</li>

										<!-- for owner file -->
										<hr>
										
										<div class="row">
											<div class="col-md-12">
												<div class="row">
													<?php if ($Files->FileByID($FileID)['userID'] == $User->UserData()['id']) { ?>
														<?php if (empty($Secure->SecureTxt($Files->FileByID($FileID)['fPinCode']))) { ?>
															<div class="col-md-6 f_action">
																<li>
																	<a href="" class="btn btn-warning">
																		<i class="fa fa-lock"></i> Lock
																	</a>
																</li>
															</div>
														<?php } else { ?>
															<div class="col-md-6 f_action">
																<li>
																	<a href="" class="btn btn-warning">
																		<i class="fa fa-key"></i> Change
																	</a>
																</li>
															</div>
														<?php } ?>
													
														<div class="col-md-6 f_action">
															<li>
																<a href="" class="btn btn-danger">
																	<i class="fa fa-trash"></i> Delete
																</a>
															</li>
														</div>
													<?php } ?>
												</div>
											</div>
										</div>

										<?php if ($Files->FileByID($FileID)['userID'] == $User->UserData()['id']) { ?>
											<hr>
										<?php } ?>
									
										<div class="row">
											<div class="col-md-12">
												<label>File link</label>
												<input type="text" name="c_link" value="http://<?php echo $_SERVER['HTTP_HOST']; ?>/file/<?php echo $FileID; ?>" class="form-control" id="a_copyLink_1_<?php echo $FileID; ?>" onclick="a_copyLink(1, <?php echo $FileID; ?>)">
												<small>To copy the link click on it</small>
													
												<br><hr>

												<label>Direct file link</label>
												<input type="text" name="c_link" value="http://<?php echo $_SERVER['HTTP_HOST'].''.$Files->FileByID($FileID)['fLink']; ?>" class="form-control" id="a_copyLink_2_<?php echo $FileID; ?>" onclick="a_copyLink(2, <?php echo $FileID; ?>)">
												<small>To copy the link click on it</small>
											</div>
										</div>
									<?php } else { ?>
										<h5>
											<i class="fa fa-lock"></i> This file is locked. <hr> 
											<i class="fa fa-angle-double-right"></i> Enter the password to unlock it.
										</h5>
									<?php } ?>

								</div>
							</div>
						</div>
					</div>
				</div>
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
	<!-- Video js -->
	<script type="text/javascript" src="/assets/video/dist/plyr.js?<?php echo time(); ?>"></script>
	<script type="text/javascript">
		var players_multiple = new Plyr.setup('.vide_');

		$(".play-video").on("click", function() {
			players_multiple[1].play(); // Start playback
			
			players_multiple[1].volume = 0.5; // 0.5;
			players_multiple[1].currentTime = 1; // 10
			players_multiple[1].fullscreen.active; // false;
		});


		function a_copyLink(fInput, fID) {
			/* Get the text field */
			if(fInput == 1) {
				var copyText = document.getElementById('a_copyLink_1_'+fID);
			} else {
				var copyText = document.getElementById('a_copyLink_2_'+fID);
			}
			/* Select the text field */
			copyText.select();
			copyText.setSelectionRange(0, 99999); /*For mobile devices*/

			/* Copy the text inside the text field */
			document.execCommand('copy');
		}
	</script>
</body>
</html>
