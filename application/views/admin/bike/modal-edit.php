<?php foreach ($bike as $item) { ?>
	<div class="modal fade" id="modal-edit-<?= $item->id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h2 class="modal-title fs-5" id="exampleModalLabel">Edit Bike</h2>
				</div>
				<form id="form-criteria" method="post" action="<?= base_url('bike/update/'. $item->id) ?>">
					<div class="modal-body">
						<div class="form-group row">
							<label for="name" class="col-sm-3 control-label col-form-label">Nama</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="name" name="name" placeholder="Input nama bike..." value="<?= $item->name ?>">
								<?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
							</div>
						</div>
						<div class="form-group row">
							<label for="price" class="col-sm-3 control-label col-form-label">Harga</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="price" name="price" placeholder="Input harga bike..." value="<?= $item->price ?>">
								<?= form_error('price', '<small class="text-danger pl-3">', '</small>'); ?>
							</div>
						</div>
						<div class="form-group row">
							<label for="year_release" class="col-sm-3 control-label col-form-label">Tahun</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="year_release" name="year_release" placeholder="Input tahun bike..." value="<?= $item->year_release ?>">
								<?= form_error('year_release', '<small class="text-danger pl-3">', '</small>'); ?>
							</div>
						</div>
						<div class="form-group row">
							<label for="engine_power" class="col-sm-3 control-label col-form-label">Kekuatan Mesin</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="engine_power" name="engine_power" placeholder="Input kekuatan mesin bike..." value="<?= $item->engine_power ?>">
								<?= form_error('engine_power', '<small class="text-danger pl-3">', '</small>'); ?>
							</div>
						</div>
						<div class="form-group row">
							<label for="fuel" class="col-sm-3 control-label col-form-label">Konsumsi Bahan Bakar</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="fuel" name="fuel" placeholder="Input kekuatan mesin bike..." value="<?= $item->fuel ?>">
								<?= form_error('fuel', '<small class="text-danger pl-3">', '</small>'); ?>
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
