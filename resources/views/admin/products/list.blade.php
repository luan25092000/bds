@extends('admin.layouts.index')


@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Sản phẩm
                    <small>Danh sách</small>
                </h1>
                @if(Session::has('invalid'))
                    <div class="alert alert-danger alert-dismissible">
                         <a class="close" data-dismiss="alert" aria-label="close">&times;</a>
                         {{Session::get('invalid')}}
                    </div>
               @endif
               @if(Session::has('success'))
                    <div class="alert alert-success alert-dismissible">
                         <a class="close" data-dismiss="alert" aria-label="close">&times;</a>
                         {{Session::get('success')}}
                    </div>
               @endif
            </div>
            <!-- /.col-lg-12 -->
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Ảnh sản phẩm</th>
                        <th>Danh mục</th>
                        <th>Dự án</th>
                        <th>Quản lý</th>
                        <th>Tên sản phẩm</th>
                        <th>Diện tích</th>
                        <th>Trạng thái</th>
                        <th>Chức năng</th>
                    </tr>
                </thead>
                <tbody align="center">
                    @php $count = 1; @endphp
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $count }}</td>
                            <td><img src="{{ asset($product->image->first()->image_src) }}" width=60px ></td>
                            <td>{{ $product->category_name }}</td>
                            <td>{{ $product->project_name }}</td>
                            <td>{{ $product->manager_name }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->area }}</td>
                            <td>
                                <a href="{{ route('product.delete',['id' => $product->id]) }}" onclick="return confirm('Bạn muốn xóa sản phẩm này ?')"><i class="fa fa-times" aria-hidden="true"></i></a>
                                <a href="{{ route('product.edit.form',['id' => $product->id]) }}" style="margin-left:1rem;"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                <a href="{{ route('product.enable',['id' => $product->id]) }}" style="margin:0 1rem;"><i class="fa fa-check" aria-hidden="true"></i></a>
                                <a href="{{ route('product.disable',['id' => $product->id]) }}" style="margin:0 1rem;"><i class="fa fa-ban" aria-hidden="true"></i></a>
                            </td>
                        </tr>
                    @php $count++; @endphp
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
@endsection