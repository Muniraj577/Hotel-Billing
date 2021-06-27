@extends('layouts.admin.app')
@section('title', 'Room')
@section('room', 'active')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row col-12 mb-2">
                <div class="col-sm-6">
                    <h1>Room</h1>
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
                                <a href="{{ route('admin.booking.show', $booking_detail->id) }}"
                                    class="btn btn-primary"><i class="fa fa-arrow-left iCheck"></i>&nbsp;Back to Booking Detail</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="col-md-12">
                                <form action="{{ route('admin.booking_room.addRoom', $booking_detail->id) }}"
                                    method="POST" id="roomForm">
                                    @csrf
                                    <div class="form-group col-md-6">
                                        <label for="room">Room</label>
                                        <select name="room_id" class="form-control" onchange="clickfunc($(this));"
                                            id="roomId">
                                            <option value="">Select Room</option>
                                            @foreach ($rooms as $room)
                                                <option value="{{ $room->id }}" data-price="{{ $room->price }}">
                                                    {{ $room->name . '(' . $room->room_no . ')' }}</option>
                                            @endforeach
                                        </select>
                                        <div class="require room_id"></div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="price">Room Price</label>
                                        <input type="text" onchange="onchangeprice();" name="price" class="form-control" id="roomPrice" readonly>
                                        <div class="require room_price"></div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="discount">Discount</label>
                                        <input type="text" onchange="onchangediscount();" name="discount" class="form-control" id="discount">
                                        <div class="require discount"></div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="amount">Amount</label>
                                        <input type="text" name="amount" class="form-control" id="amount" readonly>
                                        <div class="require amount"></div>
                                    </div>
                                    <div>
                                        <button type="submit" class="btn btn-primary" id="saveRoom">Submit</button>
                                    </div>
                                </form>
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
        function clickfunc(room) {
            if ($(room).val() != '') {
                var price = $("#roomId option:selected").data("price");
                $("#roomPrice").val(price);
                $("#roomPrice").removeAttr("readonly");
                calculateAmount();
            } else {
                $("#roomPrice").attr("readonly", true);
                $("#roomPrice").val('');
                $("#amount").val('');
            }

        }

        function calculateAmount() {
            var discount = $("#discount").val();
            var price = $("#roomPrice").val();
            var actual_price = $("#roomId option:selected").data("price");
            console.log(price);
            if (discount != '') {
                if ((price - discount) > 0) {
                    $("#amount").val(price - discount);
                } else {
                    alert("discount is greater than price");
                    $("#discount").val('');
                    $("#roomPrice").val(actual_price);
                    $("#amount").val(actual_price);
                }
            } else {
                $("#amount").val(price);
            }

        }

        function onchangeprice() {
            calculateAmount();
        }

        function onchangediscount(){
            calculateAmount();
        }

        $("#saveRoom").on("click", function(e) {
            $('.require').css('display', 'none');
            e.preventDefault();
            var formData = $('#roomForm').serialize();
            var action = $("#roomForm").attr('action');
            $.ajax({
                url: action,
                type: 'post',
                data: formData,
                dataType: 'json',
                success: function(data) {
                    if (data.errors) {
                        var error_html = "";
                        $.each(data.errors, function(key, value) {
                            error_html = '<div>' + value + '</div>';
                            $('.' + key).css('display', 'block').css('color', 'red');
                            $('.' + key).html(error_html);
                        });
                    } else {
                        var booking_id = "{{ $booking_detail->id }}";
                        var nextUrl = "{{ route('admin.booking.show', ':id') }}",
                            nextUrl = nextUrl.replace(":id", booking_id);

                        location.href = nextUrl;
                        toastr.success(data.msg);
                    }

                }
            });
        });
    </script>

@endsection
