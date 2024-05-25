const tableUrl = $('#table-url').val();
let table = $('#table');
$("#table").DataTable({
	order: [[0, 'desc']],
	ordering: true,
	serverSide: true,
	processing: true,
	autoWidth: false,
	responsive: true,
	ajax: {
		url: tableUrl
	},
	columns: [
		{data: null, render: function (data, type, row, meta) {
				return meta.row + meta.settings._iDisplayStart + 1;
			}
		},
		{ data: 'name', name: 'name', className: 'text-nowrap' },
		{ data: 'price', name: 'price', className: 'text-nowrap' },
		{ data: 'year_release', name: 'year_release', className: 'text-nowrap', orderable: false },
		{ data: 'engine_power', name: 'engine_power', className: 'text-nowrap', orderable: false, searchable: true },
		{ data: 'fuel', name: 'fuel', className: 'text-nowrap', orderable: false, searchable: true },
		{ data: null, className: 'text-nowrap', orderable: false, searchable: false,
			render: function (data, type, row, meta) {
				return `<a href="javascript:void(0)" data-id="${row.id}" class="btn btn-warning btn-sm edit"><i class="fas fa-edit"></i></a>
				<a href="javascript:void(0)" class="btn btn-danger btn-sm delete" data-id="${row.id}"><i class="fas fa-trash"></i></a>`;
			}
		}
	]
});

$('#btn-add').click(function () {
	$("#form-bike")[0].reset();
	$("#modal-bike").modal('show');
	$('.modal-title').empty().append('Tambah Bike');
});

$("#form-bike").submit(function (e) {
	e.preventDefault();

	let id = $("#id").val();
	let formData = new FormData(this);
	let btn = "#btn-submit";
	let table = "#table";
	let form = "#form-bike";
	let modal = "#modal-bike";

	if (id !== "") {
		var url = $("#update-url").val();
	} else {
		var url = $("#create-url").val();
	}

	// send data
	ajaxPost(url, formData, btn).done(function (res) {
		notifySuccess(res.message);
		reloadTable(table);
		$(modal).modal("hide");
		$(form)[0].reset();
	});
});

$("#table").on("click", ".edit", function () {
	let id = $(this).data("id");
	let url = $("#edit-url").val();
	url = url.replace(":id", id);

	ajaxGet(url).done(function (res) {
		console.log(res);
		$(".modal-title").empty().append("Edit Bike");
		$("#id").val(res.data.id);
		$("#price").val(res.data.price);
		$("#year_release").val(res.data.year_release);
		$("#name").val(res.data.name);
		$("#engine_power").val(res.data.engine_power);
		$("#fuel").val(res.data.fuel);

		$("#modal-bike").modal("show");
		resetValidation();
	});
});


$("#table").on("click", ".delete", function () {
	let id = $(this).data("id");
	let url = $("#delete-url").val();
	let table = "#table";

	ajaxDel(url, id, false, 'notifySuccess', table);
});