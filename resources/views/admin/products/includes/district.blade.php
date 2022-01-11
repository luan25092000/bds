<label for="district_id">Quận / Huyện: <span class="text-danger">*</span></label>
<select class="form-control" id="district_id" name="district_id" required>
    @if (isset($districts))
        @foreach ($districts as $district)
            <option value="{{ $district->maqh }}" {{ isset($product) && $product->district_id == $district->maqh ? 'selected' : '' }}>{{ $district->name }}</option>
        @endforeach
    @endif
</select>