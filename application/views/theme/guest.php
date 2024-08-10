<!doctype html>
<html lang="en">

<head>
	<title>@yield('title')</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700;900&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="<?= base_url('assets/template_guest/') ?>fonts/icomoon/style.css">
	<link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('') ?>assets/images/favicon.png">
	<link rel="stylesheet" href="<?= base_url('assets/template_guest/') ?>css/bootstrap.min.css">
	<link rel="stylesheet" href="<?= base_url('assets/template_guest/') ?>css/bootstrap-datepicker.css">
	<link rel="stylesheet" href="<?= base_url('assets/template_guest/') ?>css/jquery.fancybox.min.css">
	<link rel="stylesheet" href="<?= base_url('assets/template_guest/') ?>css/owl.carousel.min.css">
	<link rel="stylesheet" href="<?= base_url('assets/template_guest/') ?>css/owl.theme.default.min.css">
	<link rel="stylesheet" href="<?= base_url('assets/template_guest/') ?>fonts/flaticon/font/flaticon.css">
	<link rel="stylesheet" href="<?= base_url('assets/template_guest/') ?>css/aos.css">

	<!-- MAIN CSS -->
	<link rel="stylesheet" href="<?= base_url('assets/template_guest/') ?>css/style.css">
	<style>
		.pagination a.page-link {
			color: #007bff;
			/* width: 40px !important; */
			height: 40px !important;
			text-align: center !important;
			/* border-radius: 100% !important; */
			margin-right: 10px;
		}

		.page-item.active .page-link {
			z-index: 1;
			color: #fff;
			background-color: #007bff;
			border-color: #007bff;
			height: 40px !important;
			width: 40px !important;
			margin-right: 10px;
		}
	</style>
	@yield('style')
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">
</head>

<body>


	<div class="site-wrap" id="home-section">

		<div class="site-mobile-menu site-navbar-target">
			<div class="site-mobile-menu-header">
				<div class="site-mobile-menu-close mt-3">
					<span class="icon-close2 js-menu-toggle"></span>
				</div>
			</div>
			<div class="site-mobile-menu-body"></div>
		</div>



		<header class="site-navbar site-navbar-target" role="banner">

			<div class="container">
				<div class="row align-items-center position-relative">

					<div class="col-3">
						<div class="site-logo">
							<a href="<?= base_url('home') ?>"><strong>Bike Idea</strong></a>
						</div>
					</div>

					<div class="col-9 text-right">

						<span class="d-inline-block d-lg-none"><a href="#" class="site-menu-toggle js-menu-toggle py-5"><span class="icon-menu h3 text-black"></span></a></span>

						<nav class="site-navigation text-right ml-auto d-none d-lg-block" role="navigation">
							<ul class="site-menu main-menu js-clone-nav ml-auto">
								<li class="<?= ($this->uri->segment(1) == 'home') ? 'active' : '' ?>"><a href="<?= base_url('home') ?>" class="nav-link">Home</a></li>
								<li class="<?= ($this->uri->segment(1) == 'recommendation') ? 'active' : '' ?>"><a href="<?= base_url('recommendation') ?>" class="nav-link">Recommendation</a></li>
								<li class="<?= ($this->uri->segment(1) == 'contact') ? 'active' : '' ?>"><a href="<?= base_url('contact') ?>" class="nav-link">Contact</a></li>
							</ul>
						</nav>
					</div>



				</div>
			</div>

		</header>


		@yield('content')


		<footer class="site-footer">
			<div class="container">
				<div class="row">
					<div class="col-lg-3">
						<h2 class="footer-heading mb-4">Contact Info</h2>
						<p>Ingin data motormu diupdate di sistem? hubungi kontak dibawah ini!</p>

						<div>
							<a href="mailto:info@mydomain.com">bike_idea@gmail.com</a>
							<br>
							<a href="tel://08970274763">+62 089 70274763</a>
						</div>
					</div>
					<div class="col-lg-8 ml-auto">
						<div class="row">
							<div class="col-lg-3">
								<h2 class="footer-heading mb-4">Quick Links</h2>
								<ul class="list-unstyled">
									<li><a href="<?= base_url('home') ?>">Home</a></li>
									<li><a href="<?= base_url('recomment') ?>">Recommendation</a></li>
									<li><a href="<?= base_url('contact') ?>">Contact</a></li>
									<div class="mt-4">
										<ul class="list-unstyled social">
											<li><a href=""><span class="icon-facebook"></span></a></li>
											<li><a href="#"><span class="icon-instagram"></span></a></li>
											<li><a href="#"><span class="icon-whatsapp"></span></a></li>
										</ul>
									</div>
								</ul>
							</div>



						</div>
					</div>
				</div>
				<div class="row pt-5 mt-5 text-center">
					<div class="col-md-12">
						<div class="border-top pt-5">
							<p>
								<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
								Copyright &copy;<script>

								</script> Website Sistem Rekomendasi Rental Motor <?= date('Y'); ?> <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
							</p>
						</div>
					</div>

				</div>
			</div>
		</footer>

	</div>

	<script src="<?= base_url('assets/template_guest/') ?>js/jquery-3.3.1.min.js"></script>
	<script src="<?= base_url('assets/template_guest/') ?>js/popper.min.js"></script>
	<script src="<?= base_url('assets/template_guest/') ?>js/bootstrap.min.js"></script>
	<script src="<?= base_url('assets/template_guest/') ?>js/owl.carousel.min.js"></script>
	<script src="<?= base_url('assets/template_guest/') ?>js/jquery.sticky.js"></script>
	<script src="<?= base_url('assets/template_guest/') ?>js/jquery.waypoints.min.js"></script>
	<script src="<?= base_url('assets/template_guest/') ?>js/jquery.animateNumber.min.js"></script>
	<script src="<?= base_url('assets/template_guest/') ?>js/jquery.fancybox.min.js"></script>
	<script src="<?= base_url('assets/template_guest/') ?>js/jquery.easing.1.3.js"></script>
	<script src="<?= base_url('assets/template_guest/') ?>js/bootstrap-datepicker.min.js"></script>
	<script src="<?= base_url('assets/template_guest/') ?>js/aos.js"></script>
	<script src="<?= base_url('') ?>assets/js/helper.js"></script>
	<script src="<?= base_url('') ?>js/main.js"></script>
	<input type="hidden" id="base-url" value="<?= base_url('') ?>">
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
	@yield('url')
	@yield('script')
</body>

</html>
