<div class="col-md-12">
    <form action="{{ route("admin.booking_room.addRoom", $booking_detail->id) }}" method="POST" id="roomForm">
        @csrf
        <label for="room">Room</label>
        <select name="room_id" class="form-control">
            <option value="">Select Room</option>
            @foreach ($rooms as $room)
                <option value="{{ $room->id }}">{{ $room->name . '(' . $room->room_no . ')' }}</option>
            @endforeach
        </select>
        <div class="require room_id"></div>
    </form>
</div>
