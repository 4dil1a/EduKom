<nav class="navbar p-4 flex justify-between items-center text-white bg-[#006d77] relative">
    <div class="flex items-center space-x-8">
        <h1 class="text-2xl font-bold">EduKom</h1>
        <div class="space-x-4">
            <a href="<?= base_url('/dashboard') ?>" class="hover:text-gray-200">Dashboard</a>
            <a href="<?= base_url('/materi') ?>" class="hover:text-gray-200">Materi</a>
            <a href="<?= base_url('/kuis') ?>" class="hover:text-gray-200">Kuis</a>
            <a href="<?= base_url('/seminar') ?>" class="hover:text-gray-200">Info Seminar</a>
        </div>
    </div>
    <div class="flex items-center space-x-8">
        <div class="relative">
            <input type="text" placeholder="Cari Materi" class="px-4 py-2 rounded-full text-gray-800 w-64">
            <i class="fas fa-search absolute right-4 top-3 text-gray-500"></i>
        </div>
        <div class="relative">
            <!-- Dropdown Profile Menu -->
            <button id="profileDropdown" class="w-8 h-8 rounded-full bg-gray-200 text-gray-700 flex items-center justify-center relative z-10">
                <i class="fas fa-user"></i>
            </button>
            <div id="dropdownMenu" 
                 class="hidden absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border z-50">
                <a href="<?= base_url('/user/profile/' . session()->get('user_id')) ?>" 
                   class="block px-4 py-2 text-gray-800 hover:bg-gray-100">
                    <i class="fas fa-eye mr-2"></i>Lihat Profil
                </a>
                <a href="<?= base_url('/auth/logout') ?>" 
                   class="block px-4 py-2 text-red-600 hover:bg-gray-100">
                    <i class="fas fa-sign-out-alt mr-2"></i>Logout
                </a>
            </div>
        </div>
    </div>
</nav>

<script>
document.getElementById('profileDropdown').addEventListener('click', function() {
    var dropdownMenu = document.getElementById('dropdownMenu');
    dropdownMenu.classList.toggle('hidden');
});

// Close dropdown when clicking outside
window.addEventListener('click', function(e) {
    var dropdown = document.getElementById('dropdownMenu');
    var dropdownBtn = document.getElementById('profileDropdown');

    if (!dropdown.contains(e.target) && !dropdownBtn.contains(e.target)) {
        dropdown.classList.add('hidden');
    }
});
</script>
