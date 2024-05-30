<div class="modal fade" id="modal-criteria" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h2 class="modal-title fs-5" id="exampleModalLabel">Modal title</h2>
			</div>
			<form id="form-criteria">
				<input type="hidden" name="id" id="id" value="">
				<div class="modal-body">
					<div class="form-group row">
						<label for="code" class="col-sm-3 control-label col-form-label">Kode</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="code" name="code" placeholder="Input kode kriteria..." value="<?= set_value('code') ?>">
						</div>
					</div>
					<div class="form-group row">
						<label for="name" class="col-sm-3 control-label col-form-label">Nama</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="name" name="name" placeholder="Input nama kriteria..." value="<?= set_value('name') ?>">
						</div>
					</div>
					<div class="form-group row">
						<label for="attribute" class="col-sm-3 control-label col-form-label">Atribut</label>
						<div class="col-sm-9">
							<select class="form-control" aria-label="attribute" name="attribute" id="attribute">
								<option value="">Pilih jenis atribut</option>
								<option value="Cost">Cost</option>
								<option value="Benefit">Benefit</option>
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label for="weight" class="col-sm-3 control-label col-form-label">Bobot</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="weight" name="weight" placeholder="Input bobot kriteria..." value="<?= set_value('weight') ?>">
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary" id="btn-submit">Save changes</button>
				</div>
			</form>
		</div>
	</div>
</div>
