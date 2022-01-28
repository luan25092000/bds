@extends('client.layouts.template')

@section('title', 'Đăng nhập')

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
                            Liên hệ
                        </span>
                    </div>
                    <h1 class="title-article">Nếu quý khách có bất kì vấn đề gì, xin vui lòng để lại liên hệ cho chúng tôi, chúng tôi sẽ liên hệ cho quý khách trong thời gian sớm nhất, xin cảm ơn !</h1>
                    <div>
                        <form action="{{ route('post.contact') }}" method="POST">

                            @csrf

                            <label for="fullname">Họ tên</label>
                            <input type="text" id="fullname" name="fullname" placeholder="Nhập họ tên" value="{{ Auth::check() ? Auth::user()->name : '' }}" required>

                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" placeholder="Nhập email" value="{{ Auth::check() ? Auth::user()->email : '' }}" required>

                            <label for="phone">Số điện thoại</label>
                            <input type="tel" id="phone" name="phone" placeholder="Nhập số điện thoại" pattern="[0-9]{10}" required>

                            <label for="description">Nội dung</label>
                            <textarea id="description" name="description" cols="30" rows="5" required></textarea>

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
