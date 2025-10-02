<aside id="sidebar"
    class="bg-gray-800 text-white w-64 fixed h-full top-0 left-0 transform -translate-x-full md:translate-x-0 transition-transform duration-300 z-50 flex flex-col">

    <!-- Logo -->
    <div class="flex items-center p-4">
        <img src="{{ asset('assets/img/favicon.ico') }}" class="logo-icon w-8 h-8" alt="logo icon">
        <h1 class="hidden sm:block ml-2 text-xl font-bold">Dashboard</h1>
    </div>

    <!-- Sidebar Menu -->
    <nav class="p-4 flex-1 overflow-y-auto">
        <ul class="space-y-2">
            <!-- Dashboard -->
            <li>
                <a href="{{ route('dashboard') }}"
                    class="flex items-center justify-between px-4 py-2 rounded hover:bg-gray-700">
                    <span>Dashboard</span>
                </a>
            </li>

            <!-- User Menu -->
            <li class="menu-item" data-menu="user">
                <div class="flex items-center justify-between px-4 py-2 cursor-pointer rounded hover:bg-gray-700">
                    <div><i class="bx bx-user-circle"></i>&nbsp;<span>User</span></div>
                    <span class="toggle-icon text-white">+</span>
                </div>
                <ul class="submenu hidden ml-6 mt-2 space-y-2">
                    <li>
                        <a href="{{ route('admin.user') }}" class="block px-4 py-2 rounded bg-gray-700">
                            <i class='bx bx-radio-circle'></i>All User
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Doctor Menu -->
            <li class="menu-item" data-menu="doctor">
                <div class="flex items-center justify-between px-4 py-2 cursor-pointer rounded hover:bg-gray-700">
                    <div><i class='bx bx-category'></i>&nbsp;<span>Doctor</span></div>
                    <span class="toggle-icon">+</span>
                </div>
                <ul class="submenu hidden ml-6 mt-2 space-y-2">
                    <li>
                        <a href="{{ route('backend.doctor') }}" class="block px-4 py-2 rounded bg-gray-700">
                            <i class='bx bx-radio-circle'></i>All Doctor
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('appointment.backend') }}" class="block px-4 py-2 rounded bg-gray-700">
                            <i class='bx bx-radio-circle'></i>Appointment
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Message Menu -->
            <li class="menu-item" data-menu="message">
                <div class="flex items-center justify-between px-4 py-2 cursor-pointer rounded hover:bg-gray-700">
                    <div><i class="bx bx-message"></i>&nbsp;<span>Message</span></div>
                    <span class="toggle-icon">+</span>
                </div>
                <ul class="submenu hidden ml-6 mt-2 space-y-2">
                    <li>
                        <a href="{{ route('backend.message') }}" class="block px-4 py-2 rounded bg-gray-700">
                            <i class='bx bx-radio-circle'></i>All Message
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Report Menu -->
            <li class="menu-item" data-menu="report">
                <div class="flex items-center justify-between px-4 py-2 cursor-pointer rounded hover:bg-gray-700">
                    <div><i class="bx bx-file"></i>&nbsp;<span>Report</span></div>
                    <span class="toggle-icon">+</span>
                </div>
                <ul class="submenu hidden ml-6 mt-2 space-y-2">
                    <li>
                        <a href="#" class="block px-4 py-2 rounded bg-gray-700">
                            <i class='bx bx-radio-circle'></i>All Report
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>

    <!-- Logout -->
    <div class="p-4 border-t border-gray-700">
        <a href="{{ route('admin-logout') }}" class="block px-4 py-2 bg-red-500 text-center rounded hover:bg-red-600">
            Logout
        </a>
    </div>
</aside>
