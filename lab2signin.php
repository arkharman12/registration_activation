<!-- TITLE: Sign In
AUTHOR: Harmanjot Singh
PURPOSE: Log in the user
ORIGINALLY CREATED ON: 17 Sep 2019
LAST MODIFIED ON: 20 Sep 2019
LAST MODIFIED BY: Harmanjot Singh
MODIFICATION HISTORY: Original Build -->

<?php
session_start();
?> 

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Sign In Form</title>
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
	<!-- <link rel="stylesheet" href="style.css" type="text/css" /> -->
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/mobile.css" media="screen and (max-width : 568px)">
</head>
<body>
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
    <?php
	    $email = "";
      $pass = "";

      if (isset($_POST["enter1"])) { //check if this page is requested after Submit button is clicked
				
			//take the information submitted and send to the data file
				
			// Email and Password
			$email = trim($_POST['email']); 
			$pass = trim($_POST['password']);
						
			
      $_SESSION['email']= $email;
      $_SESSION['password']= $pass;
					
			Header ("Location:lab2info.php?");
		}
		
    ?>
    
    <div class="container">
    <h2 style="color:green"><strong>Congratulations! You have successfully activated your account</strong></h2>
      <form class="well form-horizontal" action="lab2signin.php" method="post" id="contact_form">
        <fieldset>
          
          <!-- Text input-->
          <div class="form-group">
            <label class="col-md-4 control-label">Email </label>
            <div class="col-md-4 inputGroupContainer">
              <div class="input-group">
                <span class="input-group-addon"
                ><i class="glyphicon glyphicon-user"></i
                ></span>
                <input
                  value="<?php print $email; ?>" 
                  name="email"
                  placeholder="E-mail"
                  class="form-control"
                  type="email"
                  id="email"
                />
              </div>
            </div>
          </div>

            <!-- Text input-->
          <div class="form-group">
                <label class="col-md-4 control-label">Password </label>
                <div class="col-md-4 inputGroupContainer">
                  <div class="input-group">
                    <span class="input-group-addon"
                      ><i class="glyphicon glyphicon-lock"></i
                    ></span>
                    <input
                      value="<?php print $pass; ?>" 
                      name="password"
                      placeholder="Password"
                      class="form-control"
                      type="password"
                      id="password"
                    />
                  </div>
                </div>
              </div>
		
          <!-- Button -->
          <div class="form-group">
            <label class="col-md-4 control-label"></label>
            <div class="col-md-4">
              <button name="enter1" type="submit" class="btn btn-success">Login</button>
            </div>
          </div>
        </fieldset>
      </form>
    </div>

  </body>
</html>








