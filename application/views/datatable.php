<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Datatable Serverside</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">


	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.22/datatables.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>


	<script type="text/javascript" language="javascript" src="https://nightly.datatables.net/buttons/js/dataTables.buttons.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://nightly.datatables.net/buttons/js/buttons.flash.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
	<script type="text/javascript" language="javascript" src="https://nightly.datatables.net/buttons/js/buttons.html5.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://nightly.datatables.net/buttons/js/buttons.print.min.js"></script>

</head>

<body>
	<div class="container">
		<h2 class="text-center mb-5">Datatable Serverside</h2>
		<div class="row">
			<div class="col">
				<form class="form-inline mb-3" id="formDateRange">
					<div class="form-group">
						<label for="star" class="mr-3">Tanggal awal</label>
						<input type="date" name="star" id="star" class="form-control" placeholder="tanggal awal" aria-describedby="star">
					</div>
					<div class="form-group">
						<label for="end" class="mx-3">Tanggal akhir</label>
						<input type="date" name="end" id="end" class="form-control" placeholder="tanggal akhir" aria-describedby="star">
					</div>
					<div class="form-group">
						<button type="submit" id="dateRange" class="btn btn-success ml-3">Save</button>
					</div>
				</form>
				<div class="card">
					<div class="card-body">
						<table id="example" class="table table-striped table-bordered" style="width:100%">
							<thead>
								<tr>
									<th>no</th>
									<th>Nama</th>
									<th>Jabatan</th>
									<th>Masuk</th>
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
</body>


<script>
	let base_url = '<?= base_url() ?>'
	$(document).ready(function() {

		_serverside(0);

		function _serverside(dateRange, star = null, end = null) {
			$('#example').DataTable({
				"processing": true,
				"serverSide": true,
				"responsive": true,
				"autoWidth": false,
				"dom": 'Bfrtip',
				buttons: [{
						extend: "print",
						className: "btn-sm btn-primary",
						exportOptions: {
							columns: ':visible'
						}
					},
					{
						extend: "excel",
						className: "btn-sm btn-success",
						exportOptions: {
							columns: ':visible'
						}
					},
					{
						extend: "pdf",
						className: "btn-sm btn-danger",
						exportOptions: {
							columns: ':visible'
						}
					},
					{
						extend: "csv",
						className: "btn-sm btn-danger",
						exportOptions: {
							columns: ':visible'
						}
					}
				],
				"ajax": {
					"url": base_url + 'datatable/show',
					"type": "POST",
					"data": {
						dateRange: dateRange,
						star: star,
						end: end
					}
				}
			});
		}

		$('#dateRange').click(function(e) {
			e.preventDefault();
			const star = $('#star').val();
			const end = $('#end').val();
			if (star && end) {
				$('#example').DataTable().destroy();
				_serverside(1, star, end)
			}
		});
	});
</script>

</html>