<select class="search input" id="ward_id" name="ward_id">
    <option value="">Chọn xã / phường</option>
    @if (isset($wards))
        @foreach ($wards as $ward)
            <option value="{{ $ward->xaid }}" {{ isset($product) && $product->ward_id == $ward->xaid ? 'selected' : '' }}>{{ $ward->name }}</option>
        @endforeach
    @endif
</select>