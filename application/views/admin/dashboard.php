@extends('theme.default')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid">
	<div class="row"">
		<div class="col-lg-3 col-12 mb-lg-0 mb-3">
			<div class="bg-dark p-10 text-white text-center">
				<h5 class="m-b-0 m-t-5">{{ count($bikes) }}</h5>
				<small class="font-light">Total Bike</small>
			</div>
		</div>
		<div class="col-lg-3 col-12 mb-lg-0 mb-3">
			<div class="bg-dark p-10 text-white text-center">
				<h5 class="m-b-0 m-t-5">{{ count($criteria) }}</h5>
				<small class="font-light">Toal Kriteria</small>
			</div>
		</div>
		<div class="col-lg-3 col-12 mb-lg-0 mb-3">
			<div class="bg-dark p-10 text-white text-center">
				<h5 class="m-b-0 m-t-5">{{ count($subcriteria) }}</h5>
				<small class="font-light">Toal Subkriteria</small>
			</div>
		</div>
		<div class="col-lg-3 col-12 mb-lg-0 mb-3">
			<div class="bg-dark p-10 text-white text-center">
				<h5 class="m-b-0 m-t-5">{{ count($alternatives) }}</h5>
				<small class="font-light">Total Alternative</small>
			</div>
		</div>
	</div>
</div>
@endsection

@section('url')
<input type="hidden" id="table-url" value="{{ base_url('subkriteria/table') }}">
<input type="hidden" id="create-url" value="{{ base_url('subkriteria/store') }}">
<input type="hidden" id="update-url" value="{{ base_url('subkriteria/update') }}">
<input type="hidden" id="delete-url" value="{{ base_url('subkriteria/delete') }}">
<input type="hidden" id="edit-url" value="{{ base_url('subkriteria/edit/:id') }}">
@endsection

@section('script')
<script src="{{ base_url('assets/js/subcriteria/subcriteria.js') }}"></script>
@endsection

