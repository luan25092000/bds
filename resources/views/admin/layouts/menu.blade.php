<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            @if (Auth::user()->role == 0)
                <li>
                    <a href="{{ route('dashboard') }}"><i class="fa fa-tachometer" aria-hidden="true"></i> Bảng điều khiển</a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-building" aria-hidden="true"></i> Dự án<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{ route('project.list') }}">Danh sách</a>
                        </li>
                        <li>
                            <a href="{{ route('project.add.form') }}">Thêm mới</a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
                <li>
                    <a href="#"><i class="fa fa-list" aria-hidden="true"></i> Danh mục sản phẩm<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{ route('category.list') }}">Danh sách</a>
                        </li>
                        <li>
                            <a href="{{ route('category.add.form') }}">Thêm mới</a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
                <li>
                    <a href="#"><i class="fa fa-home" aria-hidden="true"></i> Sản phẩm<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{ route('product.list') }}">Danh sách</a>
                        </li>
                        <li>
                            <a href="{{ route('product.add.form') }}">Thêm mới</a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
                <li>
                    <a href="#"><i class="fa fa-users fa-fw"></i> Người dùng<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{ route('customer.list') }}">Danh sách</a>
                        </li>
                        <li>
                            <a href="{{ route('customer.add.form') }}">Thêm mới</a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
                <li>
                    <a href="#"><i class="fa fa-list-alt" aria-hidden="true"></i> Danh mục tin tức<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{ route('category.article.list') }}">Danh sách</a>
                        </li>
                        <li>
                            <a href="{{ route('category.article.add.form') }}">Thêm mới</a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
                <li>
                    <a href="#"><i class="fa fa-newspaper-o" aria-hidden="true"></i> Tin tức<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{ route('article.list') }}">Danh sách</a>
                        </li>
                        <li>
                            <a href="{{ route('article.add.form') }}">Thêm mới</a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
                <li>
                    <a href="#"><i class="fa fa-phone" aria-hidden="true"></i> Liên hệ<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{ route('contact.list') }}">Danh sách</a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
                <li>
                    <a href="#"><i class="fa fa-usd" aria\hidden="true"></i> Hợp đồng<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{ route('order.list') }}">Danh sách</a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
                <li>
                    <a href="#"><i class="fa fa-bell" aria-hidden="true"></i> Hóa đơn<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{ route('bill.list') }}">Danh sách</a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
            @else 
                <li>
                    <a href="#"><i class="fa fa-home" aria-hidden="true"></i> Sản phẩm<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{ route('product.list') }}">Danh sách</a>
                        </li>
                        <li>
                            <a href="{{ route('product.add.form') }}">Thêm mới</a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
                <li>
                    <a href="#"><i class="fa fa-usd" aria-hidden="true"></i> Hợp đồng<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{ route('order.list') }}">Danh sách</a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
                <li>
                    <a href="#"><i class="fa fa-bell" aria-hidden="true"></i> Hóa đơn<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{ route('bill.list') }}">Danh sách</a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
            @endif
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>