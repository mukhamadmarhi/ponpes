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
			font-size: 10pt;
		}

		.data-table th,
		.data-table td {
			border: 1px solid #000;
			padding: 6px;
			text-align: center;
		}

		.data-table th {
			background-color: #f2f2f2;
			font-weight: bold;
		}

		.text-left {
			text-align: left;
		}

		.nilai-akhir {
			font-weight: bold;
			background-color: #e7f3fe;
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

		.signature-area {
			text-align: center;
			width: 300px;
		}

		.signature-space {
			height: 60px;
			margin-bottom: 5px;
		}

		.signature-line {
			border-top: 1px solid #000;
			width: 200px;
			margin: 0 auto;
		}

		.left-signature {
			float: left;
			text-align: center;
		}

		.right-signature {
			float: right;
			text-align: center;
		}

		.clearfix::after {
			content: "";
			clear: both;
			display: table;
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
				<p class="school-address">Telp/WA 0823 2824 9293  | Email: ponpes.annur.slawi@gmail.com<</p>
			</td>
		</tr>
	</table>

	<h1 class="title"><?= $title ?></h1>

	<div class="info-box">
		<div class="info-row">
			<span class="info-label">Kelas:</span>
			<span><?= $kelas ?></span>
		</div>
		<div class="info-row">
			<span class="info-label">Tanggal Cetak:</span>
			<span><?= date('d F Y') ?></span>
		</div>
	</div>

	<table class="data-table">
		<thead>
			<tr>
				<th width="4%">No</th>
				<th width="8%">NIS</th>
				<th width="15%">Nama Santri</th>
				<th width="8%">Kelas</th>
				<th width="12%">Mata Pelajaran</th>
				<th width="8%">Semester</th>
				<th width="10%">Tahun Ajaran</th>
				<th width="7%">Harian</th>
				<th width="7%">UTS</th>
				<th width="7%">UAS</th>
				<th width="8%">Nilai Akhir</th>
				<th width="12%">Guru Pengampu</th>
			</tr>
		</thead>
		<tbody>
			<?php $no = 1;
			foreach ($nilai as $n): ?>
				<tr>
					<td><?= $no++ ?></td>
					<td><?= $n->nis ?></td>
					<td class="text-left"><?= $n->nama_santri ?></td>
					<td><?= $n->kelas ?></td>
					<td class="text-left"><?= $n->mata_pelajaran ?></td>
					<td><?= $n->semester ?></td>
					<td><?= $n->tahun_ajaran ?></td>
					<td><?= $n->nilai_harian ?></td>
					<td><?= $n->nilai_uts ?></td>
					<td><?= $n->nilai_uas ?></td>
					<td class="nilai-akhir"><?= number_format($n->nilai_akhir, 2) ?></td>
					<td class="text-left"><?= $n->guru_pengampu ?></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>

	<div class="clearfix">
		<div class="left-signature">
			<div class="signature-area">
				<p>Mengetahui,</p>
				<p>Pengasuh Ponpes An Nur</p>
				<div class="signature-space"></div>
				<div class="signature-line"></div>
				<p><u>Kyai Ahmad Musyafa, S.Pd.</u></p>
				<p>NIP. 1125267527224225</p>
			</div>
		</div>
		<div class="right-signature">
			<div class="signature-area">
				<p>Tegal, <?= date('d F Y') ?></p>
				<p>Wali Kelas <?= $kelas ?></p>
				<div class="signature-space"></div>
				<div class="signature-line"></div>
				<p><u>Ust. Irwanto</u></p>
				<p>NIP. 1219211387313176</p>
			</div>
		</div>
	</div>
</body>

</html>