<html>
<head>
	<title>CodeIgniter 3 DataTables</title>
	
	<link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
	
	<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.7.0.min.js"></script>
	<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
</head>
<body>
	<h1>Client-Side DataTable</h1>
	<table class="dt-client-side">
		<thead>
			<tr>
				<th>Urutan #</th>
				<th>Nama Lengkap</th>
				<th>JK</th>
				<th>Tgl Lahir</th>
				<th>Peran</th>
				<th>Pekerjaan</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($anggota->result() as $row): ?>
			<tr>
				<td><?php echo $row->urutan; ?></td>
				<td><?php echo $row->nama; ?></td>
				<td><?php echo $row->jenis_kelamin; ?></td>
				<td><?php echo $row->tgl_lahir; ?></td>
				<td><?php echo $row->peran; ?></td>
				<td><?php echo $row->pekerjaan; ?></td>
			</tr>
			<?php endforeach; ?>
		</tbdody>
	</table>
	
	<h1>Server-Side DataTable</h1>
	<table class="dt-server-side">
		<thead>
			<tr>
				<th>Urutan #</th>
				<th>Nama Lengkap</th>
				<th>JK</th>
				<th>Tgl Lahir</th>
				<th>Peran</th>
				<th>Pekerjaan</th>
			</tr>
		</thead>
		<tbody></tbdody>
	</table>
	
	<script>
	$().ready(function() {
		
		//-----------------------
		// Client-Side DataTable
		//-----------------------
		$('.dt-client-side').DataTable({
			pageLength: 3,
			lengthMenu: [1, 3, 5]
		});
		
		//-----------------------
		// Server-Side DataTable
		//-----------------------
		$('.dt-server-side').DataTable ({
			'bInfo': true,
			'pageLength': 3,
			'lengthMenu': [1, 3, 5],
			'serverSide': true,
			'serverMethod': 'post',
			'ajax': '<?php echo site_url('welcome/post_datatable/'); ?>',
			'order': [[ 0, 'asc' ]],
			'columns': [
				{ data: 'urutan' },
				{ data: 'nama' },
				{ data: 'jenis_kelamin' },
				{ data: 'tgl_lahir' },
				{ data: 'peran' },
				{ data: 'pekerjaan' },
			]
		});
	});
	</script>
</body>
</html>