@extends('backend.layout.app')

@section('content')
    <div class="max-w-3xl mx-auto mt-6 px-4">
        <div class="bg-white shadow-lg rounded-lg p-6">
            <h3 class="text-2xl font-bold mb-6 text-gray-800 border-b pb-2">Read Message</h3>

            <!-- Name -->
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-600 mb-1">Name</label>
                <input type="text" value="{{ $message->name }}" readonly
                    class="w-full px-4 py-2 border rounded-lg bg-gray-100 text-gray-700 shadow-sm focus:outline-none cursor-not-allowed">
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-600 mb-1">Email</label>
                <input type="text" value="{{ $message->email }}" readonly
                    class="w-full px-4 py-2 border rounded-lg bg-gray-100 text-gray-700 shadow-sm focus:outline-none cursor-not-allowed">
            </div>

            <!-- Subject -->
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-600 mb-1">Subject</label>
                <input type="text" value="{{ $message->subject }}" readonly
                    class="w-full px-4 py-2 border rounded-lg bg-gray-100 text-gray-700 shadow-sm focus:outline-none cursor-not-allowed">
            </div>

            <!-- Message -->
            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-600 mb-1">Message</label>
                <textarea rows="6" readonly
                    class="w-full px-4 py-2 border rounded-lg bg-gray-100 text-gray-700 shadow-sm resize-none focus:outline-none cursor-not-allowed">{{ $message->message }}</textarea>
            </div>

            <!-- Back Button -->
            <div class="flex justify-end">
                <a href="{{ route('backend.message') }}"
                    class="px-5 py-2 bg-gray-700 hover:bg-gray-800 text-white rounded-lg shadow transition">
                    Back
                </a>
            </div>
        </div>
    </div>
@endsection
