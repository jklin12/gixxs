<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>{{ config('site.site_name');  }}</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />

    <!-- ================== BEGIN BASE CSS STYLE ================== -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link href="assets/css/default/app.min.css" rel="stylesheet" />
    <!-- ================== END BASE CSS STYLE ================== -->
</head>

<body class="pace-top">
    <!-- begin #page-loader -->
    <div id="page-loader" class="fade show">
        <span class="spinner"></span>
    </div>
    <!-- end #page-loader -->

    <!-- begin #page-container -->
    <div id="page-container" class="fade">
        <!-- begin login -->
        <div class="login login-with-news-feed">
            <!-- begin news-feed -->
            <div class="news-feed">
                <div class="news-image" style="background-image: url(assets/img/login-bg/login-bg-11.jpg)"></div>
                <div class="news-caption">
                    <h4 class="caption-title">{{ config('site.site_name');  }}</h4>
                    <p>
                        {{ config('site.site_desc');  }}
                    </p>
                </div>
            </div>
            <!-- end news-feed -->
            <!-- begin right-content -->
            <div class="right-content">
                <!-- begin login-header -->

                <div class="login-header">
                    <div class="text-center mb-2">
                        <img src="assets/img/logo.png" alt="logo" width="100" class="">
                    </div>
                    <div class="brand">
                        <h4>{{ config('site.site_name');  }}</h4>
                        <small> {{ config('site.site_desc');  }}</small>
                    </div>

                </div>
                <!-- end login-header -->
                @if($errors->any())
                @foreach($errors->all() as $err)
                <p class="alert alert-danger">{{ $err }}</p>
                @endforeach
                @endif
                <!-- begin login-content -->
                <div class="login-content">
                    <form action="{{ route('login.action' )}}" method="post" class="margin-bottom-0">
                        @csrf
                        <div class="form-group m-b-15">
                            <input type="text" name="email" class="form-control form-control-lg" placeholder="Email Address" required value="{{ old('username') }}" />
                        </div>
                        <div class="form-group m-b-15">
                            <input type="password" name="password" class="form-control form-control-lg" placeholder="Password" required />
                        </div>

                        <div class="login-buttons">
                            <button type="submit" class="btn btn-success btn-block btn-lg">Sign me in</button>
                        </div>

                        <hr />
                        <p class="text-center text-grey-darker mb-0">
                            &copy;{{ config('site.site_desc').' '.date('Y') }}
                        </p>
                    </form>
                </div>
                <!-- end login-content -->
            </div>
            <!-- end right-container -->
        </div>
        <!-- end login -->


        <!-- begin scroll to top btn -->
        <a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
        <!-- end scroll to top btn -->
    </div>
    <!-- end page container -->

    <!-- ================== BEGIN BASE JS ================== -->
    <script src="assets/js/app.min.js"></script>
    <script src="assets/js/theme/default.min.js"></script>
    <!-- ================== END BASE JS ================== -->
</body>

</html>