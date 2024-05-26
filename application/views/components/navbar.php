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
