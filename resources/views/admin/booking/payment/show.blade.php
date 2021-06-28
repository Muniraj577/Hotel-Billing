@extends('layouts.admin.app')
@section('title', 'Booking')
@section('booking', 'active')
@section('styles')

@endsection
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row col-12 mb-2">
                <div class="col-sm-6">
                    <h1>View Payments</h1>
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
                            <div class="card-title">
                            <h5>Payment Details</h5>
                            </div>
                        </div>
                        <div class="card-body">
                            <h6><strong>Grand Total : {{ $booking_detail->total }}</strong></h6>
                            <table class="table table-bordered">
                                <thead>
                                    <th>Date</th>
                                    <th>Paid Amount</th>
                                    <th>Due Amount</th>
                                    <th>Status</th>
                                </thead>
                                <tbody>
                                    @foreach($booking_detail->payments as $payment)
                                        <tr>
                                            <td>{{ $payment->date }}</td>
                                            <td>{{ $payment->paid }}</td>
                                            <td>{{ $payment->due }}</td>
                                            <td>{{ $payment->type }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <th>Total</th>
                                    <th>{{ $booking_detail->totalPaid() }}</th>
                                    <th>{{ $booking_detail->lastDue() }}</th>
                                    <th>Payment Clear <i class="fa fa-check-circle"></i></th>
                                </tfoot>
                            </table>
                            @if($booking_detail->totalPaid() != $booking_detail->total)
                            <div class="mt-3">
                                <a href="{{ route('admin.booking.payment.create', $booking_detail->id) }}" class="btn btn-primary float-right">Add Payment</a>
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


@endsection
