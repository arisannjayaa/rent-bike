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

<li class="sidebar-item <?= $this->uri->uri_string() == 'matrix' ? 'active' : '' ?>"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
																						 href="<?= base_url('matrix') ?>" aria-expanded="false"><i class="mdi mdi-chart-pie"></i><span
			class="hide-menu">Matriks</span></a></li>
<li class="sidebar-item <?= $this->uri->uri_string() == 'preference' ? 'active' : '' ?>"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
							 href="<?= base_url('preference') ?>" aria-expanded="false"><i class="mdi mdi-chart-line"></i><span
			class="hide-menu">Nilai Preferensi</span></a></li>
