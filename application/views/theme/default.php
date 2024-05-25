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
			<nav class="navbar top-navbar navbar-expand-md navbar-dark">
				<div class="navbar-header" data-logobg="skin5">
					<a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i
							class="ti-menu ti-close"></i></a>
					<a class="navbar-brand" href="<?= base_url('') ?>admin">
						<b class="logo-icon p-l-10">
							<img src="<?= base_url('') ?>assets/images/logo-icon.png" alt="homepage"
								class="light-logo" />

						</b>
						<!--End Logo icon -->
						<!-- Logo text -->
						<span class="logo-text">
							<!-- dark Logo text -->
							<img src="<?= base_url('') ?>assets/images/logo-text.png" alt="homepage"
								class="light-logo" />

						</span>
						<!-- Logo icon -->
						<!-- <b class="logo-icon"> -->
						<!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
						<!-- Dark Logo icon -->
						<!-- <img src="assets/images/logo-text.png" alt="homepage" class="light-logo" /> -->

						<!-- </b> -->
						<!--End Logo icon -->
					</a>
					<!-- ============================================================== -->
					<!-- End Logo -->
					<!-- ============================================================== -->
					<!-- ============================================================== -->
					<!-- Toggle which is visible on mobile only -->
					<!-- ============================================================== -->
					<a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)"
						data-toggle="collapse" data-target="#navbarSupportedContent"
						aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i
							class="ti-more"></i></a>
				</div>
				<!-- ============================================================== -->
				<!-- End Logo -->
				<!-- ============================================================== -->
				<div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
					<!-- ============================================================== -->
					<!-- toggle and nav items -->
					<!-- ============================================================== -->
					<ul class="navbar-nav float-left mr-auto">
						<li class="nav-item d-none d-md-block"><a
								class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)"
								data-sidebartype="mini-sidebar"><i class="mdi mdi-menu font-24"></i></a></li>
						<!-- ============================================================== -->
						<!-- create neww -->
						<!-- ============================================================== -->

					</ul>
					<!-- ============================================================== -->
					<!-- Right side toggle and nav items -->
					<!-- ============================================================== -->
					<ul class="navbar-nav float-right">
						<!-- ============================================================== -->
						<!-- Comment -->
						<!-- ============================================================== -->

						<!-- ============================================================== -->
						<!-- End Comment -->
						<!-- ============================================================== -->
						<!-- ============================================================== -->
						<!-- Messages -->
						<!-- ============================================================== -->

						<!-- ============================================================== -->
						<!-- End Messages -->
						<!-- ============================================================== -->

						<!-- ============================================================== -->
						<!-- User profile and search -->
						<!-- ============================================================== -->

						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="#"
								data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<img src="<?= base_url('assets/images/users/') . $user['image']; ?>" alt="user"
									class="rounded-circle" width="31">
								<span class="ml-2"><?= $user['name']; ?></span> <!-- Menampilkan nama pengguna -->
							</a>
							<div class="dropdown-menu dropdown-menu-right user-dd animated">
								<a class="dropdown-item" href="<?= base_url('profile'); ?>"><i
										class="mdi mdi-account m-r-5 m-l-5"></i> My Profile</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="<?= base_url('admin/change_password'); ?>"><i
										class="mdi mdi-key m-r-5 m-l-5"></i> Change password</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="<?= base_url('auth/logout'); ?>"><i
										class="mdi mdi-power m-r-5 m-l-5"></i> Logout</a>
							</div>
						</li>
						<!-- ============================================================== -->
						<!-- User profile and search -->
						<!-- ============================================================== -->
					</ul>
				</div>
			</nav>
		</header>

		<aside class="left-sidebar" data-sidebarbg="skin5">
			<!-- Sidebar scroll-->
			<div class="scroll-sidebar">
				<!-- Sidebar navigation-->
				<nav class="sidebar-nav">
					<ul id="sidebarnav" class="p-t-30">
						<li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
								href="<?= base_url('') ?>admin" aria-expanded="false"><i
									class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard</span></a></li>
						<li class="sidebar-item"> <a
								class="sidebar-link has-arrow waves-effect waves-dark <?= $this->uri->uri_string() == 'kriteria/store' || $this->uri->uri_string() == 'kriteria' || $this->uri->uri_string() == 'bike/store' || $this->uri->uri_string() == 'bike' ? 'active' : '' ?>"
								href="javascript:void(0)" aria-expanded="false"><i
									class="mdi mdi-format-list-bulleted-type"></i><span
									class="hide-menu">Data</span></a>
							<ul aria-expanded="false"
								class="collapse  first-level <?= $this->uri->uri_string() == 'kriteria/store' || $this->uri->uri_string() == 'kriteria' || $this->uri->uri_string() == 'subkriteria/store' || $this->uri->uri_string() == 'subkriteria' || $this->uri->uri_string() == 'bike/store' || $this->uri->uri_string() == 'bike' ? 'in' : '' ?>">
								<li
									class="sidebar-item <?= $this->uri->uri_string() == 'kriteria/store' || $this->uri->uri_string() == 'kriteria' ? 'active' : '' ?>">
									<a href="<?= base_url('') ?>kriteria" class="sidebar-link"><i class=""></i><span
											class="hide-menu">Bobot & Kriteria</span></a></li>
								<li
									class="sidebar-item <?= $this->uri->uri_string() == 'subkriteria/store' || $this->uri->uri_string() == 'subkriteria' ? 'active' : '' ?>">
									<a href="<?= base_url('') ?>subkriteria" class="sidebar-link"><i class=""></i><span
											class="hide-menu">Subkriteria</span></a></li>
								<li
									class="sidebar-item <?= $this->uri->uri_string() == 'bike/store' || $this->uri->uri_string() == 'bike' ? 'active' : '' ?>">
									<a href="<?= base_url('') ?>bike" class="sidebar-link"><i class=""></i><span
											class="hide-menu">Bike</span></a></li>
								<li
									class="sidebar-item <?= $this->uri->uri_string() == 'alternatif/store' || $this->uri->uri_string() == 'alternatif' ? 'active' : '' ?>">
									<a href="<?= base_url('') ?>alternatif" class="sidebar-link"><i class=""></i><span
											class="hide-menu">Alternatif</span></a></li>
							</ul>
						</li>

						<li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
								href="pages-buttons.html" aria-expanded="false"><i class="mdi mdi-chart-pie"></i><span
									class="hide-menu">Matriks</span></a></li>
						<li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
								href="pages-buttons.html" aria-expanded="false"><i class="mdi mdi-chart-line"></i><span
									class="hide-menu">Nilai Preferensi</span></a></li>
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
	@yield('url')
	@include('components/script')
	<script>
		$('.custom-file-input').on('change', function () {
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
<!--	<script src="--><?php //= base_url('') ?><!--assets/extra-libs/multicheck/datatable-checkbox-init.js"></script>-->
<!--	<script src="--><?php //= base_url('') ?><!--assets/extra-libs/multicheck/jquery.multicheck.js"></script>-->
<!--	<script src="--><?php //= base_url('') ?><!--assets/extra-libs/DataTables/datatables.min.js"></script>-->
	<script src="<?= base_url('') ?>assets/js/pages/chart/chart-page-init.js"></script>

	@yield('script')
</body>

</html>
