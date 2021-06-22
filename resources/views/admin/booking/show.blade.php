@extends('layouts.admin.app')
@section('title', 'Booking')
@section('booking', 'active')
@section('content')
    <?php $customer = $booking_detail->customer; ?>
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
                                                    <span>{{ $booking_detail->no_of_rooms }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-bordered">
                                        <thead>
                                            <th>Room No</th>
                                            <th>Room Name</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($booking_detail->booking_rooms as $booking_room)
                                                <tr>
                                                    <td>{{ $booking_room->room->room_no }}</td>
                                                    <td>{{ $booking_room->room->name }}</td>
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

