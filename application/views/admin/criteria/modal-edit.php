<?php foreach ($kriteria as $item) { ?>
	<div class="modal fade" id="modal-edit-<?= $item->id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h2 class="modal-title fs-5" id="exampleModalLabel">Edit Kriteria</h2>
				</div>
				<form id="form-criteria" method="post" action="<?= base_url('kriteria/update/'. $item->id) ?>">
					<div class="modal-body">
						<div class="form-group row">
							<label for="code" class="col-sm-3 control-label col-form-label">Kode</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="code" name="code" placeholder="Input kode kriteria..." value="<?= $item->code ?>">
								<?= form_error('code', '<small class="text-danger pl-3">', '</small>'); ?>
							</div>
						</div>
						<div class="form-group row">
							<label for="name" class="col-sm-3 control-label col-form-label">Nama</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="name" name="name" placeholder="Input nama kriteria..." value="<?= $item->name ?>">
								<?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
							</div>
						</div>
						<div class="form-group row">
							<label for="attribute" class="col-sm-3 control-label col-form-label">Atribut</label>
							<div class="col-sm-9">
								<select class="form-control" aria-label="attribute" name="attribute" id="attribute">
									<option value="">Pilih jenis atribut</option>
									<option value="Cost" <?= $item->attribute == 'Cost' ? 'selected' : '' ?> >Cost</option>
									<option value="Benefit" <?= $item->attribute == 'Benefit' ? 'selected' : '' ?>>Benefit</option>
								</select>
								<?= form_error('attribute', '<small class="text-danger pl-3">', '</small>'); ?>
							</div>
						</div>
						<div class="form-group row">
							<label for="weight" class="col-sm-3 control-label col-form-label">Bobot</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="weight" name="weight" placeholder="Input bobot kriteria..." value="<?= $item->weight ?>">
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
