<!-- Header dan Tombol Tambah -->
<div class="flex justify-between items-center mb-6">
	<h2 class="text-2xl font-semibold">Manajemen Absensi</h2>
	<?php if ($this->session->userdata('role') == 'admin'): ?>
		<button onclick="openModal('add')"
			class="bg-primary hover:bg-secondary text-white px-4 py-2 rounded flex items-center">
			<i class="fas fa-plus mr-2"></i> Tambah Absensi
		</button>
	<?php endif; ?>
</div>

<!-- Filter dan Search -->
<form method="GET" action="<?= base_url('absensi') ?>">
	<div class="bg-white p-4 rounded-lg shadow mb-6">
		<div class="grid grid-cols-1 md:grid-cols-4 gap-4">
			<div>
				<label class="block text-sm font-medium text-gray-700 mb-1">Cari Santri</label>
				<input type="text" name="search" value="<?= $this->input->get('search') ?>"
					class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-1 focus:ring-primary">
			</div>
			<div>
				<label class="block text-sm font-medium text-gray-700 mb-1">Tanggal</label>
				<input type="date" name="tanggal" value="<?= $this->input->get('tanggal') ?>"
					class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-1 focus:ring-primary">
			</div>
			<div>
				<label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
				<select name="status"
					class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-1 focus:ring-primary">
					<option value="">Semua Status</option>
					<option <?= $this->input->get('status') == 'Hadir' ? 'selected' : '' ?>>Hadir</option>
					<option <?= $this->input->get('status') == 'Izin' ? 'selected' : '' ?>>Izin</option>
					<option <?= $this->input->get('status') == 'Sakit' ? 'selected' : '' ?>>Sakit</option>
					<option <?= $this->input->get('status') == 'Alpa' ? 'selected' : '' ?>>Alpa</option>
				</select>
			</div>
			<div class="flex items-end space-x-2">
				<button type="submit"
					class="bg-primary hover:bg-secondary text-white px-4 py-2 rounded flex items-center">
					<i class="fas fa-filter mr-2"></i> Filter
				</button>
				<a href="<?= base_url('absensi') ?>"
					class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded flex items-center">
					<i class="fas fa-redo mr-2"></i> Reset
				</a>
			</div>
		</div>
	</div>
</form>

<!-- Tabel Data Absensi -->
<div class="bg-white rounded-lg shadow overflow-hidden">
	<div class="overflow-x-auto">
		<table class="min-w-full divide-y divide-gray-200">
			<thead class="bg-gray-50">
				<tr>
					<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
						Nama Santri</th>
					<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
						Tanggal</th>
					<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
						Status</th>
					<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
						Keterangan</th>
					<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
						Guru</th>
					<?php if ($this->session->userdata('role') == 'admin'): ?>
						<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
							Aksi</th>
					<?php endif; ?>
				</tr>
			</thead>
			<tbody class="bg-white divide-y divide-gray-200" id="absensiTableBody">
				<?php foreach ($absensi as $abs): ?>
					<tr>
						<td class="px-6 py-4 whitespace-nowrap">
							<div class="flex items-center">
								<div class="flex-shrink-0 h-10 w-10">
									<img class="h-10 w-10 rounded-full"
										src="<?= base_url('uploads/santri/' . $abs->foto_santri) ?>" alt="">
								</div>
								<div class="ml-4">
									<div class="text-sm font-medium text-gray-900"><?= $abs->nama_santri ?></div>
									<div class="text-sm text-gray-500"><?= $abs->kelas ?></div>
								</div>
							</div>
						</td>
						<td class="px-6 py-4 whitespace-nowrap"><?= $abs->tanggal ?></td>
						<td class="px-6 py-4 whitespace-nowrap">
							<span
								class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs"><?= $abs->status ?></span>
						</td>
						<td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= $abs->keterangan ?? '-' ?>
						</td>
						<td class="px-6 py-4 whitespace-nowrap"><?= $abs->nama_guru ?></td>
						<?php if ($this->session->userdata('role') == 'admin'): ?>
							<td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
								<button onclick="openModal('edit', '<?= $abs->id_absensi ?>')"
									class="text-primary hover:text-secondary mr-3">
									<i class="fas fa-edit"></i> Edit
								</button>
								<button class="text-red-600 hover:text-red-900" onclick="hapusAbsensi(this)"
									data-id="<?= $abs->id_absensi ?>">
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

<!-- Modal Tambah/Edit Absensi -->
<div id="absensiModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
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
						<h3 id="modalAbsensiTitle" class="text-lg leading-6 font-medium text-gray-900 mb-4">
							Tambah Absensi Baru
						</h3>
						<div class="grid grid-cols-1 gap-4">
							<input type="hidden" id="idAbsensi">
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
								<label for="tanggalAbsensi"
									class="block text-sm font-medium text-gray-700">Tanggal</label>
								<input type="datetime-local" id="tanggalAbsensi"
									class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
							</div>

							<div>
								<label for="statusAbsensi"
									class="block text-sm font-medium text-gray-700">Status</label>
								<select id="statusAbsensi"
									class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
									<option>Hadir</option>
									<option>Izin</option>
									<option>Sakit</option>
									<option>Alpa</option>
								</select>
							</div>

							<div>
								<label for="keteranganAbsensi"
									class="block text-sm font-medium text-gray-700">Keterangan</label>
								<textarea id="keteranganAbsensi" rows="3"
									class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm"
									placeholder="Opsional"></textarea>
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
				<button type="button" onclick="saveAbsensi()"
					class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-primary text-base font-medium text-white hover:bg-secondary focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary sm:ml-3 sm:w-auto sm:text-sm">
					Simpan
				</button>
				<button type="button" onclick="closeAbsensiModal()"
					class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
					Batal
				</button>
			</div>
		</div>
	</div>
</div>

<script>
	function openModal(action, idAbsensi = null) {
		const modal = document.getElementById('absensiModal');
		const modalTitle = document.getElementById('modalAbsensiTitle');
		document.getElementById('idAbsensi').value = '';

		if (action === 'add') {
			modalTitle.textContent = 'Tambah Absensi Baru';
			document.getElementById('idAbsensi').value = '';
			document.getElementById('santriSelect').value = '';
			document.getElementById('tanggalAbsensi').value = '';
			document.getElementById('statusAbsensi').value = 'Hadir';
			document.getElementById('keteranganAbsensi').value = '';
			document.getElementById('guruSelect').value = '';
		} else if (action === 'edit' && idAbsensi) {
			modalTitle.textContent = 'Edit Data Absensi';
			document.getElementById('idAbsensi').value = idAbsensi;

			fetch(`<?= base_url('absensi/get/') ?>${idAbsensi}`)
				.then(response => response.json())
				.then(result => {
					const data = result.data;
					document.getElementById('santriSelect').value = data.id_santri;
					document.getElementById('tanggalAbsensi').value = data.tanggal;
					document.getElementById('statusAbsensi').value = data.status;
					document.getElementById('keteranganAbsensi').value = data.keterangan || '';
					document.getElementById('guruSelect').value = data.id_guru;
				})
				.catch(error => {
					console.error('Gagal mengambil data absensi:', error);
				});
		}

		modal.classList.remove('hidden');
		modal.classList.add('block');
	}

	function closeAbsensiModal() {
		const modal = document.getElementById('absensiModal');
		modal.classList.remove('block');
		modal.classList.add('hidden');
	}

	function saveAbsensi() {
		const idAbsensi = document.getElementById('idAbsensi').value;
		const santriId = document.getElementById('santriSelect').value;
		const tanggal = document.getElementById('tanggalAbsensi').value;
		const status = document.getElementById('statusAbsensi').value;
		const keterangan = document.getElementById('keteranganAbsensi').value;
		const guruId = document.getElementById('guruSelect').value;

		const data = {
			santri_id: santriId,
			tanggal: tanggal,
			status: status,
			keterangan: keterangan,
			guru_id: guruId
		};

		let url = '';
		if (idAbsensi) {
			url = `<?= base_url('absensi/edit/') ?>${idAbsensi}`;
		} else {
			url = `<?= base_url('absensi/tambah') ?>`;
		}

		fetch(url, {
			method: 'POST',
			headers: {
				'Content-Type': 'application/json',
			},
			body: JSON.stringify(data),
		})
			.then(response => response.json())
			.then(result => {
				if (result.success) {
					Swal.fire({
						icon: 'success',
						title: 'Berhasil!',
						text: result.message || 'Data absensi berhasil disimpan',
						timer: 2000,
						showConfirmButton: false
					}).then(() => {
						closeAbsensiModal();
						location.reload();
					});
				} else {
					Swal.fire({
						icon: 'error',
						title: 'Gagal!',
						text: result.message || 'Gagal menyimpan data absensi',
					});
				}
			})
			.catch(error => {
				console.error('Error:', error);
				Swal.fire({
					icon: 'error',
					title: 'Oops...',
					text: 'Terjadi kesalahan saat menyimpan data.',
				});
			});
	}

	function hapusAbsensi(button) {
		const id = button.getAttribute('data-id');

		Swal.fire({
			title: 'Yakin ingin menghapus?',
			text: "Data absensi akan dihapus permanen!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#d33',
			cancelButtonColor: '#3085d6',
			confirmButtonText: 'Ya, hapus!',
			cancelButtonText: 'Batal'
		}).then((result) => {
			if (result.isConfirmed) {
				fetch(`<?= base_url('absensi/hapus/') ?>${id}`, {
					method: 'DELETE',
				})
					.then(response => response.json())
					.then(data => {
						if (data.success) {
							Swal.fire('Berhasil!', data.message, 'success').then(() => {
								location.reload();
							});
						} else {
							Swal.fire('Gagal!', data.message, 'error');
						}
					})
					.catch(error => {
						console.error('Gagal menghapus:', error);
						Swal.fire('Gagal!', 'Terjadi kesalahan saat menghapus.', 'error');
					});
			}
		});
	}

	window.addEventListener('click', function (event) {
		const modal = document.getElementById('absensiModal');
		if (event.target === modal) {
			closeAbsensiModal();
		}
	});
</script>