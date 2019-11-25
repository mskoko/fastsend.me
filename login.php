<?php

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 *   file                 :  login.php
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 *   author               :  Muhamed Skoko - info@mskoko.me
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */

include_once($_SERVER['DOCUMENT_ROOT'].'/includes.php');

//////////////////////////

if (!($User->IsLoged()) == false) {
    header('Location: /home');
    die();
}


//Login
if(isset($_GET['log'])) {
    $POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

    if(empty($POST['Email'])) {
        $error[] = 'Greska!';
        $Alert->SaveAlert('Polje #Email mora biti popunjeno.', 'info');
    }

    if(empty($POST['Password'])) {
        $error[] = 'Greska!';
        $Alert->SaveAlert('Polje #Password mora biti popunjeno.', 'info'); 
    }

    if(empty($error)) {
        echo $User->LogIn($POST['Email'], $POST['Password']);
    } else {
    	$Alert->SaveAlert('Doslo je do nepoznate greske! Molimo pokusajte opet malo kasnije.', 'error'); 
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Log In | <?php echo $Site->SiteConfig()['site_name']; ?></title>

	<?php include_once($_SERVER['DOCUMENT_ROOT'].'/assets/php/head.php'); ?>

	<!-- ld -->
	<script type="application/ld+json" src="/assets/json/ld.json"></script>
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
								<!-- Swich to Manager panel -->
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
    		<div class="col-md-6">
    			<form action="/login?log" method="POST">
	                <div class="form-group">
	                    <label>Email address</label>
	                    <input type="email" name="Email" class="form-control" placeholder="Email" required="">
	                </div>

	                <div class="form-group">
	                    <label>Password</label>
	                    <input type="password" name="Password" class="form-control" placeholder="Password" required="">
	                </div>

	                <button class="btn btn-primary btn-flat m-b-30 m-t-30" style="width:100%;">Sign in</button>     
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