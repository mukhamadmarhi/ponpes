<!DOCTYPE html>
<html lang="id">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Dashboard Admin Ponpes</title>
	<script src="https://cdn.tailwindcss.com"></script>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&family=Poppins:wght@400;600&display=swap"
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
</head>

<body class="bg-gray-100 font-sans">
	<div class="flex h-screen">
		<!-- Sidebar -->
		<?php $this->load->view('partials/_sidebar') ?>

		<!-- Main Content -->
		<div class="flex-1 flex flex-col overflow-hidden">
			<!-- Topbar -->
			<?php $this->load->view('partials/_topbar', $title) ?>

			<!-- Content -->
			<main class="flex-1 overflow-y-auto p-6 bg-gray-100">