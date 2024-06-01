<div class="modal fade" id="modal-bike" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h2 class="modal-title fs-5" id="exampleModalLabel">Modal title</h2>
			</div>
			<form id="form-bike" enctype="multipart/form-data">
				<input type="hidden" name="id" id="id" value="">
				<div class="modal-body">
					<div class="form-group row">
						<div class="col-sm-12">
							<div class="custom-file"></div>
						</div>
					</div>
					<div class="form-group row">
						<label for="name" class="col-sm-3 control-label col-form-label">Nama</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="name" name="name" placeholder="Input nama bike...">
						</div>
					</div>
					<div class="form-group row">
						<label for="price" class="col-sm-3 control-label col-form-label">Harga</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="price" name="price" placeholder="Input harga bike...">
						</div>
					</div>
					<div class="form-group row">
						<label for="year_release" class="col-sm-3 control-label col-form-label">Tahun</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="year_release" name="year_release" placeholder="Input tahun bike...">
						</div>
					</div>
					<div class="form-group row">
						<label for="engine_power" class="col-sm-3 control-label col-form-label">Kekuatan Mesin</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="engine_power" name="engine_power" placeholder="Input kekuatan mesin bike...">
						</div>
					</div>
					<div class="form-group row">
						<label for="fuel" class="col-sm-3 control-label col-form-label">Konsumsi Bahan Bakar</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="fuel" name="fuel" placeholder="Input kekuatan mesin bike...">
						</div>
					</div>
					<div class="form-group row">
						<label for="telp" class="col-sm-3 control-label col-form-label">Telp</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="telp" name="telp" placeholder="Input no telp bike...">
						</div>
					</div>
					<div class="form-group row">
						<label for="vendor" class="col-sm-3 control-label col-form-label">Vendor</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="vendor" name="vendor" placeholder="Input nama vendor bike...">
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
