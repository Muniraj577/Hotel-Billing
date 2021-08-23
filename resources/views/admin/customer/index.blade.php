@extends('layouts.admin.app')
@section('title', 'Customer')
@section('customer', 'active')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row col-12 mb-2">
                <div class="col-sm-6">
                    <h1>All Customers</h1>
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
                            <div class="card-title float-right">
                                <span class="btn btn-primary">
                                    <i class="fa fa-th-list iCheck"></i> Customers
                                </span>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">

                            <table id="Customer" class="table table-responsive-xl text-center">
                                <thead>
                                    <tr>
                                        <th>S.N</th>
                                        <th>Name</th>
                                        <th>Address</th>
                                        <th>Contact No</th>
                                        <th>Gender</th>
                                        <th>Age</th>
                                        <th>Citizenship</th>
                                        <th>Nationality</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($customers as $key => $customer)

                                        <tr>
                                            <td>{{ ++$id }}</td>
                                            <td>{{ $customer->full_name }}</td>
                                            <td>{{ $customer->address }}</td>
                                            <td>{{ $customer->contact_no }}</td>
                                            <td>{{ $customer->gender }}</td>
                                            <td>{{ $customer->age }}</td>
                                            <td>{{ $customer->identity_no }}</td>
                                            <td>{{ $customer->nationality }}</td>
                                            <td>
                                                <div class='dropdown action_dropdown'>
                                                    <button class='action_button btn dropdown-toggle' type='button'
                                                        id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true'
                                                        aria-expanded='false'>
                                                        Action
                                                    </button>
                                                    <div class='dropdown-menu dropdown-menu-right'
                                                        aria-labelledby='dropdownMenuButton'>
                                                        <a class='dropdown-item'
                                                            href="{{ route('admin.customer.show', $customer->id) }}"><i
                                                                class='fa fa-eye iCheck'></i>&nbsp;View Detail</a>
                                                        <a class="dropdown-item"
                                                            href="{{ route('admin.customer.booking.detail', $customer->id) }}">
                                                            <i class="fa fa-eye iCheck"></i>&nbsp;View Booking Details</a>
                                                        
                                                    </div>
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
                "responsive": false,
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
                        extend: 'colvis',
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
