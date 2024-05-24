<?php foreach ($subkriteria as $item) { ?>
	<div class="modal fade" id="modal-edit-<?= $item->id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h2 class="modal-title fs-5" id="exampleModalLabel">Edit Subriteria</h2>
				</div>
				<form id="form-criteria" method="post" action="<?= base_url('subkriteria/update/'. $item->id) ?>">
					<div class="modal-body">
						<div class="form-group row">
							<label for="criteria_id" class="col-sm-3 control-label col-form-label">Kriteria</label>
							<div class="col-sm-9">
								<select class="form-control" aria-label="criteria_id" name="criteria_id" id="criteria_id">
									<option value="">Pilih jenis kriteria</option>
									<?php foreach ($kriteria as $row) { ?>
										<option <?= $item->criteria_id == $row->id ? 'selected' : '' ?>  value="<?= $row->id ?>"><?= $row->code .'-'. $row->name ?></option>
									<?php } ?>
								</select>
								<?= form_error('criteria_id', '<small class="text-danger pl-3">', '</small>'); ?>
							</div>
						</div>
						<div class="form-group row">
							<label for="name" class="col-sm-3 control-label col-form-label">Nama</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="name" name="name" placeholder="Input nama subkriteria..." value="<?= $item->name ?>">
								<?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
							</div>
						</div>
						<div class="form-group row">
							<label for="weight" class="col-sm-3 control-label col-form-label">Bobot</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="weight" name="weight" placeholder="Input bobot subkriteria..." value="<?= $item->weight ?>">
								<?= form_error('weight', '<small class="text-danger pl-3">', '</small>'); ?>
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
