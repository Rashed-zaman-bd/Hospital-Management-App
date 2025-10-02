@extends('backend.layout.app')

@section('content')
    <div class="p-6 max-w-3xl mx-auto">
        <div class="bg-white shadow rounded-2xl p-6">
            <h1 class="text-2xl font-semibold mb-4">Create Doctor</h1>

            @if ($errors->any())
                <div class="mb-4 rounded bg-red-50 text-red-700 p-3">
                    <ul class="list-disc ml-5">
                        @foreach ($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('doctor.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf

                <!-- Name -->
                <div>
                    <label class="block text-sm font-medium">Name *</label>
                    <input name="name" value="{{ old('name') }}" class="mt-1 w-full border rounded px-3 py-2" required>
                </div>

                <!-- Phone & Email -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium">Phone</label>
                        <input name="phone" value="{{ old('phone') }}" class="mt-1 w-full border rounded px-3 py-2">
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}"
                            class="mt-1 w-full border rounded px-3 py-2">
                    </div>
                </div>

                <!-- Hospital -->
                <div>
                    <label class="block text-sm font-medium">Hospital *</label>
                    <select id="hospitalSelect" name="hospital_id" class="mt-1 w-full border rounded px-3 py-2" required>
                        <option value="">Select Hospital</option>
                        @foreach ($hospitals as $hospital)
                            <option value="{{ $hospital->id }}" {{ old('hospital_id') == $hospital->id ? 'selected' : '' }}>
                                {{ $hospital->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Speciality -->
                <div>
                    <label class="block text-sm font-medium">Speciality *</label>
                    <select name="speciality_id" class="mt-1 w-full border rounded px-3 py-2" required>
                        <option value="">Select Speciality</option>
                        @foreach ($specialities as $speciality)
                            <option value="{{ $speciality->id }}"
                                {{ old('speciality_id') == $speciality->id ? 'selected' : '' }}>
                                {{ $speciality->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Fee -->
                <div>
                    <label class="block text-sm font-medium">Fee</label>
                    <input type="number" step="0.01" name="fee" value="{{ old('fee') }}"
                        class="mt-1 w-full border rounded px-3 py-2">
                </div>

                <!-- Qualification -->
                <div>
                    <label class="block text-sm font-medium">Qualification</label>
                    <input name="qualification" value="{{ old('qualification') }}"
                        class="mt-1 w-full border rounded px-3 py-2">
                </div>

                <!-- Location -->
                <div>
                    <label class="block text-sm font-medium">Location</label>
                    <input id="locationInput" name="location" value="{{ old('location') }}"
                        class="mt-1 w-full border rounded px-3 py-2">
                </div>

                <!-- Description -->
                <div>
                    <label class="block text-sm font-medium">Description</label>
                    <textarea name="description" rows="4" class="mt-1 w-full border rounded px-3 py-2">{{ old('description') }}</textarea>
                </div>

                <!-- Image -->
                <div>
                    <label class="block text-sm font-medium">Image</label>
                    <input type="file" name="image" accept="image/*" class="mt-1 w-full border rounded px-3 py-2">
                    <p class="text-xs text-gray-500 mt-1">JPG, PNG, or WEBP. Max 2MB.</p>
                </div>

                <!-- Buttons -->
                <div class="flex items-center gap-3 pt-2">
                    <a href="{{ route('backend.doctor') }}" class="px-4 py-2 rounded border">Cancel</a>
                    <button type="submit" class="px-4 py-2 rounded bg-blue-600 hover:bg-blue-700 text-white">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- JS for auto-filling location -->
    <script>
        const hospitals = @json($hospitals->mapWithKeys(fn($h) => [$h->id => $h->location]));

        document.getElementById('hospitalSelect').addEventListener('change', function() {
            const hospitalId = this.value;
            const locationField = document.getElementById('locationInput');
            if (hospitalId && hospitals[hospitalId]) {
                locationField.value = hospitals[hospitalId];
            } else {
                locationField.value = '';
            }
        });

        // Fill location if hospital already selected (old form)
        window.addEventListener('DOMContentLoaded', () => {
            const hospitalSelect = document.getElementById('hospitalSelect');
            if (hospitalSelect.value && hospitals[hospitalSelect.value]) {
                document.getElementById('locationInput').value = hospitals[hospitalSelect.value];
            }
        });
    </script>
@endsection
