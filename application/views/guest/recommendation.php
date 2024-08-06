@extends('theme.guest')

@section('title', 'Recommendation')
@section('style')
<style>
	/*li.select2-selection__choice {*/
	/*	background-color: #007bff !important;*/
	/*	color: #fff !important;*/
	/*	border: 1px solid #fff !important;*/
	/*}*/

	.select2-container .select2-selection--multiple .select2-selection__choice {
		display: flex;
		align-items: center;
	}
	.select2-container .select2-selection--multiple .select2-selection__choice img {
		width: 20px;
		height: 20px;
		margin-right: 5px;
	}
</style>
@endsection
@section('content')
<div class="hero" style="background-image: url('<?= base_url('assets/template_guest/') ?>images/bike8.jpg');">

	<div class="container">
		<div class="row align-items-center justify-content-center">
			<div class="col-lg-10">

				<div class="row mb-5">
					<div class="col-lg-7 intro">
						<h1><strong>Tentukan</strong> kriteria yang kamu inginkan</h1>
					</div>
				</div>

				<?php if($this->session->flashdata('error_message')): ?>
					<div class="alert alert-danger">
						<?php echo $this->session->flashdata('error_message'); ?>
					</div>
				<?php endif; ?>

				<form class="trip-form" method="get" action="<?= base_url('recommendation/preferensi') ?>">

					<div class="row align-items-center">

						<div class="mb-3 mb-md-3 col-md-3">
							<select name="c1" id="" class="custom-select form-control" required>
								<option value="">Harga</option>
								<option value="1">Sangat Tidak penting</option>
								<option value="2">Tidak Penting</option>
								<option value="3">Netral</option>
								<option value="4">Penting</option>
								<option value="5">Sangat Penting</option>
							</select>
						</div>
						<div class="mb-3 mb-md-3 col-md-3">
							<select name="c2" id="" class="custom-select form-control" required>
								<option value="">Tahun Produksi</option>
								<option value="1">Sangat Tidak penting</option>
								<option value="2">Tidak Penting</option>
								<option value="3">Netral</option>
								<option value="4">Penting</option>
								<option value="5">Sangat Penting</option>
							</select>
						</div>
						<div class="mb-3 mb-md-3 col-md-3">
							<select name="c3" id="" class="custom-select form-control" required>
								<option value="">CC Mesin</option>
								<option value="1">Sangat Tidak penting</option>
								<option value="2">Tidak Penting</option>
								<option value="3">Netral</option>
								<option value="4">Penting</option>
								<option value="5">Sangat Penting</option>
							</select>
						</div>
						<div class="mb-3 mb-md-3 col-md-3">
							<select name="c4" id="" class="custom-select form-control" required>
								<option value="">Konsumsi BBM</option>
								<option value="1">Sangat Tidak penting</option>
								<option value="2">Tidak Penting</option>
								<option value="3">Netral</option>
								<option value="4">Penting</option>
								<option value="5">Sangat Penting</option>
							</select>
						</div>

						<div class="mb-3 mb-md-2 col-12">
							<select class="select2" name="motorcycle[]" multiple="multiple">
								@foreach($motorcycles as $motorcycle)
									<option value="{{ $motorcycle->id }}" data-image="<?= base_url($motorcycle->attachment ?? 'assets/template_guest/images/car_1.jpg') ?>">{{ $motorcycle->name }}</option>
								@endforeach
							</select>
						</div>

						<div class=" mb-md-0 col-md mt-3">
							<div class="button-container">
								<input type="submit" value="Search Now" class="btn btn-primary btn-block py-3">
							</div>
						</div>
					</div>

				</form>

			</div>
		</div>
	</div>
</div>
<div class="site-section bg-light">
	<div class="container">
		<div class="row">
			<div class="col-lg-7">
				<h2 class="section-heading"><strong>Recommendations</strong></h2>
				<p class="mb-5">Berikut adalah pilihan motor sesuai dengan preferensimu.</p>
			</div>
		</div>


		<div class="row">

			@foreach($bikes as $bike)

			<div class="col-md-6 col-lg-4 mb-4">

				<div class="listing d-block  align-items-stretch">
					<div class="listing-img h-100 mr-4">
						<img src="{{ base_url($bike->attachment ?? 'assets/template_guest/images/car_1.jpg') }}" alt="Image" class="img-fluid">
					</div>
					<div class="listing-contents h-100">
						<h3>{{ $bike->name }}</h3>
						<div class="rent-price">
							<strong>{{ format_rupiah($bike->price) }}</strong><span class="mx-1">/</span>day
						</div>
						<div class="d-block d-md-flex mb-3 border-bottom pb-3">
							<div class="listing-feature">
								<span class="caption">Mesin (cc):</span>
								<span class="number">{{ $bike->engine_power }}</span>
							</div>
							<div class="listing-feature pr-4">
								<span class="caption">Konsumsi BBM:</span>
								<span class="number">{{ $bike->fuel }} Km/L</span>
							</div>
							<div class="listing-feature ">
								<span class="caption">Tahun:</span>
								<span class="number">{{ $bike->year_release }}</span>
							</div>
						</div>
<!--						<div>-->
<!--							<p><a href="javascript:void(0)" class="btn btn-primary btn-sm detail" data-id="{{ $bike->id }}">Details</a></p>-->
<!--						</div>-->

					</div>

				</div>
			</div>

			@endforeach




		</div>
	</div>
</div>






</div>

@endsection

@section('url')

@endsection

@section('script')
<script>
	$(document).ready(function() {
		function formatState(state) {
			if (!state.id) {
				return state.text;
			}
			var image = $(state.element).data('image');
			if (image) {
				var $state = $(
					'<span><img style="width: 80px; height: 80px;" src="' + image + '" class="img-flag" /> ' + state.text + '</span>'
				);
				return $state;
			} else {
				return state.text;
			}
		}

		$( ".select2" ).select2({
			width: '100%',
			templateResult: formatState,
			templateSelection: formatState,
		});
	});
</script>
@endsection
