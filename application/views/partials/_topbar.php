<header class="bg-white shadow-sm">
	<div class="flex justify-between items-center px-6 py-4">
		<h2 class="text-xl font-semibold text-gray-800"><?= $title ?></h2>
		<div class="flex items-center space-x-4">
			<div class="relative group">
				<button class="flex items-center space-x-2 focus:outline-none">
					<img src="<?= base_url('assets/profile.png') ?>" alt="User" class="rounded-full w-8 h-8">
					<span class="font-medium capitalize"><?= $this->session->userdata('role') ?></span>
					<svg xmlns="http://www.w3.org/2000/svg"
						class="h-4 w-4 text-gray-500 group-hover:text-gray-700 transition" fill="none"
						viewBox="0 0 24 24" stroke="currentColor">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
							d="M19 9l-7 7-7-7" />
					</svg>
				</button>

				<div
					class="absolute right-0 mt-2 w-40 bg-white rounded-md shadow-lg py-1 z-40 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 border border-gray-100">
					<a href="<?= base_url('logout') ?>"
						class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition flex items-center">
						<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none"
							viewBox="0 0 24 24" stroke="currentColor">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
								d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
						</svg>
						Logout
					</a>
				</div>
			</div>
		</div>
	</div>
</header>