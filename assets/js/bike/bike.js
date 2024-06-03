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
		{ data: 'name', name: 'name', className: 'text-nowrap', render: function (data, type, row) {
			return `<div><img class="img-fluid" style="height: 50px; width: 50px; background-size: cover !important; margin-right: 10px;" src="${BASE_URL + '/' + row.attachment}" alt=""><span>${row.name}</span></div>`;
		} },
		{ data: 'price', name: 'price', className: 'text-nowrap', render: function (data, type, row){ return `<span>${formatRupiah(data, "Rp. ")}</span>`}},
		{ data: 'year_release', name: 'year_release', className: 'text-nowrap', orderable: false },
		{ data: 'engine_power', name: 'engine_power', className: 'text-nowrap', orderable: false, searchable: true },
		{ data: 'fuel', name: 'fuel', className: 'text-nowrap', orderable: false, searchable: true },
		{ data: 'telp', name: 'telp', className: 'text-nowrap', orderable: false, searchable: true },
		{ data: 'vendor', name: 'vendor', className: 'text-nowrap', orderable: false, searchable: true },
		{ data: null, className: 'text-nowrap', orderable: false, searchable: false,
			render: function (data, type, row, meta) {
				return `<a href="javascript:void(0)" data-id="${row.id}" class="btn btn-warning btn-sm edit"><i class="fas fa-edit"></i></a>
				<a href="javascript:void(0)" class="btn btn-danger btn-sm delete" data-id="${row.id}"><i class="fas fa-trash"></i></a>`;
			}
		}
	]
});

$('#btn-add').click(function () {
	$('#attachment , .dropify-wrapper').remove();
	let html = `<input type="file" id="attachment" name="attachment" class="dropify" data-max-file-size="1M" data-default-file='' />`;
	$('.custom-file').append(html);
	$('.dropify').dropify();

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
	}).fail(function (res) {
		let data = res.responseJSON;
		$(".dropify-error").empty().append(data.errors.attachment[0]);
		$(".dropify-wrapper").addClass("error");
		$(".dropify-error").show();
	});
});

resetValidationFile();

$("#table").on("click", ".edit", function () {
	let id = $(this).data("id");
	let url = $("#edit-url").val();
	url = url.replace(":id", id);

	ajaxGet(url).done(function (res) {
		$(".modal-title").empty().append("Edit Bike");
		$("#id").val(res.data.id);
		$("#price").val(res.data.price);
		$("#year_release").val(res.data.year_release);
		$("#name").val(res.data.name);
		$("#engine_power").val(res.data.engine_power);
		$("#fuel").val(res.data.fuel);
		$("#telp").val(res.data.telp);
		$("#vendor").val(res.data.vendor);

		$('#attachment , .dropify-wrapper').remove();

		let html = `<input type="file" id="attachment" name="attachment" class="dropify" data-max-file-size="1M" value="${res.data.attachment}" data-default-file='${BASE_URL + res.data.attachment}' />
			<input type="hidden" name="old_attachment" id="old-attachment" value="${res.data.attachment}">`;
		$('.custom-file').append(html);
		$('.dropify').dropify();

		$("#modal-bike").modal("show");
	});
});


$("#table").on("click", ".delete", function () {
	let id = $(this).data("id");
	let url = $("#delete-url").val();
	let table = "#table";

	ajaxDel(url, id, false, 'notifySuccess', table);
});

$('#btn-import').click(function () {
	Swal.fire({
		title: "Apakah anda yakin?",
		text: "Data bike dan aliternatif akan dihapus setelahnya!!",
		icon: "warning",
		showCancelButton: true,
		confirmButtonColor: "#3085d6",
		cancelButtonColor: "#d33",
		confirmButtonText: "Ya, import data"
	}).then((result) => {
		if (result) {
			$('#import').trigger('click');
		}
	});
});

$('#form-import').on('change', '#import', function (e) {
	let form = $('#form-import');
	if ($('#import')[0].files.length === 0) {
		notifyWarning("File belum dipilih!");
		return;
	}

	let url = $('#import-url').val();
	let btn = '#btn-import';

	let formData = new FormData(form[0]);
	ajaxPost(url, formData, btn)
		.done(function (res) {
			console.log(res);
			reloadTable($("#table"));
			notifySuccess(res.message);
		})
		.fail(function (res) {
			notifyError("Terjadi error saat upload!");
		});
});
