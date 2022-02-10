@extends('admin.layouts.index')


@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Dự án
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
                        <th>Ảnh</th>
                        <th>Tên dự án</th>
                        <th>Địa chỉ</th>
                        <th>Người quản lý</th>
                        <th>Lượt xem</th>
                        <th>Trạng thái</th>
                        <th>Chức năng</th>
                    </tr>
                </thead>
                <tbody align="center">
                    @php $count = 1; @endphp
                    @foreach ($projects as $project)
                        <tr>
                            <td>{{ $count }}</td>
                            <td><a href="{{ asset($project->image->first()->image_src) }}" target="_blank"><img src="{{ asset($project->image->first()->image_src) }}" width=60px ></a></td>
                            <td>{{ $project->name }}</td>
                            <td>{{ $project->address }}</td>
                            <td>{{ $project->manager_name }}</td>
                            <td>{{ $project->view }}</td>
                            <td>{{ $project->status == 0 ? 'Đang cập nhật' : 'Đang mở bán' }}</td>
                            <td>
                                <a href="{{ route('project.delete',['id' => $project->id]) }}" onclick="return confirm('Bạn muốn xóa item này ?')"><i class="fa fa-times" aria-hidden="true"></i></a>
                                <a href="{{ route('project.edit.form',['id' => $project->id]) }}" style="margin-left:1rem;"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                @if ($project->status == 0)
                                    <a href="{{ route('project.update.status',['id' => $project->id, 'status' => 1]) }}" style="margin:0 1rem;"><i class="fa fa-usd" aria-hidden="true"></i></a>
                                @else
                                    <a href="{{ route('project.update.status',['id' => $project->id, 'status' => 0]) }}" style="margin:0 1rem;"><i class="fa fa-clock-o" aria-hidden="true"></i></a>
                                @endif
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