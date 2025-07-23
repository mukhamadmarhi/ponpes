<div class="flex justify-between items-center mb-6">
	<h2 class="text-2xl font-semibold">Manajemen Santri</h2>
	<button onclick="openModal('add')"
		class="bg-primary hover:bg-secondary text-white px-4 py-2 rounded flex items-center">
		<i class="fas fa-plus mr-2"></i> Tambah Santri
	</button>
</div>

<form method="get" action="" class="bg-white p-4 rounded-lg shadow mb-6">
	<div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
		<div>
			<label class="block text-sm font-medium text-gray-700 mb-1">Cari Nama/NIS</label>
			<input type="text" name="keyword" value="<?= $this->input->get('keyword') ?>"
				class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-1 focus:ring-primary">
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
		<div>
			<label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
			<select name="status"
				class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-1 focus:ring-primary">
				<option value="">Semua Status</option>
				<?php foreach (['Aktif', 'Non-Aktif', 'Alumni'] as $status): ?>
					<option value="<?= $status ?>" <?= ($this->input->get('status') == $status ? 'selected' : '') ?>>
						<?= $status ?>
					</option>
				<?php endforeach; ?>
			</select>
		</div>
		<div class="flex items-end space-x-2">
			<button type="submit"
				class="bg-primary hover:bg-secondary text-white px-4 py-2 rounded flex items-center">
				<i class="fas fa-filter mr-2"></i> Filter
			</button>
			<a href="<?= base_url($user_role . '/santri') ?>"
				class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded flex items-center">
				<i class="fas fa-redo mr-2"></i> Reset
			</a>
		</div>
	</div>
</form>

<div class="bg-white rounded-lg shadow overflow-hidden">
	<div class="overflow-x-auto">
		<table class="min-w-full divide-y divide-gray-200">
			<thead class="bg-gray-50">
				<tr>
					<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIS
					</th>
					<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama
						Santri</th>
					<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
						Kelas</th>
					<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
						Status</th>
					<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi
					</th>
				</tr>
			</thead>
			<tbody class="bg-white divide-y divide-gray-200">
				<?php foreach ($santri as $s): ?>
					<tr>
						<td class="px-6 py-4 whitespace-nowrap"><?= $s->nis ?></td>
						<td class="px-6 py-4 whitespace-nowrap">
							<div class="flex items-center">
								<div class="flex-shrink-0 h-10 w-10">
									<img class="h-10 w-10 rounded-full"
										src="<?= base_url('uploads/santri/' . $s->foto) ?>" alt="">
								</div>
								<div class="ml-4">
									<div class="text-sm font-medium text-gray-900"><?= $s->nama ?></div>
									<div class="text-sm text-gray-500"><?= $s->email ?></div>
								</div>
							</div>
						</td>
						<td class="px-6 py-4 whitespace-nowrap"><?= $s->kelas ?></td>
						<td class="px-6 py-4 whitespace-nowrap">
							<span
								class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs"><?= $s->status ?></span>
						</td>
						<td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
							<button onclick="openModal('edit', '<?= $s->nis ?>')"
								class="text-primary hover:text-secondary mr-3">
								<i class="fas fa-edit"></i> Edit
							</button>
							<button onclick="hapusSantri(<?= $s->id_santri ?>)"
								class="text-red-600 hover:text-red-900">
								<i class="fas fa-trash-alt"></i> Hapus
							</button>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>

	<div class="flex items-center justify-between p-6">
		<?= $pagination ?>
	</div>
</div>

<div id="santriModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
	<div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
		<div class="fixed inset-0 transition-opacity" aria-hidden="true">
			<div class="absolute inset-0 bg-gray-500 opacity-75"></div>
		</div>
		<span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
		<form action="<?= base_url('santri/tambah') ?>" method="post" enctype="multipart/form-data"
			class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
			<input type="hidden" id="mode" name="mode">
			<input type="hidden" id="id_santri" name="id_santri">
			<div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
				<div class="sm:flex sm:items-start">
					<div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
						<h3 id="modalTitle" class="text-lg leading-6 font-medium text-gray-900 mb-4"></h3>
						<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
							<div class="col-span-2">
								<label class="block text-sm font-medium text-gray-700">Foto</label>
								<div class="mt-1 flex items-center">
									<span
										class="inline-block h-12 w-12 rounded-full overflow-hidden bg-gray-100">
										<img id="previewFoto" src="https://via.placeholder.com/48" alt=""
											class="h-full w-full">
									</span>
									<input type="file" id="fotoSantri" name="foto" class="ml-4 hidden"
										accept="image/*">
									<button type="button"
										onclick="document.getElementById('fotoSantri').click()"
										class="ml-5 bg-white py-1 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
										Pilih
									</button>
								</div>
							</div>

							<div>
								<label for="nis" class="block text-sm font-medium text-gray-700">NIS</label>
								<input type="text" id="nis" name="nis"
									class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
							</div>

							<div>
								<label for="nama" class="block text-sm font-medium text-gray-700">Nama
									Lengkap</label>
								<input type="text" id="nama" name="nama"
									class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
							</div>

							<div>
								<label for="tempatLahir" class="block text-sm font-medium text-gray-700">Tempat
									Lahir</label>
								<input type="text" id="tempatLahir" name="tempatLahir"
									class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
							</div>

							<div>
								<label for="tanggalLahir"
									class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
								<input type="date" id="tanggalLahir" name="tanggalLahir"
									class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
							</div>

							<div>
								<label for="kelas" class="block text-sm font-medium text-gray-700">Kelas</label>
								<select id="kelas" name="kelas"
									class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
									<?php foreach (['1 PA', '1 PI', '2 PA', '2 PI', '3 PA', '3 PI'] as $kelas): ?>
										<option value="<?= $kelas ?>">
											<?= $kelas ?>
										</option>
									<?php endforeach; ?>
								</select>
							</div>

							<div>
								<label for="status"
									class="block text-sm font-medium text-gray-700">Status</label>
								<select id="status" name="status"
									class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
									<option>Aktif</option>
									<option>Non-Aktif</option>
									<option>Alumni</option>
								</select>
							</div>

							<div class="col-span-2">
								<label for="alamat"
									class="block text-sm font-medium text-gray-700">Alamat</label>
								<textarea id="alamat" name="alamat" rows="3"
									class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm"></textarea>
							</div>

							<div>
								<label for="namaWali" class="block text-sm font-medium text-gray-700">Nama
									Wali</label>
								<input type="text" id="namaWali" name="namaWali"
									class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
							</div>

							<div>
								<label for="telepon"
									class="block text-sm font-medium text-gray-700">Telepon</label>
								<input type="text" id="telepon" name="telepon"
									class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
							</div>

							<div>
								<label for="email" class="block text-sm font-medium text-gray-700">Email</label>
								<input type="email" id="email" name="email"
									class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
							</div>

							<div>
								<label for="tanggalMasuk"
									class="block text-sm font-medium text-gray-700">Tanggal Masuk</label>
								<input type="date" id="tanggalMasuk" name="tanggalMasuk"
									class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
				<button type="button" onclick="submitForm()"
					class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-primary text-base font-medium text-white hover:bg-secondary focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary sm:ml-3 sm:w-auto sm:text-sm">
					Simpan
				</button>
				<button type="button" onclick="closeModal()"
					class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
					Batal
				</button>
			</div>
		</form>
	</div>
</div>

<script>
	async function openModal(action, nis = null) {
		const modal = document.getElementById('santriModal');
		const modalTitle = document.getElementById('modalTitle');
		document.getElementById('mode').value = action;

		if (action === 'add') {
			modalTitle.textContent = 'Tambah Santri Baru';
			resetForm();
			document.getElementById('id_santri').value = '';
		} else if (action === 'edit' && nis) {
			modalTitle.textContent = 'Edit Data Santri';
			const data = await getSantriByNis(nis);

			if (data) {
				document.getElementById('id_santri').value = data.id_santri;
				document.getElementById('nis').value = data.nis;
				document.getElementById('nama').value = data.nama;
				document.getElementById('tempatLahir').value = data.tempat_lahir;
				document.getElementById('tanggalLahir').value = data.tanggal_lahir;
				document.getElementById('kelas').value = data.kelas;
				document.getElementById('status').value = data.status;
				document.getElementById('alamat').value = data.alamat;
				document.getElementById('namaWali').value = data.nama_wali;
				document.getElementById('telepon').value = data.telepon;
				document.getElementById('email').value = data.email;
				document.getElementById('tanggalMasuk').value = data.tanggal_masuk;
				document.getElementById('previewFoto').src = data.foto ? '<?= base_url('uploads/santri/') ?>' + data.foto : 'https://via.placeholder.com/48';
			} else {
				alert('Data santri tidak ditemukan!');
				return;
			}
		}

		modal.classList.remove('hidden');
		modal.classList.add('block');
	}

	async function submitForm() {
		const mode = document.getElementById('mode').value;
		const id = document.getElementById('id_santri').value;
		const formData = new FormData();

		formData.append('nis', document.getElementById('nis').value);
		formData.append('nama', document.getElementById('nama').value);
		formData.append('tempat_lahir', document.getElementById('tempatLahir').value);
		formData.append('tanggal_lahir', document.getElementById('tanggalLahir').value);
		formData.append('kelas', document.getElementById('kelas').value);
		formData.append('status', document.getElementById('status').value);
		formData.append('alamat', document.getElementById('alamat').value);
		formData.append('nama_wali', document.getElementById('namaWali').value);
		formData.append('telepon', document.getElementById('telepon').value);
		formData.append('email', document.getElementById('email').value);
		formData.append('tanggal_masuk', document.getElementById('tanggalMasuk').value);

		const fotoFile = document.getElementById('fotoSantri').files[0];
		if (fotoFile) formData.append('foto', fotoFile);

		let url = mode === 'add' ? "<?= base_url('santri/tambah') ?>" : "<?= base_url('santri/update/') ?>" + id;
		if (mode === 'edit') formData.append('id_santri', id);

		try {
			const response = await fetch(url, { method: 'POST', body: formData });
			const result = await response.json();

			if (result.success) {
				Swal.fire({
					icon: 'success',
					title: 'Berhasil!',
					text: result.message,
					confirmButtonColor: '#3085d6',
				}).then(() => {
					location.reload();
				});
			} else {
				Swal.fire({
					icon: 'error',
					title: 'Gagal!',
					text: result.message || 'Gagal menyimpan data',
					confirmButtonColor: '#d33',
				});
			}
		} catch (error) {
			console.error('Submit error:', error);
			Swal.fire({
				icon: 'error',
				title: 'Kesalahan!',
				text: 'Terjadi kesalahan saat menyimpan data',
				confirmButtonColor: '#d33',
			});
		}
	}

	function resetForm() {
		const fields = ['nis', 'nama', 'tempatLahir', 'tanggalLahir', 'alamat', 'namaWali', 'telepon', 'email', 'tanggalMasuk'];
		fields.forEach(field => document.getElementById(field).value = '');
		document.getElementById('kelas').value = '7A';
		document.getElementById('status').value = 'Aktif';
		document.getElementById('previewFoto').src = 'https://via.placeholder.com/48';
		document.getElementById('fotoSantri').value = '';
	}

	async function getSantriByNis(nis) {
		try {
			const response = await fetch(`<?= base_url('santri/get/') ?>${nis}`);
			if (!response.ok) throw new Error('Gagal mengambil data');
			return await response.json();
		} catch (error) {
			console.error('Fetch error:', error);
			return null;
		}
	}

	function hapusSantri(id) {
		Swal.fire({
			title: 'Yakin hapus data?',
			text: "Data yang dihapus tidak bisa dikembalikan!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#d33',
			cancelButtonColor: '#3085d6',
			confirmButtonText: 'Ya, hapus!'
		}).then((result) => {
			if (result.isConfirmed) {
				fetch(`<?= base_url('santri/delete/') ?>${id}`, { method: 'POST' })
					.then(res => res.json())
					.then(res => {
						if (res.success) {
							Swal.fire('Berhasil!', res.message, 'success').then(() => location.reload());
						} else {
							Swal.fire('Gagal!', res.message || 'Gagal menghapus data.', 'error');
						}
					})
					.catch(error => {
						console.error('Error:', error);
						Swal.fire('Error', 'Terjadi kesalahan saat menghapus data.', 'error');
					});
			}
		});
	}

	function closeModal() {
		document.getElementById('santriModal').classList.remove('block');
		document.getElementById('santriModal').classList.add('hidden');
	}

	document.getElementById('fotoSantri').addEventListener('change', function (e) {
		if (e.target.files[0]) {
			const reader = new FileReader();
			reader.onload = function (event) {
				document.getElementById('previewFoto').src = event.target.result;
			};
			reader.readAsDataURL(e.target.files[0]);
		}
	});

	window.addEventListener('click', function (event) {
		if (event.target === document.getElementById('santriModal')) {
			closeModal();
		}
	});
</script>