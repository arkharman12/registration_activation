<!-- TITLE: Logged in page
AUTHOR: Harmanjot Singh
PURPOSE: Display the user their account information
ORIGINALLY CREATED ON: 17 Sep 2019
LAST MODIFIED ON: 20 Sep 2019
LAST MODIFIED BY: Harmanjot Singh
MODIFICATION HISTORY: Original Build -->

<?php
session_start();
?>

<!DOCTYPE html>
<!-- Website Template by freewebsitetemplates.com -->
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Signed In</title>
	<!-- Bootstrap 3 -->
    <link
      rel="stylesheet"
      href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
      integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
      crossorigin="anonymous"
    />
    <!-- Minified version of jQuery CDN -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- Bootstrap validator-->
    <script
      type="text/javascript"
      src="http://cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.3/js/bootstrapValidator.min.js"
    ></script>
    <!-- External Stylesheet -->
	<link rel="stylesheet" href="style.css" type="text/css" />
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/mobile.css" media="screen and (max-width : 568px)">
</head>
<body>
	<?php
		$email = "";
		$pass = "";

    $email = $_SESSION['email'];
    $pass = $_SESSION['password'];
        
    ?>

    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
	<div class="container">
      <form class="well form-horizontal" action="" method="" id="contact_form">	
	  	<h2 style="color:green"><strong>You have successfully logged in! Close window to log out</strong></h2>
		<h5><strong>Your account info: </strong></h5>
        <div class="form-group">
        	<label class="col-md-4 control-label">
			<h4>
			Email: <?php print $email; ?> <br />
      Password: <?php print $pass; ?> <br />
			</h4>
			</label>
        </div>
      </form>
    </div>

</body>
</html>