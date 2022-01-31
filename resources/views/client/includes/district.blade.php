<select class="search input" id="district_id" name="district_id">
    <option value="">Chọn quận / huyện</option>
    @if (isset($districts))
        @foreach ($districts as $district)
            <option value="{{ $district->maqh }}" {{ isset($product) && $product->district_id == $district->maqh ? 'selected' : '' }}>{{ $district->name }}</option>
        @endforeach
    @endif
</select>