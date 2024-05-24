<div class="container-fluid">
	<?= $this->session->flashdata('message'); ?>

	<div class="card mb-3" style="max-width: 540px;">
		<div class="row g-0">
			<div class="col-md-4">
				<img src="<?= base_url('assets/images/users/') . $user['image']; ?>" class="img-fluid rounded-start" alt="...">
			</div>
			<div class="row">
				<div class="col-lg-6">

				</div>

			</div>
			<div class="col-md-8">
				<div class="card-body">
					<h5 class="card-title"><?= $user['name']; ?> <?= form_error('name', '<small class="text-danger">', '</small>'); ?></h5>

					<p class="card-text"><?= $user['email']; ?></p>
					<p class="card-text"><small class="text-body-secondary">Member since <?= date('d F Y'); ?></small></p>


				</div>

			</div>

		</div>
		<a href="" class="btn btn-primary mt-1 mb-1" data-toggle="modal" data-target="#exampleModal">Edit</a>

	</div>

	<!-- ============================================================== -->
	<!-- Recent comment and chats -->
	<!-- ============================================================== -->
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h2 class="modal-title fs-5" id="exampleModalLabel">Edit Profile</h2>

			</div>
			<?= form_open_multipart('profile_guest/edit'); ?>
			<div class="modal-body">
				<div class="form-group row">
					<label for="email" class="col-sm-3 text-right control-label col-form-label">Email</label>
					<div class="col-sm-9">
						<input type="text" class="form-control" id="email" name="email" value="<?= $user['email']; ?>" readonly>
					</div>
				</div>
				<div class="form-group row">
					<label for="fname" class="col-sm-3 text-right control-label col-form-label">Nama</label>
					<div class="col-sm-9">
						<input type="text" class="form-control" id="name" name="name" value="<?= $user['name']; ?>">
						<?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-3 text-right control-label col-form-label">Image</label>
					<div class="col-md-9">

						<img src="<?= base_url('assets/images/users/') . $user['image']; ?>" class="img-thumbnail">
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-3 text-right control-label col-form-label"></label>
					<div class="col-md-9">

						<div class="custom-file">
							<input type="file" class="custom-file-input" id="image" name="image">
							<label class="custom-file-label" for="image">Choose file...</label>
							<div class="invalid-feedback">Example invalid custom file feedback</div>
						</div>
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
