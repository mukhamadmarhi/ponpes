<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
	<div class="bg-white rounded-lg shadow p-6 flex items-center">
		<div class="p-3 rounded-full bg-primary bg-opacity-20 text-primary mr-4">
			<i class="fas fa-users text-xl"></i>
		</div>
		<div>
			<p class="text-gray-500">Total Santri</p>
			<h3 class="text-2xl font-bold"><?= number_format($total_santri) ?></h3>
		</div>
	</div>
	<div class="bg-white rounded-lg shadow p-6 flex items-center">
		<div class="p-3 rounded-full bg-accent bg-opacity-20 text-accent mr-4">
			<i class="fas fa-chalkboard-teacher text-xl"></i>
		</div>
		<div>
			<p class="text-gray-500">Total Guru</p>
			<h3 class="text-2xl font-bold"><?= number_format($total_guru) ?></h3>
		</div>
	</div>
	<div class="bg-white rounded-lg shadow p-6 flex items-center">
		<div class="p-3 rounded-full bg-warning bg-opacity-20 text-warning mr-4">
			<i class="fas fa-clipboard-check text-xl"></i>
		</div>
		<div>
			<p class="text-gray-500">Absensi Hari Ini</p>
			<h3 class="text-2xl font-bold"><?= $absensi_hari_ini ?>%</h3>
		</div>
	</div>
	<div class="bg-white rounded-lg shadow p-6 flex items-center">
		<div class="p-3 rounded-full bg-secondary bg-opacity-20 text-secondary mr-4">
			<i class="fas fa-tasks text-xl"></i>
		</div>
		<div>
			<p class="text-gray-500">Nilai Akhir Belum Input</p>
			<h3 class="text-2xl font-bold"><?= number_format($nilai_belum_input) ?></h3>
		</div>
	</div>
</div>

<!-- Charts Section -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
	<!-- Absensi Chart -->
	<div class="bg-white rounded-lg shadow p-6">
		<div class="flex justify-between items-center mb-4">
			<h3 class="font-semibold text-lg">Statistik Absensi</h3>
			<div class="flex gap-2">
				<select id="bulanSelect" class="border rounded px-3 py-1 text-sm">
					<?php
					$bulan_array = [
						'01' => 'Januari',
						'02' => 'Februari',
						'03' => 'Maret',
						'04' => 'April',
						'05' => 'Mei',
						'06' => 'Juni',
						'07' => 'Juli',
						'08' => 'Agustus',
						'09' => 'September',
						'10' => 'Oktober',
						'11' => 'November',
						'12' => 'Desember'
					];
					$bulan_sekarang = date('m');
					$tahun_sekarang = date('Y');
					?>
					<?php foreach ($bulan_array as $val => $nama): ?>
						<option value="<?= $val ?>" <?= $val == $bulan_sekarang ? 'selected' : '' ?>><?= $nama ?></option>
					<?php endforeach; ?>
				</select>
				<select id="tahunSelect" class="border rounded px-3 py-1 text-sm">
					<?php for ($i = $tahun_sekarang; $i >= 2020; $i--): ?>
						<option value="<?= $i ?>" <?= $i == $tahun_sekarang ? 'selected' : '' ?>><?= $i ?></option>
					<?php endfor; ?>
				</select>
			</div>
		</div>
		<canvas id="absensiChart" class="w-full h-64"></canvas>
	</div>

	<!-- Recent Activities -->
	<div class="bg-white rounded-lg shadow p-6">
		<h3 class="font-semibold text-lg mb-4">Aktivitas Terkini</h3>
		<div class="space-y-4">
			<?php foreach ($log_terbaru as $index => $log): ?>
				<div class="flex items-start group">
					<div
						class="p-2 <?= $index % 2 == 0 ? 'bg-primary' : 'bg-secondary' ?> bg-opacity-20 <?= $index % 2 == 0 ? 'text-primary' : 'text-secondary' ?> rounded-full mr-3 group-hover:bg-opacity-30 transition-all">
						<i class="fas fa-<?= $log->ikon ?: 'info-circle' ?>"></i>
					</div>
					<div>
						<p class="font-medium"><span
								class="capitalize"><?= $log->nama_user . ' ' ?></span><?= $log->aktivitas ?></p>
						<p class="text-sm text-gray-500"><?= waktu_ago($log->created_at) ?></p>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</div>

<!-- Quick Actions & Recent Data -->
<div class="">
	<!-- Recent Absensi -->
	<div class="bg-white rounded-lg shadow p-6 col-span-2">
		<?php if ($this->session->userdata('role') == 'admin'): ?>
			<div class="flex justify-between items-center mb-4">
				<h3 class="font-semibold text-lg">Absensi Hari Ini</h3>
				<a href="<?= base_url('admin/absensi') ?>" class="text-primary text-sm font-medium">Lihat Semua</a>
			</div>
		<?php endif; ?>

		<?php if (empty($absensi_list_today)): ?>
			<div class="text-center py-8">
				<svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"
					aria-hidden="true">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
						d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
				</svg>
				<h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada data absensi hari ini</h3>
				<p class="mt-1 text-sm text-gray-500">Belum ada santri yang di absen hari ini.</p>
				<?php if ($this->session->userdata('role') == 'admin' || $this->session->userdata('role') == 'guru'): ?>
					<div class="mt-6">
						<a href="<?= base_url('admin/absensi') ?>"
							class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
							<svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
								fill="currentColor" aria-hidden="true">
								<path fill-rule="evenodd"
									d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
									clip-rule="evenodd" />
							</svg>
							Tambah Absensi
						</a>
					</div>
				<?php endif; ?>
			</div>
		<?php else: ?>
			<div class="overflow-x-auto">
				<table class="min-w-full divide-y divide-gray-200">
					<thead class="bg-gray-50">
						<tr>
							<th
								class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
								Nama Santri</th>
							<th
								class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
								Kelas</th>
							<th
								class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
								Status</th>
							<th
								class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
								Waktu</th>
						</tr>
					</thead>
					<tbody class="bg-white divide-y divide-gray-200">
						<?php foreach ($absensi_list_today as $row): ?>
							<tr>
								<td class="px-6 py-4 whitespace-nowrap"><?= $row->nama ?></td>
								<td class="px-6 py-4 whitespace-nowrap"><?= $row->kelas ?></td>
								<td class="px-6 py-4 whitespace-nowrap">
									<?php
									if ($row->status == 'Hadir') {
										$badge = 'bg-green-100 text-green-800';
									} elseif ($row->status == 'Izin') {
										$badge = 'bg-yellow-100 text-yellow-800';
									} elseif ($row->status == 'Sakit') {
										$badge = 'bg-blue-100 text-blue-800';
									} else {
										$badge = 'bg-red-100 text-red-800';
									}
									?>
									<span class="px-2 py-1 rounded-full text-xs <?= $badge ?>"><?= $row->status ?></span>
								</td>
								<td class="px-6 py-4 whitespace-nowrap">
									<?= $row->tanggal ? date('H:i', strtotime($row->tanggal)) : '-' ?>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		<?php endif; ?>
	</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
	let absensiChart;

	function loadStatistik(bulan, tahun) {
		fetch(`<?= base_url('dashboard/statistik?bulan=') ?>${bulan}&tahun=${tahun}`)
			.then(res => res.json())
			.then(data => {
				const dataset = [
					data.Hadir ?? 0,
					data.Izin ?? 0,
					data.Sakit ?? 0,
					data.Alpa ?? 0
				];

				if (absensiChart) {
					absensiChart.data.datasets[0].data = dataset;
					absensiChart.update();
				} else {
					const ctx = document.getElementById('absensiChart').getContext('2d');
					absensiChart = new Chart(ctx, {
						type: 'bar',
						data: {
							labels: ['Hadir', 'Izin', 'Sakit', 'Alpa'],
							datasets: [{
								label: 'Jumlah Santri',
								data: dataset,
								backgroundColor: ['#34d399', '#fbbf24', '#60a5fa', '#f87171'],
								borderRadius: 5,
								barThickness: 40
							}]
						},
						options: {
							responsive: true,
							scales: {
								y: {
									beginAtZero: true
								}
							}
						}
					});
				}
			});
	}

	document.getElementById('bulanSelect').addEventListener('change', function () {
		loadStatistik(this.value, document.getElementById('tahunSelect').value);
	});

	document.getElementById('tahunSelect').addEventListener('change', function () {
		loadStatistik(document.getElementById('bulanSelect').value, this.value);
	});

	loadStatistik(document.getElementById('bulanSelect').value, document.getElementById('tahunSelect').value);
</script>