@extends('layouts.admin.app')
@section('title', 'Order')
@section('add-order', 'active')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row col-12 mb-2">
                <div class="col-sm-6">
                    <h1>Order</h1>
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
                                                <div class="col-md-4">
                                                    <label for="room_no">Room&nbsp;<span class="req">*</span></label>
                                                </div>
                                                <div class="col-md-8">
                                                    <select name="room_id" class="form-control" id="room"
                                                        onchange="onChangeRoom($(this));">
                                                        <option value="">Select Room</option>
                                                        @foreach ($rooms as $key => $room)
                                                            <option value="{{ $room->id }}"
                                                                {{ $room->id == old('room_id') ? 'selected' : '' }}>
                                                                {{ $room->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" class="form-control" name="booking_id" id="bookId">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="customer">Customer&nbsp;<span class="req">*</span></label>
                                                </div>
                                                <div class="col-md-8">
                                                    <select name="customer_id" class="form-control" id="customer">
                                                        <option value="">Select Customer</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group inputcontainer">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bar-input" id="basic-addon1"><i
                                                    class="fa fa-barcode barcode"></i></span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Search by product name"
                                            id="search_product" value="">
                                        <div class="spinner">
                                            <div class="rect1"></div>
                                            <div class="rect2"></div>
                                            <div class="rect3"></div>
                                            <div class="rect4"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 mt-2">
                                    <table class="table table-bordered">
                                        <thead>
                                            <th>Product Name</th>
                                            <th style="width: 15%">Unit</th>
                                            <th style="width: 15%">Price</th>
                                            <th style="width: 10%">Qty</th>
                                            <th style="width: 15%">Discount</th>
                                            <th style="width: 20%">Amount</th>
                                            <th>Action</th>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>MoMo</td>
                                                <td>Bottle</td>
                                                <td>
                                                    <input type="text" name="price[]" class="form-control price"
                                                        id="price_0" value="120">
                                                </td>
                                                <td>
                                                    <input type="text" name="qty[]" class="form-control qty" id="qty_0"
                                                        value="1">
                                                </td>
                                                <td>
                                                    <input type="text" name="discount[]" class="form-control discount"
                                                        id="discount_0" value="100">
                                                </td>
                                                <td>
                                                    <input type="text" name="amount[]" class="form-control amount"
                                                        id="amount_0" value="20">
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm"><i class="fa fa-trash req"></i></button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
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
    <script>
        $(document).ready(function() {

        });

        var count = 0;

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


        function addRow(count, id) {
            if (id) {
                $.ajax({
                    url: "{{ route('admin.getProductDetails') }}",
                    type: "POST",
                    data: {
                        'product_id': id
                    },
                    dataType: 'json',
                    success: function(resp) {
                        console.log(resp);
                    }
                });
            }
        }


        $("#product_search").autocomplete({
            source: function(data, cb) {
                $.ajax({
                    url: "#",
                    type: "POST",
                    data: {
                        'product_name': data.term
                    },
                    dataType: 'json',
                    autoFocus: true,
                    showHintOnFocus: true,
                    autoSelect: true,
                    selectInitial: true,

                    success: function(res) {
                        if (res.length) {
                            var datas = $.map(res, function(value) {
                                return {
                                    label: value.name + ' -- [' + value.price + '] ',
                                    // value: '',
                                    id: value.id,
                                    item_name: value.name,

                                }
                            });
                        }
                        cb(datas);

                    },
                    error: function() {
                        $('.spinner').hide();
                    },

                });
            },
            search: function(e, ui) {

                $('.spinner').css('display', 'block');



            },
            response: function(e, el) {
                if (el.content == undefined) {} else if (el.content.length == 1) {
                    $(this).data('ui-autocomplete')._trigger('select', 'autocompleteselect', el);
                    $(this).autocomplete("close");

                }
                $('.spinner').hide();

            },

            select: function(e, ui) {
                e.preventDefault();
                if (typeof ui.content != 'undefined') {
                    if (isNaN(ui.content[0].id)) {
                        return;
                    }

                    var item_id = ui.content[0].id;
                } else {

                    var item_id = ui.item.id;
                }
                console.log(item_id);
                addRow(count, item_id);
                count++;
                $("input#product_search").val('');
            },

        });

        $("#product_search").bind('paste', (e) => {
            $("#product_search").autocomplete('search');
        });

        $('#form').validate({
            rules: {
                room_id: "required",
                customer_id: "required",

            },
            messages: {
                room_id: "Select Room",
                customer_id: "Select Customer",
            },
            submitHandler: function(form) {
                form.submit();
            }
        });
    </script>
@endsection
