<?php
$count = 0; ?>
@foreach (old('product_id') as $key => $value)
    <?php
    $product = App\Models\Product::where('id', $value)->first();
    $unit = App\Models\Unit::where('id', $product->unit_id)->first();
    ?>
    <tr id="item_{{ $value }}">
        <td>
            {{ $product->name }}
            <input type="hidden" value="{{ $value }}" name="product_id[]" class="form-control product"
                id="product_{{ $value }}" />
            @error('product_id' . '.' . $key)
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </td>
        <td>
            {{ $unit->name }}
            <input type="hidden" value="{{ old('unit_id')[$key] }}" name="unit_id[]" class="form-control unit"
                id="unit_{{ $count }}" />
            @error('unit_id' . '.' . $key)
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </td>
        <td>
            <input type="text" name="price[]" onchange="onPriceChange($(this));" class="form-control price"
                id="price_{{ $count }}" value="{{ old('price')[$key] }}">
            @error('price' . '.' . $key)
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </td>
        <td>
            <input type="text" name="qty[]" onchange="onQtyChange($(this));" value="{{ old('qty')[$key] }}"
                class="form-control qty" id="qty_{{ $count }}">
            @error('qty' . '.' . $key)
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </td>
        <td>
            <input type="text" name="discount[]" value="{{ old('discount')[$key] }}" onkeyup="onEnterDis($(this));"
                onchange="onDiscountChange($(this));" class="form-control discount" id="discount_{{ $count }}" {{ old("qty")[$key] != '' ? "" : "readonly" }}>
            @error('discount' . '.' . $key)
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </td>
        <td>
            <input type="text" name="amount[]" value="{{ old('amount')[$key] }}" class="form-control amount"
                id="amount_{{ $count }}" readonly>
            @error('amount' . '.' . $key)
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </td>
        <td>
            <button class="btn btn-sm" onclick="removeRow($(this));"><i class="fa fa-trash req"></i></button>
        </td>
    </tr>
    <?php $count++; ?>
@endforeach
<input type="hidden" class="form-control" value="{{ $count }}" id="count">
