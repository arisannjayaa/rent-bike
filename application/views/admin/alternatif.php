<div class="container-fluid">
	<?= $this->session->flashdata('message'); ?>
	<?= form_error('name', '<small class="text-danger">', '</small>'); ?>
	<!-- ============================================================== -->
	<!-- Start Page Content -->
	<!-- ============================================================== -->
	<div class="row">
		<div class="col-12">

			<div class="card">
				<div class="card-body">

					<a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#exampleModal">Add</a>
					<?= form_error('vendor', '<div class="alert alert-success" role="alert">', '</div>') ?>
					<div class="table-responsive">
						<table id="zero_config" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>No.</th>
									<th>Merk</th>
									<th>Tipe</th>
									<th>Warna</th>
									<th>No. Plat</th>
									<th>Rental</th>
									<th>No. Telp</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<?php $no = 1;
							foreach ($alternatif as $al) : ?>
								<tbody>
									<tr>
										<td><?= $no++ ?></td>
										<td><?= $al->merk ?></td>
										<td><?= $al->tipe ?></td>
										<td><?= $al->warna ?></td>
										<td><?= $al->nopol ?></td>
										<td><?= $al->rental ?></td>
										<td><?= $al->telp ?></td>
										<td>

											<a href="" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#exampleModal2<?= $al->id ?>"><i class="fas fa-edit"></i></a>

											<a href="<?= base_url('alternatif/delete/' . $al->id)?>" class="btn btn-danger btn-sm" onclick="return confirm('Delete this data?')"><i class="fas fa-trash"></i></a>
										</td>
									</tr>

								</tbody>
							<?php endforeach ?>
						</table>

					</div>

				</div>
			</div>
		</div>
	</div>
	<!-- ============================================================== -->
	<!-- End PAge Content -->
	<!-- ============================================================== -->
	<!-- ============================================================== -->
	<!-- Right sidebar -->
	<!-- ============================================================== -->
	<!-- .right-sidebar -->
	<!-- ============================================================== -->
	<!-- End Right sidebar -->
	<!-- ============================================================== -->
</div>
<!-- Button trigger modal -->
< <!-- Modal -->

	<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h2 class="modal-title fs-5" id="exampleModalLabel">Tambah Data Motor</h2>

				</div>
				<form action="<?= base_url('alternatif/tambah_aksi'); ?>" method="post">
					<div class="modal-body">
						<div class="form-group row">
							<label for="fname" class="col-sm-3 text-right control-label col-form-label">Merk</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="merk" name="merk" placeholder="Input merk kendaraan...">
								<?= form_error('merk', '<small class="text-danger pl-3">', '</small>'); ?>
							</div>
						</div>
						<div class="form-group row">
							<label for="fname" class="col-sm-3 text-right control-label col-form-label">Tipe</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="tipe" name="tipe" placeholder="Input tipe kendaraan...">
								<?= form_error('tipe', '<small class="text-danger pl-3">', '</small>'); ?>
							</div>
						</div>
						<div class="form-group row">
							<label for="fname" class="col-sm-3 text-right control-label col-form-label">Warna</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="warna" name="warna" placeholder="Input warna kendaraan...">
								<?= form_error('warna', '<small class="text-danger pl-3">', '</small>'); ?>
							</div>
						</div>
						<div class="form-group row">
							<label for="fname" class="col-sm-3 text-right control-label col-form-label">No. Plat</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="nopol" name="nopol" placeholder="Input no. plat kendaraan...">
								<?= form_error('nopol', '<small class="text-danger pl-3">', '</small>'); ?>
							</div>
						</div>
						<div class="form-group row">
							<label for="fname" class="col-sm-3 text-right control-label col-form-label">Nama Rental</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="rental" name="rental" placeholder="Input nama rental kendaraan...">
								<?= form_error('rental', '<small class="text-danger pl-3">', '</small>'); ?>
							</div>
						</div>
						<div class="form-group row">
							<label for="fname" class="col-sm-3 text-right control-label col-form-label">No. Telp</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="telp" name="telp" placeholder="Input no. telp rental...">
								<?= form_error('telp', '<small class="text-danger pl-3">', '</small>'); ?>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary">Save changes</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<?php foreach($alternatif as $al) { ?>
	<div class="modal fade" id="exampleModal2<?= $al->id ?>" tabindex="-1" aria-labelledby="exampleModalLabel2" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h2 class="modal-title fs-5" id="exampleModalLabel">Edit Data Motor</h2>

				</div>
				<form action="<?= base_url('alternatif/edit/' . $al->id) ?>" method="post">
					<div class="modal-body">
						<div class="form-group row">
							<label for="fname" class="col-sm-3 text-right control-label col-form-label">Merk</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="merk" name="merk" placeholder="Input merk kendaraan..." value="<?= $al->merk?>">
								<?= form_error('merk', '<small class="text-danger pl-3">', '</small>'); ?>
							</div>
						</div>
						<div class="form-group row">
							<label for="fname" class="col-sm-3 text-right control-label col-form-label">Tipe</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="tipe" name="tipe" placeholder="Input tipe kendaraan..." value="<?= $al->tipe?>">
								<?= form_error('tipe', '<small class="text-danger pl-3">', '</small>'); ?>
							</div>
						</div>
						<div class="form-group row">
							<label for="fname" class="col-sm-3 text-right control-label col-form-label">Warna</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="warna" name="warna" placeholder="Input warna kendaraan..."value="<?= $al->warna?>">
								<?= form_error('warna', '<small class="text-danger pl-3">', '</small>'); ?>
							</div>
						</div>
						<div class="form-group row">
							<label for="fname" class="col-sm-3 text-right control-label col-form-label">No. Plat</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="nopol" name="nopol" placeholder="Input no. plat kendaraan..."value="<?= $al->nopol?>">
								<?= form_error('nopol', '<small class="text-danger pl-3">', '</small>'); ?>
							</div>
						</div>
						<div class="form-group row">
							<label for="fname" class="col-sm-3 text-right control-label col-form-label">Nama Rental</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="rental" name="rental" placeholder="Input nama rental kendaraan..."value="<?= $al->rental?>">
								<?= form_error('rental', '<small class="text-danger pl-3">', '</small>'); ?>
							</div>
						</div>
						<div class="form-group row">
							<label for="fname" class="col-sm-3 text-right control-label col-form-label">No. Telp</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="telp" name="telp" placeholder="Input no. telp rental..."value="<?= $al->telp?>">
								<?= form_error('telp', '<small class="text-danger pl-3">', '</small>'); ?>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary">Save changes</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<?php } ?>
