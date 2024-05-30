<div class="modal fade" id="modal-create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h2 class="modal-title fs-5" id="exampleModalLabel">Tambah Alternatif</h2>
			</div>
			<form id="form-criteria" method="post" action="<?= base_url('alternatif/store') ?>">
				<div class="modal-body">
					<div class="form-group row">
						<label for="bike_id" class="col-sm-3 control-label col-form-label">Nama Bike</label>
						<div class="col-sm-9">
							<select class="form-control" aria-label="bike_id" name="bike_id" id="bike_id">
								<option value="">Pilih bike</option>
								<?php foreach ($bike as $row) { ?>
									<option <?= set_select('bike_id', $row->id) ?>  value="<?= $row->id ?>"><?= $row->name ?></option>
								<?php } ?>
							</select>
							<?= form_error('bike_id', '<small class="text-danger pl-3">', '</small>'); ?>
						</div>
					</div>
					<?php foreach ($kriteria as $kriterian) { ?>
					<div class="form-group row">
						<label for="subcriteria_id" class="col-sm-3 control-label col-form-label"><?= $kriterian->name ?></label>
						<div class="col-sm-9">
							<select class="form-control" aria-label="subcriteria_id" name="<?= $kriterian->code ?>" id="subcriteria_id">
								<option value="">Pilih <?= strtolower($kriterian->name) ?></option>
								<?php foreach (getSubcriteriaByCriteriaId($kriterian->id) as $subkriterian) { ?>
									<option <?= set_select($kriterian->code, $subkriterian->id) ?>  value="<?= $subkriterian->id ?>"><?= $subkriterian->name ?></option>
								<?php } ?>
							</select>
							<?= form_error($kriterian->code, '<small class="text-danger pl-3">', '</small>'); ?>
						</div>
					</div>
					<?php } ?>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Save changes</button>
				</div>
			</form>
		</div>
	</div>
</div>
