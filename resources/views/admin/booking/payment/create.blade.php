@extends('layouts.admin.app')
@section('title', 'Booking')
@section('booking', 'active')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/gif.css') }}">
@endsection
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row col-12 mb-2">
                <div class="col-sm-6">
                    <h1>Add Payment</h1>
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
                                <a href="{{ route("admin.booking.index") }}" class="btn btn-primary">
                                    <i class="fa fa-arrow-left"></i>&nbsp;Back to List
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route("admin.booking.payment.store", $booking_detail->id) }}" method="POST" id="paymentForm">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label for="customer">Customer Name</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" value="{{ $booking_detail->customer->full_name }}"
                                                            class="form-control" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label for="payment_date">Payment Date</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" name="date" value="{{ old('date') }}"
                                                            class="form-control @error('date') is-invalid @enderror date"
                                                            readonly>
                                                        @error('date')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label for="grand_total">Grand Total</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" value="{{ $booking_detail->total }}"
                                                            name="grand_total" class="form-control" readonly>
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
                                                        <label for="paid_amount">Paid Amount</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" name="paid_amount"
                                                             class="form-control" value="{{ $booking_detail->totalPaid() }}"
                                                            id="paid" readonly>
                                                        @error('paid_amount')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label for="last_due_amount">Last Due Amount</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" name="last_due" value="{{ $booking_detail->lastDue() }}"
                                                             class="form-control"
                                                            id="last_due" readonly>
                                                        @error('last_due')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label for="payment_type">Payment Type</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <select name="payment_type"
                                                            class="form-control @error('payment_type') is-invalid @enderror"
                                                            id="payment_type">
                                                            <option value="">Select Payment Type</option>
                                                            <option value="Full Payment"
                                                                {{ old('payment_type') == 'Full Payment' ? 'selected' : '' }}>
                                                                Full Payment</option>
                                                            <option value="Partial Payment"
                                                                {{ old('payment_type') == 'Partial Payment' ? 'selected' : '' }}>
                                                                Partial Payment</option>
                                                        </select>
                                                        @error('payment_type')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group d-none" id="addPay">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label for="add_payment">Add Payment</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" name="add_payment" class="form-control"
                                                            id="add_payment" value="{{ old('add_payment') }}"
                                                            onkeyup="addPayment();">
                                                        @error('add_payment')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group d-none" id="dueAmount">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label for="due">Due Amount</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" name="due" value="{{ old('due') }}"
                                                            class="form-control" readonly id="due">
                                                        @error('due')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary float-right"
                                    >
                                    Submit
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.date').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
                todayBtn: true,
                todayHighlight: true,
            });
            var payment_type = $("#payment_type");
            $(payment_type).on('change', () => {
                if ($(payment_type).val() == "Full Payment") {
                    $("#dueAmount").removeClass('d-none');
                    $("#addPay").addClass('d-none');
                    $("#add_payment").val(0.00);
                    $("#due").val(0.00);
                } else if ($(payment_type).val() == "Partial Payment") {
                    $("#dueAmount").removeClass('d-none');
                    $("#addPay").removeClass('d-none');
                    $("#due").val($("#last_due").val());
                } else {
                    $("#dueAmount").addClass('d-none');
                    $("#addPay").addClass('d-none');
                }
            });


            @if (old('payment_type') == 'Full Payment') {
                $("#dueAmount").removeClass('d-none');
                $("#addPay").addClass('d-none');
            
            } @elseif (old('payment_type') == "Partial Payment") {
                $("#dueAmount").removeClass('d-none');
                $("#addPay").removeClass('d-none');
            
            } @else {
                $("#dueAmount").addClass('d-none');
                $("#addPay").addClass('d-none');
                }
            @endif
        });

        function addPayment() {
            var last_due_amount = $("#last_due").val();
            var paid_amount = $("#add_payment");
            var due_amount = last_due_amount - $(paid_amount).val();
            if (due_amount < 0) {
                $.alert({
                    title: 'Alert!',
                    icon: 'fa fa-warning',
                    content: 'Paid amount exceeds due amount',
                });
                $(paid_amount).val(0.00);
                $("#due").val(last_due_amount);
            } else {
                $("#due").val(due_amount);
            }
        }

        $("#paymentForm").validate({
            rules: {
                date: "required",
                payment_type: "required",
                add_payment: {
                    required: function(element){
                        return $("#payment_type").val() == "Partial Payment";
                    },
                    digits: true,
                }
            }
        });

    </script>
@endsection
