<!DOCTYPE html>
<html lang="id">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Akses Ditolak - SIAKAD Ponpes An-Nur Slawi</title>
	<script src="https://cdn.tailwindcss.com"></script>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Cairo:wght@400;600;700&display=swap"
		rel="stylesheet">
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
	<style>
		.gradient-bg {
			background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
		}

		.card-shadow {
			box-shadow: 0 20px 40px -15px rgba(0, 0, 0, 0.1), 0 10px 20px -5px rgba(0, 0, 0, 0.05);
		}

		.animated-pulse {
			animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
		}

		@keyframes pulse {

			0%,
			100% {
				opacity: 1;
			}

			50% {
				opacity: 0.7;
			}
		}
	</style>
</head>

<body class="gradient-bg min-h-screen flex items-center justify-center font-sans">
	<div class="max-w-4xl w-full mx-4">
		<div class="bg-white rounded-2xl overflow-hidden card-shadow flex flex-col md:flex-row">
			<!-- Illustration Section -->
			<div class="w-full md:w-2/5 bg-primary p-8 flex items-center justify-center">
				<div class="text-center">
					<svg xmlns="http://www.w3.org/2000/svg" class="h-40 w-40 mx-auto text-white" fill="none"
						viewBox="0 0 24 24" stroke="currentColor">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
							d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
					</svg>
					<h3 class="text-xl font-bold text-white mt-6">SISTEM INFORMASI AKADEMIK</h3>
					<p class="text-white opacity-90 mt-2">Pondok Pesantren An-Nur Slawi</p>
				</div>
			</div>

			<!-- Content Section -->
			<div class="w-full md:w-3/5 p-10 flex flex-col justify-center">
				<div class="flex items-center mb-6">
					<div class="bg-warning rounded-full p-2 mr-4">
						<svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-secondary" fill="none"
							viewBox="0 0 24 24" stroke="currentColor">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
								d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
						</svg>
					</div>
					<h1 class="text-3xl font-bold text-secondary">Akses Tidak Diizinkan</h1>
				</div>

				<div class="space-y-4">
					<p class="text-gray-700 leading-relaxed">
						Anda tidak memiliki izin untuk mengakses halaman ini. Silakan hubungi administrator sistem
						jika Anda merasa ini adalah kesalahan.
					</p>

					<div class="bg-accent bg-opacity-10 border-l-4 border-accent p-4 rounded-r">
						<p class="text-secondary font-medium">
							<span class="font-bold">Kode Error:</span> 403 - Forbidden Access
						</p>
					</div>

					<div class="pt-4">
						<a href="<?= base_url('') ?>"
							class="inline-flex items-center px-6 py-3 bg-primary hover:bg-secondary rounded-lg text-white font-medium transition duration-300 ease-in-out transform hover:-translate-y-1">
							<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
								viewBox="0 0 24 24" stroke="currentColor">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
									d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
							</svg>
							Kembali ke Halaman Utama
						</a>
					</div>
				</div>
			</div>
		</div>

		<div class="mt-8 text-center text-gray-500 text-sm">
			<p>© <?= date('Y') ?> SIAKAD Ponpes An-Nur Slawi. All rights reserved.</p>
		</div>
	</div>
</body>

</html>