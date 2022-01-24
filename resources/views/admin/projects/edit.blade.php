@extends('admin.layouts.index')


@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Dự án
                    <small>Sửa</small>
                </h1>
                <form action="{{ route('project.edit', ['id' => $project->id]) }}" method="POST" enctype="multipart/form-data">

                    @csrf
                    
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="name">Tên dự án <span class="text-danger">*</span></label>
                            <input class="form-control" id="name" type="text" name="name" value="{{ $project->name }}" required>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="address">Địa chỉ dự án <span class="text-danger">*</span></label>
                            <input class="form-control" id="address" type="text" name="address" value="{{ $project->address }}" required>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="view">Lượt xem:</label>
                            <input type="number" class="form-control" placeholder="Nhập lượt xem" id="view" name="view" min=0 value="{{ $project->view }}">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Người quản lý <span class="text-danger">*</span></label>
                            <select class="form-control" name="manager" required>
                                @foreach ($managers as $manager)
                                    <option value="{{ $manager->id }}" {{ $manager->id == $project->manager_id ? 'selected' : '' }}>{{ $manager->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label>Hình ảnh dự án<span class="text-danger">*</span></label>
                        <div id="multiple-images">
                            @foreach($project->image as $item)
                                <div style='background-image: url({{ asset($item->image_src) }})'>
                                    <div class="overlay"></div>
                                    <div class="remove" onclick="removeImage(this)">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                        <input type="hidden" name="thumbnail_src[]" 
                                            value="{{ $item->image_src }}" style="display: none" id="thumbnail">
                                    </div>
                                </div>
                            @endforeach
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

                    <button type="submit" class="btn btn-primary">Sửa</button>
                  </form>
            </div>
        </div>
    </div>    
</div>
@endsection