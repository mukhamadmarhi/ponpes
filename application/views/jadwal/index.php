<!-- Header dan Tombol Tambah -->
<div class="flex justify-between items-center mb-6">
	<h2 class="text-2xl font-semibold">Manajemen Jadwal</h2>
	<button onclick="openModal('add')"
		class="bg-primary hover:bg-secondary text-white px-4 py-2 rounded flex items-center">
		<i class="fas fa-plus mr-2"></i> Tambah Jadwal
	</button>
</div>

<!-- Filter dan Search -->
<form method="GET" class="bg-white p-4 rounded-lg shadow mb-6">
	<div class="grid grid-cols-1 md:grid-cols-4 gap-4">
		<div>
			<label class="block text-sm font-medium text-gray-700 mb-1">Cari Mata Pelajaran</label>
			<input type="text" name="mapel" value="<?= $this->input->get('mapel') ?>"
				class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-1 focus:ring-primary">
		</div>
		<div>
			<label class="block text-sm font-medium text-gray-700 mb-1">Hari</label>
			<select name="hari"
				class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-1 focus:ring-primary">
				<option value="">Semua Hari</option>
				<?php foreach (['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Ahad'] as $hari): ?>
					<option value="<?= $hari ?>" <?= $this->input->get('hari') == $hari ? 'selected' : '' ?>><?= $hari ?>
					</option>
				<?php endforeach ?>
			</select>
		</div>
		<div>
			<label class="block text-sm font-medium text-gray-700 mb-1">Kelas</label>
			<select name="kelas"
				class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-1 focus:ring-primary">
				<option value="">Semua Kelas</option>
				<?php foreach (['1 PA', '1 PI', '2 PA', '2 PI', '3 PA', '3 PI'] as $kelas): ?>
					<option value="<?= $kelas ?>" <?= ($this->input->get('kelas') == $kelas ? 'selected' : '') ?>>
						<?= $kelas ?>
					</option>
				<?php endforeach; ?>
			</select>
		</div>
		<div class="flex items-end space-x-2">
			<button type="submit"
				class="bg-primary hover:bg-secondary text-white px-4 py-2 rounded flex items-center">
				<i class="fas fa-filter mr-2"></i> Filter
			</button>
			<a href="<?= base_url('jadwal') ?>"
				class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded flex items-center">
				<i class="fas fa-redo mr-2"></i> Reset
			</a>
		</div>
	</div>
</form>

<!-- Tabel Data Jadwal -->
<div class="bg-white rounded-lg shadow overflow-hidden">
	<div class="overflow-x-auto">
		<table class="min-w-full divide-y divide-gray-200">
			<thead class="bg-gray-50">
				<tr>
					<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
						Hari</th>
					<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
						Waktu</th>
					<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
						Mata Pelajaran</th>
					<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
						Kelas</th>
					<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
						Guru</th>
					<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
						Aksi</th>
				</tr>
			</thead>
			<tbody class="bg-white divide-y divide-gray-200" id="jadwalTableBody">
				<?php foreach ($jadwal as $j): ?>
					<tr>
						<td class="px-6 py-4 whitespace-nowrap"><?= $j->hari ?></td>
						<td class="px-6 py-4 whitespace-nowrap"><?= $j->waktu_mulai ?> - <?= $j->waktu_selesai ?></td>
						<td class="px-6 py-4 whitespace-nowrap"><?= $j->mata_pelajaran ?></td>
						<td class="px-6 py-4 whitespace-nowrap">
							<span
								class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-xs"><?= $j->kelas ?></span>
						</td>
						<td class="px-6 py-4 whitespace-nowrap"><?= $j->nama_guru ?></td>
						<td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
							<button onclick="openModal('edit', '<?= $j->id_jadwal ?>')"
								class="text-primary hover:text-secondary mr-3">
								<i class="fas fa-edit"></i> Edit
							</button>
							<button onclick="hapusJadwal(<?= $j->id_jadwal ?>)"
								class="text-red-600 hover:text-red-900">
								<i class="fas fa-trash-alt"></i> Hapus
							</button>
						</td>
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

<!-- Modal Tambah/Edit Jadwal -->
<div id="jadwalModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
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
						<input type="hidden" id="jadwalId">
						<h3 id="modalJadwalTitle" class="text-lg leading-6 font-medium text-gray-900 mb-4">
							Tambah Jadwal Baru
						</h3>
						<div class="grid grid-cols-1 gap-4">
							<div>
								<label for="hariSelect"
									class="block text-sm font-medium text-gray-700">Hari</label>
								<select id="hariSelect"
									class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
									<option>Pilih Hari</option>
									<option>Senin</option>
									<option>Selasa</option>
									<option>Rabu</option>
									<option>Kamis</option>
									<option>Jumat</option>
									<option>Sabtu</option>
									<option>Ahad</option>
								</select>
							</div>

							<div class="grid grid-cols-2 gap-4">
								<div>
									<label for="waktuMulai"
										class="block text-sm font-medium text-gray-700">Waktu Mulai</label>
									<input type="time" id="waktuMulai"
										class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
								</div>
								<div>
									<label for="waktuSelesai"
										class="block text-sm font-medium text-gray-700">Waktu Selesai</label>
									<input type="time" id="waktuSelesai"
										class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
								</div>
							</div>

							<div>
								<label for="mapelSelect" class="block text-sm font-medium text-gray-700">Mata
									Pelajaran</label>
								<select id="mapelSelect"
									class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
									<option>Pilih Mata Pelajaran</option>
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
								<label for="kelasSelect"
									class="block text-sm font-medium text-gray-700">Kelas</label>
								<select id="kelasSelect"
									class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
									<?php foreach (['1 PA', '1 PI', '2 PA', '2 PI', '3 PA', '3 PI'] as $kelas): ?>
										<option value="<?= $kelas ?>" ?>
											<?= $kelas ?>
										</option>
									<?php endforeach; ?>
								</select>
							</div>

							<div>
								<label for="guruSelect"
									class="block text-sm font-medium text-gray-700">Guru</label>
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
				<button type="button" onclick="saveJadwal()"
					class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-primary text-base font-medium text-white hover:bg-secondary focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary sm:ml-3 sm:w-auto sm:text-sm">
					Simpan
				</button>
				<button type="button" onclick="closeJadwalModal()"
					class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
					Batal
				</button>
			</div>
		</div>
	</div>
</div>

<script>
	function openModal(action, idJadwal = null) {
		const modal = document.getElementById('jadwalModal');
		const modalTitle = document.getElementById('modalJadwalTitle');
		document.getElementById('jadwalId').value = '';

		if (action === 'add') {
			modalTitle.textContent = 'Tambah Jadwal Baru';
			document.getElementById('hariSelect').value = '';
			document.getElementById('waktuMulai').value = '';
			document.getElementById('waktuSelesai').value = '';
			document.getElementById('mapelSelect').value = '';
			document.getElementById('kelasSelect').value = '';
			document.getElementById('guruSelect').value = '';
		} else if (action === 'edit') {
			modalTitle.textContent = 'Edit Data Jadwal';
			fetch(`<?= base_url('jadwal/get/') ?>${idJadwal}`)
				.then(res => res.json())
				.then(res => {
					const data = res.data;
					document.getElementById('jadwalId').value = data.id_jadwal;
					document.getElementById('hariSelect').value = data.hari;
					document.getElementById('waktuMulai').value = data.waktu_mulai;
					document.getElementById('waktuSelesai').value = data.waktu_selesai;
					document.getElementById('mapelSelect').value = data.mata_pelajaran;
					document.getElementById('kelasSelect').value = data.kelas;
					document.getElementById('guruSelect').value = data.id_guru;
				});
		}

		modal.classList.remove('hidden');
		modal.classList.add('block');
	}

	// Fungsi untuk menutup modal jadwal
	function closeJadwalModal() {
		const modal = document.getElementById('jadwalModal');
		modal.classList.remove('block');
		modal.classList.add('hidden');
	}

	// Fungsi untuk menyimpan jadwal
	function saveJadwal() {
		const id = document.getElementById('jadwalId').value;
		const data = {
			hari: document.getElementById('hariSelect').value,
			waktu_mulai: document.getElementById('waktuMulai').value,
			waktu_selesai: document.getElementById('waktuSelesai').value,
			mata_pelajaran: document.getElementById('mapelSelect').value,
			kelas: document.getElementById('kelasSelect').value,
			id_guru: document.getElementById('guruSelect').value
		};

		const url = id
			? `<?= base_url('jadwal/update/') ?>${id}`
			: `<?= base_url('jadwal/tambah') ?>`;

		fetch(url, {
			method: 'POST',
			headers: { 'Content-Type': 'application/json' },
			body: JSON.stringify(data)
		})
			.then(res => res.json())
			.then(res => {
				if (res.success) {
					Swal.fire('Sukses', 'Data jadwal berhasil disimpan', 'success').then(() => location.reload());
				} else {
					Swal.fire('Gagal', res.message || 'Terjadi kesalahan', 'error');
				}
			});
	}

	function hapusJadwal(id) {
		Swal.fire({
			title: 'Yakin ingin menghapus?',
			text: 'Data tidak bisa dikembalikan!',
			icon: 'warning',
			showCancelButton: true,
			confirmButtonText: 'Ya, hapus!',
			cancelButtonText: 'Batal'
		}).then((result) => {
			if (result.isConfirmed) {
				fetch(`<?= base_url('jadwal/delete/') ?>${id}`, {
					method: 'DELETE'
				})
					.then(res => res.json())
					.then(res => {
						if (res.success) {
							Swal.fire('Terhapus!', 'Data berhasil dihapus.', 'success').then(() => {
								location.reload();
							});
						} else {
							Swal.fire('Gagal', res.message || 'Gagal menghapus data.', 'error');
						}
					});
			}
		});
	}

	// Tutup modal saat klik di luar modal
	window.addEventListener('click', function (event) {
		const modal = document.getElementById('jadwalModal');
		if (event.target === modal) {
			closeJadwalModal();
		}
	});
</script>