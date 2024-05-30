@extends('theme.default')

@section('title', 'Alternatif')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<button type="button" class="btn btn-primary mb-3" id="btn-add">Add</button>
					<div class="table-responsive">
						<table id="table" class="table table-striped table-bordered">
							<thead>
							<tr>
								<th>No.</th>
								<th>Nama</th>
								<th>Harga</th>
								<th>Tahun</th>
								<th>Kekuatan Mesin</th>
								<th>Bahan Bakar</th>
								<th>Aksi</th>
							</tr>
							</thead>
							<tbody></tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@include('admin/alternative/modal')
@endsection

@section('url')
<input type="hidden" id="table-url" value="{{ base_url('alternatif/table') }}">
<input type="hidden" id="create-url" value="{{ base_url('alternatif/store') }}">
<input type="hidden" id="update-url" value="{{ base_url('alternatif/update') }}">
<input type="hidden" id="delete-url" value="{{ base_url('alternatif/delete') }}">
<input type="hidden" id="bike-all-url" value="{{ base_url('bike/getall') }}">
<input type="hidden" id="edit-url" value="{{ base_url('alternatif/edit/:id') }}">
@endsection

@section('script')
<script src="{{ base_url('assets/js/alternative/alternative.js') }}"></script>
@endsection

