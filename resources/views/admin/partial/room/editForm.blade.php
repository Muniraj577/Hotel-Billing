<div class="col-md-12">
    <form action="{{ route('admin.booking_room.update', $booking_room->id) }}" method="POST" id="editRoomForm">
        @csrf
        <label for="room">Room</label>
        <select name="roomid" class="form-control" id="roomId" onchange="clickfunc($(this));">
            <option value="">Select Room</option>
            @foreach ($rooms as $room)
                <option value="{{ $room->id }}" {{ $booking_room->room_id == $room->id ? 'selected' : '' }}>
                    {{ $room->name . '(' . $room->room_no . ')' }}</option>
            @endforeach
        </select>
        <div class="require roomid"></div>
    </form>
</div>


<script>
    function clickfunc(room){
        console.log($(room).val());
    }
</script>
