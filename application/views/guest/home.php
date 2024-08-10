@extends('theme.guest')

@section('title', 'Home')

@section('content')
<div class="hero" style="background-image: url('<?= base_url('assets/template_guest/') ?>images/bike8.jpg');">

	<div class="container">
		<div class="row align-items-center justify-content-center">
			<div class="col-lg-10">

				<div class="row mb-5">
					<div class="col-lg-7 intro">
						<h1><strong>Bike Idea</strong> is easier to give you recommendations.</h1>
					</div>
				</div>



			</div>
		</div>
	</div>
</div>
<div class="site-section">
	<div class="container">
		<div class="row">
			<div class="col-lg-6 mb-5 mb-lg-0 order-lg-2">
				<img src="<?= base_url('assets/template_guest/') ?>images/bike9.jpg" alt="Image" class="img-fluid rounded">
			</div>
			<div class="col-lg-4 mr-auto">
				<h2>Bike Idea</h2>
				<p>Bike Idea adalah sebuah sistem berbasis web yang dirancang untuk membantu wisatawan menemukan rental sepeda motor.</p>
				<p> Dengan mempertimbangkan bobot dan nilai dari setiap kriteria, sistem ini menghasilkan rekomendasi berdasarkan nilai tertinggi, sehingga mempermudah wisatawan dalam melakukan penyewaan sepeda motor.</p>
			</div>
		</div>
	</div>
</div>






<div class="site-section bg-light">
	<div class="container">
		<div class="row">
			<div class="col-lg-7">
				<h2 class="section-heading"><strong>Bike Listing</strong></h2>
				<p class="mb-5"></p>
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
						<div>
							<p><a href="javascript:void(0)" class="btn btn-primary btn-sm detail" data-id="{{ $bike->id }}">Details</a></p>
						</div>

					</div>

				</div>
			</div>
			@endforeach

		</div>

		<?= $this->pagination->create_links(); ?>
	</div>
</div>



@include('guest/modal')
@endsection

@section('url')
<input type="hidden" id="detail-url" value="{{ base_url('bike/edit/:id') }}">
@endsection

@section('script')
<script>
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
				$("#name").html(res.data.name);
				$("#price").html(formatRupiah(res.data.price, "IDR", false));
				$("#attachment").attr('src', res.data.attachment ?? BASE_URL + '/assets/template_guest/images/car_1.jpg');
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
</script>

@endsection
