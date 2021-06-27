@extends('layouts.admin.app')
@section('title', 'Booking')
@section('booking', 'active')
@section('content')
    <?php 
    $customer = $booking_detail->customer;
    $status = $booking_detail->status;
    ?>
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
                            <div class="card-title float-right">
                                <a href="{{ route('admin.booking.index') }}" class="btn btn-primary float-right"><i
                                        class="fa fa-arrow-left iCheck"></i>&nbsp;Back to List</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <h3><u>{{ strtoupper('Customer Details') }}</u></h3>
                            <input type="hidden" class="form-control" name="customer_id" id="client_id">
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
                                                    <label for="identity_no">Citizenship No:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <span>{{ $customer->identity_no }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="driving_license_no">Driving License No:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <span>{{ $customer->driving_license_no }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <h3><u>{{ strtoupper('Booking Details') }}</u></h3>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="arrival_date">Arrival Date:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <span>
                                                        {{ $booking_detail->nepali_arrival_date ? $booking_detail->nepali_arrival_date : $booking_detail->arrival_date }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="arrival_time">Arrival Time:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <span>{{ date('h:i a', strtotime($booking_detail->arrival_time)) }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="purpose">Purpose:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <span>{{ $booking_detail->purpose }}</span>
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
                                                    <label for="departure_date">Departure Date:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <span>{{ $booking_detail->nepali_departure_date ? $booking_detail->nepali_departure_date : ($booking_detail->departure_date ? $booking_detail->departure_date : ucwords('not available')) }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="departure_time">Departure Time:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <span>{{ $booking_detail->departure_time != null ? date('h:i a', strtotime($booking_detail->departure_time)) : '00:00' }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="remarks">Remarks:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <span>{{ $booking_detail->remarks }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <h3><u>{{ strtoupper('Payment Detail') }}</u></h3>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="total_amount">Total Amount:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <span>
                                                        {{ $booking_detail->total }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="paid">Paid Amount:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <span>{{ $booking_detail->paid }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="change">Change:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <span>{{ $booking_detail->change_amount }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="due">Due:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <span>{{ $booking_detail->due }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            <h3><u>{{ strtoupper('Room Details') }}</u></h3>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="no_of_room">No of Rooms:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <span>{{ count($booking_detail->booking_rooms) }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @include('admin.partial.room.createModal')
                            <div class="row">
                                <div class="col-md-12">
                                    @if($status == 1)
                                    <div class="float-right mb-1">
                                        {{-- <button type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#createRoomModal" data-target-id="{{ $booking_detail->id }}">
                                            Add Room
                                        </button> --}}
                                        <a href="{{ route('admin.booking_room.getForm', $booking_detail->id) }}" class="btn btn-primary">
                                        Add Room
                                        </a>
                                    </div>
                                    @endif
                                    <table class="table table-bordered">
                                        <thead>
                                            <th>Room No</th>
                                            <th>Room Name</th>
                                            <th>Price</th>
                                            <th>Discount</th>
                                            <th>Amount</th>
                                            @if($status == 1)
                                            <th>Action</th>
                                            @endif
                                        </thead>
                                        <tbody>
                                            @foreach ($booking_detail->booking_rooms as $booking_room)
                                                <tr>
                                                    <td>{{ $booking_room->room->room_no }}</td>
                                                    <td>{{ $booking_room->room->name }}</td>
                                                    <td>{{ $booking_room->price }}</td>
                                                    <td>{{ $booking_room->discount }}</td>
                                                    <td>{{ $booking_room->amount }}</td>
                                                    @if($status == 1)
                                                    <td>
                                                        <div class="d-inline-flex">
                                                            {{-- <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#editRoomModal" data-target-id="{{ $booking_room->id }}">
                                                                Edit
                                                            </button>&nbsp;&nbsp; --}}
                                                            <a href="{{ route('admin.booking_room.edit', $booking_room->id) }}" class="btn btn-sm btn-primary">
                                                                Edit
                                                            </a>&nbsp;&nbsp;
                                                            <form
                                                                action="{{ route('admin.booking_room.destroy', $booking_room->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-sm btn-danger">
                                                                    Delete
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                    @endif
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            @if (count($booking_detail->relatives) > 0)
                                <h3><u>{{ strtoupper('Relative Details') }}</u></h3>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label for="no_of_room">No of relatives:</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <span>{{ count($booking_detail->relatives) }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @include('admin.partial.room.editModal')
                                <div class="row">
                                    <div class="col-md-12">
                                        @if($status == 1)
                                        <div class="float-right mb-1">
                                            <a href="{{ route('admin.relative.create', $booking_detail->id) }}"
                                                class="btn btn-primary">
                                                Add Relative
                                            </a>
                                        </div>
                                        @endif
                                        <table class="table table-bordered">
                                            <thead>
                                                <th>Name</th>
                                                <th>Phone no</th>
                                                <th>Age</th>
                                                <th>Gender</th>
                                                <th>Relation</th>
                                            
                                                <th>Action</th>
                                                
                                            </thead>
                                            <tbody>
                                                @foreach ($booking_detail->relatives as $relative)
                                                    <tr>
                                                        <td>{{ $relative->full_name }}</td>
                                                        <td>{{ $relative->contact_no }}</td>
                                                        <td>{{ $relative->age }}</td>
                                                        <td>{{ $relative->gender }}</td>
                                                        <td>{{ $relative->relation }}</td>
                                                        
                                                        <td>
                                                            <div class="d-inline-flex">
                                                                @if($status == 1)
                                                                <a href="{{ route('admin.relative.edit', $relative->id) }}"
                                                                    class="btn btn-sm btn-primary">Edit</a>&nbsp;&nbsp;
                                                                @endif
                                                                <a href="{{ route('admin.customer.show', $relative->id) }}"
                                                                    class="btn btn-sm btn-primary">
                                                                    View Detail
                                                                </a>&nbsp;&nbsp;
                                                                @if($status == 1)
                                                                <form
                                                                    action="{{ route('admin.relative.destroy', $relative->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                                        Delete
                                                                    </button>
                                                                </form>
                                                                @endif
                                                            </div>
                                                        </td>
                                                        
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @endif
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
            $("#createRoomModal").on("show.bs.modal", function(e) {
                var id = $(e.relatedTarget).data("target-id");
                var url = "{{ route('admin.booking_room.getForm', ':id') }}",
                    url = url.replace(":id", id);
                $.get(url, function(data) {
                    $(".modal-body").html(data);
                });
            });

            $("#createRoomModal").on('hidden.bs.modal', function() {
                $(this).find('form')[0].reset();
                $('.require').css('display', 'none');
            });


            $("#editRoomModal").on("show.bs.modal", function(e) {
                var id = $(e.relatedTarget).data("target-id");
                console.log(id);
                var url = "{{ route('admin.booking_room.edit', ':id') }}",
                    url = url.replace(":id", id);
                $.get(url, function(data) {
                    $(".modal-body").html(data);
                });
            });

            $("#editRoomModal").on('hidden.bs.modal', function() {
                $(this).find('form')[0].reset();
                $('.require').css('display', 'none');
            });
        });

        $("#saveRoom").on("click", function(e){
            $('.require').css('display', 'none');
            e.preventDefault();
            var formData = $('#roomForm').serialize();
            // var formData = new FormData($('#roomForm')[0]);
            console.log(formData);
            var action = $("#roomForm").attr('action');
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
                        $("#createRoomModal").modal('hide');
                        location.reload();
                        toastr.success(data.msg);

                    }

                }
            });
        });


        $("#editRoom").on("click", function(e){
        
            console.log("Hi");
            $('.require').css('display', 'none');
            e.preventDefault();
            // var formData = new FormData($('#editRoomForm')[0]);
            // console.log(formData);
            var formData = $("#editRoomForm").serialize();
            console.log(formData);
            
            var action = $("#editRoomForm").attr('action');
            $.ajax({
                url: action,
                type: 'post',
                data: formData,
                dataType: 'json',
                // processData: false,
                // contentType: false,
                success: function(data) {
                    if (data.errors) {
                        var error_html = "";
                        $.each(data.errors, function(key, value) {
                            error_html = '<div>' + value + '</div>';
                            $('.' + key).css('display', 'block').css('color', 'red');
                            $('.' + key).html(error_html);
                        });
                    } else {
                        $("#editRoomModal").modal('hide');
                        location.reload();
                        toastr.success(data.msg);

                    }

                }
            });
        });
    </script>
@endsection
