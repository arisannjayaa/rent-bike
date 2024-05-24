<div class="container-fluid">
	<!-- ============================================================== -->
	<!-- Start Page Content -->
	<!-- ============================================================== -->
	<div class="card">
		<div class="card-body wizard-content">
			<?= $this->session->flashdata('message'); ?>
			<form action="<?= base_url('guest/change_password_guest'); ?>" method="post">
				<div class="mb-3">
					<label for="current_password" class="form-label">Current Password</label>
					<input type="password" class="form-control" id="current_password" name="current_password">
					<?= form_error('current_password', '<small class="text-danger pl-3">', '</small>'); ?>
				</div>
				<div class="mb-3">
					<label for="new_password1" class="form-label">New Password</label>
					<input type="password" class="form-control" id="new_password1" name="new_password1">
					<?= form_error('new_password1', '<small class="text-danger pl-3">', '</small>'); ?>
				</div>
				<div class="mb-3">
					<label for="new_password2" class="form-label">Repeat Password</label>
					<input type="password" class="form-control" id="new_password2" name="new_password2">
					<?= form_error('new_password2', '<small class="text-danger pl-3">', '</small>'); ?>
				</div>

				<button type="submit" class="btn btn-primary">Change Password </button>
			</form>
		</div>
	</div>
	<!-- ============================================================== -->
	<!-- End PAge Content -->
	<!-- ============================================================== -->
	<!-- ============================================================== -->
	<!-- Right sidebar -->
	<!-- ============================================================== -->
	<!-- .right-sidebar -->
	<!-- ============================================================== -->
	<!-- End Right sidebar -->
	<!-- ============================================================== -->
</div>
