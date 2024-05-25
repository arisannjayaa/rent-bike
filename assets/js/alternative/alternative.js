const tableUrl = $('#table-url').val();
let table = $('#table');
const bikeUrl = $("#bike-all-url").val();

setTimeout(function() {
	loadSelectBike(bikeUrl)
}, 1500);

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
		{ data: 'name', name: 'name', className: 'text-nowrap', orderable: false, searchable: false },
		{ data: 'price', name: 'price', className: 'text-nowrap' },
		{ data: 'year_release', name: 'year_release', className: 'text-nowrap', orderable: false, searchable: true },
		{ data: 'engine_power', name: 'engine_power', className: 'text-nowrap', orderable: false, searchable: true },
		{ data: 'fuel', name: 'engine_power', className: 'text-nowrap', orderable: false, searchable: true },
		{ data: null, className: 'text-nowrap', orderable: false, searchable: false,
			render: function (data, type, row, meta) {
				return `<a href="javascript:void(0)" data-id="${row.id}" class="btn btn-warning btn-sm edit"><i class="fas fa-edit"></i></a>
				<a href="javascript:void(0)" class="btn btn-danger btn-sm delete" data-id="${row.id}"><i class="fas fa-trash"></i></a>`;
			}
		}
	]
});

$('#btn-add').click(function () {
	$("#form-alternative")[0].reset();
	$("#modal-alternative").modal('show');
	$('.modal-title').empty().append('Tambah Alternatif');
});

$("#form-alternative").submit(function (e) {
	e.preventDefault();

	let id = $("#id").val();
	let formData = new FormData(this);
	let btn = "#btn-submit";
	let table = "#table";
	let form = "#form-alternative";
	let modal = "#modal-alternative";

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

	setTimeout(function() {
		loadSelectBike(bikeUrl)
	}, 1500);
});

$("#table").on("click", ".edit", function () {
	let id = $(this).data("id");
	let url = $("#edit-url").val();
	url = url.replace(":id", id);

	ajaxGet(url).done(function (res) {
		$(".modal-title").empty().append("Edit Alternatif");
		$("#id").val(res.data.id);
		$("#name").val(res.data.name);
		$("#price").val(res.data.price);
		$("#year_release").val(res.data.year_release);
		$("#engine_power").val(res.data.engine_power);
		$("#fuel").val(res.data.fuel);

		$("#modal-alternative").modal("show");
	});
});


$("#table").on("click", ".delete", function () {
	let id = $(this).data("id");
	let url = $("#delete-url").val();
	let table = "#table";

	ajaxDel(url, id, false, 'notifySuccess', table);
	setTimeout(function() {
		loadSelectBike(bikeUrl)
	}, 1500);
});

function loadSelectBike(url) {
	let select = document.querySelector("#bike_id");
	select.innerHTML = '';
	let html = '<option value="">Pilih bike</option>';

	ajaxGet(url).done(function (res) {
		console.log(res);
		let data = res.data;

		if(data == 0) {
			$("#btn-add").prop('disabled', true);
			return;
		}

		$("#btn-add").prop('disabled', false);

		data.forEach(function (item) {
			html += `<option value="${item.id}">${item.name}</option>`
		})

		$("#bike_id").append(html);
	})
}
