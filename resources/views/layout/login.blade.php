
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Bootstrap 5 Admin &amp; Dashboard Template">
	<meta name="author" content="Bootlab">

	<title>Sign In | Arkamaya</title>

	<link rel="canonical" href="https://appstack.bootlab.io/pages-sign-in.html" />
	<link rel="shortcut icon" href="img/favicon.ico">

	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">

	<!-- Choose your prefered color scheme -->
	<!-- <link href="css/light.css" rel="stylesheet"> -->
	<!-- <link href="css/dark.css" rel="stylesheet"> -->

	<!-- BEGIN SETTINGS -->
	<!-- Remove this after purchasing -->
	<link class="js-stylesheet" href="{{asset('template')}}/dist/css/dark.css" rel="stylesheet">
	<script src="js/settings.js"></script>
	<!-- END SETTINGS -->
</head>
<!--
  HOW TO USE: 
  data-theme: default (default), dark, light
  data-layout: fluid (default), boxed
  data-sidebar-position: left (default), right
  data-sidebar-behavior: sticky (default), fixed, compact
-->

<body data-theme="default" data-layout="fluid" data-sidebar-position="left" data-sidebar-behavior="sticky">
	<div class="main d-flex justify-content-center w-100">
		<main class="content d-flex p-0">
			<div class="container d-flex flex-column">
				<div class="row h-100">
					<div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
						<div class="d-table-cell align-middle">

							<div class="card">
								<div class="card-body">
									<div class="m-sm-4">
										
										<form class="user" method="POST" action="{{ route('login') }}">
                        @csrf
                    <div class="form-group mb-3">
					<label class="form-label">Email</label>
                      <input id="email" type="email" name="email" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Enter Email Address...">
                                
                    </div>
                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                    <div class="form-group mb-3">
                    <label class="form-label">Password</label>
                      <input type="password" name="password" class="form-control form-control-lg @error('password') is-invalid @enderror" required id="password" placeholder="Password">
                                
                    </div>
                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                    <!-- <a href="/login" class="btn btn-primary btn-user btn-block">
                      Login
                    </a> -->
                    
                    <div class="text-center">
                    	<button type="submit" class="btn btn-info btn-user btn-block">Sign In</button>
                    </div>
                  
                  </form>
										<hr>
                  <div class="text-center">
                    <a class="text-white" href="/register"><strong>Create an Account!</strong></a>
                  </div>
									</div>
								</div>
							</div>

						</div>
					</div>
				</div>
			</div>
		</main>
	</div>

	<script src="{{asset('template')}}/dist/js/app.js"></script>

</body>

</html>