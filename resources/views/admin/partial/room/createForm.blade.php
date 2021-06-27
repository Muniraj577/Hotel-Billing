<div class="col-md-12">
    <form action="{{ route('admin.booking_room.addRoom', $booking_detail->id) }}" method="POST" id="roomForm">
        @csrf
        <div class="form-group">
            <label for="room">Room</label>
            <select name="room_id" class="form-control">
                <option value="">Select Room</option>
                @foreach ($rooms as $room)
                    <option value="{{ $room->id }}">{{ $room->name . '(' . $room->room_no . ')' }}</option>
                @endforeach
            </select>
            <div class="require room_id"></div>
        </div>
        <div class="form-group">
            <label for="price">Room Price</label>
            <input type="text" name="room_price" class="form-control" id="roomPrice" readonly>
            <div class="require room_price"></div>
        </div>
        <div class="form-group">
            <label for="discount">Discount</label>
            <input type="text" name="discount" class="form-control" id="discount" readonly>
            <div class="require discount"></div>
        </div>
        <div class="form-group">
            <label for="amount">Amount</label>
            <input type="text" name="amount" class="form-control" id="amount" readonly>
            <div class="require amount"></div>
        </div>
    </form>
</div>
