<header class="bg-white shadow px-6 py-4 flex justify-between items-center sticky top-0 z-40">
    <div class="flex items-center gap-3">
        <!-- Toggle Button for Mobile -->
        <button id="menu-btn" class="md:hidden text-gray-700">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
        <h1 class="text-xl font-semibold">Dashboard</h1>
    </div>

    <!-- User Dropdown -->
    <div class="relative inline-block text-left">
        <button id="dropdownButton"
            class="flex items-center gap-3 bg-gray-100 px-3 py-2 rounded-lg hover:bg-gray-200 transition">
            <img src="{{ asset('assets/img/user.png') }}" class="w-10 h-10 rounded-full border" alt="user avatar">
            <div class="text-left">
                <p class="text-gray-800 font-semibold">
                    @auth
                        {{ Auth::user()->name }}
                    @endauth
                </p>
                <p class="text-sm text-gray-500">
                    @auth
                        {{ Auth::user()->email }}
                    @endauth
                </p>
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-500" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </button>

        <!-- Dropdown Menu -->
        <div id="dropdownMenu"
            class="hidden absolute right-0 mt-2 w-60 bg-white rounded-lg shadow-lg ring-1 ring-black ring-opacity-5 z-10">
            <ul class="py-1">
                <li><a href="{{ route('profile.edit') }}"
                        class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Profile</a>
                </li>
                <li><a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Settings</a>
                </li>
                <li><a href="{{ route('dashboard') }}"
                        class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Dashboard</a>
                </li>
                <li>
                    <div class="border-t my-1"></div>
                </li>
                <li><a href="{{ route('admin-logout') }}"
                        class="block px-4 py-2 text-red-600 hover:bg-gray-100">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</header>

<script>
    const btn = document.getElementById('dropdownButton');
    const menu = document.getElementById('dropdownMenu');

    btn.addEventListener('click', (e) => {
        e.stopPropagation();
        menu.classList.toggle('hidden');
    });

    // Close when clicking outside
    window.addEventListener('click', () => menu.classList.add('hidden'));

    // Close with Escape key
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') menu.classList.add('hidden');
    });
</script>
