@extends('layouts.admin.app')
@section('title', 'Order Payment')
@section('payment', 'active')
@section('styles')
<link rel="stylesheet" href="{{ asset('css/datepicker.min.css') }}">
@endsection
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row col-12 mb-2">
                <div class="col-sm-6">
                    <h1>Order Payment</h1>
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
                                <a href="{{ route('admin.order.index') }}" class="btn btn-primary"><i
                                        class="fa fa-arrow-left iCheck"></i>&nbsp;Back to List</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="#" method="POST" enctype="multipart/form-data" id="form">
                                @csrf
                                <div class="col-md-6">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label for="room_no">Room&nbsp;<span class="req">*</span></label>
                                                </div>
                                                <div class="col-md-6">
                                                    <select name="room_id" class="form-control" id="room"
                                                        onchange="onChangeRoom($(this)); getRoomAmount($(this));">
                                                        <option value="">Select Room</option>
                                                        @foreach ($rooms as $key => $room)
                                                            <option value="{{ $room->id }}" data-price = "{{ $room->totalAmount() }}"
                                                                {{ $room->id == old('room_id') ? 'selected' : '' }}>
                                                                {{ $room->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('room_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-3">
                                                    <span><strong>Rs.&nbsp;</strong><b class="room_amount">0.00</b></span>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" class="form-control" value="{{ old('booking_id') }}"
                                            name="booking_id" id="bookId">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label for="customer">Customer&nbsp;<span class="req">*</span></label>
                                                </div>
                                                <div class="col-md-6">
                                                    <select name="customer_id" class="form-control" id="customer">
                                                        <option value="">Select Customer</option>
                                                    </select>
                                                    @error('customer_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-3">
                                                    <span><strong>Rs.</strong><b class="customer_amount">0.00</b></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label for="amount">Add Amount</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="text" name="amount" value="{{ old('amount') }}"
                                                        class="form-control" onpaste="return onpasteString(event);"
                                                        onkeypress="return onlynumbers(event);"
                                                        onkeyup="onPaid($(this)); return onlynumbers(event);">
                                                    @error('paid_amount')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label for="pay_date">Payment Date</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="text" name="payment_date" class="form-control"
                                                        value="{{ old('payment_date') }}" id="pay_date" readonly>
                                                    @error('payment_date')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button class="btn btn-primary" type="submit" id="formSubmit">Submit</button>
                                </div>
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
        $(function() {
            $("#pay_date").datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
                todayHighlight: true,
                todayBtn: 'linked',
                clearBtn: true,
            });

            // @if (old('supplier_id') != '')
            //     var amount = $("#supplier option:selected").data('price');
            //     $(".supplier_amount").html(amount.toFixed(2));
            // @else
            //     var amount = 0;
            //     $(".supplier_amount").html(amount.toFixed(2));
            //     @endif

        });

        $(document).ready(function(){
            @if(old("room_id") != '')
            var room_id = $("#room").val();
            var old_customer_id = "{{ old("customer_id") }}";
            console.log(old_customer_id);
            if(room_id) {
                $.ajax({
                    url: "{{ route('admin.getRoomCustomer') }}",
                    type: "POST",
                    data: {
                        "room_id": room_id
                    },
                    dataType: "json",
                    success: function(data) {
                        $("#customer").html("<option value=''>Select Customer</option>");
                        $("#bookId").val(data.booking_id);
                        $.each(data.customers, function(key, customer) {
                            var $options = $('<option></option>').val(customer.id).html(customer
                                .full_name);
                            if(customer.id == old_customer_id)
                                $options = $options.attr("selected", "selected");
                            
                            $("#customer").append($options);
                        });
                    }
                });
            } else {
                $("#customer").html("<option value=''>Select Customer</option>");
                $("#bookId").val('');
            }
            @endif
        });

        function onChangeRoom(room) {
            let room_id = $(room).val();
            if (room_id) {
                $.ajax({
                    url: "{{ route('admin.getRoomCustomer') }}",
                    type: "POST",
                    data: {
                        "room_id": room_id
                    },
                    dataType: "json",
                    success: function(data) {
                        $("#customer").html("<option value=''>Select Customer</option>");
                        $("#bookId").val(data.booking_id);
                        $.each(data.customers, function(key, customer) {
                            let $options = $('<option></option>').val(customer.id).html(customer
                                .full_name);
                            $("#customer").append($options);
                        });
                    }
                });
            } else {
                $("#customer").html("<option value=''>Select Customer</option>");
                $("#bookId").val('');
            }
        }


        function getRoomAmount(room) {
            // $('option:selected',this); // get selected option value
            // $('option:selected',this).attr('value'); //get selected  option attribute value
            // $('option:selected',this).text(); // get selected option text
            if ($(room).val() != '') {
                var amount = $('option:selected', room).data('price');
                // let amount = $(supplier).find('option:selected').data('price'); //working code
            } else {
                var amount = 0;
            }
            $(".room_amount").html(amount.toFixed(2));
        }

        function onPaid(amount) {
            let paid_amount = $(amount).val(),
                due_amount = $(".supplier_amount").html();
            if ($("#supplier").val() != '') {
                if ((due_amount - paid_amount) < 0) {
                    $.alert({
                        title: 'Alert !',
                        content: 'Amount is greater than due amount',
                    });
                    $(amount).val('');
                }
            } else {
                $.alert({
                    title: 'Alert !',
                    content: 'Select Supplier First',
                });
                $(amount).val('');
            }


        }

        $('#form').validate({
            rules: {
                room_id: "required",
                amount: {
                    required: true,
                    number: true,
                },
                payment_date: {
                    required: true,
                },

            },
            messages: {
                room_id: "Select Room",
                amount: {
                    required: "Amount is required",
                    number: "Amount must be valid price",
                },
                payment_date: {
                    required: "Payment date is required",
                }
            },
            submitHandler: function(form) {
                form.submit();
            }
        });
    </script>
@endsection
