<div class="modal fade" id="modal-alternative" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h2 class="modal-title fs-5" id="exampleModalLabel">Modal title</h2>
			</div>
			<form id="form-alternative">
				<input type="hidden" name="id" id="id" value="">
				<div class="modal-body">
					<div class="form-group row">
						<label for="bike_id" class="col-sm-3 control-label col-form-label">Nama Bike</label>
						<div class="col-sm-9">
							<select class="form-control" aria-label="bike_id" name="bike_id" id="bike_id">
								<option value="">Pilih bike</option>
							</select>
						</div>
					</div>
					<?php foreach ($kriteria as $kriterian) { ?>
						<div class="form-group row">
							<label for="subcriteria_id" class="col-sm-3 control-label col-form-label"><?= $kriterian->name ?></label>
							<div class="col-sm-9">
								<select class="form-control" aria-label="subcriteria_id" name="<?= $kriterian->code ?>" id="{{ $kriterian->code }}">
									<option value="">Pilih <?= strtolower($kriterian->name) ?></option>
									<?php foreach (getSubcriteriaByCriteriaId($kriterian->id) as $subkriterian) { ?>
										<option value="<?= $subkriterian->id ?>"><?= $subkriterian->name ?></option>
									<?php } ?>
								</select>
							</div>
						</div>
					<?php } ?>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary" id="btn-submit">Save changes</button>
				</div>
			</form>
		</div>
	</div>
</div>
