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
            </ul>
        </div>
    </div>
@endif