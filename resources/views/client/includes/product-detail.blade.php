@if (isset($product) && !is_null($product))
    <div class="box-side boxside">
        <div class="title-side">
            <span>Thông tin sản phẩm</span>
        </div>
        <div class="contain clearfm">
            <ul class="ulside load-cont">
                <li>Dự án:
                    <span>{{ \App\Models\Project::find($product->project_id)->name }}</span>
                </li>
                <li>Số điện thoại liên hệ:
                    <span>{{ \App\Models\User::find(\App\Models\Project::find($product->project_id)->manager_id)->phone }}</span>
                </li>
                <li>Diện tích:
                    <span>{{ $product->area }} m<sup>2</sup></span>
                </li>
                <li>Số tầng:
                    <span>{{ $product->floor_count }}</span>
                </li>
                <li>Số phòng:
                    <span>{{ $product->room_count }}</span>
                </li>
                <li>Tiền thuê:
                    <span>{{ number_format($product->room_price,-3,',',',') }}₫ / tháng</span>
                </li>
                <li>Tiền điện:
                    <span>{{ number_format($product->electricity_price,-3,',',',') }}₫ / kí</span>
                </li>
                <li>Tiền nước:
                    <span>{{ number_format($product->water_price,-3,',',',') }}₫ / m<sup>3</sup></span>
                </li>
                <li>Thành phố / Tỉnh:
                    <span>{{ \App\Models\City::find($product->city_id)->name }}</span>
                </li>
                <li>Quận / huyện:
                    <span>{{ \App\Models\District::find($product->district_id)->name }}</span>
                </li>
                <li>Xã / phường:
                    <span>{{ \App\Models\Ward::find($product->ward_id)->name }}</span>
                </li>
            </ul>
        </div>
    </div>
@endif