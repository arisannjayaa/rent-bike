@extends('theme.default')

@section('title', 'Nilai Preferensi')

@section('style')
<style>
	th {
		text-align: center !important;
		vertical-align: middle !important;
	}
</style>
@endsection
@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<div class="table-responsive">
						<table id="table" class="table table-striped table-bordered">
							<thead>
							<tr>
								<th>Alternatif</th>
								<th>Bike</th>
								<th>Vendor</th>
								<th>Hasil Akhir</th>
							</tr>
							</thead>
							<tbody>
							<?php foreach ($matrix_result as $item) { ?>
								<tr>
									<td><?= "A".$item->id ?></td>
									<td>
										<div class="d-flex align-items-center" style="gap: 10px;">
											<img height="100" width="100" style="border-radius: 10px" src=<?= base_url($item->attachment ?? 'assets/template_guest/images/car_1.jpg') ?> alt="">
											<p><?= $item->name ?></p>
										</div>
									</td>
									<td><?= $item->vendor ?></td>
									<td><?= $item->result ?></td>
								</tr>
							<?php  } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@include('admin/criteria/modal')
@endsection

@section('url')
<input type="hidden" id="table-url" value="{{ base_url('kriteria/table') }}">
<input type="hidden" id="create-url" value="{{ base_url('kriteria/store') }}">
<input type="hidden" id="update-url" value="{{ base_url('kriteria/update') }}">
<input type="hidden" id="delete-url" value="{{ base_url('kriteria/delete') }}">
<input type="hidden" id="edit-url" value="{{ base_url('kriteria/edit/:id') }}">
@endsection

@section('script')
<!--<script src="{{ base_url('assets/js/criteria/criteria.js') }}"></script>-->
@endsection


