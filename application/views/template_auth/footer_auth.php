	<!-- ============================================================== -->
	<!-- All Required js -->
	<!-- ============================================================== -->
	<script src="<?= base_url('') ?>assets/libs/jquery/dist/jquery.min.js"></script>
	<!-- Bootstrap tether Core JavaScript -->
	<script src="<?= base_url('') ?>assets/libs/popper.js/dist/umd/popper.min.js"></script>
	<script src="<?= base_url('') ?>assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
	<!-- ============================================================== -->
	<!-- This page plugin js -->
	<!-- ============================================================== -->
	<script>
		$('[data-toggle="tooltip"]').tooltip();
		$(".preloader").fadeOut();
		// ============================================================== 
		// Login and Recover Password 
		// ============================================================== 
		$('#to-recover').on("click", function() {
			$("#loginform").slideUp();
			$("#recoverform").fadeIn();
		});
		$('#to-login').click(function() {

			$("#recoverform").hide();
			$("#loginform").fadeIn();
		});
	</script>

	</body>

	</html>
