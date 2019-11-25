<!-- Navigation -->
<div class="main_menu">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<nav class="navbar navbar-expand-lg navbar-light">
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>

					<div class="collapse navbar-collapse" id="navbarSupportedContent">
						<ul class="navbar-nav mr-auto">
							<li class="nav-item active">
								<a class="nav-link js-scroll-trigger" href="/home">Home</a>
							</li>

							<li class="nav-item">
								<a class="nav-link js-scroll-trigger" href="/home">How It Works</a>
							</li>

							<li class="nav-item">
								<a class="nav-link js-scroll-trigger" href="/home">News</a>
							</li>

							<li class="nav-item">
								<a class="nav-link js-scroll-trigger" href="/home">About</a>
							</li>

							<li class="nav-item">
								<a class="nav-link js-scroll-trigger" href="/home">Support</a>
							</li>
						</ul>

						<div class="rightNav" style="float:right;">
							<?php if (!($User->IsLoged()) == true) { ?>
								<li class="nav-item">
									<a class="nav-link js-scroll-trigger" href="/login?login">Log In</a>
								</li>

								<li class="nav-item">
									<a class="nav-link js-scroll-trigger" href="/register">Register</a>
								</li>
							<?php } ?>
						</div>
					</div>
				</nav>
			</div>
		</div>
	</div>
</div>