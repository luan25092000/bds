<label for="ward_id">Xã / Phường: <span class="text-danger">*</span></label>
<select class="form-control" id="ward_id" name="ward_id" required>
    @if (isset($wards))
        @foreach ($wards as $ward)
            <option value="{{ $ward->xaid }}">{{ $ward->name }}</option>
        @endforeach
    @endif
</select>