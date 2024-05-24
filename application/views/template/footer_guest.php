<footer class="footer text-center">
	Copyright &copy; Website Sistem Rekomendasi Rental Motor <?= date('Y'); ?>
</footer>
<!-- ============================================================== -->
<!-- End footer -->
<!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Page wrapper  -->
<!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Wrapper -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- All Jquery -->
<!-- ============================================================== -->
<script src="<?= BASEURL ?>assets/libs/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap tether Core JavaScript -->
<script>
	$('.custom-file-input').on('change', function() {
		let fileName = $(this).val().split('\\').pop();
		$(this).next('.custom-file-label').addClass("selected").html(fileName);
	});
</script>
<script src="<?= BASEURL ?>assets/libs/popper.js/dist/umd/popper.min.js"></script>
<script src="<?= BASEURL ?>assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?= BASEURL ?>assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
<script src="<?= BASEURL ?>assets/extra-libs/sparkline/sparkline.js"></script>
<!--Wave Effects -->
<script src="<?= BASEURL ?>assets/js/waves.js"></script>
<!--Menu sidebar -->
<script src="<?= BASEURL ?>assets/js/sidebarmenu.js"></script>
<!--Custom JavaScript -->
<script src="<?= BASEURL ?>assets/js/custom.min.js"></script>
<!--This page JavaScript -->
<!-- <script src="dist/js/pages/dashboards/dashboard1.js"></script> -->
<!-- Charts js Files -->
<script src="<?= BASEURL ?>assets/libs/flot/excanvas.js"></script>
<script src="<?= BASEURL ?>assets/libs/flot/jquery.flot.js"></script>
<script src="<?= BASEURL ?>assets/libs/flot/jquery.flot.pie.js"></script>
<script src="<?= BASEURL ?>assets/libs/flot/jquery.flot.time.js"></script>
<script src="<?= BASEURL ?>assets/libs/flot/jquery.flot.stack.js"></script>
<script src="<?= BASEURL ?>assets/libs/flot/jquery.flot.crosshair.js"></script>
<script src="<?= BASEURL ?>assets/libs/flot.tooltip/js/jquery.flot.tooltip.min.js"></script>
<script src="<?= BASEURL ?>assets/js/pages/chart/chart-page-init.js"></script>

</body>

</html>
