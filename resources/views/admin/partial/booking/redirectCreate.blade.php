@foreach (old('room_no') as $key => $value)
    <tr>
        <td>
            <select name="room_no[]" onchange="onRoomChange($(this));" class="form-control no_of_room"
                id="room_no{{ $key }}">
                <option value="">Select Room</option>
                @foreach ($rooms as $room)
                    <option value="{{ $room->id }}" data-value="{{ $room->price }}"
                        {{ $value == $room->id ? 'selected' : '' }}>
                        {{ $room->name . '(' . $room->room_no . ')' . '(Rs. ' . $room->price . ')' }}
                    </option>
                @endforeach
            </select>
            @error('room_no' . '.' . $key)
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </td>
        <td>
            <input type="text" onchange="onPriceChange($(this));" class="form-control price" value="{{ old("price")[$key] }}" name="price[]"
                id="price_{{ $key }}" readonly="readonly">
            @error('price' . '.' . $key)
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </td>
        <td>
            <input type="text" onchange="onDiscountChange($(this));" value="{{ old("discount")[$key] }}" class="form-control discount" name="discount[]"
                id="discount_{{ $key }}" readonly="readonly">
            @error('discount' . '.' . $key)
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </td>
        <td>
            <input type="text" class="form-control amount" value="{{ old("amount")[$key] }}" name="amount[]" id="amount_{{ $key }}" readonly>
            @error('amount' . '.' . $key)
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </td>

    </tr>
@endforeach
