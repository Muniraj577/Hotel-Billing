@extends('layouts.admin.app')
@section('title', 'Booking')
@section('booking', 'active')
@section('styles')
<style>

    .dropdown-menu a:not([href]){
        cursor: pointer !important;
        color: #212529 !important;
    }
    .dropdown-menu a:not([href]):hover{
        color: #212529 !important;
    }

</style>
@endsection
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row col-12 mb-2">
                <div class="col-sm-6">
                    <h1>All Bookings</h1>
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
                                <a href="{{ route('admin.booking.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus"></i> Add Booking
                                </a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">

                            <table id="BookingDetail" class="table text-center">
                                <thead>
                                    <tr>
                                        <th>S.N</th>
                                        <th>Customer</th>
                                        <th>Arrival Date</th>
                                        <th>Arrival Time</th>
                                        <th>Departure Date</th>
                                        <th>Departure Time</th>
                                        <th>No of rooms</th>
                                        <th>Status</th>
                                        <th class="hidden">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($booking_details as $key => $booking_detail)
                                        @php($status = $booking_detail->status)
                                            <tr>
                                                <td>{{ ++$id }}</td>

                                                <td>{{ $booking_detail->customer != null ? $booking_detail->customer->full_name : '' }}
                                                </td>
                                                <td>
                                                    {{ $booking_detail->nepali_arrival_date ? $booking_detail->nepali_arrival_date : $booking_detail->arrival_date }}
                                                </td>
                                                <td>
                                                    {{ $booking_detail->arrival_time != null ? date('h:i a', strtotime($booking_detail->arrival_time)) : '' }}
                                                </td>
                                                <td>
                                                    {{ $booking_detail->nepali_departure_date ? $booking_detail->nepali_departure_date : ($booking_detail->departure_date ? $booking_detail->departure_date : ucwords('Not available')) }}
                                                </td>
                                                <td>
                                                    {{ $booking_detail->departure_time != null ? date('h:i a', strtotime($booking_detail->departure_time)) : 'Not Available' }}
                                                </td>
                                                <td>{{ $booking_detail->no_of_rooms }}</td>
                                                <td>{{ $booking_detail->status == 1 ? 'Active' : 'Inactive' }}</td>
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
                                                                href="{{ route('admin.booking.show', $booking_detail->id) }}"><i
                                                                    class='fa fa-eye iCheck'></i>&nbsp;View Booking Detail</a>
                                                            <a class="dropdown-item" @if ($status == 1) href="{{ route('admin.booking.edit', $booking_detail->id) }}"@else onclick="alertWarning();" @endif>
                                                                <i class="fa fa-edit iCheck"></i>&nbsp;Edit Booking Detail</a>
                                                            <button class="dropdown-item" type="button" data-toggle="modal"
                                                                data-target="#departureModal"
                                                                data-target-id="{{ $booking_detail->id }}">
                                                                <i class="fa fa-edit"></i>Update Departure
                                                            </button>


                                                            {{-- <button class='dropdown-item' onclick='alertPayMessage();'><i class='far fa-money-bill-alt iCheck'></i>&nbsp;Add Payment</button> --}}
                                                        </div>
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
                {{-- Model Section --}}
                <div>
                    <!-- Modal -->
                    <div class="modal fade" id="departureModal" tabindex="-1" role="dialog"
                        aria-labelledby="departureModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="departureModalLabel">Modal title</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary" id="updateDeparture">Save changes</button>
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

        $(document).ready(function() {
            $("#departureModal").on("show.bs.modal", function(e) {
                console.log($(e.relatedTarget));
                var id = $(e.relatedTarget).data("target-id");
                console.log(id);
                var url = "{{ route('admin.booking.getDepartureModel', ':id') }}",
                    url = url.replace(":id", id);
                $.get(url, function(data) {
                    $(".modal-body").html(data);
                });
            });

            $("#departureModal").on('hidden.bs.modal', function() {
                $(this).find('form')[0].reset();
                $('.require').css('display', 'none');
            });

        });

        $("#updateDeparture").on('click', function(e) {
            $('.require').css('display', 'none');
            e.preventDefault();
            var formData = new FormData($('#departureForm')[0]);
            var action = $("#departureForm").attr('action');
            $.ajax({
                url: action,
                type: 'post',
                data: formData,
                dataType: 'json',
                processData: false,
                contentType: false,
                success: function(data) {
                    if (data.errors) {
                        var error_html = "";
                        $.each(data.errors, function(key, value) {
                            error_html = '<div>' + value + '</div>';
                            $('.' + key).css('display', 'block').css('color', 'red');
                            $('.' + key).html(error_html);
                        });
                    } else {
                        $("#departureModal").modal('hide');
                        location.reload();
                        toastr.success("Departure updated");

                    }

                }
            });
        });

        function alertWarning()
        {
            $.alert({
                title: "Alert !",
                content: "The booking is inactive. You are not allowed to edit this.",
                icon: "fa fa-exclamation-triangle",
                theme: "modern",
                
            });
        }
    </script>
@endsection
