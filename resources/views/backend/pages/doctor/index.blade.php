@extends('backend.layout.app')
@section('content')
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    <div class="p-4 overflow-y-hidden">
        <div class="px-6 py-6 border-b border-gray-200 flex items-center justify-between">
            <h2 class="text-xl font-semibold text-gray-800">Doctors</h2>

            <div class="flex items-center gap-3">
                <span class="text-md text-gray-700">Total: {{ count($doctors) }}</span>

                <a href="{{ route('doctor.create') }}"
                    class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-blue-600 hover:bg-blue-700 text-white shadow">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Create
                </a>
            </div>
        </div>

        <div class="overflow-x-auto overflow-y-hidden">
            <table id="doctorsTable" class="min-w-full divide-y divide-gray-200 display">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Image</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Description</th>
                        <th>Speciality</th>
                        <th>Qualification</th>
                        <th>Hospital</th>
                        <th>Location</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($doctors as $key => $doctor)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $doctor->name }}</td>
                            <td>
                                @if ($doctor->image)
                                    <img src="{{ asset('storage/' . $doctor->image) }}"
                                        class="w-32 h-32 object-cover rounded" alt="{{ $doctor->name }}">
                                @else
                                    <img src="https://via.placeholder.com/50" class="w-12 h-12 object-cover rounded"
                                        alt="No Image">
                                @endif
                            </td>

                            <td>{{ $doctor->phone }}</td>
                            <td>{{ $doctor->email }}</td>
                            <td>{{ $doctor->description }}</td>
                            <td>{{ $doctor->speciality }}</td>
                            <td>{{ $doctor->qualification }}</td>
                            <td>{{ $doctor->hospital }}</td>
                            <td>{{ $doctor->location }}</td>
                            <td>
                                <a href="{{ route('doctor.read', $doctor->id) }}"
                                    class="px-3 py-1 bg-blue-500 hover:bg-blue-600 text-white rounded-lg shadow">Read</a>
                                <a href="{{ route('doctor.edit', $doctor->id) }}"
                                    class="px-3 py-1 bg-green-500 hover:bg-green-600 text-white rounded-lg shadow mt-1 block">Edit</a>
                                <form action="{{ route('doctor.delete', $doctor->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="px-3 py-1 bg-red-500 hover:bg-red-600 text-white rounded-lg shadow mt-1 block">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- jQuery + DataTables -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            // Clone header row for filters
            $('#doctorsTable thead tr')
                .clone(true)
                .addClass('filters')
                .appendTo('#doctorsTable thead');

            let table = $('#doctorsTable').DataTable({
                pageLength: 10,
                lengthMenu: [5, 10, 25, 50],
                order: [],
                ordering: true,
                columnDefs: [{
                    orderable: false,
                    targets: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9,
                        10
                    ] // disable sorting for No, Image, Description, Qualification, Action
                }],
                initComplete: function() {
                    this.api().columns().every(function(i) {
                        let column = this;
                        let cell = $('.filters th').eq(i);

                        // Skip filter for Image & Action columns
                        if ([0, 2, 5, 7, 10].includes(i)) {
                            cell.html('');
                            return;
                        }

                        let select = $(
                                '<select class="border px-2 py-1 rounded w-full"><option value="">All</option></select>'
                            )
                            .appendTo(cell.empty())
                            .on('change', function() {
                                let val = $.fn.dataTable.util.escapeRegex($(this).val());
                                column.search(val ? '^' + val + '$' : '', true, false)
                                    .draw();
                            });

                        // Populate unique values
                        column.data().unique().sort().each(function(d) {
                            if (d) select.append('<option value="' + d + '">' + d +
                                '</option>')
                        });
                    });
                }
            });
        });
    </script>
@endsection
