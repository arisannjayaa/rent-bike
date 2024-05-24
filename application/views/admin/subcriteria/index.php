<div class="container-fluid">
	<?= $this->session->flashdata('message'); ?>
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<button type="button" class="btn btn-primary mb-3" id="btn-add" data-toggle="modal" data-target="#modal-create">Add</button>
					<?= form_error('vendor', '<div class="alert alert-success" role="alert">', '</div>') ?>
					<div class="table-responsive">
						<table id="zero_config" class="table table-striped table-bordered">
							<thead>
							<tr>
								<th>No.</th>
								<th>Kode Kriteria</th>
								<th>Nama</th>
								<th>Bobot</th>
								<th>Aksi</th>
							</tr>
							</thead>
							<?php $no = 1;
							foreach ($subkriteria as $item) : ?>
								<tbody>
								<tr>
									<td><?= $no++ ?></td>
									<td><?= $item->code ?></td>
									<td><?= $item->name ?></td>
									<td><?= $item->weight ?></td>
									<td>
										<button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-edit-<?= $item->id ?>"><i class="fas fa-edit"></i></button>
										<a href="<?= base_url('subkriteria/delete/' . $item->id)?>" class="btn btn-danger btn-sm" onclick="return confirm('Delete this data?')"><i class="fas fa-trash"></i></a>
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
</div>
<?php include "modal-create.php"?>
<?php include "modal-edit.php"?>

