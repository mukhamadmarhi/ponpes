<!-- Header dan Tombol Tambah -->
<div class="flex justify-between items-center mb-6">
	<h2 class="text-2xl font-semibold">Manajemen Pengguna</h2>
	<button onclick="openModal('add')"
		class="bg-primary hover:bg-secondary text-white px-4 py-2 rounded flex items-center">
		<i class="fas fa-plus mr-2"></i> Tambah Pengguna
	</button>
</div>

<!-- Filter dan Search -->
<form method="get">
	<div class="bg-white p-4 rounded-lg shadow mb-6">
		<div class="grid grid-cols-1 md:grid-cols-4 gap-4">
			<div>
				<label class="block text-sm font-medium text-gray-700 mb-1">Cari Username</label>
				<input type="text" name="search" value="<?= $this->input->get('search') ?>"
					class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-1 focus:ring-primary">
			</div>
			<div>
				<label class="block text-sm font-medium text-gray-700 mb-1">Role</label>
				<select name="role"
					class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-1 focus:ring-primary">
					<option value="">Semua Role</option>
					<option value="admin" <?= $this->input->get('role') == 'admin' ? 'selected' : '' ?>>Admin</option>
					<option value="guru" <?= $this->input->get('role') == 'guru' ? 'selected' : '' ?>>Guru</option>
					<option value="santri" <?= $this->input->get('role') == 'santri' ? 'selected' : '' ?>>Santri
					</option>
				</select>
			</div>
			<div>
				<label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
				<select name="status"
					class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-1 focus:ring-primary">
					<option value="">Semua Status</option>
					<option value="aktif" <?= $this->input->get('status') == 'aktif' ? 'selected' : '' ?>>Aktif
					</option>
					<option value="nonaktif" <?= $this->input->get('status') == 'nonaktif' ? 'selected' : '' ?>>
						Nonaktif</option>
				</select>
			</div>
			<div class="flex items-end space-x-2">
				<button type="submit"
					class="bg-primary hover:bg-secondary text-white px-4 py-2 rounded flex items-center">
					<i class="fas fa-filter mr-2"></i> Filter
				</button>
				<a href="<?= base_url('user') ?>"
					class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded flex items-center">
					<i class="fas fa-redo mr-2"></i> Reset
				</a>
			</div>
		</div>
	</div>
</form>

<!-- Tabel Data Pengguna -->
<div class="bg-white rounded-lg shadow overflow-hidden">
	<div class="overflow-x-auto">
		<table class="min-w-full divide-y divide-gray-200">
			<thead class="bg-gray-50">
				<tr>
					<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
						Username</th>
					<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
						Role</th>
					<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
						Terkait Dengan</th>
					<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
						Last Login</th>
					<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
						Status</th>
					<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
						Aksi</th>
				</tr>
			</thead>
			<tbody class="bg-white divide-y divide-gray-200" id="userTableBody">
				<?php foreach ($user as $u): ?>
					<tr>
						<td class="px-6 py-4 whitespace-nowrap"><?= $u->username ?></td>
						<td class="px-6 py-4 whitespace-nowrap">
							<span
								class="px-2 py-1 bg-purple-100 text-purple-800 rounded-full text-xs capitalize"><?= $u->role ?></span>
						</td>
						<td class="px-6 py-4 whitespace-nowrap"><?= $u->nama_terkait ?></td>
						<td class="px-6 py-4 whitespace-nowrap"><?= $u->last_login ?></td>
						<td class="px-6 py-4 whitespace-nowrap">
							<span
								class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs"><?= $u->status ?></span>
						</td>
						<td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
							<button onclick="openModal('edit', '<?= $u->id_user ?>')"
								class="text-blue-600 hover:underline">
								<i class="fas fa-edit"></i> Edit
							</button>
							<button onclick="deleteUser('<?= $u->id_user ?>')" class="text-red-600 hover:underline">
								<i class="fas fa-trash"></i> Hapus
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

<!-- Modal Tambah/Edit Pengguna -->
<div id="userModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
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
						<h3 id="modalUserTitle" class="text-lg leading-6 font-medium text-gray-900 mb-4">
							Tambah Pengguna Baru
						</h3>
						<div class="grid grid-cols-1 gap-4">
							<div>
								<label for="usernameInput"
									class="block text-sm font-medium text-gray-700">Username</label>
								<input type="text" id="usernameInput"
									class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
							</div>

							<div id="passwordField">
								<label for="passwordInput"
									class="block text-sm font-medium text-gray-700">Password</label>
								<div class="relative">
									<input type="password" id="passwordInput"
										class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
									<button onclick="togglePasswordVisibility()"
										class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5">
										<i class="fas fa-eye text-gray-500"></i>
									</button>
								</div>
							</div>

							<div>
								<label for="roleSelect"
									class="block text-sm font-medium text-gray-700">Role</label>
								<select id="roleSelect" onchange="toggleRelatedField()"
									class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
									<option value="">Pilih Role</option>
									<option value="admin">Admin</option>
									<option value="guru">Guru</option>
									<option value="santri">Santri</option>
								</select>
							</div>

							<div id="relatedField" class="hidden">
								<label for="relatedSelect"
									class="block text-sm font-medium text-gray-700">Terkait Dengan</label>
								<select id="relatedSelect"
									class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
									<option value="">Pilih Data Terkait</option>
									<!-- Options will be populated based on role selection -->
								</select>
							</div>

							<div>
								<label for="statusSelect"
									class="block text-sm font-medium text-gray-700">Status</label>
								<select id="statusSelect"
									class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
									<option value="aktif">Aktif</option>
									<option value="nonaktif">Nonaktif</option>
								</select>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
				<button type="button" onclick="saveUser()"
					class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-primary text-base font-medium text-white hover:bg-secondary focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary sm:ml-3 sm:w-auto sm:text-sm">
					Simpan
				</button>
				<button type="button" onclick="closeUserModal()"
					class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
					Batal
				</button>
			</div>
		</div>
	</div>
</div>

<script>
	function toggleRelatedField(selectedId = '') {
		const roleSelect = document.getElementById('roleSelect');
		const relatedField = document.getElementById('relatedField');
		const relatedSelect = document.getElementById('relatedSelect');

		if (roleSelect.value === 'admin') {
			relatedField.classList.add('hidden');
		} else {
			relatedField.classList.remove('hidden');
			relatedSelect.innerHTML = '<option value="">Pilih Data Terkait</option>';

			let url = '';
			if (roleSelect.value === 'guru') {
				url = '<?= base_url('user/get_guru') ?>';
			} else if (roleSelect.value === 'santri') {
				url = '<?= base_url('user/get_santri') ?>';
			}

			if (url) {
				fetch(url)
					.then(res => res.json())
					.then(data => {
						data.forEach(item => {
							const option = document.createElement('option');
							option.value = item.id;
							option.textContent = item.nama;
							relatedSelect.appendChild(option);
						});

						if (selectedId) relatedSelect.value = selectedId;
					});
			}
		}
	}

	// Fungsi untuk toggle password visibility
	function togglePasswordVisibility() {
		const passwordInput = document.getElementById('passwordInput');
		const toggleButton = document.querySelector('#passwordField button i');

		if (passwordInput.type === 'password') {
			passwordInput.type = 'text';
			toggleButton.classList.remove('fa-eye');
			toggleButton.classList.add('fa-eye-slash');
		} else {
			passwordInput.type = 'password';
			toggleButton.classList.remove('fa-eye-slash');
			toggleButton.classList.add('fa-eye');
		}
	}

	// Fungsi untuk membuka modal user
	let selectedUserId = null;

	function openModal(action, idUser = null) {
		const modal = document.getElementById('userModal');
		const modalTitle = document.getElementById('modalUserTitle');
		const passwordField = document.getElementById('passwordField');

		if (action === 'add') {
			selectedUserId = null;
			modalTitle.textContent = 'Tambah Pengguna Baru';
			passwordField.classList.remove('hidden');
			document.getElementById('usernameInput').value = '';
			document.getElementById('passwordInput').value = '';
			document.getElementById('roleSelect').value = '';
			document.getElementById('relatedSelect').innerHTML = '<option value="">Pilih Data Terkait</option>';
			document.getElementById('relatedField').classList.add('hidden');
			document.getElementById('statusSelect').value = 'Aktif';
		} else if (action === 'edit') {
			selectedUserId = idUser;
			modalTitle.textContent = 'Edit Data Pengguna';
			passwordField.classList.add('hidden');

			fetch(`<?= base_url('user/get/') ?>${idUser}`)
				.then(res => res.json())
				.then(user => {
					document.getElementById('usernameInput').value = user.username;
					document.getElementById('roleSelect').value = user.role;
					document.getElementById('statusSelect').value = user.status;

					toggleRelatedField(user.id_related);
				});
		}

		modal.classList.remove('hidden');
		modal.classList.add('block');
	}

	// Fungsi untuk menutup modal user
	function closeUserModal() {
		const modal = document.getElementById('userModal');
		modal.classList.remove('block');
		modal.classList.add('hidden');
	}

	// Fungsi untuk menyimpan user
	function saveUser() {
		const username = document.getElementById('usernameInput').value;
		const password = document.getElementById('passwordInput').value;
		const role = document.getElementById('roleSelect').value;
		const id_related = document.getElementById('relatedSelect').value;
		const status = document.getElementById('statusSelect').value;

		const data = {
			username, role, id_related, status
		};

		if (!selectedUserId) {
			data.password = password;
			fetch('<?= base_url('user/tambah') ?>', {
				method: 'POST',
				headers: { 'Content-Type': 'application/json' },
				body: JSON.stringify(data)
			}).then(res => res.json()).then(res => {
				Swal.fire('Berhasil!', 'Data pengguna ditambahkan.', 'success').then(() => location.reload());
			});
		} else {
			fetch(`<?= base_url('user/update/') ?>${selectedUserId}`, {
				method: 'PUT',
				headers: { 'Content-Type': 'application/json' },
				body: JSON.stringify(data)
			}).then(res => res.json()).then(res => {
				Swal.fire('Berhasil!', 'Data pengguna diperbarui.', 'success').then(() => location.reload());
			});
		}
	}

	function deleteUser(id) {
		Swal.fire({
			title: 'Yakin hapus?',
			text: 'Data tidak bisa dikembalikan',
			icon: 'warning',
			showCancelButton: true,
			confirmButtonText: 'Hapus'
		}).then(result => {
			if (result.isConfirmed) {
				fetch(`<?= base_url('user/delete/') ?>${id}`, {
					method: 'DELETE'
				}).then(res => res.json()).then(res => {
					Swal.fire('Dihapus!', 'Pengguna berhasil dihapus.', 'success').then(() => location.reload());
				});
			}
		});
	}

	window.addEventListener('click', function (event) {
		const modal = document.getElementById('userModal');
		if (event.target === modal) {
			closeUserModal();
		}
	});
</script>