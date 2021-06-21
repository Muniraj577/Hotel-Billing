@foreach (old('room_no') as $key => $value)
    <div class="form-group">
        <div class="row">
            <div class="col-md-4">
                <label for="">Select Room</label>
            </div>
            <div class="col-md-8">
                <select name="room_no[]" class="form-control" id="room_no{{ $key }}">
                    <option value="">Select Room</option>
                    @foreach ($rooms as $room)
                        <option value="{{ $room->id }}" {{ $value == $room->id ? 'selected' : '' }}>{{ $room->name . '(' . $room->room_no . ')' }}</option>
                    @endforeach
                </select>
                @error('room_no'. '.' .$key)
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
@endforeach
