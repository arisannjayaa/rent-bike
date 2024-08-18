<div class="modal fade" id="modal-subcriteria" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h2 class="modal-title fs-5" id="exampleModalLabel">Modal title</h2>
			</div>
			<form id="form-subcriteria">
				<input type="hidden" name="id" id="id" value="">
				<div class="modal-body">
					<div class="form-group row">
						<label for="criteria_id" class="col-sm-3 control-label col-form-label">Kriteria</label>
						<div class="col-sm-9">
							<select class="form-control" aria-label="criteria_id" name="criteria_id" id="criteria_id">
								<option value="">Pilih jenis kriteria</option>
								@foreach($kriteria as $row)
									<option value="{{ $row->id }}">{{ $row->code . ' - ' . $row->name}}</option>
								@endforeach
							</select>
							<?= form_error('criteria_id', '<small class="text-danger pl-3">', '</small>'); ?>
						</div>
					</div>
					<div class="form-group row">
						<label for="name" class="col-sm-3 control-label col-form-label">Nama</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="name" name="name" placeholder="Input nama subkriteria...">
						</div>
					</div>
					<div class="form-group row">
						<label for="weight" class="col-sm-3 control-label col-form-label">Bobot</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="weight" name="weight" placeholder="Input bobot subkriteria..."">
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
