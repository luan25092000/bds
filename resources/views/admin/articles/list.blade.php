@extends('admin.layouts.index')


@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Tin tức
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
                        <th>Ảnh</th>
                        <th>Danh mục tin tức</th>
                        <th>Tiêu đề</th>
                        <th>Lượt xem</th>
                        <th>Thời gian đăng</th>
                        <th>Chức năng</th>
                    </tr>
                </thead>
                <tbody align="center">
                    @php $count = 1; @endphp
                    @foreach ($articles as $article)
                        <tr>
                            <td>{{ $count }}</td>
                            <td><a href="{{ asset($article->thumbnail) }}" target="_blank"><img src="{{ asset($article->thumbnail) }}" width=60px ></a></td>
                            <td>{{ $article->category_article_name }}</td>
                            <td>{{ $article->title }}</td>
                            <td>{{ $article->view }}</td>
                            <td>{{ date('d/m/Y H:i:s', strtotime($article->updated_at)) }}</td>
                            <td>
                                <a href="{{ route('article.delete',['id' => $article->id]) }}" onclick="return confirm('Bạn muốn xóa item này ?')"><i class="fa fa-times" aria-hidden="true"></i></a>
                                <a href="{{ route('article.edit.form',['id' => $article->id]) }}" style="margin-left:1rem;"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
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