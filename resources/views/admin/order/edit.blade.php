@extends('layouts.admin.app')
@section('title', 'Order')
@section('add-order', 'active')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/gif.css') }}">
    <style>
        .spinner {
            height: 38px !important;
        }

    </style>
@endsection
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
                            <form action="{{ route('admin.order.update', $order->id) }}" method="POST" enctype="multipart/form-data"
                                id="form">
                                @csrf
                                @method("PUT")
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
                                                                {{ $room->id == old('room_id', $order->room_id) ? 'selected' : '' }}>
                                                                {{ $room->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('room_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" class="form-control" value="{{ $order->booking_id }}"
                                            name="booking_id" id="bookId">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="customer">Customer&nbsp;<span class="req">*</span></label>
                                                </div>
                                                <div class="col-md-8">
                                                    <select name="customer_id" class="form-control" id="customer">
                                                        <option value="">Select Customer</option>
                                                    </select>
                                                    @error('customer_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
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
                                        <tbody id="productRow">
                                            @if (old('product_id') != '')
                                                @include("admin.partial.order.redirectCreate")
                                            @else
                                                <?php $count = 0; ?>
                                                @foreach ($order->order_items as $key => $order_item)
                                                    <?php
                                                    $product = App\Models\Product::where('id', $order_item->product_id)->first();
                                                    $unit = App\Models\Unit::where('id', $product->unit_id)->first();
                                                    ?>
                                                    <tr id="item_{{ $order_item->product_id }}">
                                                        <td>
                                                            {{ $order_item->product->name }}
                                                            <input type="hidden" value="{{ $order_item->product_id }}"
                                                                name="product_id[]" class="form-control product"
                                                                id="product_{{ $order_item->product_id }}" />
                                                            <input type="hidden" name="order_product_id[]" class="form-control" value="{{ $order_item->id }}">
                                                            @error('product_id' . '.' . $key)
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </td>
                                                        <td>
                                                            {{ $order_item->unit->name }}
                                                            <input type="hidden" value="{{ $order_item->unit_id }}"
                                                                name="unit_id[]" class="form-control unit"
                                                                id="unit_{{ $count }}" />
                                                            @error('unit_id' . '.' . $key)
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </td>
                                                        <td>
                                                            <input type="text" name="price[]"
                                                                onchange="onPriceChange($(this));"
                                                                class="form-control price" id="price_{{ $count }}"
                                                                value="{{ $order_item->price }}">
                                                            @error('price' . '.' . $key)
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </td>
                                                        <td>
                                                            <input type="text" name="qty[]" onchange="onQtyChange($(this));"
                                                                value="{{ $order_item->qty }}" class="form-control qty"
                                                                id="qty_{{ $count }}">
                                                            @error('qty' . '.' . $key)
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </td>
                                                        <td>
                                                            <input type="text" name="discount[]"
                                                                value="{{ $order_item->discount }}"
                                                                onkeyup="onEnterDis($(this));"
                                                                onchange="onDiscountChange($(this));"
                                                                class="form-control discount"
                                                                id="discount_{{ $count }}">
                                                            @error('discount' . '.' . $key)
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </td>
                                                        <td>
                                                            <input type="text" name="amount[]"
                                                                value="{{ $order_item->amount }}"
                                                                class="form-control amount"
                                                                id="amount_{{ $count }}" readonly>
                                                            @error('amount' . '.' . $key)
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </td>
                                                        <td>
                                                            <button class="btn btn-sm" onclick="removeRow($(this));"><i
                                                                    class="fa fa-trash req"></i></button>
                                                        </td>
                                                    </tr>
                                                    <?php $count++; ?>
                                                @endforeach
                                                <input type="hidden" class="form-control" value="{{ $count }}"
                                                    id="count">

                                            @endif
                                        </tbody>
                                        <tfoot id="product_footer">
                                            <tr>
                                                <td colspan="5" class="text-right">
                                                    <label>Total</label>
                                                </td>
                                                <td>
                                                    <input type="text" name="total" value="{{ old('total', $order->total) }}"
                                                        class="form-control" id="total" readonly>
                                                    @error('total')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="5" class="text-right">
                                                    <label>Paid Amount</label>
                                                </td>
                                                <td>
                                                    <input type="text" name="paid" onchange="onPaid();"
                                                        value="{{ old('paid', $order->paid) }}" class="form-control" id="paid">
                                                    @error('paid')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="5" class="text-right">
                                                    <label>Due Amount</label>
                                                </td>
                                                <td>
                                                    <input type="text" name="due" class="form-control"
                                                        value="{{ old('due', $order->due) }}" id="due" readonly>
                                                    @error('due')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
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
    <script>
        $(document).ready(function() {
            var trlength = $("#productRow tr").length;
            if (trlength > 0) {
                $("#product_footer").removeClass("d-none");
            } else {
                $("#product_footer").addClass("d-none");
            }

            var order_room_id = $("#room").val();
            var order_customer_id = "{{ $order->customer_id }}";
            if(order_room_id) {
                $.ajax({
                    url: "{{ route('admin.getRoomCustomer') }}",
                    type: "POST",
                    data: {
                        "room_id": order_room_id
                    },
                    dataType: "json",
                    success: function(data) {
                        $("#customer").html("<option value=''>Select Customer</option>");
                        $("#bookId").val(data.booking_id);
                        $.each(data.customers, function(key, customer) {
                            var $options = $('<option></option>').val(customer.id).html(customer
                                .full_name);
                            if(customer.id == order_customer_id)
                                $options = $options.attr("selected", "selected");
                            
                            $("#customer").append($options);
                        });
                    }
                });
            } else {
                $("#customer").html("<option value=''>Select Customer</option>");
                $("#bookId").val('');
            }

        });

        $("#formSubmit").on("click", function(e) {
            var trlength = $("#productRow tr").length;
            if (trlength > 0) {
                $("#form").submit();
            } else {
                alert("Please add product");
                e.preventDefault();
                return false;
            }
        });

        $(document).ready(function(){
            @if(old("product_id") != '')
            var old_room_id = $("#room").val();
            var old_customer_id = "{{ old("customer_id") }}";
            console.log(old_customer_id);
            if(old_room_id) {
                $.ajax({
                    url: "{{ route('admin.getRoomCustomer') }}",
                    type: "POST",
                    data: {
                        "room_id": old_room_id
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

        var count = $("#count").val();

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


        function addRow(count, id) {
            if (!check_same_item(id)) {
                return false;
            }
            if (id) {
                $.ajax({
                    url: "{{ route('admin.getProductDetails') }}",
                    type: "POST",
                    data: {
                        'product_id': id
                    },
                    dataType: 'json',
                    success: function(resp) {
                        let row =
                            `<tr id="item_` + id + `">
                            <td>
                                ` + resp.product.name + `
                                <input type="hidden" value="` + resp.product.id +
                            `" name="product_id[]" class="form-control product" id="product_` + id + `" />
                            </td>
                            <td>
                                ` + resp.unit + `
                                <input type="hidden" value="` + resp.product.unit_id +
                            `" name="unit_id[]" class="form-control unit" id="unit_` + count + `" />
                            </td>
                            <td>
                                <input type="text" name="price[]" onchange="onPriceChange($(this));" class="form-control price"
                                    id="price_` + count + `" value="` + resp.product.price +
                            `">
                            </td>
                            <td>
                                <input type="text" name="qty[]" onchange="onQtyChange($(this));" class="form-control qty" id="qty_` +
                            count + `">
                            </td>
                            <td>
                                <input type="text" name="discount[]" onkeyup="onEnterDis($(this));" onchange="onDiscountChange($(this));" class="form-control discount"
                                    id="discount_` + count + `" readonly>
                            </td>
                            <td>
                                <input type="text" name="amount[]" class="form-control amount"
                                    id="amount_` + count + `" readonly>
                            </td>
                            <td>
                                <button class="btn btn-sm" onclick="removeRow($(this));"><i class="fa fa-trash req"></i></button>
                            </td>
                        </tr>`;

                        $("#productRow").append(row);
                        $("#product_footer").removeClass("d-none");
                    }
                });
            }
        }

        function onQtyChange(qty) {
            let qty_value = $(qty).val(),
                tr = $(qty).parents("tr").get();
            if (qty_value) {
                $(tr).find(".discount").removeAttr("readonly");
                if (qty_value == 0) {
                    $(tr).find(".discount").attr("readonly", true);
                    $(tr).find(".discount").val('');
                    $(tr).find("input.amount").val('');
                } else {
                    let price = $(tr).find("input.price").val(),
                        amount = price * qty_value;
                    $(tr).find("input.amount").val(amount.toFixed(2));
                    totalAmount();
                }
            } else {
                $(tr).find("input.amount").val('');
                $(tr).find(".discount").attr("readonly", true);
                $(tr).find(".discount").val('');
            }
        }

        function totalAmount() {
            let table_tbody = $("#productRow");
            let amounts = $(table_tbody).find(".amount");
            let total_amount = 0.00;
            $.each(amounts, function(key, value) {
                if ($(value).val()) {
                    total_amount += parseFloat($(value).val());
                }
            });
            if (total_amount == 0) {
                $("#total").val('');
            } else {
                $("#total").val(total_amount.toFixed(2));
            }
            onPaid();
        }

        function onEnterDis(this_row) {
            let tr = $(this_row).closest("tr");
            let qty = $(tr).find(".qty").val();
            if (qty != '' || qty != 0) {
                return false;
            } else {
                $.alert({
                    title: "Alert !",
                    content: "Please Enter qty first",
                    icon: "fa fa-exclamation-triangle",
                    theme: "modern",
                });
                $(tr).find(".discount").val('');
                $(tr).find(".amount").vaL('');
                totalAmount();
            }
        }

        function onDiscountChange(this_discount) {
            var tr = $(this_discount).closest("tr"),
                price = $(tr).find(".price"),
                qty = $(tr).find(".qty").val(),
                discount = $(tr).find(".discount");
            var this_amount = $(price).val() * qty;
            if ($(discount).val() != '') {
                if ((this_amount - $(discount).val()) >= 0) {
                    var amount = $(price).val() * qty - $(discount).val();
                    $(tr).find(".amount").val(amount.toFixed(2));
                    totalAmount();
                } else {
                    $.alert({
                        title: "Alert !",
                        content: "Discount is greater than amount",
                        icon: "fa fa-exclamation-triangle",
                        theme: "modern",
                    });
                    // $(price).val(actual_price);
                    $(discount).val('');
                    $(tr).find(".amount").val(this_amount.toFixed(2));
                    totalAmount();
                }
            } else {
                $(tr).find(".amount").val(this_amount.toFixed(2));
                totalAmount();
            }

        }

        function onPriceChange(prod_price) {
            onDiscountChange(prod_price);
        }


        function onPaid() {
            var amount_paid = $("#paid");
            var total = $("#total").val();
            if ((total - $(amount_paid).val()) > 0) {
                $("#due").val((total - $(amount_paid).val()).toFixed(2));
            } else if ((total - $(amount_paid).val()) < 0) {
                $.alert({
                    title: "Alert !",
                    content: "Paid amount is larger than actual amount",
                    theme: "modern",
                    icon: "fa fa-exclamation-triangle",
                });
                $("#paid").val('');
                $("#due").val(total);
            }
        }


        function check_same_item(item_id) {
            var trLength = $("#productRow tr").length;
            if (trLength) {
                for (i = 0; i <= trLength; i++) {
                    if ($("#product_" + item_id).val() == item_id) {
                        var tr = $("#item_" + item_id);
                        var qty = $(tr).find('input.qty').val();
                        if (qty != '') {
                            // var newQty = parseInt(qty) + 1;
                            $(tr).find('input.qty').focus();

                        } else if (qty == '') {
                            // var newQty = 1;
                            $(tr).find('input.qty').focus();

                        }
                        // $(tr).find('input.qty').val(qty);
                        $(".spinner").hide();
                        onQtyChange($(tr).find('input.qty'));

                        return false;
                    }
                }
            }
            return true;
        }

        function removeRow(this_row) {
            let tr = $(this_row).closest("tr");
            $(tr).remove();
            var trLength = $("#productRow tr").length;
            if (trLength > 0) {
                totalAmount();
            } else {
                $("#product_footer").addClass("d-none");
                $("#total").val('');
                $("#paid").val('');
                $("#due").val('');
            }
        }


        $("#search_product").autocomplete({
            source: function(data, cb) {
                $.ajax({
                    url: "{{ route('admin.getProducts') }}",
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
                addRow(count, item_id);
                count++;
                $("input#search_product").val('');
            },

        });

        $("#search_product").bind('paste', (e) => {
            $("#search_product").autocomplete('search');
        });

        $('#form').validate({
            rules: {
                room_id: "required",
                customer_id: "required",
                "price[]": {
                    required: true,
                    number: true,
                },
                "qty[]": {
                    required: true,
                    number: true,
                },
                "amount[]": {
                    required: true,
                    number: true,
                },
                total: {
                    required: true,
                    number: true,
                },
                due: {
                    required: true,
                    number: true,
                },

            },
            messages: {
                room_id: "Select Room",
                customer_id: "Select Customer",
                "price[]": {
                    required: "Price is required",
                    number: "Please enter valid price",
                },
                "qty[]": {
                    required: "Quatity is required",
                    number: "Please enter valid quantity"
                },
                "amount[]": {
                    required: "Amount is required",
                    number: "Amount must be valid price",
                },
                total: {
                    required: "Total is required",
                    number: "Total must be valid price",
                },
                due: {
                    required: "Due is required",
                    number: "Due amount must be valid price",
                }
            },
            submitHandler: function(form) {
                form.submit();
            }
        });
    </script>
@endsection
