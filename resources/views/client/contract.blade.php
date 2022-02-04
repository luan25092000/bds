@extends('client.layouts.template')

@section('title', 'Ký hợp đồng')

@section('content')
    <style>
        label {
            color: white;
        }
        input[type=email], input[type=password], input[type=text], input[type=tel], textarea {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        
        input[type=submit] {
            width: 100%;
            background-color: #d21007;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        
        input[type=submit]:hover {
            background-color: #b11810;
        }
    </style>
    <article id="Wrapper" class="Section">
        <div class="container">
            <section class="col-section">
                <div class="boxes">
                    <div class="title-cat">
                        <span>
                            Ký hợp đồng
                        </span>
                    </div>
                    <div style="margin-top:1rem;">
                        <form action="{{ route('post.contract', compact('id')) }}" method="POST">

                            @csrf

                            <label for="product">Sản phẩm</label>
                            <input type="text" id="product" name="product" value="{{ \App\Models\Product::find(\App\Models\Wishlist::find($id)->product_id)->name }}" readonly>

                            <label for="fullname">Họ tên <span style="color:red;">*</span></label>
                            <input type="text" id="fullname" name="fullname" placeholder="Nhập họ tên khách hàng" required>

                            <label for="email">Email <span style="color:red;">*</span></label>
                            <input type="email" id="email" name="email" placeholder="Nhập email khách hàng" required>

                            <label for="phone">Số điện thoại <span style="color:red;">*</span></label>
                            <input type="tel" id="phone" name="phone" placeholder="Nhập số điện thoại khách hàng" pattern="[0-9]{10}" required>

                            <label for="description">Ghi chú</label>
                            <textarea id="description" name="description" cols="30" rows="5"></textarea>

                            <input type="submit" value="Gửi">
                        </form>
                    </div>
                </div>
            </section>
            <aside class="col-side fixed">
                @include('client.includes.project',['projects' => $projects])
                @include('client.includes.article',['articles' => $articles])
            </aside>
        </div>
    </article>
@endsection
