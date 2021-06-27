<div class="col-md-12">
    <form action="{{ route('admin.booking_room.update', $booking_room->id) }}" method="POST" id="editRoomForm">
        @csrf
        <div class="form-group">
            <label for="room">Room</label>
            <select name="roomid" class="form-control" id="roomId" onchange="clickfunc($(this));">
                <option value="">Select Room</option>
                @foreach ($rooms as $room)
                    <option value="{{ $room->id }}" {{ $booking_room->room_id == $room->id ? 'selected' : '' }}
                        data-price="{{ $room->price }}">
                        {{ $room->name . '(' . $room->room_no . ')' }}</option>
                @endforeach
            </select>
            <div class="require roomid"></div>
        </div>
        <div class="form-group">
            <label for="price">Room Price</label>
            <input type="text" name="room_price" value="{{ $booking_room->price }}" onchange="onchangeprice();" class="form-control modal_price"
                id="modal_price">
            <div class="require room_price"></div>
        </div>
        <div class="form-group">
            <label for="discount">Discount</label>
            <input type="text" name="discount" value="{{ $booking_room->discount }}" class="form-control modal_discount"
                id="modal_discount">
            <div class="require discount"></div>
        </div>
        <div class="form-group">
            <label for="amount">Amount</label>
            <input type="text" name="amount" value="{{ $booking_room->amount }}" class="form-control modal_amount"
                id="modal_amount">
            <div class="require amount"></div>
        </div>
    </form>
</div>


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
        console.log(price);
        if (discount != '') {
            if ((price - discount) > 0) {
                $(".modal_amount").val(price - discount);
            } else {
                alert("discount is greater than price");
                $(".modal_amount").val(price);
            }
        } else {
            $(".modal_amount").val(price);
        }

    }

    function onchangeprice(){
        calculateAmount();
    }
</script>
