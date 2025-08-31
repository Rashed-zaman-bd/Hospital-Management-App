@extends('backend.layout.app')

@section('content')
    <div class="p-4" x-data="{ openCreate: false, openEdit: false, editUser: {} }">
        <!-- Header + Filter + Create Button -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-4">
            <h2 class="text-xl font-semibold text-gray-800">Users</h2>

            <!-- Filter Form -->
            <form method="GET" class="flex items-center gap-2">
                <label for="user_type" class="text-gray-700">Filter:</label>
                <select name="user_type" id="user_type" onchange="this.form.submit()"
                    class="px-3 py-2 rounded border border-gray-300 focus:ring focus:ring-blue-200">
                    <option value="">All Types</option>
                    @foreach ($userTypes as $type)
                        <option value="{{ $type }}" @selected(request('user_type') == $type)>{{ ucfirst($type) }}</option>
                    @endforeach
                </select>
            </form>

            <!-- Create User Button -->
            <button @click="openCreate = true"
                class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg shadow transition">
                + Create User
            </button>
        </div>

        <!-- Users Table -->
        <div class="overflow-x-auto bg-white shadow-lg rounded-2xl">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600 uppercase">No</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600 uppercase">Name</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600 uppercase">User Type</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600 uppercase">Email</th>
                        <th class="px-6 py-3 text-center text-sm font-semibold text-gray-600 uppercase">Action</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @forelse ($users as $key => $user)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-sm text-gray-700">{{ $key + 1 }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700">{{ $user->name }}</td>
                            <td class="px-6 py-4 text-sm text-blue-600">{{ $user->user_type }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700">{{ $user->email }}</td>
                            <td class="px-6 py-4 flex justify-center space-x-2">
                                <!-- Delete -->
                                <form action="{{ route('delete.user', $user->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="px-3 py-1 text-sm bg-red-500 hover:bg-red-600 text-white rounded-lg shadow transition">
                                        Delete
                                    </button>
                                </form>
                                <!-- Edit -->
                                <button
                                    @click="
                                    editUser = {{ $user }};
                                    openEdit = true;
                                "
                                    class="px-3 py-1 text-sm bg-green-500 hover:bg-green-600 text-white rounded-lg shadow transition">
                                    Edit
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">No users found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Create User Modal -->
        <div x-show="openCreate" x-cloak class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div @click.away="openCreate = false" class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
                <h3 class="text-lg font-semibold mb-4">Create User</h3>
                <form action="{{ route('backend.user.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="block text-gray-700 mb-1">Name</label>
                        <input type="text" name="name" class="w-full px-3 py-2 border rounded" required>
                    </div>
                    <div class="mb-3">
                        <label class="block text-gray-700 mb-1">Email</label>
                        <input type="email" name="email" class="w-full px-3 py-2 border rounded" required>
                    </div>
                    <div class="mb-3">
                        <label class="block text-gray-700 mb-1">User Type</label>
                        <select name="user_type" class="w-full px-3 py-2 border rounded" required>
                            <option value="">Select Type</option>
                            <option value="admin">Admin</option>
                            <option value="user">User</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="block text-gray-700 mb-1">Password</label>
                        <input type="password" name="password" class="w-full px-3 py-2 border rounded" required>
                    </div>
                    <div class="flex justify-end gap-2">
                        <button type="button" @click="openCreate = false"
                            class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Cancel</button>
                        <button type="submit"
                            class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Create</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Edit User Modal -->
        <div x-show="openEdit" x-cloak class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div @click.away="openEdit = false" class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
                <h3 class="text-lg font-semibold mb-4">Edit User</h3>
                <form :action="'/admin/users/' + editUser.id" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="block text-gray-700 mb-1">Name</label>
                        <input type="text" name="name" class="w-full px-3 py-2 border rounded" x-model="editUser.name"
                            required>
                    </div>
                    <div class="mb-3">
                        <label class="block text-gray-700 mb-1">Email</label>
                        <input type="email" name="email" class="w-full px-3 py-2 border rounded"
                            x-model="editUser.email" required>
                    </div>
                    <div class="mb-3">
                        <label class="block text-gray-700 mb-1">User Type</label>
                        <select name="user_type" class="w-full px-3 py-2 border rounded" x-model="editUser.user_type"
                            required>
                            <option value="">Select Type</option>
                            <option value="admin">Admin</option>
                            <option value="user">User</option>
                        </select>
                    </div>
                    <div class="flex justify-end gap-2">
                        <button type="button" @click="openEdit = false"
                            class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Cancel</button>
                        <button type="submit"
                            class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Alpine.js -->
    <script src="//unpkg.com/alpinejs" defer></script>
@endsection
