@extends('theme.guest')

@section('title', 'Recommendation')
@section('style')
<style>
	/li.select2-selection__choice {
		/
		/*	background-color: #007bff !important;*/
		/*	color: #fff !important;*/
		/*	border: 1px solid #fff !important;*/
		/
	}

	/ .select2-container .select2-selection--multiple .select2-selection__choice {
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
						<h1><strong>Tentukan</strong> sepeda motor yang ingin kamu bandingkan</h1>
					</div>
				</div>

				<?php if ($this->session->flashdata('error_message')): ?>
					<div class="alert alert-danger">
						<?php echo $this->session->flashdata('error_message'); ?>
					</div>
				<?php endif; ?>

				<form class="trip-form" method="get" action="<?= base_url('recommendation/preferensi') ?>">

					<div class="row align-items-center">
						<div class="mb-3 mb-md-2 col-12">
							<label for="">Pilih Motor Untuk Dibandingkan</label>
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
<div class="site-section">
	<div class="container">
		<h2 class="section-heading"><strong>Deskripsi Sistem Bike Idea</strong></h2>
		<p class="mb-5">Berikut adalah deskripsi singkat dari sistem Bike Idea</p>

		<div class="row mb-5">
			<div class="col-lg-4 mb-4 mb-lg-0">
				<div class="step">
					<span>1</span>
					<div class="step-inner">
						<span class="number text-primary">01.</span>
						<h3>Simple Additive Weighting</h3>
						<p>Sistem ini menggunakan metode Simple Additive Weighting atau penjumlahan terbobot dalam melakukan perhitungan.</p>
					</div>
				</div>
			</div>
			<div class="col-lg-4 mb-4 mb-lg-0">
				<div class="step">
					<span>2</span>
					<div class="step-inner">
						<span class="number text-primary">02.</span>
						<h3>Ranking</h3>
						<p>Sistem akan menghitung dan mengurutkan alternatif sepeda motor terbaik dari nilai terbesar ke terkecil.</p>
					</div>
				</div>
			</div>
			<div class="col-lg-4 mb-4 mb-lg-0">
				<div class="step">
					<span>3</span>
					<div class="step-inner">
						<span class="number text-primary">03.</span>
						<h3>Rekomendasi</h3>
						<p>Anda dapat membandingkan sepeda motor yang sesuai dengan keinginan anda dan menghubungi pemilik rental sepeda motor</p>
					</div>
				</div>
			</div>
		</div>

	</div>
</div>
<div class="site-section bg-light">
	<div class="container">
		<div class="row">
			<div class="col-lg-7">
				@if ($this->input->get())
				<h2 class="section-heading"><strong>Recommendations</strong></h2>
				<p class="mb-5">Berikut adalah perbandingkan sepeda motor dengan nilai perhitungan tertinggi hingga terendah.</p>
				@endif
			</div>
		</div>


		<div class="row">
			@if(@$bikes)
			@foreach(@$bikes as $row => $bike)

			<div class="col-md-6 col-lg-4 mb-4">

				<div class="listing d-block  align-items-stretch">
					<div class="listing-img h-100 mr-4">
						<img src="{{ base_url($bike->attachment ?? 'assets/template_guest/images/car_1.jpg') }}" alt="Image" class="img-fluid">
					</div>
					<div class="listing-contents h-100">
						<span class="badge bg-primary text-white">{{ $bike->result }}</span>
						<div class="d-flex align-items-center" style="gap: 5px">
							<h3>{{ $bike->name }}</h3>
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#FFB22C" class="bi bi-award-fill" viewBox="0 0 16 16">
								<path d="m8 0 1.669.864 1.858.282.842 1.68 1.337 1.32L13.4 6l.306 1.854-1.337 1.32-.842 1.68-1.858.282L8 12l-1.669-.864-1.858-.282-.842-1.68-1.337-1.32L2.6 6l-.306-1.854 1.337-1.32.842-1.68L6.331.864z"/>
								<path d="M4 11.794V16l4-1 4 1v-4.206l-2.018.306L8 13.126 6.018 12.1z"/>
								<text font-weight="bold" x="50%" y="45%" text-anchor="middle" dominant-baseline="middle" font-size="8" fill="white">{{ $row+1 }}</text>
							</svg>
						</div>
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
						<div>
							<p>
								<a href="javascript:void(0)" class="btn btn-primary btn-sm detail" data-id="{{ $bike->id }}">Details</a>
								<a style="background-color: #25D366 !important; border-color: #25D366 !important;" href="{{ "https://wa.me/" . formatIndonesianPhoneNumber($bike->telp) }}" class="btn btn-primary btn-sm contact" data-id="{{ $bike->telp }}">Hubungi</a>
							</p>
						</div>

					</div>

				</div>
			</div>

			@endforeach
			@endif
		</div>
	</div>
</div>
</div>
@include('guest/modal')
@endsection

@section('url')
<input type="hidden" id="detail-url" value="{{ base_url('bike/edit/:id') }}">
@endsection

@section('script')
<script>
	$(document).ready(function() {
		$(".detail").click(function() {
			let id = $(this).data("id");
			let url = $("#detail-url").val();
			const BASE_URL = $("#base-url").val();
			url = url.replace(":id", id);

			$.ajax({
				url: url,
				method: 'GET',
				dataType: 'json',
				success: function(res) {
					console.log(res);
					$("#name").html(res.data.name);
					$("#price").html(formatRupiah(res.data.price, "IDR", false));
					$("#attachment").attr('src', BASE_URL + res.data.attachment ?? BASE_URL + '/assets/template_guest/images/car_1.jpg');
					$("#year_release").html(res.data.year_release);
					$("#engine_power").html(res.data.engine_power);
					$("#fuel").html(res.data.fuel);
					$("#vendor").html(res.data.vendor);
					$("#address").html(res.data.address);
					$("#telp").html(res.data.telp);

					$("#modal-guest").modal("show");
				},
				error: function(jqXHR, textStatus, errorThrown) {
					console.error('Error fetching car listings:', textStatus, errorThrown);
				}
			});
		});

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

		$(".select2").select2({
			width: '100%',
			templateResult: formatState,
			templateSelection: formatState,
		});
	});
</script>
@endsection
