@extends('backend.layout.app')

@section('content')
    <div class="p-6 max-w-3xl mx-auto">
        <div class="bg-white shadow rounded-2xl p-6">
            <h1 class="text-2xl font-semibold mb-4">Edit Doctor</h1>

            @if ($errors->any())
                <div class="mb-4 rounded bg-red-50 text-red-700 p-3">
                    <ul class="list-disc ml-5">
                        @foreach ($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('doctor.update', $doctor->id) }}" method="POST" enctype="multipart/form-data"
                class="space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-sm font-medium">Name *</label>
                    <input name="name" value="{{ old('name', $doctor->name) }}"
                        class="mt-1 w-full border rounded px-3 py-2" required>
                </div>

                <div>
                    <label class="block text-sm font-medium">Phone</label>
                    <input name="phone" value="{{ old('phone', $doctor->phone) }}"
                        class="mt-1 w-full border rounded px-3 py-2">
                </div>

                <div>
                    <label class="block text-sm font-medium">Email</label>
                    <input type="email" name="email" value="{{ old('email', $doctor->email) }}"
                        class="mt-1 w-full border rounded px-3 py-2">
                </div>

                <div>
                    <label class="block text-sm font-medium">Speciality</label>
                    <select name="speciality_id" class="mt-1 w-full border rounded px-3 py-2">
                        @foreach ($specialities as $speciality)
                            <option value="{{ $speciality->id }}"
                                {{ $doctor->speciality_id == $speciality->id ? 'selected' : '' }}>
                                {{ $speciality->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium">Qualification</label>
                    <input name="qualification" value="{{ old('qualification', $doctor->qualification) }}"
                        class="mt-1 w-full border rounded px-3 py-2">
                </div>

                <div>
                    <label class="block text-sm font-medium">Hospital</label>
                    <select name="hospital_id" class="mt-1 w-full border rounded px-3 py-2">
                        @foreach ($hospitals as $hospital)
                            <option value="{{ $hospital->id }}"
                                {{ $doctor->hospital_id == $hospital->id ? 'selected' : '' }}>
                                {{ $hospital->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium">Location</label>
                    <input name="location" value="{{ old('location', $doctor->location) }}"
                        class="mt-1 w-full border rounded px-3 py-2">
                </div>

                <div>
                    <label class="block text-sm font-medium">Description</label>
                    <textarea name="description" rows="4" class="mt-1 w-full border rounded px-3 py-2">{{ old('description', $doctor->description) }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="block text-sm font-medium">Current Image:</label><br>
                    @if ($doctor->image)
                        <img src="{{ asset('storage/' . $doctor->image) }}" class="img-thumbnail" width="150">
                    @else
                        <span class="text-muted">No image available</span>
                    @endif
                </div>

                <div class="mb-3">
                    <label class="block text-sm font-medium">Change Image:</label>
                    <input type="file" name="image" class="form-control">
                    <p class="text-xs text-gray-500 mt-1">jpg, jpeg, png, webp, Max 2MB.</p>
                </div>

                <div class="flex items-center gap-3 pt-2">
                    <a href="{{ route('backend.doctor') }}" class="px-4 py-2 rounded border">Cancel</a>
                    <button type="submit" class="px-4 py-2 rounded bg-blue-600 hover:bg-blue-700 text-white">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
