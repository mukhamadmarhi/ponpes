<div class="bg-white rounded-lg shadow-md overflow-hidden">
	<div class="bg-primary px-6 py-4">
		<h2 class="text-xl font-semibold text-white">LAPORAN</h2>
	</div>

	<div class="border-b border-gray-200">
		<nav class="flex -mb-px">
			<button onclick="showTab('santri')" id="tab-santri"
				class="border-primary text-primary whitespace-nowrap py-4 px-6 border-b-2 font-medium text-sm">
				Data Santri
			</button>
			<button onclick="showTab('guru')" id="tab-guru"
				class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-6 border-b-2 font-medium text-sm">
				Data Guru
			</button>
			<button onclick="showTab('nilai')" id="tab-nilai"
				class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-6 border-b-2 font-medium text-sm">
				Nilai Santri
			</button>
			<button onclick="showTab('absen')" id="tab-absen"
				class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-6 border-b-2 font-medium text-sm">
				Absensi
			</button>
		</nav>
	</div>

	<div class="p-6">
		<!-- Tab 1: Data Santri -->
		<div id="content-santri" class="space-y-6">
			<div class="flex justify-between items-center">
				<h3 class="text-lg font-medium text-gray-900">Laporan Data Santri</h3>
				<div class="flex space-x-3">
					<select id="filter-kelas-santri"
						class="border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary">
						<option value="">Semua Kelas</option>
						<?php foreach (['1 PA', '1 PI', '2 PA', '2 PI', '3 PA', '3 PI'] as $kelas): ?>
							<option value="<?= $kelas ?>" <?= ($this->input->get('kelas') == $kelas ? 'selected' : '') ?>>
								<?= $kelas ?>
							</option>
						<?php endforeach; ?>
					</select>
					<div class="flex space-x-2">
						<button onclick="previewSantri()"
							class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md text-sm flex items-center">
							<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
								viewBox="0 0 24 24" stroke="currentColor">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
									d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
									d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
							</svg>
							Preview
						</button>
						<button onclick="exportSantri()"
							class="bg-primary hover:bg-secondary text-white px-4 py-2 rounded-md text-sm flex items-center">
							<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
								viewBox="0 0 24 24" stroke="currentColor">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
									d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
							</svg>
							Download
						</button>
					</div>
				</div>
			</div>

			<div class="overflow-x-auto">
				<table class="min-w-full divide-y divide-gray-200">
					<thead class="bg-gray-50">
						<tr>
							<th scope="col"
								class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
								No</th>
							<th scope="col"
								class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
								NIS</th>
							<th scope="col"
								class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
								Nama Santri</th>
							<th scope="col"
								class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
								Kelas</th>
							<th scope="col"
								class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
								Tanggal Lahir</th>
							<th scope="col"
								class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
								Status</th>
						</tr>
					</thead>
					<tbody class="bg-white divide-y divide-gray-200" id="tabel-santri">
						<tr>
							<td colspan="7" class="text-center py-4">Memuat data...</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>

		<!-- Tab 2: Data Guru -->
		<div id="content-guru" class="space-y-6 hidden">
			<div class="flex justify-between items-center">
				<h3 class="text-lg font-medium text-gray-900">Laporan Data Guru</h3>
				<div class="flex space-x-3">
					<?php
					$daftar_bidang = ['Nahwu', 'Sharaf', 'Fiqih', 'Tauhid', 'Tasawuf', 'Hadist', "Qiro'ah", 'Tarikh', 'Tafsir', 'Khitobah'];
					$selected_bidang = $this->input->get('bidang');
					?>

					<select id="filter-bidang-guru"
						class="border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary">
						<option value="">Semua Bidang</option>
						<?php foreach ($daftar_bidang as $b):
							$selected = ($selected_bidang === $b) ? 'selected' : '';
							echo "<option value=\"$b\" $selected>$b</option>";
						endforeach; ?>
					</select>
					<div class="flex space-x-2">
						<button onclick="previewGuru()"
							class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md text-sm flex items-center">
							<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
								viewBox="0 0 24 24" stroke="currentColor">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
									d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
									d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
							</svg>
							Preview
						</button>
						<button onclick="exportGuru()"
							class="bg-primary hover:bg-secondary text-white px-4 py-2 rounded-md text-sm flex items-center">
							<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
								viewBox="0 0 24 24" stroke="currentColor">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
									d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
							</svg>
							Download
						</button>
					</div>
				</div>
			</div>

			<div class="overflow-x-auto">
				<table class="min-w-full divide-y divide-gray-200">
					<thead class="bg-gray-50">
						<tr>
							<th scope="col"
								class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
								No</th>
							<th scope="col"
								class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
								NIP</th>
							<th scope="col"
								class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
								Nama Guru</th>
							<th scope="col"
								class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
								Bidang</th>
							<th scope="col"
								class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
								Status</th>
						</tr>
					</thead>
					<tbody class="bg-white divide-y divide-gray-200" id="tabel-guru">
						<tr>
							<td colspan="5" class="text-center py-4">Memuat data...</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>

		<!-- Tab 3: Nilai Santri -->
		<div id="content-nilai" class="space-y-6 hidden">
			<div class="flex justify-between items-center">
				<h3 class="text-lg font-medium text-gray-900">Laporan Nilai Santri</h3>
				<div class="flex space-x-3">
					<select id="filter-kelas-nilai"
						class="border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary">
						<option value="">Semua Kelas</option>
						<?php foreach (['1 PA', '1 PI', '2 PA', '2 PI', '3 PA', '3 PI'] as $kelas): ?>
							<option value="<?= $kelas ?>" <?= ($this->input->get('kelas') == $kelas ? 'selected' : '') ?>>
								<?= $kelas ?>
							</option>
						<?php endforeach; ?>
					</select>
					<select id="filter-semester"
						class="border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary">
						<option value="">Semua Semester</option>
						<option>Ganjil</option>
						<option>Genap</option>
					</select>
					<?php
					$tahun_awal = 2021;
					$tahun_sekarang = date('Y');
					$tahun_selected = $this->input->get('tahun');
					?>

					<select id="filter-tahun"
						class="border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary">
						<option value="">Semua Tahun</option>
						<?php for ($th = $tahun_sekarang + 1; $th >= $tahun_awal; $th--):
							$tahun_ajaran = ($th - 1) . '/' . $th;
							$selected = ($tahun_selected == $tahun_ajaran) ? 'selected' : '';
							echo "<option value=\"$tahun_ajaran\" $selected>$tahun_ajaran</option>";
						endfor; ?>
					</select>

					<div class="flex space-x-2">
						<button onclick="previewNilai()"
							class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md text-sm flex items-center">
							<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
								viewBox="0 0 24 24" stroke="currentColor">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
									d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
									d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
							</svg>
							Preview
						</button>
						<button onclick="exportNilai()"
							class="bg-primary hover:bg-secondary text-white px-4 py-2 rounded-md text-sm flex items-center">
							<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
								viewBox="0 0 24 24" stroke="currentColor">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
									d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
							</svg>
							Download
						</button>
					</div>
				</div>
			</div>

			<div class="overflow-x-auto">
				<table class="min-w-full divide-y divide-gray-200">
					<thead class="bg-gray-50">
						<tr>
							<th
								class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
								No</th>
							<th
								class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
								NIS</th>
							<th
								class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
								Nama Santri</th>
							<th
								class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
								Kelas</th>
							<th
								class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
								Mapel</th>
							<th
								class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
								Semester</th>
							<th
								class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
								Tahun Ajaran</th>
							<th
								class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
								Harian</th>
							<th
								class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
								UTS</th>
							<th
								class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
								UAS</th>
							<th
								class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
								Nilai Akhir</th>
							<th
								class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
								Guru</th>
						</tr>
					</thead>
					<tbody class="bg-white divide-y divide-gray-200" id="tabel-nilai">
						<tr>
							<td colspan="12" class="text-center py-4">Memuat data...</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>

		<!-- Tab 4: Absensi -->
		<div id="content-absen" class="space-y-6 hidden">
			<div class="flex justify-between items-center">
				<h3 class="text-lg font-medium text-gray-900">Laporan Absensi Santri</h3>
				<div class="flex space-x-3">
					<input type="date" id="filter-tanggal"
						class="border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary">
					<select id="filter-kelas-absen"
						class="border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary">
						<option value="">Semua Kelas</option>
						<?php foreach (['1 PA', '1 PI', '2 PA', '2 PI', '3 PA', '3 PI'] as $kelas): ?>
							<option value="<?= $kelas ?>" <?= ($this->input->get('kelas') == $kelas ? 'selected' : '') ?>>
								<?= $kelas ?>
							</option>
						<?php endforeach; ?>
					</select>
					<div class="flex space-x-2">
						<button onclick="previewAbsen()"
							class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md text-sm flex items-center">
							<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
								viewBox="0 0 24 24" stroke="currentColor">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
									d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
									d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
							</svg>
							Preview
						</button>
						<button onclick="exportAbsen()"
							class="bg-primary hover:bg-secondary text-white px-4 py-2 rounded-md text-sm flex items-center">
							<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
								viewBox="0 0 24 24" stroke="currentColor">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
									d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
							</svg>
							Download
						</button>
					</div>
				</div>
			</div>

			<div class="overflow-x-auto">
				<table class="min-w-full divide-y divide-gray-200">
					<thead class="bg-gray-50">
						<tr>
							<th scope="col"
								class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
								No</th>
							<th scope="col"
								class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
								NIS</th>
							<th scope="col"
								class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
								Nama Santri</th>
							<th scope="col"
								class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
								Kelas</th>
							<th scope="col"
								class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
								Tanggal</th>
							<th scope="col"
								class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
								Status</th>
							<th scope="col"
								class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
								Keterangan</th>
						</tr>
					</thead>
					<tbody class="bg-white divide-y divide-gray-200" id="tabel-absen">
						<tr>
							<td colspan="7" class="text-center py-4">Memuat data...</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<script>
	function showTab(tabName) {
		document.getElementById('content-santri').classList.add('hidden');
		document.getElementById('content-guru').classList.add('hidden');
		document.getElementById('content-nilai').classList.add('hidden');
		document.getElementById('content-absen').classList.add('hidden');

		document.getElementById('tab-santri').classList.remove('border-primary', 'text-primary');
		document.getElementById('tab-santri').classList.add('border-transparent', 'text-gray-500');
		document.getElementById('tab-guru').classList.remove('border-primary', 'text-primary');
		document.getElementById('tab-guru').classList.add('border-transparent', 'text-gray-500');
		document.getElementById('tab-nilai').classList.remove('border-primary', 'text-primary');
		document.getElementById('tab-nilai').classList.add('border-transparent', 'text-gray-500');
		document.getElementById('tab-absen').classList.remove('border-primary', 'text-primary');
		document.getElementById('tab-absen').classList.add('border-transparent', 'text-gray-500');

		document.getElementById('content-' + tabName).classList.remove('hidden');
		document.getElementById('tab-' + tabName).classList.add('border-primary', 'text-primary');
		document.getElementById('tab-' + tabName).classList.remove('border-transparent', 'text-gray-500');

		loadData(tabName);
	}

	function loadData(type) {
		let url = '';
		let params = new URLSearchParams();
		let targetTable = '';

		switch (type) {
			case 'santri':
				url = '<?= base_url("laporan/get_santri") ?>';
				params.append('kelas', document.getElementById('filter-kelas-santri').value);
				targetTable = 'tabel-santri';
				break;
			case 'guru':
				url = '<?= base_url("laporan/get_guru") ?>';
				params.append('bidang', document.getElementById('filter-bidang-guru').value);
				targetTable = 'tabel-guru';
				break;
			case 'nilai':
				url = '<?= base_url("laporan/get_nilai") ?>';
				params.append('kelas', document.getElementById('filter-kelas-nilai').value);
				params.append('semester', document.getElementById('filter-semester').value);
				params.append('tahun_ajaran', document.getElementById('filter-tahun').value);
				targetTable = 'tabel-nilai';
				break;
			case 'absen':
				url = '<?= base_url("laporan/get_absen") ?>';
				params.append('kelas', document.getElementById('filter-kelas-absen').value);
				params.append('tanggal', document.getElementById('filter-tanggal').value);
				targetTable = 'tabel-absen';
				break;
		}

		fetch(`${url}?${params.toString()}`)
			.then(response => response.json())
			.then(data => {
				const tableBody = document.getElementById(targetTable);
				tableBody.innerHTML = '';

				if (data.length === 0) {
					const colSpan = type === 'nilai' ? 12 : (type === 'absen' ? 7 : (type === 'guru' ? 5 : 6));
					tableBody.innerHTML = `<tr><td colspan="${colSpan}" class="text-center py-4">Tidak ada data ditemukan</td></tr>`;
					return;
				}

				data.forEach((item, index) => {
					const row = document.createElement('tr');

					switch (type) {
						case 'santri':
							row.innerHTML = `
						  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${index + 1}</td>
						  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${item.nis}</td>
						  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${item.nama}</td>
						  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${item.kelas}</td>
						  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${new Date(item.tanggal_lahir).toLocaleDateString('id-ID')}</td>
						  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${item.status}</td>
					   `;
							break;
						case 'guru':
							row.innerHTML = `
						  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${index + 1}</td>
						  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${item.nip}</td>
						  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${item.nama}</td>
						  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${item.bidang_pengajaran}</td>
						  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
							 <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full ${item.status === 'Aktif' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'}">
								${item.status}
							 </span>
						  </td>
					   `;
							break;
						case 'nilai':
							row.innerHTML = `
						  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${index + 1}</td>
						  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${item.nis}</td>
						  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${item.nama_santri}</td>
						  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${item.kelas}</td>
						  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${item.mapel}</td>
						  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${item.semester}</td>
						  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${item.tahun_ajaran}</td>
						  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${item.nilai_harian}</td>
						  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${item.nilai_uts}</td>
						  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${item.nilai_uas}</td>
						  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-semibold">${item.nilai_akhir}</td>
						  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${item.guru_pengampu}</td>
					   `;
							break;
						case 'absen':
							let statusClass = '';
							if (item.status === 'Hadir') statusClass = 'bg-green-100 text-green-800';
							else if (item.status === 'Izin') statusClass = 'bg-yellow-100 text-yellow-800';
							else statusClass = 'bg-red-100 text-red-800';

							row.innerHTML = `
						  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${index + 1}</td>
						  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${item.nis}</td>
						  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${item.nama_santri}</td>
						  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${item.kelas}</td>
						  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${new Date(item.tanggal).toLocaleDateString('id-ID')}</td>
						  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
							 <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full ${statusClass}">
								${item.status}
							 </span>
						  </td>
						  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${item.keterangan || '-'}</td>
					   `;
							break;
					}

					tableBody.appendChild(row);
				});
			})
			.catch(error => {
				console.error('Error:', error);
				document.getElementById(targetTable).innerHTML = `<tr><td colspan="7" class="text-center py-4 text-red-500">Gagal memuat data</td></tr>`;
			});
	}

	function previewSantri() {
		const kelas = document.getElementById('filter-kelas-santri').value;
		window.open(`<?= base_url('laporan/preview_santri') ?>?kelas=${kelas}`, '_blank');
	}

	function exportSantri() {
		const kelas = document.getElementById('filter-kelas-santri').value;
		window.open(`<?= base_url('laporan/export_santri') ?>?kelas=${kelas}`, '_blank');
	}

	function previewGuru() {
		const bidang = document.getElementById('filter-bidang-guru').value;
		window.open(`<?= base_url('laporan/preview_guru') ?>?bidang=${bidang}`, '_blank');
	}

	function exportGuru() {
		const bidang = document.getElementById('filter-bidang-guru').value;
		window.open(`<?= base_url('laporan/export_guru') ?>?bidang=${bidang}`, '_blank');
	}

	function previewNilai() {
		const kelas = document.getElementById('filter-kelas-nilai').value;
		const semester = document.getElementById('filter-semester').value;
		const tahun = document.getElementById('filter-tahun').value;
		window.open(`<?= base_url('laporan/preview_nilai') ?>?kelas=${kelas}&semester=${semester}&tahun_ajaran=${tahun}`, '_blank');
	}

	function exportNilai() {
		const kelas = document.getElementById('filter-kelas-nilai').value;
		const semester = document.getElementById('filter-semester').value;
		const tahun = document.getElementById('filter-tahun').value;
		window.open(`<?= base_url('laporan/export_nilai') ?>?kelas=${kelas}&semester=${semester}&tahun_ajaran=${tahun}`, '_blank');
	}

	function previewAbsen() {
		const kelas = document.getElementById('filter-kelas-absen').value;
		const tanggal = document.getElementById('filter-tanggal').value;
		window.open(`<?= base_url('laporan/preview_absen') ?>?kelas=${kelas}&tanggal=${tanggal}`, '_blank');
	}

	function exportAbsen() {
		const kelas = document.getElementById('filter-kelas-absen').value;
		const tanggal = document.getElementById('filter-tanggal').value;
		window.open(`<?= base_url('laporan/export_absen') ?>?kelas=${kelas}&tanggal=${tanggal}`, '_blank');
	}

	document.getElementById('filter-kelas-santri').addEventListener('change', () => loadData('santri'));
	document.getElementById('filter-bidang-guru').addEventListener('change', () => loadData('guru'));
	document.getElementById('filter-kelas-nilai').addEventListener('change', () => loadData('nilai'));
	document.getElementById('filter-semester').addEventListener('change', () => loadData('nilai'));
	document.getElementById('filter-tahun').addEventListener('change', () => loadData('nilai'));
	document.getElementById('filter-kelas-absen').addEventListener('change', () => loadData('absen'));
	document.getElementById('filter-tanggal').addEventListener('change', () => loadData('absen'));

	document.addEventListener('DOMContentLoaded', () => {
		showTab('santri');
	});
</script>