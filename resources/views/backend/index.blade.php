@extends('backend.layout.app')
@section('content')
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 p-4">
        <!-- Today Appointment -->
        <div class="bg-white shadow rounded-xl border-l-4 border-blue-500 p-5 flex items-center">
            <div>
                <p class="text-gray-500 text-sm">Today Appointment</p>
                <h4 class="text-2xl font-bold text-blue-500">{{ $todayAppointments ?? 0 }}</h4>
            </div>
            <div class="ml-auto flex items-center justify-center w-12 h-12 rounded-full bg-blue-500 text-white text-xl">
                <i class='bx bxs-cart'></i>
            </div>
        </div>

        <!-- Total User -->
        <div class="bg-white shadow rounded-xl border-l-4 border-red-500 p-5 flex items-center">
            <div>
                <p class="text-gray-500 text-sm">Total User</p>
                <h4 class="text-2xl font-bold text-red-500">{{ $totalUsers ?? 0 }}</h4>
            </div>
            <div class="ml-auto flex items-center justify-center w-12 h-12 rounded-full bg-red-500 text-white text-xl">
                <i class='bx bxs-wallet'></i>
            </div>
        </div>

        <!-- New Message -->
        <div class="bg-white shadow rounded-xl border-l-4 border-green-500 p-5 flex items-center">
            <div>
                <p class="text-gray-500 text-sm">New Message</p>
                <h4 class="text-2xl font-bold text-green-500">{{ $newMessages ?? 0 }}</h4>
            </div>
            <div class="ml-auto flex items-center justify-center w-12 h-12 rounded-full bg-green-500 text-white text-xl">
                <i class='bx bxs-bar-chart-alt-2'></i>
            </div>
        </div>

        <!-- All Doctor -->
        <div class="bg-white shadow rounded-xl border-l-4 border-yellow-500 p-5 flex items-center">
            <div>
                <p class="text-gray-500 text-sm">All Doctor</p>
            </div>
            <div class="ml-auto flex items-center justify-center w-12 h-12 rounded-full bg-yellow-500 text-white text-xl">
                <i class='bx bxs-group'></i>
            </div>
        </div>
    </div>
    <!--end row-->

    <div class="card radius-10 shadow-md bg-white">
        <div class="card-header flex items-center justify-between px-4 py-3 border-b">
            <h6 class="mb-0 font-bold text-lg">Recent Appointments</h6>
            <div class="dropdown relative">
                <button class="text-gray-500 hover:text-gray-700">
                    <i class='bx bx-dots-horizontal-rounded text-xl'></i>
                </button>
                <ul class="dropdown-menu absolute hidden bg-white shadow-md rounded mt-2">
                    <li><a class="block px-4 py-2 hover:bg-gray-100" href="#">Action</a></li>
                    <li><a class="block px-4 py-2 hover:bg-gray-100" href="#">Another action</a></li>
                </ul>
            </div>
        </div>
        <div class="card-body overflow-x-auto">
            <table class="table-auto w-full text-left border-collapse">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="px-4 py-2">Sl. No</th>
                        <th class="px-4 py-2">Doctor Name</th>
                        <th class="px-4 py-2">Department</th>
                        <th class="px-4 py-2">Hospital Name</th>
                        <th class="px-4 py-2">Date</th>
                        <th class="px-4 py-2">Time</th>
                        <th class="px-4 py-2">Doctor Fee</th>
                        <th class="px-4 py-2">Patient ID</th>
                        <th class="px-4 py-2">Patient Name</th>
                        <th class="px-4 py-2">Phone</th>
                        <th class="px-4 py-2">Email</th>
                        <th class="px-4 py-2">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($appointments as $key=>$appointment)
                        <tr class="border-b">
                            <td class="px-4 py-2">{{ $key + 1 }}</td>
                            <td class="px-4 py-2">{{ $appointment->doctor_name }}</td>
                            <td class="px-4 py-2">{{ $appointment->speciality }}</td>
                            <td class="px-4 py-2">{{ $appointment->hospital_name }}</td>
                            <td>{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d/m/Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('H:m') }}</td>
                            <td class="px-4 py-2">{{ $appointment->doctor_fee }}</td>
                            <td class="px-4 py-2">{{ $appointment->appointment_code }}</td>
                            <td class="px-4 py-2">{{ $appointment->patient_name }}</td>
                            <td class="px-4 py-2">{{ $appointment->patient_phone }}</td>
                            <td class="px-4 py-2">{{ $appointment->patient_email }}</td>
                            <td class="px-4 py-2">{{ $appointment->status }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center py-4 text-gray-500">No appointments found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
