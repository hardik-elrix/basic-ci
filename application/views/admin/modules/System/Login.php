<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login</title>
	<link href="<?=CDN_PATH?>css/bootstrap.min.css" rel="stylesheet">
	<link href="<?=CDN_PATH?>font-awesome/css/font-awesome.css" rel="stylesheet">
	<link href="<?=CDN_PATH?>css/animate.css" rel="stylesheet">
	<link href="<?=CDN_PATH?>css/style.css" rel="stylesheet">
</head>

<body class="gray-bg">

<div class="middle-box text-center loginscreen animated fadeInDown">
	<div>
		<div>
			<h1 class="logo-name">IN+</h1>
		</div>
		<h3>Welcome to IN+</h3>
		<p>Perfectly designed and precisely prepared admin theme with over 50 pages with extra new web app views.
		</p>
		<p>Login in. To see it in action.</p>
		<form class="m-t" id="auth_form" role="form" method="post" action="../auth/">
			<div class="form-group">
				<input type="email" id="username" name="username" class="form-control" placeholder="Username" required="">
			</div>
			<div class="form-group">
				<input type="password" id="password" name="password" class="form-control" placeholder="Password" required="">
			</div>
			<div id="response" style="display: none">
				<div class="alert" id="alert_box"></div>
			</div>
			<div style="display: none" id="process">
				<div class="sk-spinner sk-spinner-wave">
					<div class="sk-rect1"></div>
					<div class="sk-rect2"></div>
					<div class="sk-rect3"></div>
					<div class="sk-rect4"></div>
					<div class="sk-rect5"></div>
				</div>
				<br/>
			</div>
			<button type="submit" id="submit" class="btn btn-primary block full-width m-b">Login</button>
		</form>
		<a href="#"><small>Forgot password?</small></a>
		<p class="m-t"> <small>By Zest Brains</small> </p>
	</div>
</div>

<!-- Mainly scripts -->
<script src="<?=CDN_PATH?>js/jquery-3.1.1.min.js"></script>
<script src="<?=CDN_PATH?>js/bootstrap.min.js"></script>

<script>
    $('#auth_form').submit(function(){
        $('#response').hide();
        // show that something is loading
        $('#process').show();
        $("#username").prop('disabled', true);
        $("#password").prop('disabled', true);
        $('#submit').prop('disabled', true);

        /*
         * 'post_receiver.php' - where you will pass the form data
         * $(this).serialize() - to easily read form data
         * function(data){... - data contains the response from post_receiver.php
         */
        $.ajax({
            type: 'POST',
            url: '../auth/',
            data: {
                'username' : $("#username").val(),
				'password' : btoa($("#password").val())
			}
        })
			.done(function(data)
			{
			    data = $.trim(data);
			    if(data=='1')
				{
					$('#alert_box').removeClass("alert-danger");
					$('#alert_box').addClass("alert-success");
                    $('#alert_box').html("Loggedin Successful, Redirecting...");
                    $('#response').show();
                    url = "<?=SITEURLADM?>console/";
                    $( location ).attr("href", url);
				}
                else
				{
                    $('#process').hide();
                    $('#alert_box').html("Username or Password incorrect, Please try again.");
					$('#alert_box').removeClass("alert-success");
                    $('#alert_box').addClass("alert-danger");
                    $('#response').show();
                    $("#username").prop('disabled', false);
                    $("#password").prop('disabled', false);
                    $('#submit').prop('disabled', false);
				}
				
            })
            .fail(function() {
                $('#submit').prop('disabled', false);
                alert( "Something went wrong, please try again." );
            });

        // to prevent refreshing the whole page page
        return false;

    });
</script>

</body>

</html>