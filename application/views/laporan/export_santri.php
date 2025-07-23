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

		.info {
			text-align: center;
			margin-bottom: 20px;
			font-size: 12pt;
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
				<img src="<?= base_url('assets/logo.png') ?>" class="logo" alt="Logo Pesantren">
			</td>
			<td class="school-info">
				<h1 class="school-name">PONDOK PESANTREN AN NUR SLAWI</h1>
				<p class="school-address">Jl. RA. Kartini No. 17 Desa Kalisapu Kec. Slawi Kab. Tegal</p>
				<p class="school-address">Telp/WA 0823 2824 9293  | Email: ponpes.annur.slawi@gmail.com</p>
			</td>
		</tr>
	</table>

	<h1 class="title"><?= $title ?></h1>

	<div class="info">
		<p><strong>Kelas:</strong> <?= $kelas ?> | <strong>Tanggal Cetak:</strong> <?= date('d F Y') ?></p>
	</div>

	<table class="data-table">
		<thead>
			<tr>
				<th width="5%">No</th>
				<th width="10%">NIS</th>
				<th width="20%">Nama Santri</th>
				<th width="10%">Kelas</th>
				<th width="15%">Tanggal Lahir</th>
				<th width="15%">Alamat</th>
				<th width="15%">Nama Wali</th>
				<th width="10%">Status</th>
			</tr>
		</thead>
		<tbody>
			<?php $no = 1;
			foreach ($santri as $s): ?>
				<tr>
					<td class="text-center"><?= $no++ ?></td>
					<td><?= $s->nis ?></td>
					<td><?= $s->nama ?></td>
					<td class="text-center"><?= $s->kelas ?></td>
					<td><?= date('d/m/Y', strtotime($s->tanggal_lahir)) ?></td>
					<td><?= $s->alamat ?></td>
					<td><?= $s->nama_wali ?></td>
					<td class="text-center"><?= $s->status ?></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>

	<table class="signature-table">
		<tr>
			<td></td>
			<td class="signature">
				<div>Tegal, <?= date('d F Y') ?></div>
				<div>Pengasuh Ponpes An Nur</div>
				<div class="signature-line"></div>
				<div><strong><u>Kyai Ahmad Musyafa, S.Pd.</u></strong></div>
				<div>NIP. 197003101995021001</div>
			</td>
		</tr>
	</table>
</body>

</html>