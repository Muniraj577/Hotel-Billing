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
                                <a href="{{ route('admin.booking.show', $booking_room->booking_id) }}" class="btn btn-primary"><i
                                        class="fa fa-arrow-left iCheck"></i>&nbsp;Back to Booking Detail</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="col-md-12">
                                <form action="{{ route('admin.booking_room.update', $booking_room->id) }}" method="POST"
                                    id="editform">
                                    @csrf
                                    <div class="form-group col-md-6">
                                        <label for="room">Room</label>
                                        <select name="roomid" class="form-control" id="roomId"
                                            onchange="clickfunc($(this));">
                                            <option value="">Select Room</option>
                                            @foreach ($rooms as $room)
                                                <option value="{{ $room->id }}"
                                                    {{ $booking_room->room_id == $room->id ? 'selected' : '' }}
                                                    data-price="{{ $room->price }}">
                                                    {{ $room->name . '(' . $room->room_no . ')' }}</option>
                                            @endforeach
                                        </select>
                                        <div class="require roomid"></div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="price">Room Price</label>
                                        <input type="text" name="price" value="{{ $booking_room->price }}"
                                            onchange="onchangeprice();" class="form-control modal_price" id="modal_price">
                                        <div class="require room_price"></div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="discount">Discount</label>
                                        <input type="text" onchange="ondischange();" name="discount" value="{{ $booking_room->discount }}"
                                            class="form-control modal_discount" id="modal_discount">
                                        <div class="require discount"></div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="amount">Amount</label>
                                        <input type="text" name="amount" value="{{ $booking_room->amount }}"
                                            class="form-control modal_amount" id="modal_amount" readonly>
                                        <div class="require amount"></div>
                                    </div>
                                    <div>
                                        <button type="submit" class="btn btn-primary" id="editRoom">Submit</button>
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
            var new_value = $(room).val();
            $(room).children().removeAttr("selected");
            $("#roomId").val(new_value);
            var price = $("#roomId option:selected").data("price");
            $(".modal_price").val(price);
            calculateAmount();
        }

        function calculateAmount() {
            var discount = $(".modal_discount").val();
            var price = $(".modal_price").val();
            var actual_price = $("#roomId option:selected").data("price");
            if (discount != '') {
                if ((price - discount) > 0) {
                    $(".modal_amount").val(price - discount);
                } else {
                    alert("discount is greater than price");
                    $(".modal_discount").val('');
                    $(".modal_price").val(actual_price);
                    $(".modal_amount").val(actual_price);
                }
            } else {
                $(".modal_amount").val(price);
            }

        }

        function onchangeprice() {
            calculateAmount();
        }

        function ondischange(){
            calculateAmount();
        }

        $("#editRoom").on("click", function(e) {
            $('.require').css('display', 'none');
            e.preventDefault();

            var formData = $("#editform").serialize();
            var action = $("#editform").attr('action');
            $.ajax({
                url: action,
                type: 'post',
                data: formData,
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    if (data.errors) {
                        var error_html = "";
                        $.each(data.errors, function(key, value) {
                            error_html = '<div>' + value + '</div>';
                            $('.' + key).css('display', 'block').css('color', 'red');
                            $('.' + key).html(error_html);
                        });
                    } else {
                        var booking_id = "{{ $booking_room->booking_id }}";
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
