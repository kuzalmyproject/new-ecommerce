@extends('frontend.main_master')
@section('content')
<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="home.html">Home</a></li>
                <li class='active'>Forget Password</li>
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content">
    <div class="container">
        <div class="sign-in-page">
            <div class="row">
                <!-- Sign-in -->            
<div class="col-md-12 col-sm-12 sign-in">
    <h4 class="">Forget Password</h4>
    <p class="">Hello, Welcome to your account.</p>
<!--     <div class="social-sign-in outer-top-xs">
        <a href="#" class="facebook-sign-in"><i class="fa fa-facebook"></i> Sign In with Facebook</a>
        <a href="#" class="twitter-sign-in"><i class="fa fa-twitter"></i> Sign In with Twitter</a>
    </div> -->
    <form method="POST" action="{{ route('password.email') }}">
            @csrf
        <div class="form-group">
            <label class="info-title" for="email">Email Address <span>*</span></label>
            <input type="email" class="form-control unicase-form-control text-input" id="email" name="email" >
            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong> {{ $message }}</strong>
            </span>
            @enderror
        </div>
        <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Email Password Reset Link</button>
    </form>                 
</div>
<!-- Sign-in -->

 
<!-- create a new account -->           </div><!-- /.row -->
        </div><!-- /.sigin-in-->
        <!-- ============================================== BRANDS CAROUSEL ============================================== -->
         @include('frontend.body.brand')
</.logo-slider-inner -->
    
</div><!-- /.logo-slider -->
<!-- ============================================== BRANDS CAROUSEL : END ============================================== -->    </div><!-- /.container -->
</div>
@endsection