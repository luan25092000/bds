@extends('client.layouts.template')

@section('title', 'Giới thiệu')

@section('content')
    <article id="Wrapper" class="Section">
        <div class="container">
            <section class="col-section">
                <div class="boxes">
                    <div class="title-cat">
                        <span>
                            Giới thiệu
                        </span>
                    </div>
                    <h1 class="title-article">Chào mừng quý khách đến với công ty kiến trúc Anh Duy</h1>
                    <div class="detail">
                        <h2 class="description"></h2>
                        <p style="text-align:justify"><span style="color:rgb(255, 0, 0)">Anh Duy</span>&nbsp;là công ty
                            hoạt động trong lĩnh vực thiết kế và xây dựng, chuyên về thiết kế biệt thự, nhà phố, nhà cấp 4,
                            công trình công cộng.</p>

                        <p style="text-align:justify">Trong nhiều năm qua, cùng với sự phát triển về kiến trúc,&nbsp;<span
                                style="color:rgb(255, 0, 0)">Anh Duy</span>&nbsp;đã và đang khẳng định được vị trí, chất
                            lượng dịch vụ và uy tín của công ty đến với khách hàng. Với cơ sở vật chất hiện đại, đội ngũ
                            kiến trúc sư được đào tạo bài bản, có nhiều năm kinh nghiệm cùng sự sáng tạo, luôn tận tâm với
                            công việc để tạo ra những không gian đẹp, những công trình đẹp đến quý khách hàng.</p>

                        <p style="text-align:justify"><span style="color:rgb(255, 0, 0)">Anh Duy</span>&nbsp;luôn nghiên
                            cứu những thiết kế mới lạ, phù hợp với xu hướng hiện đại kết hợp với yếu tố phong thủy, am hiểu
                            về phong thủy để thu hút vận may cũng như thu hút tài lộc của gia chủ. Các thiết kế được nghiên
                            cứu chuyên sâu để tạo ra một thế kiết nhà đẹp phù hợp với phong thủy không chỉ hài hòa từ hướng
                            nhà, hướng cửa mà còn tổng thể nội thất bên trong hay phối cảnh xung quanh nhà.</p>

                        <p style="text-align:justify"><img alt=""
                                src="https://bds85.lc/uploads/product_image_1629447218477.jpg"
                                style="height:405px; width:400px"><img alt=""
                                src="https://bds85.lc/uploads/product_image_1629447247579.jpg"
                                style="height:405px; width:400px"></p>

                        <p style="text-align:justify">Sau nhiều năm nỗ lực,&nbsp;<span style="color:rgb(255, 0, 0)">Anh Duy</span>&nbsp;đã trở thành lựa chọn hàng đầu của nhiều quý khách, chúng tôi thấu hiểu
                            được nhu cầu cũng như mong muốn của khách hàng, chính vì vậy luôn làm khách hàng yên tâm và hài
                            lòng bằng chính những dịch vụ thiết kế và thi công chuyên nghiệp.</p>

                        <p style="text-align:justify">Với tiêu chí chuyên nghiệp trong công việc, tận tâm trong dịch vụ và
                            chu đáo khi hậu mãi, Công ty kiến trúc&nbsp;<span style="color:rgb(255, 0, 0)">Anh Duy</span>&nbsp;luôn là một nhà thiết kế và nhà thầu chính được tín nhiệm hiện
                            nay.&nbsp;<span style="color:rgb(255, 0, 0)">Anh Duy</span>&nbsp;đã thiết kế và thi công tất
                            cả các hạng mục của hơn 1000 công trình các loại như Biệt Thự, Cao ốc Văn Phòng, Siêu Thị, Khách
                            Sạn, Nhà Phố, …</p>

                        <p style="text-align:justify"><img alt=""
                                src="https://bds85.lc/uploads/product_image_1629447278776.jpg"
                                style="height:405px; width:400px"><img alt=""
                                src="https://bds85.lc/uploads/product_image_1629447303162.jpg"
                                style="height:405px; width:400px"></p>

                        <p style="text-align:justify"><span style="font-family:segoe ui; font-size:15px">Mục tiêu chính của
                                công ty chúng tôi, là đem lại sự hài lòng cho quý khách với tiêu chí “Chuyên nghiệp – Chất
                                lượng cao – Giá cả phải chăng”.&nbsp;Uy tín là vấn đề hàng đầu mà&nbsp;</span><span
                                style="font-family:segoe ui; font-size:15px">Anh Duy</span><span
                                style="font-family:segoe ui; font-size:15px">&nbsp;đặt ra để đưa tới cho quý khách hàng một
                                sản phẩm tốt nhất. Sự tin tưởng và ủng hộ của khách hàng trong suốt thời gian qua là động
                                lực to lớn trên bước đường phát triển của&nbsp;</span><span
                                style="font-family:segoe ui; font-size:15px">Anh Duy</span><span
                                style="color:rgb(255, 255, 255); font-family:segoe ui; font-size:15px">.</span></p>

                        <p style="text-align:justify"><img alt=""
                                src="https://bds85.lc/uploads/product_image_1629447422293.jpg"
                                style="height:405px; width:400px"><img alt=""
                                src="https://bds85.lc/uploads/product_image_1629447438222.jpg"
                                style="height:405px; width:400px"></p>
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
