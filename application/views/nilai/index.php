<!-- Header dan Tombol Tambah -->
<div class="flex justify-between items-center mb-6">
	<h2 class="text-2xl font-semibold">Manajemen Nilai</h2>
	<?php if ($this->session->userdata('role') == 'admin' || $this->session->userdata('role') == 'guru'): ?>
		<button onclick="openModal('add')"
			class="bg-primary hover:bg-secondary text-white px-4 py-2 rounded flex items-center">
			<i class="fas fa-plus mr-2"></i> Tambah Nilai
		</button>
	<?php endif; ?>
</div>

<!-- Filter dan Search -->
<form method="get" class="bg-white p-4 rounded-lg shadow mb-6">
	<div class="grid grid-cols-1 md:grid-cols-5 gap-4">
		<div>
			<label class="block text-sm font-medium text-gray-700 mb-1">Cari Santri</label>
			<input type="text" name="search" value="<?= $this->input->get('search') ?>"
				class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-1 focus:ring-primary">
		</div>
		<div>
			<label class="block text-sm font-medium text-gray-700 mb-1">Mata Pelajaran</label>
			<select name="mapel"
				class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-1 focus:ring-primary">
				<option value="">Semua Mapel</option>
				<?php
				$mapelList = ['Nahwu', 'Sharaf', 'Fiqih', 'Tauhid', 'Tasawuf', 'Hadist', "Qiro'ah", 'Tarikh', 'Tafsir', 'Khitobah'];
				foreach ($mapelList as $mapel) {
					$selected = ($this->input->get('mapel') === $mapel) ? 'selected' : '';
					echo "<option value=\"$mapel\" $selected>$mapel</option>";
				}
				?>
			</select>
		</div>
		<div>
			<label class="block text-sm font-medium text-gray-700 mb-1">Semester</label>
			<select name="semester"
				class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-1 focus:ring-primary">
				<option value="">Semua Semester</option>
				<option value="Ganjil" <?= $this->input->get('semester') == 'Ganjil' ? 'selected' : '' ?>>1
					(Ganjil)</option>
				<option value="Genap" <?= $this->input->get('semester') == 'Genap' ? 'selected' : '' ?>>2
					(Genap)</option>
			</select>
		</div>
		<div>
			<label class="block text-sm font-medium text-gray-700 mb-1">Tahun Ajaran</label>
			<?php
			$tahun_awal = 2021;
			$tahun_sekarang = date('Y');
			$tahunList = [];

			for ($th = $tahun_sekarang + 1; $th >= $tahun_awal; $th--) {
				$tahun_ajaran = ($th - 1) . '/' . $th;
				$tahunList[] = $tahun_ajaran;
			}
			?>

			<select name="tahun"
				class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-1 focus:ring-primary">
				<option value="">Semua Tahun</option>
				<?php
				foreach ($tahunList as $thn) {
					$selected = ($this->input->get('tahun') === $thn) ? 'selected' : '';
					echo "<option value=\"$thn\" $selected>$thn</option>";
				}
				?>
			</select>
		</div>
		<div class="flex items-end space-x-2">
			<button type="submit"
				class="bg-primary hover:bg-secondary text-white px-4 py-2 rounded flex items-center">
				<i class="fas fa-filter mr-2"></i> Filter
			</button>
			<a href="<?= base_url('nilai') ?>"
				class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded flex items-center">
				<i class="fas fa-redo mr-2"></i> Reset
			</a>
		</div>
	</div>
</form>

<!-- Tabel Data Nilai -->
<div class="bg-white rounded-lg shadow overflow-hidden">
	<div class="overflow-x-auto">
		<table class="min-w-full divide-y divide-gray-200">
			<thead class="bg-gray-50">
				<tr>
					<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
						Santri</th>
					<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
						Mata Pelajaran</th>
					<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
						Semester</th>
					<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
						Nilai Harian</th>
					<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
						Nilai UTS</th>
					<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
						Nilai UAS</th>
					<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
						Nilai Akhir</th>
					<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
						Guru</th>
					<?php if ($this->session->userdata('role') == 'admin' || $this->session->userdata('role') == 'guru'): ?>
						<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
							Aksi</th>
					<?php endif; ?>
				</tr>
			</thead>
			<tbody class="bg-white divide-y divide-gray-200" id="nilaiTableBody">
				<?php foreach ($nilai as $n): ?>
					<tr>
						<td class="px-6 py-4 whitespace-nowrap">
							<div class="flex items-center">
								<div class="flex-shrink-0 h-10 w-10">
									<img class="h-10 w-10 rounded-full"
										src="<?= base_url('uploads/santri/' . $n->foto) ?>" alt="">
								</div>
								<div class="ml-4">
									<div class="text-sm font-medium text-gray-900"><?= $n->nama_santri ?></div>
									<div class="text-sm text-gray-500">
										<?= $n->kelas ?>
									</div>
								</div>
							</div>
						</td>
						<td class="px-6 py-4 whitespace-nowrap"><?= $n->mata_pelajaran ?></td>
						<td class="px-6 py-4 whitespace-nowrap"><?= $n->semester ?></td>
						<td class="px-6 py-4 whitespace-nowrap text-center"><?= $n->nilai_harian ?></td>
						<td class="px-6 py-4 whitespace-nowrap text-center"><?= $n->nilai_uts ?></td>
						<td class="px-6 py-4 whitespace-nowrap text-center"><?= $n->nilai_uas ?></td>
						<td class="px-6 py-4 whitespace-nowrap text-center font-semibold text-primary">
							<?= $n->nilai_akhir ?>
						</td>
						<td class="px-6 py-4 whitespace-nowrap"><?= $n->nama_guru ?></td>
						<?php if ($this->session->userdata('role') == 'admin' || $this->session->userdata('role') == 'guru'): ?>
							<td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
								<button onclick="openModal('edit', '<?= $n->id_nilai ?>')"
									class="text-primary hover:text-secondary mr-3">
									<i class="fas fa-edit"></i> Edit
								</button>
								<button onclick="hapusNilai(<?= $n->id_nilai ?>)" class="text-red-600 hover:text-red-900">
									<i class="fas fa-trash-alt"></i> Hapus
								</button>
							</td>
						<?php endif; ?>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>

	<!-- Pagination -->
	<div class="flex items-center justify-between p-6">
		<?= $pagination ?>
	</div>
</div>

<div id="nilaiModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
	<div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
		<div class="fixed inset-0 transition-opacity" aria-hidden="true">
			<div class="absolute inset-0 bg-gray-500 opacity-75"></div>
		</div>
		<span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
		<div
			class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
			<div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
				<div class="sm:flex sm:items-start">
					<div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
						<h3 id="modalNilaiTitle" class="text-lg leading-6 font-medium text-gray-900 mb-4">
							Tambah Nilai Baru
						</h3>
						<div class="grid grid-cols-1 gap-4">
							<div>
								<label for="santriSelect"
									class="block text-sm font-medium text-gray-700">Santri</label>
								<select id="santriSelect"
									class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
									<option>Pilih Santri</option>
									<?php foreach ($santri as $s): ?>
										<option value="<?= $s->id_santri ?>"><?= $s->nama ?></option>
									<?php endforeach; ?>
								</select>
							</div>

							<div>
								<label for="mapelSelect" class="block text-sm font-medium text-gray-700">Mata
									Pelajaran</label>
								<select id="mapelSelect"
									class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
									<option value="">Pilih Mata Pelajaran</option>
									<?php
									$mapel_list = [
										'Nahwu',
										'Sharaf',
										'Fiqih',
										'Tauhid',
										'Tasawuf',
										'Hadist',
										"Qiro'ah",
										'Tarikh',
										'Tafsir',
										'Khitobah'
									];
									foreach ($mapel_list as $m) {
										echo "<option value=\"$m\">$m</option>";
									}
									?>
								</select>
							</div>

							<div class="grid grid-cols-2 gap-4">
								<div>
									<label for="semesterSelect"
										class="block text-sm font-medium text-gray-700">Semester</label>
									<select id="semesterSelect"
										class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
										<option>Ganjil</option>
										<option>Genap</option>
									</select>
								</div>

								<div>
									<label for="tahunSelect"
										class="block text-sm font-medium text-gray-700">Tahun Ajaran</label>
									<?php
									$tahun_awal = 2021;
									$tahun_sekarang = date('Y');
									?>

									<select id="tahunSelect"
										class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
										<?php for ($th = $tahun_sekarang + 1; $th >= $tahun_awal; $th--):
											$tahun_ajaran = ($th - 1) . '/' . $th;
											echo "<option value=\"$tahun_ajaran\">$tahun_ajaran</option>";
										endfor; ?>
									</select>

								</div>
							</div>

							<div class="grid grid-cols-3 gap-4">
								<div>
									<label for="nilaiHarian"
										class="block text-sm font-medium text-gray-700">Nilai Harian</label>
									<input type="number" id="nilaiHarian" min="0" max="100"
										class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
								</div>

								<div>
									<label for="nilaiUTS" class="block text-sm font-medium text-gray-700">Nilai
										UTS</label>
									<input type="number" id="nilaiUTS" min="0" max="100"
										class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
								</div>

								<div>
									<label for="nilaiUAS" class="block text-sm font-medium text-gray-700">Nilai
										UAS</label>
									<input type="number" id="nilaiUAS" min="0" max="100"
										class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
								</div>
							</div>

							<div class="bg-gray-50 p-3 rounded">
								<label class="block text-sm font-medium text-gray-700 mb-1">Nilai Akhir</label>
								<div class="text-xl font-bold text-primary" id="nilaiAkhirDisplay">0.0</div>
								<small class="text-gray-500">(30% Harian + 30% UTS + 40% UAS)</small>
							</div>

							<div>
								<label for="guruSelect" class="block text-sm font-medium text-gray-700">Guru
									Pengajar</label>
								<select id="guruSelect"
									class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
									<option>Pilih Guru</option>
									<?php foreach ($guru as $g): ?>
										<option value="<?= $g->id_guru ?>"><?= $g->nama ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
				<button type="button" onclick="saveNilai()"
					class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-primary text-base font-medium text-white hover:bg-secondary focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary sm:ml-3 sm:w-auto sm:text-sm">
					Simpan
				</button>
				<button type="button" onclick="closeNilaiModal()"
					class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
					Batal
				</button>
			</div>
		</div>
	</div>
</div>

<script>
	function calculateNilaiAkhir() {
		const harian = parseFloat(document.getElementById('nilaiHarian').value) || 0;
		const uts = parseFloat(document.getElementById('nilaiUTS').value) || 0;
		const uas = parseFloat(document.getElementById('nilaiUAS').value) || 0;

		const nilaiAkhir = (harian * 0.3) + (uts * 0.3) + (uas * 0.4);
		document.getElementById('nilaiAkhirDisplay').textContent = nilaiAkhir.toFixed(1);
	}

	// Fungsi untuk membuka modal nilai
	function openModal(action, idNilai = null) {
		const modal = document.getElementById('nilaiModal');
		const modalTitle = document.getElementById('modalNilaiTitle');
		modal.setAttribute('data-action', action);
		modal.setAttribute('data-id', idNilai ?? '');

		if (action === 'add') {
			modalTitle.textContent = 'Tambah Nilai Baru';
			document.getElementById('santriSelect').value = 'Pilih Santri';
			document.getElementById('mapelSelect').value = 'Pilih Mata Pelajaran';
			document.getElementById('semesterSelect').value = '1 (Ganjil)';
			document.getElementById('tahunSelect').value = '2023/2024';
			document.getElementById('nilaiHarian').value = '';
			document.getElementById('nilaiUTS').value = '';
			document.getElementById('nilaiUAS').value = '';
			document.getElementById('nilaiAkhirDisplay').textContent = '0.0';
			document.getElementById('guruSelect').value = 'Pilih Guru';
		} else if (action === 'edit' && idNilai) {
			modalTitle.textContent = 'Edit Data Nilai';
			fetch(`<?= base_url('nilai/get/') ?>${idNilai}`)
				.then(response => response.json())
				.then(res => {
					const data = res.data;
					document.getElementById('santriSelect').value = data.id_santri;
					document.getElementById('mapelSelect').value = data.mata_pelajaran;
					document.getElementById('semesterSelect').value = data.semester;
					document.getElementById('tahunSelect').value = data.tahun_ajaran;
					document.getElementById('nilaiHarian').value = data.nilai_harian;
					document.getElementById('nilaiUTS').value = data.nilai_uts;
					document.getElementById('nilaiUAS').value = data.nilai_uas;
					document.getElementById('guruSelect').value = data.id_guru;
					calculateNilaiAkhir();
				})
				.catch(error => {
					console.error('Gagal mengambil data nilai:', error);
				});
		}
		modal.classList.remove('hidden');
		modal.classList.add('block');
	}

	// Fungsi untuk menutup modal nilai
	function closeNilaiModal() {
		const modal = document.getElementById('nilaiModal');
		modal.classList.remove('block');
		modal.classList.add('hidden');
	}

	// Fungsi untuk menyimpan nilai
	function saveNilai() {
		const modal = document.getElementById('nilaiModal');
		const action = modal.getAttribute('data-action');
		const idNilai = modal.getAttribute('data-id');

		const data = {
			id_santri: document.getElementById('santriSelect').value,
			mata_pelajaran: document.getElementById('mapelSelect').value,
			semester: document.getElementById('semesterSelect').value,
			tahun_ajaran: document.getElementById('tahunSelect').value,
			nilai_harian: parseFloat(document.getElementById('nilaiHarian').value) || 0,
			nilai_uts: parseFloat(document.getElementById('nilaiUTS').value) || 0,
			nilai_uas: parseFloat(document.getElementById('nilaiUAS').value) || 0,
			id_guru: document.getElementById('guruSelect').value
		};
		data.nilai_akhir = ((data.nilai_harian * 0.3) + (data.nilai_uts * 0.3) + (data.nilai_uas * 0.4)).toFixed(2);

		const url = action === 'edit'
			? `<?= base_url('nilai/edit/') ?>${idNilai}`
			: `<?= base_url('nilai/tambah') ?>`;

		fetch(url, {
			method: 'POST',
			headers: { 'Content-Type': 'application/json' },
			body: JSON.stringify(data)
		})
			.then(res => res.json())
			.then(res => {
				if (res.success) {
					Swal.fire('Berhasil', res.message, 'success').then(() => location.reload());
				} else {
					Swal.fire('Gagal', res.message, 'error');
				}
			})
			.catch(error => {
				console.error(error);
				Swal.fire('Error', 'Terjadi kesalahan saat menyimpan data.', 'error');
			});
	}

	function hapusNilai(id) {
		Swal.fire({
			title: 'Yakin ingin menghapus?',
			text: 'Data nilai ini akan dihapus permanen.',
			icon: 'warning',
			showCancelButton: true,
			confirmButtonText: 'Ya, hapus',
			cancelButtonText: 'Batal'
		}).then((result) => {
			if (result.isConfirmed) {
				fetch(`<?= base_url('nilai/hapus/') ?>${id}`, {
					method: 'DELETE',
				})
					.then(res => res.json())
					.then(res => {
						if (res.success) {
							Swal.fire('Berhasil', res.message, 'success').then(() => location.reload());
						} else {
							Swal.fire('Gagal', res.message, 'error');
						}
					});
			}
		});
	}

	// Event listener untuk menghitung nilai otomatis
	document.getElementById('nilaiHarian').addEventListener('input', calculateNilaiAkhir);
	document.getElementById('nilaiUTS').addEventListener('input', calculateNilaiAkhir);
	document.getElementById('nilaiUAS').addEventListener('input', calculateNilaiAkhir);

	// Tutup modal saat klik di luar modal
	window.addEventListener('click', function (event) {
		const modal = document.getElementById('nilaiModal');
		if (event.target === modal) {
			closeNilaiModal();
		}
	});
</script>