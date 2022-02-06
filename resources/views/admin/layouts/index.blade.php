@if (Auth::check())
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href='{{ asset('client/assets/images/logo.png') }}' type="image/png" />
        <title>Batdongsan</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/metisMenu/1.1.3/metisMenu.min.css" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('admin/css/style.css') }}" media="all" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
        <link href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap.min.css" rel="stylesheet">
        <link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    </head>

    <body>
        <div id="wrapper">

            @include('admin.layouts.header')

            @yield('content')

        </div>
        <!-- /#wrapper -->
        <input type="hidden" id="data1" value="{{ json_encode($data1) }}" />
        <input type="hidden" id="data2" value="{{ json_encode($data2) }}" />
        
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/metisMenu/1.1.3/metisMenu.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap.min.js"></script>
        <script type="text/javascript" src="{{ asset('admin/js/main.js') }}"></script>
        <script src="{{ asset('admin/ckeditor/ckeditor.js') }}"></script>
        <script src="{{ asset('admin/ckfinder/ckfinder.js') }}"></script>
        <script>
            var editor = CKEDITOR.replace('content');
            CKFinder.setupCKEditor(editor);
        </script>
        <script>
            // Handle choose city,district,ward
            $('#city_id').change(function(e) {
                var city_id = $(this).val();
                $.ajax({
                    url: "/ad/product/ajax_district",
                    type: 'GET',
                    data: {
                        city_id: city_id
                    },
                    beforeSend: function(xhr) {
                        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    }
                }).done(function(res) {
                    if (res.status == 200) {
                        $('#district').html(res.data);
                    }
                });
            });
            $('#district').on('change', '#district_id', function(e) {
                var district_id = $(this).val();
                $.ajax({
                    url: "/ad/product/ajax_ward",
                    type: 'GET',
                    data: {
                        district_id: district_id
                    },
                    beforeSend: function(xhr) {
                        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    }
                }).done(function(res) {
                    if (res.status == 200) {
                        $('#ward').html(res.data);
                    }
                });
            });
        </script>
        <!-- Google Charts Library -->
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
            var arr1 = [
                ['Tháng', 'Doanh thu']
            ];
            var orders = JSON.parse(document.getElementById("data1").value);
            google.charts.load('current', {
                'packages': ['corechart']
            });
            google.charts.setOnLoadCallback(drawChart);
            for (x of orders) {
                arr1.push(['Tháng ' + x.bill_month, parseInt(x.total_price)])
            }

            function drawChart() {

                var data = google.visualization.arrayToDataTable(
                    arr1
                );

                var options = {
                    title: 'Thống kê doanh thu theo tháng'
                };

                var chart = new google.visualization.PieChart(document.getElementById('piechart1'));

                chart.draw(data, options);
            }
        </script>
        <script type="text/javascript">
            var arr2 = [
                ['Năm', 'Doanh thu']
            ];
            var orders = JSON.parse(document.getElementById("data2").value);
            google.charts.load('current', {
                'packages': ['corechart']
            });
            google.charts.setOnLoadCallback(drawChart);
            for (x of orders) {
                arr2.push(['Năm ' + x.bill_year, parseInt(x.total_price)])
            }

            function drawChart() {

                var data = google.visualization.arrayToDataTable(
                    arr2
                );

                var options = {
                    title: 'Thống kê doanh thu theo năm'
                };

                var chart = new google.visualization.PieChart(document.getElementById('piechart2'));

                chart.draw(data, options);
            }
        </script>
    </body>

    </html>
@else
    @php
        echo redirect()
            ->route('admin.form.login')
            ->with('invalid', 'Xin vui lòng đăng nhập.');
    @endphp
@endif
