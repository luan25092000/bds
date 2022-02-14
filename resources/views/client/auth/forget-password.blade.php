@extends('client.layouts.template')

@section('title', 'Quên mật khẩu')

@section('content')
    <style>
        label {
            color: white;
        }
        input[type=email], input[type=password] {
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

        .psw > a { 
            color: #901403;
        }
    </style>
    <article id="Wrapper" class="Section">
        <div class="container">
            <section class="col-section">
                <div class="boxes">
                    <div class="title-cat">
                        <span>
                            Quên mật khẩu
                        </span>
                    </div>
                    <h1 class="title-article">Vui lòng nhập email để khôi phục mật khẩu</h1>
                    <div>
                        <form action="{{ route('send.mail') }}" method="POST">

                            @csrf

                            <label for="email">Email <span style="color:red;">*</span></label>
                            <input type="email" id="email" name="email" placeholder="Nhập email" required>

                            <input type="submit" value="Gửi link">
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
