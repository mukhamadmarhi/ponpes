<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title><?= $title ?></title>
	<style>
		body {
			font-family: 'Times New Roman', Times, serif;
			font-size: 12pt;
			margin: 0;
			padding: 0;
		}

		.header-table {
			width: 100%;
			border-collapse: collapse;
			margin-bottom: 20px;
			border-bottom: 2px solid #000;
		}

		.logo-cell {
			width: 100px;
			padding-right: 20px;
			vertical-align: middle;
		}

		.logo {
			height: 80px;
			width: auto;
		}

		.school-info {
			text-align: center;
			vertical-align: middle;
		}

		.school-name {
			font-weight: bold;
			font-size: 16pt;
			margin: 0;
			padding: 0;
		}

		.school-address {
			font-size: 12pt;
			margin: 2px 0;
			padding: 0;
		}

		.title {
			font-size: 14pt;
			font-weight: bold;
			text-align: center;
			margin: 15px 0;
			text-decoration: underline;
		}

		.info-box {
			margin: 10px 0 20px 0;
			padding: 10px;
			border: 1px solid #ddd;
			background-color: #f9f9f9;
		}

		.info-row {
			margin-bottom: 5px;
		}

		.info-label {
			display: inline-block;
			width: 120px;
			font-weight: bold;
		}

		.data-table {
			width: 100%;
			border-collapse: collapse;
			margin-bottom: 30px;
		}

		.data-table th,
		.data-table td {
			border: 1px solid #000;
			padding: 8px;
		}

		.data-table th {
			background-color: #f2f2f2;
			text-align: center;
			font-weight: bold;
		}

		.text-center {
			text-align: center;
		}

		.signature-table {
			width: 100%;
			margin-top: 50px;
			border-collapse: collapse;
		}

		.signature-table td {
			border: none;
			padding: 0;
		}

		.signature {
			text-align: center;
			width: 300px;
			float: right;
		}

		.signature-line {
			margin-top: 60px;
			border-top: 1px solid #000;
			width: 200px;
			display: inline-block;
		}
	</style>
</head>

<body>
	<table class="header-table">
		<tr>
			<td class="logo-cell">
				<img src="<?= base_url('assets/logo.png') ?>" class="logo" alt="Logo">
			</td>
			<td class="school-info">
				<h1 class="school-name">PONDOK PESANTREN AN NUR SLAWI</h1>
				<p class="school-address">Jl. RA. Kartini No. 17 Desa Kalisapu Kec. Slawi Kab. Tegal</p>
				<p class="school-address">Telp/WA 0823 2824 9293  | Email: ponpes.annur.slawi@gmail.com</p>
			</td>
		</tr>
	</table>

	<h1 class="title">DATA GURU DAN TENAGA PENGAJAR</h1>

	<div class="info-box">
		<div class="info-row">
			<span class="info-label">Bidang:</span>
			<span><?= $bidang ?></span>
		</div>
		<div class="info-row">
			<span class="info-label">Tanggal Cetak:</span>
			<span><?= date('d F Y') ?></span>
		</div>
		<div class="info-row">
			<span class="info-label">Jumlah Data:</span>
			<span><?= count($guru) ?> orang</span>
		</div>
	</div>

	<table class="data-table">
		<thead>
			<tr>
				<th width="5%">No</th>
				<th width="10%">NIP</th>
				<th width="20%">Nama Guru</th>
				<th width="15%">Bidang</th>
				<th width="15%">Alamat</th>
				<th width="10%">Telepon</th>
				<th width="15%">Email</th>
				<th width="10%">Status</th>
			</tr>
		</thead>
		<tbody>
			<?php $no = 1;
			foreach ($guru as $g): ?>
				<tr>
					<td class="text-center"><?= $no++ ?></td>
					<td><?= $g->nip ?></td>
					<td><?= $g->nama ?></td>
					<td><?= $g->bidang_pengajaran ?></td>
					<td><?= $g->alamat ?></td>
					<td><?= $g->telepon ?></td>
					<td><?= $g->email ?></td>
					<td class="text-center"><?= $g->status ?></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>

	<table class="signature-table">
		<tr>
			<td></td>
			<td class="signature">
				<div>Mengetahui,</div>
				<div>Pengasuh Ponpes An Nur</div>
				<div class="signature-line"></div>
				<div><strong><u>Kyai Ahmad Musyafa, S.Pd.</u></strong></div>
				<div>NIP. 197003101995021001</div>
			</td>
		</tr>
	</table>
</body>

</html>