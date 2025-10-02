@extends('backend.layout.app')

@section('content')
    <div class="p-6 max-w-3xl mx-auto">
        <div class="bg-white shadow rounded-2xl p-6">
            <h1 class="text-2xl font-semibold mb-4">Doctor Details</h1>

            @if ($errors->any())
                <div class="mb-4 rounded bg-red-50 text-red-700 p-3">
                    <ul class="list-disc ml-5">
                        @foreach ($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-sm font-medium">Name *</label>
                    <input name="name" value="{{ $doctor->name }}" class="mt-1 w-full border rounded px-3 py-2" readonly>
                </div>

                <div>
                    <label class="block text-sm font-medium">Phone</label>
                    <input name="phone" value="{{ $doctor->phone }}" class="mt-1 w-full border rounded px-3 py-2"
                        readonly>
                </div>

                <div>
                    <label class="block text-sm font-medium">Email</label>
                    <input type="email" name="email" value="{{ $doctor->email }}"
                        class="mt-1 w-full border rounded px-3 py-2" readonly>
                </div>

                <div>
                    <label class="block text-sm font-medium">Speciality</label>
                    <input name="speciality" value="{{ $doctor->speciality ? $doctor->speciality->name : 'N/A' }}"
                        class="mt-1 w-full border rounded px-3 py-2" readonly>
                </div>

                <div>
                    <label class="block text-sm font-medium">Qualification</label>
                    <input name="qualification" value="{{ $doctor->qualification }}"
                        class="mt-1 w-full border rounded px-3 py-2" readonly>
                </div>

                <div>
                    <label class="block text-sm font-medium">Hospital</label>
                    <input name="hospital" value="{{ $doctor->hospital ? $doctor->hospital->name : 'N/A' }}"
                        class="mt-1 w-full border rounded px-3 py-2" readonly>
                </div>

                <div>
                    <label class="block text-sm font-medium">Location</label>
                    <input name="location" value="{{ $doctor->location }}" class="mt-1 w-full border rounded px-3 py-2"
                        readonly>
                </div>

                <div>
                    <label class="block text-sm font-medium">Description</label>
                    <textarea name="description" rows="4" class="mt-1 w-full border rounded px-3 py-2" readonly>{{ $doctor->description }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium">Image</label>
                    @if ($doctor->image)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $doctor->image) }}" alt="{{ $doctor->name }}"
                                class="w-36 h-36 object-cover rounded">
                        </div>
                    @else
                        <p class="text-gray-500">No image available</p>
                    @endif
                </div>

                <div class="flex items-center gap-3 pt-2">
                    <a href="{{ route('backend.doctor') }}" class="px-4 py-2 rounded border">Back</a>
                </div>
            </form>
        </div>
    </div>
@endsection
