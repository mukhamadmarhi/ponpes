<!-- Header dan Tombol Tambah -->
<div class="flex justify-between items-center mb-6">
	<h2 class="text-2xl font-semibold">Manajemen Guru</h2>
	<button onclick="openModal('add')"
		class="bg-primary hover:bg-secondary text-white px-4 py-2 rounded flex items-center">
		<i class="fas fa-plus mr-2"></i> Tambah Guru
	</button>
</div>

<!-- Filter dan Search -->
<form method="get" action="" class="bg-white p-4 rounded-lg shadow mb-6">
	<div class="grid grid-cols-1 md:grid-cols-4 gap-4">
		<div>
			<label class="block text-sm font-medium text-gray-700 mb-1">Cari Nama/NIP</label>
			<input type="text" name="keyword" value="<?= $this->input->get('keyword') ?>"
				class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-1 focus:ring-primary">
		</div>
		<div>
			<label class="block text-sm font-medium text-gray-700 mb-1">Bidang Pengajaran</label>
			<select name="bidang"
				class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-1 focus:ring-primary">
				<option value="">Semua Bidang</option>
				<?php
				$daftar_bidang = [
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

				foreach ($daftar_bidang as $b) {
					$selected = ($this->input->get('bidang') == $b) ? 'selected' : '';
					echo "<option $selected>$b</option>";
				}
				?>
			</select>
		</div>
		<div>
			<label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
			<select name="status"
				class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-1 focus:ring-primary">
				<option value="">Semua Status</option>
				<option <?= $this->input->get('status') == 'Aktif' ? 'selected' : '' ?>>Aktif</option>
				<option <?= $this->input->get('status') == 'Non-Aktif' ? 'selected' : '' ?>>Non-Aktif</option>
			</select>
		</div>
		<div class="flex items-end space-x-2">
			<button type="submit"
				class="bg-primary hover:bg-secondary text-white px-4 py-2 rounded flex items-center">
				<i class="fas fa-filter mr-2"></i> Filter
			</button>
			<a href="<?= base_url('admin/guru') ?>"
				class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded flex items-center">
				<i class="fas fa-redo mr-2"></i> Reset
			</a>
		</div>
	</div>
</form>

<!-- Tabel Data Guru -->
<div class="bg-white rounded-lg shadow overflow-hidden">
	<div class="overflow-x-auto">
		<table class="min-w-full divide-y divide-gray-200">
			<thead class="bg-gray-50">
				<tr>
					<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
						NIP</th>
					<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
						Nama Guru</th>
					<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
						Bidang</th>
					<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
						Status</th>
					<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
						Aksi</th>
				</tr>
			</thead>
			<tbody class="bg-white divide-y divide-gray-200" id="guruTableBody">
				<?php foreach ($guru as $g): ?>
					<tr>
						<td class="px-6 py-4 whitespace-nowrap"><?= $g->nip ?></td>
						<td class="px-6 py-4 whitespace-nowrap">
							<div class="flex items-center">
								<div class="flex-shrink-0 h-10 w-10">
									<img class="h-10 w-10 rounded-full"
										src="<?= base_url('uploads/guru/' . $g->foto) ?>" alt="">
								</div>
								<div class="ml-4">
									<div class="text-sm font-medium text-gray-900"><?= $g->nama ?></div>
									<div class="text-sm text-gray-500"><?= $g->email ?></div>
								</div>
							</div>
						</td>
						<td class="px-6 py-4 whitespace-nowrap"><?= $g->bidang_pengajaran ?></td>
						<td class="px-6 py-4 whitespace-nowrap">
							<span
								class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs"><?= $g->status ?></span>
						</td>
						<td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
							<button onclick="openModal('edit', '<?= $g->nip ?>')"
								class="text-primary hover:text-secondary mr-3">
								<i class="fas fa-edit"></i> Edit
							</button>
							<button class="text-red-600 hover:text-red-900 btn-hapus-guru" data-nip="<?= $g->nip ?>">
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

<!-- Modal Tambah/Edit Guru -->
<div id="guruModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
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
						<h3 id="modalGuruTitle" class="text-lg leading-6 font-medium text-gray-900 mb-4">
							Tambah Guru Baru
						</h3>
						<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
							<div class="col-span-2">
								<label class="block text-sm font-medium text-gray-700">Foto</label>
								<div class="mt-1 flex items-center">
									<span
										class="inline-block h-12 w-12 rounded-full overflow-hidden bg-gray-100">
										<img id="previewFotoGuru" src="https://via.placeholder.com/48" alt=""
											class="h-full w-full">
									</span>
									<input type="file" id="fotoGuru" class="ml-4 hidden" accept="image/*">
									<button onclick="document.getElementById('fotoGuru').click()" type="button"
										class="ml-5 bg-white py-1 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
										Pilih
									</button>
								</div>
							</div>

							<div>
								<label for="nip" class="block text-sm font-medium text-gray-700">NIP</label>
								<input type="text" id="nip"
									class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
							</div>

							<div>
								<label for="namaGuru" class="block text-sm font-medium text-gray-700">Nama
									Lengkap</label>
								<input type="text" id="namaGuru"
									class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
							</div>

							<div>
								<label for="bidang" class="block text-sm font-medium text-gray-700">Bidang
									Pengajaran</label>
								<select id="bidang"
									class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
									<?php
									$mapelList = ['Nahwu', 'Sharaf', 'Fiqih', 'Tauhid', 'Tasawuf', 'Hadist', "Qiro'ah", 'Tarikh', 'Tafsir', 'Khitobah'];
									foreach ($mapelList as $mapel) {
										$selected = ($this->input->get('bidang') === $mapel) ? 'selected' : '';
										echo "<option value=\"$mapel\" $selected>$mapel</option>";
									}
									?>
								</select>
							</div>

							<div>
								<label for="statusGuru"
									class="block text-sm font-medium text-gray-700">Status</label>
								<select id="statusGuru"
									class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
									<option>Aktif</option>
									<option>Non-Aktif</option>
								</select>
							</div>

							<div class="col-span-2">
								<label for="alamatGuru"
									class="block text-sm font-medium text-gray-700">Alamat</label>
								<textarea id="alamatGuru" rows="3"
									class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm"></textarea>
							</div>

							<div>
								<label for="teleponGuru"
									class="block text-sm font-medium text-gray-700">Telepon</label>
								<input type="text" id="teleponGuru"
									class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
							</div>

							<div>
								<label for="emailGuru"
									class="block text-sm font-medium text-gray-700">Email</label>
								<input type="email" id="emailGuru"
									class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
				<button type="button"
					class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-primary text-base font-medium text-white hover:bg-secondary focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary sm:ml-3 sm:w-auto sm:text-sm">
					Simpan
				</button>
				<button type="button" onclick="closeGuruModal()"
					class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
					Batal
				</button>
			</div>
		</div>
	</div>
</div>
</main>

<script>
	function openModal(action, nip = null) {
		const modal = document.getElementById('guruModal');
		const modalTitle = document.getElementById('modalGuruTitle');
		const nipField = document.getElementById('nip');

		nipField.value = '';
		document.getElementById('namaGuru').value = '';
		document.getElementById('bidang').value = 'Al-Quran';
		document.getElementById('statusGuru').value = 'Aktif';
		document.getElementById('alamatGuru').value = '';
		document.getElementById('teleponGuru').value = '';
		document.getElementById('emailGuru').value = '';
		document.getElementById('fotoGuru').value = '';
		document.getElementById('previewFotoGuru').src = 'https://via.placeholder.com/48';

		if (action === 'edit' && nip) {
			fetch(`<?= base_url('guru/get/') ?>${nip}`)
				.then(res => res.json())
				.then(data => {
					nipField.value = data.nip;
					nipField.readOnly = true;
					document.getElementById('namaGuru').value = data.nama;
					document.getElementById('bidang').value = data.bidang;
					document.getElementById('statusGuru').value = data.status;
					document.getElementById('alamatGuru').value = data.alamat;
					document.getElementById('teleponGuru').value = data.telepon;
					document.getElementById('emailGuru').value = data.email;
					if (data.foto) {
						document.getElementById('previewFotoGuru').src = `<?= base_url('uploads/guru/') ?>${data.foto}`;
					}
				});
			modalTitle.textContent = 'Edit Data Guru';
		} else {
			nipField.readOnly = false;
			modalTitle.textContent = 'Tambah Guru Baru';
		}

		modal.classList.remove('hidden');
		modal.classList.add('block');
	}

	document.querySelector('#guruModal button[type="button"].bg-primary').addEventListener('click', function () {
		const formData = new FormData();
		const nip = document.getElementById('nip').value;
		const nama = document.getElementById('namaGuru').value;
		const bidang = document.getElementById('bidang').value;
		const status = document.getElementById('statusGuru').value;
		const alamat = document.getElementById('alamatGuru').value;
		const telepon = document.getElementById('teleponGuru').value;
		const email = document.getElementById('emailGuru').value;
		const foto = document.getElementById('fotoGuru').files[0];

		formData.append('nip', nip);
		formData.append('nama', nama);
		formData.append('bidang', bidang);
		formData.append('status', status);
		formData.append('alamat', alamat);
		formData.append('telepon', telepon);
		formData.append('email', email);
		if (foto) {
			formData.append('foto', foto);
		}

		const isEdit = document.getElementById('nip').readOnly;

		const url = isEdit
			? `<?= base_url('guru/update/') ?>${nip}`
			: `<?= base_url('guru/tambah') ?>`;

		fetch(url, {
			method: 'POST',
			body: formData
		})
			.then(res => res.json())
			.then(res => {
				if (res.success) {
					Swal.fire({
						icon: 'success',
						title: isEdit ? 'Data guru diperbarui!' : 'Guru berhasil ditambahkan!',
						showConfirmButton: false,
						timer: 1500
					});
					closeGuruModal();
					setTimeout(() => location.reload(), 1600);
				} else {
					Swal.fire({
						icon: 'error',
						title: 'Gagal',
						text: res.message || 'Terjadi kesalahan saat menyimpan data.'
					});
				}
			})
			.catch(err => {
				console.error(err);
				Swal.fire({
					icon: 'error',
					title: 'Oops...',
					text: 'Terjadi kesalahan pada server.'
				});
			});
	});

	function closeGuruModal() {
		const modal = document.getElementById('guruModal');
		modal.classList.remove('block');
		modal.classList.add('hidden');
	}

	document.querySelectorAll('.btn-hapus-guru').forEach(button => {
		button.addEventListener('click', function () {
			const nip = this.getAttribute('data-nip');

			Swal.fire({
				title: 'Yakin hapus?',
				text: `Data guru dengan NIP ${nip} akan dihapus!`,
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#d33',
				cancelButtonColor: '#3085d6',
				confirmButtonText: 'Ya, hapus',
				cancelButtonText: 'Batal'
			}).then((result) => {
				if (result.isConfirmed) {
					fetch(`<?= base_url('guru/delete/') ?>${nip}`, {
						method: 'POST'
					})
						.then(res => res.json())
						.then(res => {
							if (res.success) {
								Swal.fire('Berhasil!', res.message, 'success')
									.then(() => location.reload());
							} else {
								Swal.fire('Gagal!', res.message, 'error');
							}
						})
						.catch(err => {
							console.error(err);
							Swal.fire('Error!', 'Terjadi kesalahan.', 'error');
						});
				}
			});
		});
	});

	document.getElementById('fotoGuru').addEventListener('change', function (e) {
		const reader = new FileReader();
		reader.onload = function (event) {
			document.getElementById('previewFotoGuru').src = event.target.result;
		};
		reader.readAsDataURL(e.target.files[0]);
	});

	window.addEventListener('click', function (event) {
		const modal = document.getElementById('guruModal');
		if (event.target === modal) {
			closeGuruModal();
		}
	});
</script>