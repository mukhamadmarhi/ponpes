<!DOCTYPE html>
<html lang="id">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Ponpes An Nur Slawi</title>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&family=Cairo:wght@400;600;700&display=swap"
		rel="stylesheet">
	<script src="https://cdn.tailwindcss.com"></script>
	<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
	<script>
		tailwind.config = {
			theme: {
				extend: {
					colors: {
						primary: '#0d8f81',
						secondary: '#245668',
						accent: '#6ec574',
						warning: '#edef5d',
						dark: '#1a2e35',
						light: '#f5f7fa',
					},
					fontFamily: {
						sans: ['Poppins', 'sans-serif'],
						cairo: ['Cairo', 'sans-serif'],
					},
					boxShadow: {
						'3d': '0 10px 30px -5px rgba(0, 0, 0, 0.2)',
						'neumorph': '8px 8px 16px #d9d9d9, -8px -8px 16px #ffffff',
					}
				}
			}
		}
	</script>
	<style>
		@keyframes float {

			0%,
			100% {
				transform: translateY(0);
			}

			50% {
				transform: translateY(-15px);
			}
		}

		.floating {
			animation: float 4s ease-in-out infinite;
		}

		.text-stroke {
			-webkit-text-stroke: 1px #0d8f81;
			color: transparent;
		}
	</style>
</head>

<body class="font-sans bg-light overflow-x-hidden">
	<!-- Preloader -->
	<div id="preloader" class="fixed inset-0 bg-white z-50 flex items-center justify-center">
		<div class="w-16 h-16 border-4 border-primary border-t-transparent rounded-full animate-spin"></div>
	</div>

	<!-- Floating WhatsApp Button -->
	<a href="https://wa.me/6281935525318" target="_blank"
		class="fixed bottom-8 right-8 bg-accent p-4 rounded-full shadow-lg z-40 hover:bg-primary transition">
		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="white">
			<path
				d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z" />
		</svg>
	</a>


	<!-- Navbar Modern -->
	<nav class="bg-white/80 backdrop-blur-md py-4 sticky top-0 z-30 shadow-sm">
		<div class="container mx-auto px-6 flex justify-between items-center">
			<div class="flex items-center space-x-2">
				<img src="<?= base_url('assets/logo.png') ?>" alt="" class="w-10">
				<span class="text-xl font-bold text-dark">PONPES ANNUR SLAWI</span>
			</div>
			<div class="hidden lg:flex space-x-8 items-center">
				<a href="#home" class="text-secondary hover:text-accent transition">Beranda</a>
				<a href="#about" class="text-secondary hover:text-accent transition">Tentang</a>
				<a href="#program" class="text-secondary hover:text-accent transition">Program</a>
				<a href="#fasilitas" class="text-secondary hover:text-accent transition">Fasilitas</a>
				<a href="#lokasi" class="text-secondary hover:text-accent transition">Lokasi</a>
				<a href="#testimoni" class="text-secondary hover:text-accent transition">Testimoni</a>

				<?php if ($this->session->userdata('logged_in')): ?>
					<div class="relative group">
						<button class="flex items-center space-x-1 focus:outline-none">
							<div
								class="w-8 h-8 bg-primary rounded-full flex items-center justify-center text-white text-sm font-medium">
								AN
							</div>
							<svg xmlns="http://www.w3.org/2000/svg"
								class="h-4 w-4 text-gray-600 group-hover:text-accent transition" fill="none"
								viewBox="0 0 24 24" stroke="currentColor">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
									d="M19 9l-7 7-7-7" />
							</svg>
						</button>

						<?php

						$role = $this->session->userdata('role');

						?>
						<div
							class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-40 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200">
							<a href="<?= base_url("$role/dashboard") ?>"
								class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition">Dashboard</a>
							<a href="<?= base_url('logout') ?>"
								class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition">Logout</a>
						</div>
					</div>
				<?php else: ?>
					<a href="<?= base_url('login') ?>" class="text-secondary hover:text-accent transition">Login</a>
				<?php endif; ?>
			</div>
			<button class="lg:hidden text-dark">
				<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
					stroke="currentColor">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
						d="M4 6h16M4 12h16M4 18h16" />
				</svg>
			</button>
		</div>
	</nav>

	<!-- Hero Section (3D Style) -->
	<section id="home" class="relative overflow-hidden">
		<div class="absolute inset-0 bg-gradient-to-br from-primary to-secondary opacity-90 z-0"></div>
		<div class="container mx-auto px-6 py-32 relative z-10">
			<div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
				<div data-aos="fade-right">
					<h1 class="text-3xl md:text-5xl font-bold text-white mb-6 leading-tight">
						Menggali Ilmu <span class="text-accent">Mebentuk Karakter</span> Mengukir Prestasi
					</h1>
					<p class="text-lg text-white/80 mb-8 max-w-lg">
						Pentingnya menggali ilmu agama dan umum, membentuk karakter mulia, serta mempersiapkan
						diri untuk masa depan.
					</p>
					<div class="flex flex-col sm:flex-row gap-4">
						<a href="#program"
							class="bg-accent hover:bg-white text-dark font-bold py-4 px-8 rounded-full transition duration-300 transform hover:scale-105 shadow-lg">
							Jelajahi Program
						</a>
						<a href="#lokasi"
							class="border-2 border-white text-white hover:bg-white hover:text-primary font-bold py-4 px-8 rounded-full transition duration-300 transform hover:scale-105">
							Kunjungi Kami
						</a>
					</div>
				</div>
				<div data-aos="fade-left" class="flex justify-center">
					<div class="relative">
						<div class="w-full h-full bg-primary rounded-2xl shadow-3d floating"
							style="max-width: 400px;">
							<img src="assets/gambar1.jpg" alt="Santri"
								class="w-full h-full object-cover rounded-2xl">
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="absolute bottom-0 left-0 right-0 h-20 bg-white/10 backdrop-blur-sm"></div>
	</section>

	<!-- Stats Section -->
	<section class="py-16 bg-white">
		<div class="container mx-auto px-6">
			<div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
				<div data-aos="fade-up" data-aos-delay="100">
					<div class="text-4xl font-bold text-primary mb-2">12+</div>
					<p class="text-secondary">Tahun Pengalaman</p>
				</div>
				<div data-aos="fade-up" data-aos-delay="200">
					<div class="text-4xl font-bold text-primary mb-2">60+</div>
					<p class="text-secondary">Santri Aktif</p>
				</div>
				<div data-aos="fade-up" data-aos-delay="300">
					<div class="text-4xl font-bold text-primary mb-2">15+</div>
					<p class="text-secondary">Pengajar Profesional</p>
				</div>
				<div data-aos="fade-up" data-aos-delay="400">
					<div class="text-4xl font-bold text-primary mb-2">500+</div>
					<p class="text-secondary">Alumni</p>
				</div>
			</div>
		</div>
	</section>

	<!-- About Section -->
	<section id="about" class="py-20 bg-light">
		<div class="container mx-auto px-6">
			<div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
				<div data-aos="fade-right">
					<h2 class="text-3xl md:text-4xl font-bold text-secondary mb-6">
						<span class="text-primary">Pesantren Salafy</span> dengan Nuansa Islami
					</h2>
					<p class="text-lg text-gray-700 mb-6 text-justify">
						Pondok Pesantren An Nur Slawi adalah salah satu lembaga pendidikan Islam
						yang mendidik para santri dengan pengetahuan agama dan berbagai keterampilan lainnya.
						Pondok Pesantren An Nur Slawi memiliki bangunan bertingkat dengan warna tebok hijau
						yang cerah sehingga indah untuk dipandang. Pondok Pesantren ini terletak di Jl. R.A
						kartini No. 17
						Kelurahan Kalisapu Kecamatan Slawi Kabupaten Tegal. Pondok Pesantren ini didirikan pada
						tahun 2011
						di bawah naungan Yayasan Kawit An Nur Slawi.
					</p>
					<ul class="space-y-3 mb-8">
						<li class="flex items-start">
							<svg class="w-5 h-5 text-accent mt-1 mr-3 flex-shrink-0" fill="none"
								stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
									d="M5 13l4 4L19 7" />
							</svg>
							<span>Kurikulum terpadu agama dan umum</span>
						</li>
						<li class="flex items-start">
							<svg class="w-5 h-5 text-accent mt-1 mr-3 flex-shrink-0" fill="none"
								stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
									d="M5 13l4 4L19 7" />
							</svg>
							<span>Lingkungan asrama yang nyaman</span>
						</li>
						<li class="flex items-start">
							<svg class="w-5 h-5 text-accent mt-1 mr-3 flex-shrink-0" fill="none"
								stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
									d="M5 13l4 4L19 7" />
							</svg>
							<span>Fasilitas pendidikan lengkap</span>
						</li>
					</ul>
					<a href="#"
						class="inline-flex items-center text-primary font-bold hover:text-secondary transition">
						Selengkapnya
						<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20"
							fill="currentColor">
							<path fill-rule="evenodd"
								d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z"
								clip-rule="evenodd" />
						</svg>
					</a>
				</div>
				<div data-aos="fade-left" class="relative">
					<div class="grid grid-cols-2 gap-4">
						<div class="rounded-xl overflow-hidden shadow-lg hover:scale-105 transition duration-300">
							<img src="assets/gambar8.jpg" alt="Kelas" class="w-full h-48 object-cover">
						</div>
						<div
							class="rounded-xl overflow-hidden shadow-lg mt-8 hover:scale-105 transition duration-300">
							<img src="assets/gambar2.jpg" alt="Perpustakaan" class="w-full h-48 object-cover">
						</div>
						<div class="rounded-xl overflow-hidden shadow-lg hover:scale-105 transition duration-300">
							<img src="assets/gambar9.jpg" alt="Masjid" class="w-full h-48 object-cover">
						</div>
						<div
							class="rounded-xl overflow-hidden shadow-lg mt-8 hover:scale-105 transition duration-300">
							<img src="assets/gambar4.jpg" alt="Olahraga" class="w-full h-48 object-cover">
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Program Section -->
	<section id="program" class="py-20 bg-white">
		<div class="container mx-auto px-6">
			<div class="text-center mb-16">
				<h2 class="text-3xl md:text-4xl font-bold text-secondary mb-4" data-aos="fade-up">
					Program <span class="text-primary">Unggulan</span>
				</h2>
				<p class="text-lg text-gray-600 max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="100">
					Kami menyediakan berbagai program pendidikan yang dirancang untuk mengembangkan potensi santri
					secara maksimal.
				</p>
			</div>
			<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
				<!-- Program 1 -->
				<div data-aos="fade-up" data-aos-delay="200"
					class="bg-light rounded-xl p-8 shadow-md hover:shadow-xl transition duration-300 border-t-4 border-primary">
					<div class="w-16 h-16 bg-primary/10 rounded-full flex items-center justify-center mb-6">
						<svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-primary" fill="none"
							viewBox="0 0 24 24" stroke="currentColor">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
								d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
						</svg>
					</div>
					<h3 class="text-xl font-bold text-secondary mb-3">Studi Kitab Kuning</h3>
					<p class="text-gray-600 mb-4 text-justify">Penekanan pada penguasaan berbagai disiplin ilmu agama 
						dengan mempelajari kitab-kitab klasik berbahasa Arab.</p>
					<ul class="space-y-2 mb-6">
						<li class="flex items-start">
							<svg class="w-4 h-4 text-accent mt-1 mr-2 flex-shrink-0" fill="none"
								stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
									d="M5 13l4 4L19 7" />
							</svg>
							<span>Memahami Kitab Klasik</span>
						</li>
						<li class="flex items-start">
							<svg class="w-4 h-4 text-accent mt-1 mr-2 flex-shrink-0" fill="none"
								stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
									d="M5 13l4 4L19 7" />
							</svg>
							<span>Menanam Nilai-nilai Pemahaman Ulama Salaf</span>
						</li>
						<li class="flex items-start">
							<svg class="w-4 h-4 text-accent mt-1 mr-2 flex-shrink-0" fill="none"
								stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
									d="M5 13l4 4L19 7" />
							</svg>
							<span>Evaluasi Bulanan</span>
						</li>
					</ul>
					<a href="#"
						class="text-primary font-semibold hover:text-secondary transition flex items-center">
						Detail Program
						<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" viewBox="0 0 20 20"
							fill="currentColor">
							<path fill-rule="evenodd"
								d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z"
								clip-rule="evenodd" />
						</svg>
					</a>
				</div>

				<!-- Program 2 -->
				<div data-aos="fade-up" data-aos-delay="300"
					class="bg-light rounded-xl p-8 shadow-md hover:shadow-xl transition duration-300 border-t-4 border-secondary">
					<div class="w-16 h-16 bg-secondary/10 rounded-full flex items-center justify-center mb-6">
						<svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-secondary" fill="none"
							viewBox="0 0 24 24" stroke="currentColor">
							<path d="M12 14l9-5-9-5-9 5 9 5z" />
							<path
								d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
								d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />
						</svg>
					</div>
					<h3 class="text-xl font-bold text-secondary mb-3">Sekolah Formal</h3>
					<p class="text-gray-600 mb-4 text-justify">Jenjang pendidikan formal SMP dan SMK dengan kurikulum
						merdeka dengan pendidikan agama.</p>
					<ul class="space-y-2 mb-6">
						<li class="flex items-start">
							<svg class="w-4 h-4 text-accent mt-1 mr-2 flex-shrink-0" fill="none"
								stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
									d="M5 13l4 4L19 7" />
							</svg>
							<span>Akreditasi B</span>
						</li>
						<li class="flex items-start">
							<svg class="w-4 h-4 text-accent mt-1 mr-2 flex-shrink-0" fill="none"
								stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
									d="M5 13l4 4L19 7" />
							</svg>
							<span>Guru Berkompeten</span>
						</li>
						<li class="flex items-start">
							<svg class="w-4 h-4 text-accent mt-1 mr-2 flex-shrink-0" fill="none"
								stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
									d="M5 13l4 4L19 7" />
							</svg>
							<span>Fasilitas Lengkap</span>
						</li>
					</ul>
					<a href="#"
						class="text-primary font-semibold hover:text-secondary transition flex items-center">
						Detail Program
						<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" viewBox="0 0 20 20"
							fill="currentColor">
							<path fill-rule="evenodd"
								d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z"
								clip-rule="evenodd" />
						</svg>
					</a>
				</div>

				<!-- Program 3 -->
				<div data-aos="fade-up" data-aos-delay="400"
					class="bg-light rounded-xl p-8 shadow-md hover:shadow-xl transition duration-300 border-t-4 border-accent">
					<div class="w-16 h-16 bg-accent/10 rounded-full flex items-center justify-center mb-6">
						<svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-accent" fill="none"
							viewBox="0 0 24 24" stroke="currentColor">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
								d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
						</svg>
					</div>
					<h3 class="text-xl font-bold text-secondary mb-3">Program Khusus</h3>
					<p class="text-gray-600 mb-4 text-justify">Berbagai program penunjang untuk pengembangan diri santri di
						bidang sains, bahasa, dan leadership.</p>
					<ul class="space-y-2 mb-6">
						<li class="flex items-start">
							<svg class="w-4 h-4 text-accent mt-1 mr-2 flex-shrink-0" fill="none"
								stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
									d="M5 13l4 4L19 7" />
							</svg>
							<span>English & Arabic Camp</span>
						</li>
						<li class="flex items-start">
							<svg class="w-4 h-4 text-accent mt-1 mr-2 flex-shrink-0" fill="none"
								stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
									d="M5 13l4 4L19 7" />
							</svg>
							<span>Sains Club</span>
						</li>
						<li class="flex items-start">
							<svg class="w-4 h-4 text-accent mt-1 mr-2 flex-shrink-0" fill="none"
								stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
									d="M5 13l4 4L19 7" />
							</svg>
							<span>Leadership Training</span>
						</li>
					</ul>
					<a href="#"
						class="text-primary font-semibold hover:text-secondary transition flex items-center">
						Detail Program
						<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" viewBox="0 0 20 20"
							fill="currentColor">
							<path fill-rule="evenodd"
								d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z"
								clip-rule="evenodd" />
						</svg>
					</a>
				</div>
			</div>
		</div>
	</section>

	<!-- Fasilitas Section -->
	<section id="fasilitas" class="py-20 bg-gradient-to-br from-primary/5 to-secondary/5">
		<div class="container mx-auto px-6">
			<div class="text-center mb-16">
				<h2 class="text-3xl md:text-4xl font-bold text-secondary mb-4" data-aos="fade-up">
					Fasilitas <span class="text-primary">Unggulan</span>
				</h2>
				<p class="text-lg text-gray-600 max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="100">
					Kami menyediakan fasilitas terbaik untuk mendukung proses belajar mengajar yang optimal.
				</p>
			</div>
			<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
				<!-- Fasilitas 1 -->
				<div data-aos="fade-up" data-aos-delay="200"
					class="bg-white rounded-xl p-6 shadow-md hover:shadow-xl transition duration-300 text-center">
					<div
						class="w-20 h-20 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-4">
						<svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-primary" fill="none"
							viewBox="0 0 24 24" stroke="currentColor">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
								d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z" />
						</svg>
					</div>
					<h3 class="text-xl font-bold text-secondary mb-2">Asrama Nyaman</h3>
					<p class="text-gray-600">Asrama bersih dan luas untuk kenyamanan belajar.</p>
				</div>
				<!-- Fasilitas 2 -->
				<div data-aos="fade-up" data-aos-delay="300"
					class="bg-white rounded-xl p-6 shadow-md hover:shadow-xl transition duration-300 text-center">
					<div
						class="w-20 h-20 bg-secondary/10 rounded-full flex items-center justify-center mx-auto mb-4">
						<svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-secondary" fill="none"
							viewBox="0 0 24 24" stroke="currentColor">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
								d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
						</svg>
					</div>
					<h3 class="text-xl font-bold text-secondary mb-2">Bengkel Otomotif</h3>
					<p class="text-gray-600">Bengkel dengan alat-alat lengkap pelatihan para santri.</p>
				</div>
				<!-- Fasilitas 3 -->
				<div data-aos="fade-up" data-aos-delay="400"
					class="bg-white rounded-xl p-6 shadow-md hover:shadow-xl transition duration-300 text-center">
					<div class="w-20 h-20 bg-accent/10 rounded-full flex items-center justify-center mx-auto mb-4">
						<svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-accent" fill="none"
							viewBox="0 0 24 24" stroke="currentColor">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
								d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z" />
						</svg>
					</div>
					<h3 class="text-xl font-bold text-secondary mb-2">Gedung Serbaguna</h3>
					<p class="text-gray-600">Fasilitas olahraga lengkap untuk menjaga kebugaran santri.</p>
				</div>
				<!-- Fasilitas 4 -->
				<div data-aos="fade-up" data-aos-delay="500"
					class="bg-white rounded-xl p-6 shadow-md hover:shadow-xl transition duration-300 text-center">
					<div
						class="w-20 h-20 bg-warning/10 rounded-full flex items-center justify-center mx-auto mb-4">
						<svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-warning" fill="none"
							viewBox="0 0 24 24" stroke="currentColor">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
								d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z" />
						</svg>
					</div>
					<h3 class="text-xl font-bold text-secondary mb-2">Lab Komputer</h3>
					<p class="text-gray-600">Peralatan teknologi terkini untuk pembelajaran digital.</p>
				</div>
			</div>
		</div>
	</section>

	<!-- Lokasi & Pendaftaran Section -->
	<section id="lokasi" class="py-20 bg-white">
		<div class="container mx-auto px-6">
			<div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
				<div data-aos="fade-right">
					<h2 class="text-3xl md:text-4xl font-bold text-secondary mb-6">Lokasi & Pendaftaran</h2>
					<p class="text-lg text-gray-600 mb-6">
						Untuk mendaftar, silahkan datang langsung ke lokasi pesantren dengan membawa persyaratan
						yang diperlukan.
					</p>
					<div class="bg-primary/10 border-l-4 border-primary p-4 mb-6">
						<h4 class="font-bold text-secondary mb-2">Persyaratan Pendaftaran:</h4>
						<ul class="list-disc pl-5 space-y-1">
							<li>Sowan Kepada Pengasuh Ponpes</li>
							<li>Mengisi Formulir Pendaftaran</li>
							<li>Fotocopy Akta Kelahiran dan KK</li>
							<li>Pas Foto 3x4 (2 lembar)</li>
							<li>Fotocopy Rapor terakhir</li>
							<li>Fotocopy KTP Orang tua dan Ijazah</li>
						</ul>
					</div>
					<div class="space-y-4">
						<div class="flex items-start">
							<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary mr-4 mt-1"
								fill="none" viewBox="0 0 24 24" stroke="currentColor">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
									d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
									d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
							</svg>
							<div>
								<h4 class="font-bold text-secondary">Alamat Lengkap</h4>
								<p class="text-gray-600">Jl. R.A. Kartini No. 17 Rt. 09 Rw. 05 Desa Kalisapu
									Kec. Slawi Kab. Tegal, Jawa Tengah 52416</p>
							</div>
						</div>
						<div class="flex items-start">
							<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary mr-4 mt-1"
								fill="none" viewBox="0 0 24 24" stroke="currentColor">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
									d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
							</svg>
							<div>
								<h4 class="font-bold text-secondary">Jam Operasional</h4>
								<p class="text-gray-600">Senin - Jumat: 08.00 - 17.00 WIB</p>
								<p class="text-gray-600">Sabtu: 08.00 - 14.00 WIB</p>
							</div>
						</div>
						<div class="flex items-start">
							<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary mr-4 mt-1"
								fill="none" viewBox="0 0 24 24" stroke="currentColor">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
									d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
							</svg>
							<div>
								<h4 class="font-bold text-secondary">Kontak Pendaftaran</h4>
								<p class="text-gray-600">Ust. Irwanto: +62 819 3552 5318</p>
								<p class="text-gray-600">Ustz. Henifah: +62 812 3456 7890</p>
							</div>
						</div>
					</div>
				</div>
				<div data-aos="fade-left" class="h-full">
					<div class="rounded-xl overflow-hidden shadow-lg h-full">
						<iframe
							src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.123456789012!2d109.12345678901234!3d-6.987654321098765!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNsKwNTknMTUuNiJTIDEwOcKwMDcnNDEuOSJF!5e0!3m2!1sen!2sid!4v1234567890123!5m2!1sen!2sid"
							width="100%" height="100%" style="min-height: 400px; border:0;" allowfullscreen=""
							loading="lazy" class="rounded-xl">
						</iframe>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Testimoni Section -->
	<section id="testimoni" class="py-20 bg-light">
		<div class="container mx-auto px-6">
			<div class="text-center mb-16">
				<h2 class="text-3xl md:text-4xl font-bold text-secondary mb-4" data-aos="fade-up">
					Apa Kata <span class="text-primary">Mereka?</span>
				</h2>
				<p class="text-lg text-gray-600 max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="100">
					Testimoni dari orang tua, alumni dan santri tentang pengalaman mereka.
				</p>
			</div>
			<div class="grid grid-cols-1 md:grid-cols-3 gap-8">
				<!-- Testimoni 1 -->
				<div data-aos="fade-up" data-aos-delay="200"
					class="bg-white rounded-xl p-8 shadow-md hover:shadow-xl transition duration-300">
					<div class="flex items-center mb-6">
						<div class="w-16 h-16 rounded-full overflow-hidden mr-4">
							<img src="assets/gambar5.jpg" alt="Testimoni" class="w-full h-full object-cover">
						</div>
						<div>
							<h4 class="font-bold text-secondary">Mi'rat</h4>
							<p class="text-gray-500">Orang Tua Santri</p>
						</div>
					</div>
					<p class="text-gray-700 italic mb-6">"Anak saya berkembang sangat pesat baik akademik maupun
						agamanya sejak masuk ponpes ini. Pengajarannya sangat berkualitas."</p>
					<div class="flex text-yellow-400">
						<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
							fill="currentColor">
							<path
								d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
						</svg>
						<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
							fill="currentColor">
							<path
								d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
						</svg>
						<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
							fill="currentColor">
							<path
								d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
						</svg>
						<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
							fill="currentColor">
							<path
								d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
						</svg>
						<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
							fill="currentColor">
							<path
								d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
						</svg>
					</div>
				</div>
				<!-- Testimoni 2 -->
				<div data-aos="fade-up" data-aos-delay="300"
					class="bg-white rounded-xl p-8 shadow-md hover:shadow-xl transition duration-300">
					<div class="flex items-center mb-6">
						<div class="w-16 h-16 rounded-full overflow-hidden mr-4">
							<img src="assets/gambar7.jpg" alt="Testimoni" class="w-full h-full object-cover">
						</div>
						<div>
							<h4 class="font-bold text-secondary">Kholil Saputra</h4>
							<p class="text-gray-500">Alumni 2020</p>
						</div>
					</div>
					<p class="text-gray-700 italic mb-6">"Pendidikan di ponpes ini membentuk saya menjadi pribadi
						yang disiplin dan berakhlak, alhamdulillah sekarang saya bisa kuliah dengan bekal ilmu di
						pondok."
					</p>
					<div class="flex text-yellow-400">
						<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
							fill="currentColor">
							<path
								d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
						</svg>
						<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
							fill="currentColor">
							<path
								d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
						</svg>
						<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
							fill="currentColor">
							<path
								d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
						</svg>
						<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
							fill="currentColor">
							<path
								d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
						</svg>
						<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
							fill="currentColor">
							<path
								d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
						</svg>
					</div>
				</div>
				<!-- Testimoni 3 -->
				<div data-aos="fade-up" data-aos-delay="400"
					class="bg-white rounded-xl p-8 shadow-md hover:shadow-xl transition duration-300">
					<div class="flex items-center mb-6">
						<div class="w-16 h-16 rounded-full overflow-hidden mr-4">
							<img src="assets/gambar6.jpg" alt="Testimoni" class="w-full h-full object-cover">
						</div>
						<div>
							<h4 class="font-bold text-secondary">M. Najwa Izuddin</h4>
							<p class="text-gray-500">Santri Aktif</p>
						</div>
					</div>
					<p class="text-gray-700 italic mb-6">"Sistem pendidikan disini menggabungkan metode
						pembelajaran tradisional pesantren salaf dengan kurikulum dan sistem formal sekolah."</p>
					<div class="flex text-yellow-400">
						<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
							fill="currentColor">
							<path
								d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
						</svg>
						<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
							fill="currentColor">
							<path
								d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
						</svg>
						<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
							fill="currentColor">
							<path
								d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
						</svg>
						<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
							fill="currentColor">
							<path
								d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
						</svg>
						<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="none"
							stroke="currentColor">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
								d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
						</svg>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- CTA Section -->
	<section class="py-20 bg-gradient-to-r from-primary to-secondary text-white">
		<div class="container mx-auto px-6 text-center">
			<h2 class="text-3xl md:text-4xl font-bold mb-6" data-aos="fade-up">Siap Bergabung Dengan Kami?</h2>
			<p class="text-xl mb-8 max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="100">
				Datang langsung ke lokasi pesantren untuk informasi pendaftaran lebih lanjut.
			</p>
			<div class="flex flex-col sm:flex-row justify-center gap-4" data-aos="fade-up" data-aos-delay="200">
				<a href="#lokasi"
					class="bg-white text-primary font-bold py-4 px-8 rounded-full hover:bg-accent hover:text-dark transition duration-300 transform hover:scale-105">
					Lihat Lokasi
				</a>
				<a href="https://wa.me/6281935525318" target="_blank"
					class="border-2 border-white text-white font-bold py-4 px-8 rounded-full hover:bg-white hover:text-primary transition duration-300 transform hover:scale-105">
					Hubungi via WhatsApp
				</a>
			</div>
		</div>
	</section>

	<!-- Kontak Section -->
	<section id="kontak" class="py-20 bg-white">
		<div class="container mx-auto px-6">
			<div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
				<div data-aos="fade-right">
					<h2 class="text-3xl md:text-4xl font-bold text-secondary mb-6">Hubungi Kami</h2>
					<p class="text-lg text-gray-600 mb-8">
						Untuk informasi lebih lanjut tentang pendaftaran, kunjungan, atau kerja sama, silakan
						hubungi kami melalui form berikut atau langsung ke alamat pesantren.
					</p>
					<div class="space-y-4">
						<div class="flex items-start">
							<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary mr-4 mt-1"
								fill="none" viewBox="0 0 24 24" stroke="currentColor">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
									d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
									d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
							</svg>
							<div>
								<h4 class="font-bold text-secondary">Alamat</h4>
								<p class="text-gray-600">Jl. R.A. Kartini No. 17 Rt. 09 Rw. 05 Desa Kalisapu
									Kec. Slawi Kab. Tegal
								</p>
							</div>
						</div>
						<div class="flex items-start">
							<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary mr-4 mt-1"
								fill="none" viewBox="0 0 24 24" stroke="currentColor">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
									d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
							</svg>
							<div>
								<h4 class="font-bold text-secondary">Telepon</h4>
								<p class="text-gray-600">+62 819 3552 5318 (Admin)</p>
								<p class="text-gray-600">+62 823 2403 4312 (Panitia PSB)</p>
							</div>
						</div>
						<div class="flex items-start">
							<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary mr-4 mt-1"
								fill="none" viewBox="0 0 24 24" stroke="currentColor">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
									d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
							</svg>
							<div>
								<h4 class="font-bold text-secondary">Email</h4>
								<p class="text-gray-600">ponpes.annur.slawi@gmail.com</p>
								<p class="text-gray-600">psb@ponpesannurslawi.com</p>
							</div>
						</div>
					</div>
				</div>
				<div data-aos="fade-left" class="bg-light rounded-xl p-8 shadow-md">
					<h3 class="text-2xl font-bold text-secondary mb-6">Kirim Pesan</h3>
					<form>
						<div class="mb-4">
							<label for="name" class="block text-gray-700 mb-2">Nama Lengkap</label>
							<input type="text" id="name"
								class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
						</div>
						<div class="mb-4">
							<label for="email" class="block text-gray-700 mb-2">Email</label>
							<input type="email" id="email"
								class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
						</div>
						<div class="mb-4">
							<label for="phone" class="block text-gray-700 mb-2">No. HP</label>
							<input type="tel" id="phone"
								class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
						</div>
						<div class="mb-6">
							<label for="message" class="block text-gray-700 mb-2">Pesan</label>
							<textarea id="message" rows="4"
								class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"></textarea>
						</div>
						<button type="submit"
							class="w-full bg-primary text-white font-bold py-3 px-6 rounded-lg hover:bg-secondary transition duration-300">
							Kirim Pesan
						</button>
					</form>
				</div>
			</div>
		</div>
	</section>

	<!-- Footer -->
	<footer class="bg-dark text-white py-12">
		<div class="container mx-auto px-6">
			<div class="grid grid-cols-1 md:grid-cols-4 gap-8">
				<div>
					<h3 class="text-xl font-bold mb-4 text-accent">Ponpes An Nur Slawi</h3>
					<p class="mb-4">Pesantren Salafy dan Sains untuk Mencetak Generasi Berakidah Lurus dan
						Berakhlak Mulia.</p>
					<div class="flex space-x-4">
						<a href="#" class="text-gray-400 hover:text-accent transition">
							<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor"
								viewBox="0 0 24 24">
								<path
									d="M22.675 0h-21.35c-.732 0-1.325.593-1.325 1.325v21.351c0 .731.593 1.324 1.325 1.324h11.495v-9.294h-3.128v-3.622h3.128v-2.671c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12v9.293h6.116c.73 0 1.323-.593 1.323-1.325v-21.35c0-.732-.593-1.325-1.325-1.325z" />
							</svg>
						</a>
						<a href="#" class="text-gray-400 hover:text-accent transition">
							<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor"
								viewBox="0 0 24 24">
								<path
									d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
							</svg>
						</a>
						<a href="#" class="text-gray-400 hover:text-accent transition">
							<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor"
								viewBox="0 0 24 24">
								<path
									d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z" />
							</svg>
						</a>
					</div>
				</div>
				<div>
					<h4 class="text-lg font-bold mb-4 text-accent">Tautan Cepat</h4>
					<ul class="space-y-2">
						<li><a href="#home" class="text-gray-400 hover:text-accent transition">Beranda</a></li>
						<li><a href="#about" class="text-gray-400 hover:text-accent transition">Tentang Kami</a>
						</li>
						<li><a href="#program" class="text-gray-400 hover:text-accent transition">Program</a></li>
						<li><a href="#lokasi" class="text-gray-400 hover:text-accent transition">Lokasi</a></li>
						<li><a href="#testimoni" class="text-gray-400 hover:text-accent transition">Testimoni</a>
						</li>
					</ul>
				</div>
				<div>
					<h4 class="text-lg font-bold mb-4 text-accent">Program</h4>
					<ul class="space-y-2">
						<li><a href="#" class="text-gray-400 hover:text-accent transition">Pendidikan Salafy</a>
						</li>
						<li><a href="#" class="text-gray-400 hover:text-accent transition">Sekolah Formal</a></li>
						<li><a href="#" class="text-gray-400 hover:text-accent transition">Bahasa Arab &
								Inggris</a></li>
						<li><a href="#" class="text-gray-400 hover:text-accent transition">Program Khusus</a></li>
						<li><a href="#" class="text-gray-400 hover:text-accent transition">Ekstrakurikuler</a>
						</li>
					</ul>
				</div>
				<div>
					<h4 class="text-lg font-bold mb-4 text-accent">Kontak</h4>
					<ul class="space-y-2">
						<li class="flex items-start">
							<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-accent mr-2 mt-0.5"
								fill="none" viewBox="0 0 24 24" stroke="currentColor">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
									d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
									d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
							</svg>
							<span class="text-gray-400">Jl. R.A. Kartini No. 17 Rt. 09 Rw. 05 Desa
								Kalisapu</span>
						</li>
						<li class="flex items-start">
							<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-accent mr-2 mt-0.5"
								fill="none" viewBox="0 0 24 24" stroke="currentColor">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
									d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
							</svg>
							<span class="text-gray-400">+62 819 3552 5318</span>
						</li>
						<li class="flex items-start">
							<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-accent mr-2 mt-0.5"
								fill="none" viewBox="0 0 24 24" stroke="currentColor">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
									d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
							</svg>
							<span class="text-gray-400">ponpes.annur.slawi@gmail.com</span>
						</li>
					</ul>
				</div>
			</div>
			<hr class="border-gray-800 my-8">
			<div class="flex flex-col md:flex-row justify-between items-center">
				<p class="text-gray-400">© 2025 Ponpes An Nur Slawi. All rights reserved.</p>
				<div class="flex space-x-6 mt-4 md:mt-0">
					<a href="#" class="text-gray-400 hover:text-accent transition">Privacy Policy</a>
					<a href="#" class="text-gray-400 hover:text-accent transition">Terms of Service</a>
				</div>
			</div>
		</div>
	</footer>

	<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
	<script>
		window.addEventListener('load', function () {
			const preloader = document.getElementById('preloader');
			preloader.style.transition = 'opacity 0.5s ease';
			preloader.style.opacity = '0';
			setTimeout(() => {
				preloader.style.display = 'none';
			}, 500);
		});

		AOS.init({
			duration: 800,
			easing: 'ease-in-out',
			once: true
		});

		const mobileMenuButton = document.querySelector('.lg\\:hidden');
		mobileMenuButton.addEventListener('click', function () {
			console.log('Mobile menu clicked');
		});
	</script>
</body>

</html>