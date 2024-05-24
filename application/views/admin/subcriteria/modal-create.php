<div class="modal fade" id="modal-create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h2 class="modal-title fs-5" id="exampleModalLabel">Tambah Subkriteria</h2>
			</div>
			<form id="form-criteria" method="post" action="<?= base_url('subkriteria/store') ?>">
				<div class="modal-body">
					<div class="form-group row">
						<label for="criteria_id" class="col-sm-3 control-label col-form-label">Kriteria</label>
						<div class="col-sm-9">
							<select class="form-control" aria-label="criteria_id" name="criteria_id" id="criteria_id">
								<option value="">Pilih jenis kriteria</option>
								<?php foreach ($kriteria as $row) { ?>
									<option <?= set_select('criteria_id', $row->id) ?>  value="<?= $row->id ?>"><?= $row->code .'-'. $row->name ?></option>
								<?php } ?>
							</select>
							<?= form_error('criteria_id', '<small class="text-danger pl-3">', '</small>'); ?>
						</div>
					</div>
					<div class="form-group row">
						<label for="name" class="col-sm-3 control-label col-form-label">Nama</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="name" name="name" placeholder="Input nama subkriteria..." value="<?= set_value('name') ?>">
							<?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
						</div>
					</div>
					<div class="form-group row">
						<label for="weight" class="col-sm-3 control-label col-form-label">Bobot</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="weight" name="weight" placeholder="Input bobot subkriteria..." value="<?= set_value('weight') ?>">
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
