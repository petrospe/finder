<!DOCTYPE html>
<html lang="en">
<head>
	<title>Under Constraction</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="{{ asset('images/icons/favicon.png') }}"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('css/comingsoon/bootstrap.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('css/comingsoon/font-awesome.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('css/comingsoon/animate.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('css/comingsoon/select2.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('css/comingsoon/util.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/comingsoon/main.css') }}">
<!--===============================================================================================-->
</head>
<body>

	<!--  -->
	<div class="simpleslide100">
		<div class="simpleslide100-item bg-img1" style="background-image: url('{{ asset('images/bg01.jpg') }}');"></div>
		<div class="simpleslide100-item bg-img1" style="background-image: url('{{ asset('images/bg02.jpg') }}');"></div>
	</div>

	<div class="flex-col-c-sb size1 overlay1">
		<!--  -->
		<div class="w-full flex-w flex-sb-m p-l-80 p-r-80 p-t-22 p-lr-15-sm">
			<div class="wrappic1 m-r-30 m-t-10 m-b-10">
        @if (Route::has('login'))
                @auth
                    <a href="{{ url('/home') }}">
                @else
                    <a href="{{ route('login') }}">
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}">
                    @endif
                @endauth
        @endif
          <img src="{{ asset('images/icons/logo.png') }}" alt="LOGO">
        </a>
			</div>

			<div class="flex-w m-t-10 m-b-10">
				<a href="{{ route('login') }}" class="size2 m1-txt1 flex-c-m how-btn1 trans-04">
					Sign Up
				</a>
			</div>
		</div>

		<!--  -->
		<div class="flex-col-c-m p-l-15 p-r-15 p-t-50 p-b-120">
			<h3 class="l1-txt1 txt-center p-b-40 respon1">
				Coming Soon
			</h3>

			<div class="flex-w flex-c-m cd100">
				<div class="flex-col-c wsize1 m-b-30">
					<span class="l1-txt2 p-b-9 days">35</span>
					<span class="s1-txt1 where1 p-l-35">Days</span>
				</div>

				<div class="flex-col-c wsize1 m-b-30">
					<span class="l1-txt2 p-b-9 hours">17</span>
					<span class="s1-txt1 where1 p-l-35">Hours</span>
				</div>

				<div class="flex-col-c wsize1 m-b-30">
					<span class="l1-txt2 p-b-9 minutes">50</span>
					<span class="s1-txt1 where1 p-l-35">Minutes</span>
				</div>

				<div class="flex-col-c wsize1 m-b-30">
					<span class="l1-txt2 p-b-9 seconds">39</span>
					<span class="s1-txt1 where1 p-l-35">Seconds</span>
				</div>
			</div>
		</div>

		<!--  -->
		<div class="flex-w flex-c-m p-b-35">
			<a href="#" class="size3 flex-c-m how-social trans-04 m-r-3 m-l-3 m-b-5">
				<i class="fa fa-facebook"></i>
			</a>

			<a href="#" class="size3 flex-c-m how-social trans-04 m-r-3 m-l-3 m-b-5">
				<i class="fa fa-twitter"></i>
			</a>

			<a href="#" class="size3 flex-c-m how-social trans-04 m-r-3 m-l-3 m-b-5">
				<i class="fa fa-youtube-play"></i>
			</a>
		</div>
	</div>





<!--===============================================================================================-->
	<script src="{{ asset('js/comingsoon/jquery-3.2.1.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('js/comingsoon/popper.js') }}"></script>
	<script src="{{ asset('js/comingsoon/bootstrap.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('js/comingsoon/select2.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('js/comingsoon/moment.min.js') }}"></script>
	<script src="{{ asset('js/comingsoon/moment-timezone.min.js') }}"></script>
	<script src="{{ asset('js/comingsoon/moment-timezone-with-data.min.js') }}"></script>
	<script src="{{ asset('js/comingsoon/countdowntime.js') }}"></script>
	<script>
		$('.cd100').countdown100({
			/*Set Endtime here*/
			/*Endtime must be > current time*/
			endtimeYear: 2020,
			endtimeMonth: 04,
			endtimeDate: 28,
			endtimeHours: 22,
			endtimeMinutes: 0,
			endtimeSeconds: 0,
			timeZone: ""
			// ex:  timeZone: "America/New_York"
			//go to " http://momentjs.com/timezone/ " to get timezone
		});
	</script>
<!--===============================================================================================-->
	<script src="{{ asset('js/comingsoon/tilt.jquery.min.js') }}"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="{{ asset('js/comingsoon/main.js') }}"></script>

</body>
</html>
