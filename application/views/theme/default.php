<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<!-- Tell the browser to be responsive to screen width -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<!-- Favicon icon -->
	<link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('') ?>assets/images/favicon.png">
	<title>@yield('title')</title>
	<!-- Custom CSS -->
	<link href="<?= base_url('') ?>assets/libs/flot/css/float-chart.css" rel="stylesheet">
	<!-- Custom CSS -->
	<link href="<?= base_url('') ?>assets/css/style.min.css" rel="stylesheet">
	<link href="<?= base_url('') ?>assets/css/admin.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/yaza-putu/helpers@V2.0.4/libs/libs-core.min.css">
	<!-- Dropify -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" integrity="sha512-EZSUkJWTjzDlspOoPSpUFR0o0Xy7jdzW//6qhUkoZ9c4StFkVsp9fbbd0O06p9ELS3H486m4wmrCELjza4JEog==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	@yield('style')
</head>

<body>
	<div class="preloader">
		<div class="lds-ripple">
			<div class="lds-pos"></div>
			<div class="lds-pos"></div>
		</div>
	</div>

	<div id="main-wrapper">
		<header class="topbar" data-navbarbg="skin5">
			@include('components/navbar')
		</header>

		<aside class="left-sidebar" data-sidebarbg="skin5">
			<!-- Sidebar scroll-->
			<div class="scroll-sidebar">
				<!-- Sidebar navigation-->
				<nav class="sidebar-nav">
					<ul id="sidebarnav" class="p-t-30">
						@include('components/sidebar')
					</ul>
				</nav>
				<!-- End Sidebar navigation -->
			</div>
			<!-- End Sidebar scroll-->
		</aside>
		<div class="page-wrapper">

			<div class="page-breadcrumb">
				<div class="row">
					<div class="col-12 d-flex no-block align-items-center">
						<h4 class="page-title">@yield('title')</h4>
					</div>
				</div>
			</div>
			@yield('content')
			<footer class="footer text-center">
				Copyright &copy; Website Sistem Rekomendasi Rental Motor <?= date('Y'); ?>
			</footer>
		</div>

	</div>
	<input type="hidden" id="base-url" value="<?= base_url('') ?>">
	@yield('url')
	@include('components/script')
	<script>
		$('.custom-file-input').on('change', function() {
			let fileName = $(this).val().split('\\').pop();
			$(this).next('.custom-file-label').addClass("selected").html(fileName);
		});
	</script>
	<script src="<?= base_url('') ?>assets/libs/popper.js/dist/umd/popper.min.js"></script>
	<script src="<?= base_url('') ?>assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
	<script src="<?= base_url('') ?>assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
	<script src="<?= base_url('') ?>assets/extra-libs/sparkline/sparkline.js"></script>
	<!--Wave Effects -->
	<script src="<?= base_url('') ?>assets/js/waves.js"></script>
	<!--Menu sidebar -->
	<script src="<?= base_url('') ?>assets/js/sidebarmenu.js"></script>
	<!--Custom JavaScript -->
	<script src="<?= base_url('') ?>assets/js/custom.min.js"></script>
	<!--This page JavaScript -->
	<!-- <script src="dist/js/pages/dashboards/dashboard1.js"></script> -->
	<!-- Charts js Files -->
	<script src="<?= base_url('') ?>assets/libs/flot/excanvas.js"></script>
	<script src="<?= base_url('') ?>assets/libs/flot/jquery.flot.js"></script>
	<script src="<?= base_url('') ?>assets/libs/flot/jquery.flot.pie.js"></script>
	<script src="<?= base_url('') ?>assets/libs/flot/jquery.flot.time.js"></script>
	<script src="<?= base_url('') ?>assets/libs/flot/jquery.flot.stack.js"></script>
	<script src="<?= base_url('') ?>assets/libs/flot/jquery.flot.crosshair.js"></script>
	<script src="<?= base_url('') ?>assets/libs/flot.tooltip/js/jquery.flot.tooltip.min.js"></script>
	<!--	<script src="--><?php //= base_url('') 
							?><!--assets/extra-libs/multicheck/datatable-checkbox-init.js"></script>-->
	<!--	<script src="--><?php //= base_url('') 
							?><!--assets/extra-libs/multicheck/jquery.multicheck.js"></script>-->
	<!--	<script src="--><?php //= base_url('') 
							?><!--assets/extra-libs/DataTables/datatables.min.js"></script>-->
	<script src="<?= base_url('') ?>assets/js/pages/chart/chart-page-init.js"></script>
	<script src="<?= base_url('') ?>assets/js/helper.js"></script>

	@yield('script')
</body>

</html>
