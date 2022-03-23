<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{ __('site.login') }}</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


   <!-- FontAwesome JS-->
   <script defer src="{{ asset('dashbaord_files/js/all.min.js') }}"></script>
   {{-- <script defer src="{{ asset('dashbaord_files/css/all.min.css') }}"></script> --}}


   <!-- App CSS -->
   <link id="theme-style" rel="stylesheet" href="{{ asset('dashbaord_files/css/portal.css') }}">
   <link id="theme-style" rel="stylesheet" href="{{ asset('dashbaord_files/css/custom.css') }}">

@if (LaravelLocalization::getCurrentLocale() =='ar')
    <style>
        *{
            direction: rtl;
            font-family: "Droid Sans", sans-serif/*rtl:prepend:"Droid Arabic Kufi",*/;
            font-size:16px/*rtl:14px*/;
        }
        .app-branding{
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>


@endif
</head>

<body class="app app-login p-0">
    <div class="row g-0 app-auth-wrapper">
	    <div class="col-12 col-md-7 col-lg-6 auth-main-col text-center p-5">
		    <div class="d-flex flex-column align-content-end">
			    <div class="app-auth-body mx-auto">
				    <div class="app-auth-branding mb-4"><a class="app-logo" href="index.html">
                        <img class="logo-icon me-2" src="{{ asset('logo.png') }}" alt="logo"></a></div>
					<h2 class="auth-heading text-center mb-5">{{ __('site.Dashboard_Login') }}</h2>
			        <div class="auth-form-container text-start">
						<form class="auth-form login-form" method="POST" action="{{ route('admin.login') }}">
                            @csrf
							<div class="email mb-3">
								<label class="sr-only" for="signin-email">{{ __('site.email') }}</label>
								<input id="signin-email" name="email" type="email" class="form-control signin-email @error('email') is-invalid @enderror" value="{{ old('email') }}"  placeholder="{{ __('site.email') }}" required="required">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div><!--//form-group-->
							<div class="password mb-3">
								<label class="sr-only" for="signin-password">{{ __('site.password') }}</label>
								<input id="signin-password" name="password" type="password" class="form-control signin-password" placeholder="{{ __('site.password') }}" required="required">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                <div class="extra mt-3 row justify-content-between">
									<div class="col-6">
										<div class="form-check">
											<input class="form-check-input" type="checkbox"  name="remember" id="RememberPassword">
											<label class="form-check-label" for="RememberPassword">
                                                {{ __('site.remember_me') }}
											</label>
										</div>
									</div><!--//col-6-->

								</div><!--//extra-->
							</div><!--//form-group-->
							<div class="text-center">
								<button type="submit" class="btn app-btn-primary w-100 theme-btn mx-auto">
                                                                                {{ __('site.login') }}
                                </button>
							</div>
						</form>

					</div><!--//auth-form-container-->

			    </div><!--//auth-body-->


		    </div><!--//flex-column-->
	    </div><!--//auth-main-col-->
	    <div class="col-12 col-md-5 col-lg-6 h-100 auth-background-col">
		    <div class="auth-background-holder">
		    </div>
		    <div class="auth-background-mask"></div>
		    <div class="auth-background-overlay p-3 p-lg-5">
			    <div class="d-flex flex-column align-content-end h-100">
				    <div class="h-100"></div>

				</div>
		    </div><!--//auth-background-overlay-->
	    </div><!--//auth-background-col-->

    </div><!--//row-->


</body>
</html>

