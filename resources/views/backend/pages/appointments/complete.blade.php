@extends('backend.layout.app')

@section('content')
    <div class="card radius-10 shadow-md bg-white">
        <div class="card-header flex items-center justify-between px-4 py-3 border-b">
            <h6 class="mb-0 font-bold text-lg">Appointment Details</h6>
        </div>
        <div class="card-body p-4">
            @if (session('success'))
                <div class="bg-green-100 text-green-700 px-3 py-2 rounded mb-3">
                    {{ session('success') }}
                </div>
            @endif

            <table class="min-w-full border border-gray-200 rounded-lg overflow-hidden shadow-sm">
                <tbody class="divide-y divide-gray-200">
                    <tr class="bg-gray-50">
                        <th class="p-3 w-1/3 font-semibold text-gray-700">Doctor Name:</th>
                        <td class="p-3 text-gray-900">{{ $appointment->doctor_name }}</td>
                    </tr>
                    <tr>
                        <th class="p-3 font-semibold text-gray-700">Department:</th>
                        <td class="p-3">{{ $appointment->speciality }}</td>
                    </tr>
                    <tr class="bg-gray-50">
                        <th class="p-3 font-semibold text-gray-700">Hospital:</th>
                        <td class="p-3">{{ $appointment->hospital_name }}</td>
                    </tr>
                    <tr>
                        <th class="p-3 font-semibold text-gray-700">Date:</th>
                        <td class="p-3">{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d/m/Y') }}</td>
                    </tr>
                    <tr class="bg-gray-50">
                        <th class="p-3 font-semibold text-gray-700">Time:</th>
                        <td class="p-3">{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('H:i') }}</td>
                    </tr>
                    <tr>
                        <th class="p-3 font-semibold text-gray-700">Doctor Fee:</th>
                        <td class="p-3 text-green-600 font-semibold">{{ $appointment->doctor_fee }} BDT</td>
                    </tr>
                    <tr class="bg-gray-50">
                        <th class="p-3 font-semibold text-gray-700">Patient ID:</th>
                        <td class="p-3">{{ $appointment->appointment_code }}</td>
                    </tr>
                    <tr>
                        <th class="p-3 font-semibold text-gray-700">Patient Name:</th>
                        <td class="p-3">{{ $appointment->patient_name }}</td>
                    </tr>
                    <tr class="bg-gray-50">
                        <th class="p-3 font-semibold text-gray-700">Phone:</th>
                        <td class="p-3">{{ $appointment->patient_phone }}</td>
                    </tr>
                    <tr>
                        <th class="p-3 font-semibold text-gray-700">Email:</th>
                        <td class="p-3">{{ $appointment->patient_email }}</td>
                    </tr>
                    <tr class="bg-gray-50">
                        <th class="p-3 font-semibold text-gray-700">Status:</th>
                        <td class="p-3">
                            <span
                                class="px-3 py-1 rounded-full text-sm font-medium
                    {{ $appointment->status == 'pending' ? 'bg-yellow-100 text-yellow-700' : '' }}
                    {{ $appointment->status == 'confirmed' ? 'bg-blue-100 text-blue-700' : '' }}
                    {{ $appointment->status == 'cancelled' ? 'bg-red-100 text-red-700' : '' }}
                    {{ $appointment->status == 'complete' ? 'bg-green-100 text-green-700' : '' }}">
                                {{ ucfirst($appointment->status) }}
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>



            <!-- Status Update Form -->
            <form action="{{ route('appointments.updateStatus', $appointment->id) }}" method="POST" class="mt-4">
                @csrf
                <label for="status" class="block mb-2 font-semibold">Change Status</label>
                <select name="status" id="status" class="border px-3 py-2 rounded w-1/3">
                    <option value="Pending" {{ $appointment->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                    <option value="Complete" {{ $appointment->status == 'complete' ? 'selected' : '' }}>complete</option>
                    <option value="Cancelled" {{ $appointment->status == 'Cancelled' ? 'selected' : '' }}>Cancelled
                    </option>
                </select>
                <button type="submit" class="ml-3 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                    Update
                </button>

                <a href="{{ route('appointment.backend') }}"
                    class="ml-3 px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                    Back
                </a>

            </form>
        </div>
    </div>
@endsection
