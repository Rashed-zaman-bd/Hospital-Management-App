@extends('backend.layout.app')

@section('content')
    <div class="p-4">
        <div class="bg-white shadow-lg rounded-2xl overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                <h2 class="text-xl font-semibold text-gray-800">Messages</h2>
                <span class="text-sm text-gray-500">Total: {{ count($messages) }}</span>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600 uppercase">No</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600 uppercase">Name</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600 uppercase">Email</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600 uppercase">Subject</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600 uppercase">Message</th>
                            <th class="px-6 py-3 text-center text-sm font-semibold text-gray-600 uppercase">Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @foreach ($messages as $key => $message)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 text-sm text-gray-700">{{ $key + 1 }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700">{{ $message->name }}</td>
                                <td class="px-6 py-4 text-sm text-blue-600">{{ $message->email }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700">{{ $message->subject }}</td>
                                <td class="px-6 py-4 text-sm text-gray-500">
                                    {{ substr($message->message, 0, 50) }}...
                                </td>
                                <td class="px-6 py-4 flex justify-center space-x-2">
                                    <a href="{{ route('backend.message.show', $message->id) }}"
                                        class="px-3 py-1 text-sm bg-blue-500 hover:bg-blue-600 text-white rounded-lg shadow transition">
                                        Read
                                    </a>
                                    <form action="{{ route('delete.message', $message->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="px-3 py-1 text-sm bg-red-500 hover:bg-red-600 text-white rounded-lg shadow transition">
                                            Delete
                                        </button>
                                    </form>
                                    <button
                                        class="px-3 py-1 text-sm bg-green-500 hover:bg-green-600 text-white rounded-lg shadow transition">
                                        Reply
                                    </button>
                                </td>
                            </tr>
                        @endforeach

                        @if ($messages->isEmpty())
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                    No messages found.
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            {{-- Pagination (if needed) --}}
            <div class="px-6 py-4 border-t border-gray-200">

            </div>
        </div>
    </div>
@endsection
