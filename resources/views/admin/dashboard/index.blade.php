@extends('admin.layouts.index')

@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Thống kê</h1>
                </div>
                <form action="{{ route('fillter.bill') }}" method="GET" enctype="multipart/form-data">

                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="start_date">Ngày bắt đầu: <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" id="start_date" name="start_date" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="end_date">Ngày kết thúc: <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" id="end_date" name="end_date"required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">Lọc</button>
                    </div>
                </form>
                @if (isset($bills))
                    <div class="col-lg-12" style="margin-top:1rem;">
                        <a href="{{ route('bill.export.excel') }}" class="btn btn-primary" style="margin-bottom:1rem;">Xuất file excel</a>
                        @include('admin.dashboard.includes.bill', compact('bills'))
                    </div>
                @endif
            </div>
            <!-- /.row -->
        </div>
    </div>
@endsection