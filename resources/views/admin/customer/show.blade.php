@extends('layouts.admin.app')
@section('title', 'Customer')
@section('customer', 'active')
@section('content')
    <style>
        .profile-img img {
            height: 180px;
            width: 180px;
        }

    </style>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row col-12 mb-2">
                <div class="col-sm-6">
                    <h1>Customer Details</h1>
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
                                <a href="{{ route('admin.customer.index') }}" class="btn btn-primary float-right"><i
                                        class="fa fa-arrow-left iCheck"></i>&nbsp;Back to List</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <h3><u>{{ strtoupper('Customer Details') }}</u></h3>
                            <input type="hidden" class="form-control" name="customer_id" id="client_id">
                            <div class="row">
                                <div class="col-md-10 mb-5">
                                    <div class="profile-img text-center">
                                        <img class="img-circle" src="{{ $customer->getAvatar($customer->profile_pic) }}"
                                            alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="first_name">Name: </label>
                                                </div>
                                                <div class="col-md-8">
                                                    <span>{{ $customer->full_name }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="gender">Gender:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <span>{{ $customer->gender }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="age">Age:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <span>{{ $customer->age }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="nationality">Nationality:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <span>{{ $customer->nationality }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="address">Address:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <span>{{ $customer->address }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="contact_no">Contact No:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <span>{{ $customer->contact_no }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="occupation">Occupation:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <span>{{ $customer->occupation }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="identity">Identity Type:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <span>{{ $customer->identity_type->name }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="identity_no">Identity No:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <span>{{ $customer->identity_no }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="profile_pic">Profile Photo:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <span>
                                                        <img class="imageSize"
                                                            src="{{ $customer->getAvatar($customer->profile_pic) }}"
                                                            alt="">
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="col-md-12">
                                    <div class="heading">
                                        <h3><u>{{ strtoupper('Booking Details') }}</u></h3>
                                    </div>
                                    <table id="BookingDetail" class="table table-responsive-xl">
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
                                                        {{ $bkd->nepali_departure_date ? $bkd->nepali_departure_date : ($bkd->departure_date ? $bkd->departure_date : 'Staying') }}
                                                    </td>
                                                    <td>
                                                        {{ $bkd->departure_time ? getTime($bkd->departure_time) : 'Not available' }}
                                                    </td>
                                                    <td>{{ count($bkd->booking_rooms) }}</td>
                                                    <td>{{ count($bkd->relatives) }}</td>
                                                    <td>
                                                        <div class="d-inline-flex">
                                                            <a href="{{ route('admin.booking.show', $bkd->id) }}"
                                                                class="btn btn-primary btn-sm">
                                                                View Detail
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $("#BookingDetail").DataTable({
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
