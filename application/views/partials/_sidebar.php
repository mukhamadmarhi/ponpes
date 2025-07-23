<?php
$segment = $this->uri->segment(2);
$user_role = $this->session->userdata('role'); // Asumsi role disimpan di session
?>

<div class="w-64 bg-primary text-white shadow-lg">
	<div class="p-4 border-b border-secondary flex items-center">
		<img src="<?= base_url('assets/logo.png') ?>" alt="Logo" class="rounded-full mr-3 w-12">
		<h1 class="text-xl font-bold">
			<span class="capitalize"><?= $user_role ?></span> Ponpes
		</h1>
	</div>
	<nav class="mt-6">
		<!-- Menu Dashboard untuk semua role -->
		<a href="<?= base_url($user_role . '/dashboard') ?>"
			class="px-4 py-3 flex items-center <?= ($segment == 'dashboard' ? 'bg-secondary' : 'hover:bg-secondary') ?>">
			<i class="fas fa-tachometer-alt mr-3"></i>
			<span class="font-medium">Dashboard</span>
		</a>

		<!-- Menu khusus Santri -->
		<?php if ($user_role == 'santri'): ?>
			<a href="<?= base_url($user_role . '/absensi') ?>"
				class="px-4 py-3 flex items-center <?= ($segment == 'absensi' ? 'bg-secondary' : 'hover:bg-secondary') ?>">
				<i class="fas fa-clipboard-check mr-3"></i>
				<span>Absensi Saya</span>
			</a>
			<a href="<?= base_url($user_role . '/nilai') ?>"
				class="px-4 py-3 flex items-center <?= ($segment == 'nilai' ? 'bg-secondary' : 'hover:bg-secondary') ?>">
				<i class="fas fa-book-open mr-3"></i>
				<span>Nilai Saya</span>
			</a>
		<?php endif; ?>

		<!-- Menu khusus Admin -->
		<?php if ($user_role == 'admin'): ?>
			<a href="<?= base_url($user_role . '/santri') ?>"
				class="px-4 py-3 flex items-center <?= ($segment == 'santri' ? 'bg-secondary' : 'hover:bg-secondary') ?>">
				<i class="fas fa-users mr-3"></i>
				<span>Santri</span>
			</a>
			<a href="<?= base_url($user_role . '/guru') ?>"
				class="px-4 py-3 flex items-center <?= ($segment == 'guru' ? 'bg-secondary' : 'hover:bg-secondary') ?>">
				<i class="fas fa-chalkboard-teacher mr-3"></i>
				<span>Guru</span>
			</a>
			<a href="<?= base_url($user_role . '/user') ?>"
				class="px-4 py-3 flex items-center <?= ($segment == 'user' ? 'bg-secondary' : 'hover:bg-secondary') ?>">
				<i class="fas fa-user-cog mr-3"></i>
				<span>Manajemen User</span>
			</a>
		<?php endif; ?>

		<!-- Menu untuk Admin dan Guru -->
		<?php if ($user_role == 'admin' || $user_role == 'guru'): ?>
			<a href="<?= base_url($user_role . '/absensi') ?>"
				class="px-4 py-3 flex items-center <?= ($segment == 'absensi' ? 'bg-secondary' : 'hover:bg-secondary') ?>">
				<i class="fas fa-clipboard-check mr-3"></i>
				<span>Absensi</span>
			</a>
			<a href="<?= base_url($user_role . '/nilai') ?>"
				class="px-4 py-3 flex items-center <?= ($segment == 'nilai' ? 'bg-secondary' : 'hover:bg-secondary') ?>">
				<i class="fas fa-book-open mr-3"></i>
				<span>Nilai</span>
			</a>
			<a href="<?= base_url($user_role . '/jadwal') ?>"
				class="px-4 py-3 flex items-center <?= ($segment == 'jadwal' ? 'bg-secondary' : 'hover:bg-secondary') ?>">
				<i class="fas fa-calendar-alt mr-3"></i>
				<span>Jadwal</span>
			</a>
		<?php endif; ?>

		<!-- Menu untuk Admin dan Pimpinan -->
		<?php if ($user_role == 'admin' || $user_role == 'pimpinan'): ?>
			<a href="<?= base_url($user_role . '/laporan') ?>"
				class="px-4 py-3 flex items-center <?= ($segment == 'laporan' ? 'bg-secondary' : 'hover:bg-secondary') ?>">
				<i class="fas fa-file-alt mr-3"></i>
				<span>Laporan</span>
			</a>
		<?php endif; ?>
	</nav>
</div>