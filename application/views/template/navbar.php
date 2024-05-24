<aside class="left-sidebar" data-sidebarbg="skin5">
	<!-- Sidebar scroll-->
	<div class="scroll-sidebar">
		<!-- Sidebar navigation-->
		<nav class="sidebar-nav">
			<ul id="sidebarnav" class="p-t-30">
				<li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= base_url('') ?>admin" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard</span></a></li>
				<li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark <?= $this->uri->uri_string() == 'kriteria/store' || $this->uri->uri_string() == 'kriteria' ? 'active' : '' ?>" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-format-list-bulleted-type"></i><span class="hide-menu">Data</span></a>
					<ul aria-expanded="false" class="collapse  first-level <?= $this->uri->uri_string() == 'kriteria/store' || $this->uri->uri_string() == 'kriteria' || $this->uri->uri_string() == 'subkriteria/store' || $this->uri->uri_string() == 'subkriteria' ? 'in' : '' ?>">
						<li class="sidebar-item"><a href="<?= base_url('') ?>alternatif" class="sidebar-link"><i class=""></i><span class="hide-menu">Alternatif</span></a></li>
						<li class="sidebar-item <?= $this->uri->uri_string() == 'kriteria/store' || $this->uri->uri_string() == 'kriteria' ? 'active' : '' ?>"><a href="<?= base_url('') ?>kriteria" class="sidebar-link"><i class=""></i><span class="hide-menu">Bobot & Kriteria</span></a></li>
						<li class="sidebar-item <?= $this->uri->uri_string() == 'subkriteria/store' || $this->uri->uri_string() == 'subkriteria' ? 'active' : '' ?>"><a href="<?= base_url('') ?>subkriteria" class="sidebar-link"><i class=""></i><span class="hide-menu">Subkriteria</span></a></li>
					</ul>
				</li>

				<li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="pages-buttons.html" aria-expanded="false"><i class="mdi mdi-chart-pie"></i><span class="hide-menu">Matriks</span></a></li>
				<li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="pages-buttons.html" aria-expanded="false"><i class="mdi mdi-chart-line"></i><span class="hide-menu">Nilai Preferensi</span></a></li>
				

			</ul>
		</nav>
		<!-- End Sidebar navigation -->
	</div>
	<!-- End Sidebar scroll-->
</aside>
<div class="page-wrapper">
	<!-- ============================================================== -->
	<!-- Bread crumb and right sidebar toggle -->
	<!-- ============================================================== -->
	<div class="page-breadcrumb">
		<div class="row">
			<div class="col-12 d-flex no-block align-items-center">
				<h4 class="page-title"><?= $title ?></h4>

			</div>
		</div>
	</div>
