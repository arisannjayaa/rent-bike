@extends('theme.default')

@section('title', 'Bobot dan Kriteria')

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
								<th>No</th>
								<th>Kode</th>
								<th>Nama</th>
								<th>Atribut</th>
								<th>Bobot</th>
								<th>Aksi</th>
							</tr>
							</thead>
							<tbody>

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
	<script src="{{ base_url('assets/js/criteria/criteria.js') }}"></script>
@endsection


