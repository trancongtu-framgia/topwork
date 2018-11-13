<html>
<head>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/mail.css') }}" />
</head>
<body>
<div class="container">
    <div class="row content-mail">
        <div class="row content-mail-header">
            @php
                $urlImage = asset('assets/clients/images/logo.png');
                    if (file_exists($urlImage)) {
                        $image = $urlImage;
                    } else {
                        $image = 'https://haymora.com/upload/images/cong_nghe_thong_tin/phan_mem/framgia_inc/framgia-logo.jpg';
                    }
            @endphp
            <div class="col-md-3">
                <img src="{{ $image }}">
            </div>
            <div class="col-md-9"></div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="content-mail-body">
                    @yield('contentMail')
                    <div class="content-mail-footer">
                        <p><i>Thank you for trusting and using Topwork.</i></p>
                        <div>
                            ---- <br/>
                            TOPWORK Team
                        </div>
                        <div class="content-mail-footer-information">
                            <table>
                                <tr>
                                    <td>Email:</td>
                                    <td>topwork2018@gmail.com</td>
                                </tr>
                                <tr>
                                    <td>Address:</td>
                                    <td> Handico Tower, Phạm Hùng, Mễ Trì, Nam Từ Liêm, Hà Nội</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
