<!-- application/views/auth/login.php -->
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login - SIAKAD An-Nur Slawi</title>
	<script src="https://cdn.tailwindcss.com"></script>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
	<style>
		.bg-login {
			background-image: url('<?= base_url('assets/pondok.png') ?>');
			background-size: cover;
			background-position: center;
		}
	</style>
	<script>
		tailwind.config = {
			theme: {
				extend: {
					colors: {
						primary: '#0d8f81',
						secondary: '#245668',
						accent: '#6ec574',
						warning: '#edef5d',
					},
					fontFamily: {
						sans: ['Poppins', 'sans-serif'],
						cairo: ['Cairo', 'sans-serif'],
					}
				}
			}
		}
	</script>
</head>

<body class="font-sans bg-gray-100">
	<div class="min-h-screen flex flex-col md:flex-row">
		<div class="w-full md:w-1/2 bg-login hidden md:block"></div>

		<div class="w-full md:w-1/2 flex items-center justify-center p-8">
			<div class="w-full max-w-md">
				<div class="text-center mb-8">
					<img src="<?= base_url('assets/logo.png') ?>" alt="Logo An-Nur Slawi"
						class="mx-auto h-20 w-auto">
					<h1 class="text-3xl font-bold text-gray-800 mt-4">SIAKAD An-Nur Slawi</h1>
					<p class="text-gray-600 mt-2">Sistem Informasi Akademik Terpadu</p>
				</div>

				<div class="bg-white rounded-lg shadow-lg p-8">
					<?php if ($this->session->flashdata('error')): ?>
						<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
							<?= $this->session->flashdata('error') ?>
						</div>
					<?php endif; ?>

					<?php if ($this->session->flashdata('success')): ?>
						<div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
							<?= $this->session->flashdata('success') ?>
						</div>
					<?php endif; ?>

					<h2 class="text-2xl font-bold text-gray-800 text-center mb-6">Masuk ke Akun Anda</h2>

					<form action="<?= site_url('auth/process_login') ?>" method="POST">
						<div class="mb-4">
							<label for="username"
								class="block text-gray-700 text-sm font-medium mb-2">Username</label>
							<div class="relative">
								<div
									class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
									<i class="fas fa-user text-gray-400"></i>
								</div>
								<input type="text" id="username" name="username"
									class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
									placeholder="Masukkan username" required>
							</div>
						</div>

						<div class="mb-4">
							<label for="password"
								class="block text-gray-700 text-sm font-medium mb-2">Password</label>
							<div class="relative">
								<div
									class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
									<i class="fas fa-lock text-gray-400"></i>
								</div>
								<input type="password" id="password" name="password"
									class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
									placeholder="Masukkan password" required>
							</div>
						</div>

						<div class="flex items-center justify-between mb-6">
							<div class="flex items-center">
								<input id="remember" name="remember" type="checkbox"
									class="h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded">
								<label for="remember" class="ml-2 block text-sm text-gray-700">Ingat
									saya</label>
							</div>
							<div class="text-sm">
								<a href="<?= site_url('auth/forgot_password') ?>"
									class="font-medium text-primary hover:text-secondary">Lupa password?</a>
							</div>
						</div>

						<button type="submit"
							class="w-full bg-primary hover:bg-secondary text-white font-bold py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition duration-150">
							Masuk
						</button>
					</form>

					<div class="mt-6 text-center">
						<p class="text-sm text-gray-600">
							Belum punya akun?
							<a href="<?= site_url('auth/registrasi') ?>"
								class="font-medium text-primary hover:text-secondary">Daftar sekarang</a>
						</p>
					</div>
				</div>

				<div class="mt-8 text-center text-xs text-gray-500">
					<p>&copy; <?= date('Y') ?> SIAKAD An-Nur Slawi. All rights reserved.</p>
				</div>
			</div>
		</div>
	</div>
</body>

</html>