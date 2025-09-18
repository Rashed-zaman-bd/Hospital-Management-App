@extends('backend.layout.app')
@section('content')
    <div class="card radius-10 shadow-md bg-white">
        <div class="card-header flex items-center justify-between px-4 py-3 border-b">
            <h6 class="mb-0 font-bold text-lg">Recent Appointments</h6>
        </div>
        <div class="card-body overflow-x-auto">
            <table id="appointmentTable" class="table-auto w-full text-left border-collapse">
                <thead>

                    <tr>
                        <th>Sl. No</th>
                        <th>Doctor Name</th>
                        <th>Department</th>
                        <th>Hospital Name</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Doctor Fee</th>
                        <th>Patient ID</th>
                        <th>Patient Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    <!-- 👇 Add this row for filters -->
                    <tr class="filters">
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>


                </thead>
                <tbody>
                    @foreach ($appointments as $key => $appointment)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $appointment->doctor_name }}</td>
                            <td>{{ $appointment->speciality }}</td>
                            <td>{{ $appointment->hospital_name }}</td>
                            <td>{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d/m/Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('H:i') }}</td>
                            <td>{{ $appointment->doctor_fee }}</td>
                            <td>{{ $appointment->appointment_code }}</td>
                            <td>{{ $appointment->patient_name }}</td>
                            <td>{{ $appointment->patient_phone }}</td>
                            <td>{{ $appointment->patient_email }}</td>
                            <td>{{ $appointment->status }}</td>
                            <td>
                                <a href="{{ route('appointments.complete', $appointment->id) }}"
                                    class="px-3 py-1 bg-blue-500 hover:bg-blue-600 text-white rounded-lg shadow">Complete</a>
                                <form action="{{ route('delete.appointment', $appointment->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="px-3 py-1 bg-red-500 hover:bg-red-600 text-white rounded-lg shadow mt-1 block">Cancel</button>
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
            let table = $('#appointmentTable').DataTable({
                pageLength: 10,
                lengthMenu: [5, 10, 25, 50],
                orderCellsTop: true,
                fixedHeader: true,
                initComplete: function() {
                    let api = this.api();

                    api.columns().every(function(index) {
                        // skip first and last column
                        if (index === 0 || index === (api.columns().count() - 1)) {
                            return;
                        }

                        let column = this;
                        let th = $('.filters th').eq(index);

                        let select = $(
                                '<select class="border px-2 py-1 rounded w-full"><option value="">All</option></select>'
                            )
                            .appendTo(th.empty())
                            .on('change', function() {
                                let val = $.fn.dataTable.util.escapeRegex($(this).val());
                                column.search(val ? '^' + val + '$' : '', true, false)
                                    .draw();
                            });

                        column.data().unique().sort().each(function(d) {
                            if (d) {
                                select.append('<option value="' + d + '">' + d +
                                    '</option>');
                            }
                        });
                    });
                }
            });
        });
    </script>
@endsection
