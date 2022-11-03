@extends('client.templates.layout')
@section('title') - About
@endsection
@section('content')




  <!-- header -->
  <header class="single-header">
    <!-- Start: Header Content -->
    <div class="container">
        <div class="row text-center wow fadeInUp" data-wow-delay="0.5s">
            <div class="col-sm-12">
                <!-- Headline Goes Here -->
                <h3>Đăng Nhập</h3>
                <h4><a href="{{ route('home') }} "> Trang chủ </a> <span> &vert; </span> Đăng Nhập </h4>
            </div>
        </div>
        <!-- End: .row -->
    </div>
    <!-- End: Header Content -->
</header>
<!--/. header -->
<!--/
==================================================-->



<!-- Start: Account Section
==================================================-->
<section class="account-section">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="reg_wrap">
                    <!-- Start: Image -->
                    <div class="reg_img">
                        <img src="{{ asset('client/images/hero-men.png') }}" alt="">
                    </div>
                    <!-- Start:  Login Form  -->
                    <div class="login-form">
                        <h2> Đăng Nhập </h2>
                        <form method="post">
                            <input class="login-field" name="email" id="lemail" type="text"
                                placeholder="Email">
                            <input class="login-field" name="password" id="lpassword" type="text"
                                placeholder="Password">
                            <div class="lost_pass">
                                <input type="checkbox" id="rem-checkbox-input">
                                <label for="rem-checkbox-input" class="rem-checkbox">
                                    <span class="rem-me">Lưu tài khoản</span>
                                </label>
                                 <a href="#" class="forget" style="margin-left: 15px"> Quên mật khẩu? </a>
                            </div>
                            <div class="submit-area">
                                <a href="#" class="submit more-link"> Đăng Nhập </a>
                                <a href="#" class="submit more-link"> Đăng Ký Tài Khoản</a>
                                <div id="lmsg" class="message"></div>
                            </div>
                        </form>
                    </div>
                    <!-- End:Login Form  -->
                </div>
            </div>
            <!-- .col-md-6 .col-sm-12 /- -->
        </div>
        <!-- row /- -->
    </div>
    <!-- container /- -->
</section>
<!-- End : Account Section
==================================================-->



@endsection
