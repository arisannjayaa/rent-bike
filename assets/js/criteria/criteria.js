const tableUrl = $('#table-url').val();
let table = $('#table');
$("#table").DataTable({
	order: [[0, 'desc']],
	ordering: true,
	serverSide: true,
	processing: true,
	autoWidth: false,
	responsive: false,
	ajax: {
		url: tableUrl
	},
	columns: [
		{data: null, render: function (data, type, row, meta) {
				return meta.row + meta.settings._iDisplayStart + 1;
			}
		},
		{ data: 'code', name: 'code', className: 'text-nowrap' },
		{ data: 'name', name: 'name', className: 'text-nowrap' },
		{ data: 'attribute', name: 'attribute', className: 'text-nowrap', orderable: false },
		{ data: 'weight', name: 'weight', className: 'text-nowrap', orderable: false, searchable: true },
		{ data: null, className: 'text-nowrap', orderable: false, searchable: false,
			render: function (data, type, row, meta) {
				return `<a href="javascript:void(0)" data-id="${row.id}" class="btn btn-warning btn-sm edit"><i class="fas fa-edit"></i></a>
				<a href="javascript:void(0)" class="btn btn-danger btn-sm delete" data-id="${row.id}"><i class="fas fa-trash"></i></a>`;
			}
		}
	]
});

$('#btn-add').click(function () {
	$("#form-criteria")[0].reset();
	$("#modal-criteria").modal('show');
	$('.modal-title').empty().append('Tambah Kriteria');
});

$("#form-criteria").submit(function (e) {
	e.preventDefault();

	let id = $("#id").val();
	let formData = new FormData(this);
	let btn = "#btn-submit";
	let table = "#table";
	let form = "#form-criteria";
	let modal = "#modal-criteria";

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
		$(".modal-title").empty().append("Edit Kriteria");
		$("#id").val(res.data.id);
		$("#code").val(res.data.code);
		$("#name").val(res.data.name);
		$("#attribute").val(res.data.attribute);
		$("#weight").val(res.data.weight);

		$("#modal-criteria").modal("show");
		resetValidation();
	});
});


$("#table").on("click", ".delete", function () {
	let id = $(this).data("id");
	let url = $("#delete-url").val();
	let table = "#table";

	ajaxDel(url, id, false, 'notifySuccess', table);
});
