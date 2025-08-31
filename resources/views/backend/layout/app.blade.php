<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Responsive Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">


</head>

<body class="bg-gray-100">

    <div class="flex h-screen">
        <!-- Sidebar -->
        @include('backend.layout.sidebar')

        <!-- Main Content -->
        <div class="flex-1 flex flex-col md:ml-64 transition-all">

            <!-- Header -->
            @include('backend.layout.header')

            <!-- Dashboard Content -->
            <main class="p-6 overflow-y-auto">

                <div>
                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    <!-- Script -->
    <script>
        const sidebar = document.getElementById('sidebar');
        const menuBtn = document.getElementById('menu-btn');

        // Toggle Sidebar
        if (menuBtn) {
            menuBtn.addEventListener('click', () => {
                sidebar.classList.toggle('-translate-x-full');
            });
        }

        // Handle submenu toggle with localStorage persistence
        const menuItems = document.querySelectorAll('.menu-item');
        menuItems.forEach(item => {
            const key = item.getAttribute('data-menu');
            const toggleIcon = item.querySelector('.toggle-icon');
            const submenu = item.querySelector('.submenu');

            // Load state from localStorage
            if (localStorage.getItem(`menu-${key}`) === 'open') {
                submenu.classList.remove('hidden');
                toggleIcon.textContent = '-';
            }

            // Add toggle click
            item.querySelector('div').addEventListener('click', () => {
                submenu.classList.toggle('hidden');
                const isOpen = !submenu.classList.contains('hidden');
                toggleIcon.textContent = isOpen ? '-' : '+';
                localStorage.setItem(`menu-${key}`, isOpen ? 'open' : 'closed');
            });
        });
    </script>


</body>

</html>
