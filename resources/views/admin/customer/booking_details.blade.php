@extends('layouts.admin.app')
@section('title', 'Customer')
@section('customer', 'active')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row col-12 mb-2">
                <div class="col-sm-6">
                    <h1>Booking Details</h1>
                </div>

            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-12">
                                    <h5>All Booking Details of {{ $customer->full_name }}</h5>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">

                            <table id="Customer" class="table text-center">
                                <thead>
                                    <tr>
                                        <th>S.N</th>
                                        <th>Arrival Date</th>
                                        <th>Arrival Time</th>
                                        <th>Departure Date</th>
                                        <th>Departure Time</th>
                                        <th>No of Rooms</th>
                                        <th>No of relatives</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($customer->booking_details as $key => $bkd)

                                        <tr>
                                            <td>{{ ++$id }}</td>
                                            <td>
                                                {{ $bkd->nepali_arrival_date ? $bkd->nepali_arrival_date : $bkd->arrival_date }}
                                            </td>
                                            <td>{{ getTime($bkd->arrival_time) }}</td>
                                            <td>
                                                {{ $bkd->nepali_departure_date ? $bkd->nepali_departure_date : ($bkd->departure_date ? $bkd->departure_date : "Staying") }}
                                            </td>
                                            <td>
                                                {{ $bkd->departure_time ? getTime($bkd->departure_time) : "Not available" }}
                                            </td>
                                            <td>{{ count($bkd->booking_rooms) }}</td>
                                            <td>{{ count($bkd->relatives) }}</td>
                                            <td>
                                                <div class="d-inline-flex">
                                                    <a href="{{ route("admin.booking.show", $bkd->id) }}" class="btn btn-primary btn-sm">
                                                        View Detail
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')

    <script>
        $(document).ready(function() {
            $("#Customer").DataTable({
                "responsive": true,
                "lengthChange": true,
                "autoWidth": false,
                "dom": 'lBfrtip',
                "buttons": [{
                        extend: 'collection',
                        text: "<i class='fa fa-ellipsis-v'></i>",
                        buttons: [{
                                extend: 'copy',
                                exportOptions: {
                                    columns: 'th:not(:last-child)'
                                }
                            },
                            {
                                extend: 'csv',

                                exportOptions: {
                                    columns: 'th:not(:last-child)'
                                }
                            },
                            {
                                extend: 'excel',

                                exportOptions: {
                                    columns: 'th:not(:last-child)'
                                }
                            },
                            {
                                extend: 'pdf',

                                exportOptions: {
                                    columns: 'th:not(:last-child)'
                                }
                            },
                            {
                                extend: 'print',

                                exportOptions: {
                                    columns: 'th:not(:last-child)'
                                },

                            },
                        ],

                    },
                    {
                       extend:'colvis',
                       columns: ':not(.hidden)' 
                    }
                ],
                "language": {
                    "infoEmpty": "No entries to show",
                    "emptyTable": "No data available",
                    "zeroRecords": "No records to display",
                }
            });
            dataTablePosition();
        });

    </script>
@endsection
