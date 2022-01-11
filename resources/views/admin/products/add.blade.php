@extends('admin.layouts.index')


@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Sản phẩm
                    <small>Thêm</small>
                </h1>
                <form action="{{ route('product.add') }}" method="POST" enctype="multipart/form-data">

                    @csrf
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="category_id">Danh mục sản phẩm: <span class="text-danger">*</span></label>
                            <select class="form-control" name="category_id" id="category_id" required>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="project_id">Dự án: <span class="text-danger">*</span></label>
                            <select class="form-control" name="project_id" id="project_id" required>
                                @foreach ($projects as $project)
                                    <option value="{{ $project->id }}">{{ $project->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="manager_id">Người quản lý: <span class="text-danger">*</span></label>
                            <select class="form-control" name="manager_id" id="manager_id" required>
                                @foreach ($managers as $manager)
                                    <option value="{{ $manager->id }}">{{ $manager->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="name">Tên sản phẩm: <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="Nhập tên sản phẩm" id="name" name="name" required>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="content">Mô tả sản phẩm:</label>
                            <textarea class="form-control" id="content" name="content"></textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="area">Diện tích (m<sup>2</sup>): <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" placeholder="Nhập diện tích" id="area" name="area" min=0 required>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="room_count">Số phòng: <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" placeholder="Nhập số phòng" id="room_count" name="room_count" min=0 required>
                                </div>
                                <div class="col-md-6">
                                    <label for="floor_count">Số tầng: <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" placeholder="Nhập số lầu" id="floor_count" name="floor_count" min=0 required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="city_id">Thành phố: <span class="text-danger">*</span></label>
                                    <select class="form-control" id="city_id" name="city_id" required>
                                        <option value="">Chọn thành phố</option>
                                        @foreach ($cities as $city)
                                            <option value="{{ $city->matp }}">{{ $city->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4" id="district">
                                    <label for="district_id">Quận / Huyện: <span class="text-danger">*</span></label>
                                    @include('admin.products.includes.district')
                                </div>
                                <div class="col-md-4" id="ward">
                                    <label for="ward_id">Xã / Phường: <span class="text-danger">*</span></label>
                                    @include('admin.products.includes.ward')
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="room_price">Tiền phòng: <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" placeholder="Nhập tiền phòng" id="room_price" name="room_price" min=0 required>
                                </div>
                                <div class="col-md-4">
                                    <label for="electricity_price">Tiền điện (kí): <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" placeholder="Nhập tiền điện" id="electricity_price" name="electricity_price" min=0 required>
                                </div>
                                <div class="col-md-4">
                                    <label for="water_price">Tiền nước (m<sup>3</sup>): <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" placeholder="Nhập tiền nước" id="water_price" name="water_price" min=0 required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="is_invalid">Sổ hồng: <span class="text-danger">*</span></label>
                            <select class="form-control" name="is_invalid" id="is_invalid" required>
                                <option value="0">Không</option>
                                <option value="1">Có</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label>Hình ảnh sản phẩm<span class="text-danger">*</span></label>
                        <div id="multiple-images">
                            <div id="add-image" class="add" onclick="addImage()">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                            </div>
                        </div>
                        <div id="error" class="text-danger"></div>
                        <br>
                        <script>
                            function addImage() {
                                let imagePreview = $(`<div class="image-preview" style="display: none">
                                        <div class="overlay"></div>
                                        <div class="remove" onclick="removeImage(this)">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                            <input type="file" name="thumbnail[]" accept="image/*"
                                                onchange="checkImage(this)" style="display: none" id="thumbnail">
                                        </div>
                                    </div>`);
                                imagePreview.find('input').last().click();
                            }
                            function checkImage(el) {
                                const file = el.files[0];
                                const reader = new FileReader();
                                reader.addEventListener("load", function() {
                                    let imagePreview = $(el).parent().parent();
                                    imagePreview.attr("style", "display: flex; background-image: url(\""+this.result+"\")");
                                    $('#multiple-images #add-image').before(imagePreview);
                                });
                                reader.readAsDataURL(file);
                            }
                            function removeImage(el) {
                                if($(el).parent().css('display') != 'none') {
                                    $(el).parent().remove();
                                }
                            }
                        </script>
                        <style>
                            #multiple-images {
                                display: grid;
                                grid-template-columns: repeat(5, 1fr);
                                grid-gap: .5rem;
                                width: 100%;
                                padding: 0;
                                margin: 0;
                                margin-bottom: 1rem;
                            }
                            #multiple-images > div {
                                display: flex;
                                align-items: start;
                                justify-content: flex-end;
                                padding: 0;
                                margin: 0;
                                background-color: black;
                                border-radius: .5rem;
                                overflow: hidden;
                                background-size: cover;
                                background-position: center center;
                                width: 100%;
                            }
                            #multiple-images .overlay {
                                width: 101%;
                                padding-top: 101%;
                                background-color: rgb(0, 0, 0, .2);
                            }
                            #multiple-images .remove {
                                font-size: 1.2rem;
                                padding: .5rem;
                                color: white;
                                cursor: pointer;
                                position: absolute;
                            }
                            #multiple-images .add {
                                display: flex;
                                align-items: center;
                                justify-content: center;
                                width: 100%;
                                padding-top: calc(50% - 1.5rem);
                                padding-bottom: calc(50% - 1.5rem);
                                font-size: 3rem;
                                line-height: 3rem;
                                color: gray;
                                background: white;
                                border: thin solid gray;
                                cursor: pointer;
                            }
                        </style>
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">Thêm</button>
                    </div>
                  </form>
            </div>
        </div>
    </div>    
</div>
@endsection