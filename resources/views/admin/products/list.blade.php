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
            <form action="{{ route('product.delete.all') }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" style="margin-bottom:1rem;">Xóa</button>
                <!-- /.col-lg-12 -->
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr>
                            <th><input type="checkbox" class="selectall"/></th>
                            <th>#</th>
                            <th>Ảnh sản phẩm</th>
                            <th>Danh mục</th>
                            <th>Dự án</th>
                            <th>Quản lý</th>
                            <th>Tên sản phẩm</th>
                            <th>Diện tích</th>
                            <th>Lượt xem</th>
                            <th>Trạng thái</th>
                            <th>Chức năng</th>
                        </tr>
                    </thead>
                    <tbody align="center">
                        @php $count = 1; @endphp
                        @foreach ($products as $product)
                            <tr>
                                <td><input type="checkbox" name="ids[]" class="selectbox" value="{{ $product->id }}" /></td>
                                <td>{{ $count }}</td>
                                <td><a href="{{ asset($product->image->first()->image_src) }}" target="_blank"><img src="{{ asset($product->image->first()->image_src) }}" width=60px></a></td>
                                <td>{{ $product->category_name }}</td>
                                <td>{{ $product->project_name }}</td>
                                <td>{{ $product->manager_name }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->area }} / m<sup>2</sup></td>
                                <td>{{ $product->view }}</td>
                                <td>
                                    @if ($product->status == 1)
                                        <i class="fa fa-check text-success" aria-hidden="true"></i>
                                    @else
                                        <i class="fa fa-ban text-danger" aria-hidden="true"></i>
                                    @endif
                                </td>
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
            </form>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<script>
    $('.selectall').click(function() {
        $('.selectbox').prop('checked', $(this).prop('checked'));
    });
    $('.selectbox').change(function() {
        var total = $('.selectbox').length;
        var number = $('.selectbox:checked').length;
        if (total == number) {
            $('.selectall').prop('checked', true);
        } else {
            $('.selectall').prop('checked', false);
        }
    });
</script>
@endsection