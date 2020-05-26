<!-- TITLE: Form Validation and Verification
AUTHOR: Harmanjot Singh
PURPOSE: Validate and Verify the User
ORIGINALLY CREATED ON: 17 Sep 2019
LAST MODIFIED ON: 20 Sep 2019
LAST MODIFIED BY: Harmanjot Singh
MODIFICATION HISTORY: Original Build -->

<?php
session_start();
require_once "inc/util.php";
require_once "mail/mail.class.php";
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Contact - Mustache Enthusiast</title>
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
		<div id="header">
				<a href="index.php" class="logo">
					<img src="images/logo.jpg" alt="">
				</a>
				<ul id="navigation">
					<li>
						<a href="index.php">home</a>
					</li>
					<li>
						<a href="about.php">about</a>
					</li>
					<li>
						<a href="gallery.php">gallery</a>
					</li>
					<li>
						<a href="blog.php">blog</a>
					</li>
					<li class="selected">
						<a href="lab2.php">contact</a>
					</li>
				</ul>
		</div>
		
    <?php
			$fn = "";
			$ln = "";
			$em = "";
      $msg = "";
      $msg2 = "";
      $msg3 = "";
      $confirm_em = "";
      $pass = "";
      $confirm_pass = "";
      $gender = "";
			$department = "";
			$selected = "";
			  
			$fnre="*";
			$lnre="*";
      $emre="*";
      $confirm_emre="*";

      $passre="*";
      $confirm_passre="*";

			$male_checked = "";
			$female_checked = "";

			$student_checked = "";
			$faculty_checked = "";
      $staff_checked = "";

      $pass_req_msg = "(Must contain at least 10 characters with letters and numbers)";
      $pwdok = false;
      $agreeok = false;
      $selectok = false;

      if (isset($_POST["enter"])) { //check if this page is requested after Submit button is clicked
				
			// First name and Last name
			$fn = trim($_POST['first_name']); 
			$ln = trim($_POST['last_name']);

			// Email and confirm email
			if (!filter_input(INPUT_POST, 'email',FILTER_VALIDATE_EMAIL)) 
				$emre = '<span style="color:red">*</span>';
      else $em = trim($_POST['email']);
        
      if (!filter_input(INPUT_POST, 'confirm_email',FILTER_VALIDATE_EMAIL)) 
				$confirm_emre = '<span style="color:red">*</span>';
      else $confirm_em = trim($_POST['confirm_email']);

      // Validate emails
      if (trim($_POST['email']) != trim($_POST['confirm_email']))
        $confirm_emre = '<span style="color:red">*</span>';

      // Password and confirm password
        $pass = trim($_POST['password']); 
        $confirm_pass = trim($_POST['confirm_password']);
      
      // Match the passwords
      if (!pwdValidate($pass))
        $passre = '<span style="color:red">*</span>';
      else if ($pass!= $confirm_pass)
        $confirm_passre = '<span style="color:red">*</span>';
      else
        $pwdok = true;
        
      // Gender
			if (isset($_POST['gender']))
				$gender = trim($_POST['gender']);
		
			if ($gender=="Male") {
				$male_checked="checked";
				$female_checked="";
			}
			else {
				$male_checked="";
				$female_checked="checked";
			}
        
      // Department
			$department = trim($_POST['department']);
        
      // Make the star red if value is empty for any of the required fields
			if ($fn== "")
         	$fnre = "<span style=\"color:red\">*</span>";
				
			if ($ln== "")
          $lnre = '<span style="color:red">*</span>';

      if ($em== "")
          $emre = '<span style="color:red">*</span>';
          
      if ($confirm_em== "")
				  $confirm_emre = '<span style="color:red">*</span>';
          
      if ($pass== "")
          $passre = '<span style="color:red">*</span>';
          
      if ($confirm_pass== "")
          $confirm_passre = '<span style="color:red">*</span>';
            
      if (isset($_POST['terms'])) {
        $agreeok = true;
      } else {
        $msg2 = "<br /><span style=\"color:red\">You must agree to the Terms & Policies</span><br />";
      }
      
    
      // Validate the Checkboxes
      if (isset($_POST['status1']) || isset($_POST['status2']) || isset($_POST['status3'])) {
        $selectok = true;
      } else {
        $msg3 = "<br /><span style=\"color:red\">You must select your status</span><br />";
      }


      // Make sure user doesn't get through without passing the requirements
			if (($fnre!="*") || ($lnre != "*") || ($emre != "*") || ($confirm_emre != "*") || ($passre != "*") || ($confirm_passre != "*"))				
			{	
        $msg = "<br /><span style=\"color:red\">Please check errors and enter valid data.</span><br />";
			} else if ($agreeok != true) {
        $msg2 = "<br /><span style=\"color:red\">You must agree to the Terms & Policies</span><br />";
      } else if ($selectok != true) {
        $msg3 = "<br /><span style=\"color:red\">You must select your status</span><br />";
      }
			else {					
				//now send the email to the username registered for activating the account
        $code = randomCodeGenerator(50);
        $subject = "Email Activation";
                  
        $body = 'Welcome User! <br/> <br/>
          Please click on the link below to activate your account. <br/>
          http://corsair.cs.iupui.edu:24061/lab2/lab2signin.php?a='.$code;
           
        $mailer = new Mail();
        if (($mailer->sendMail($em, $fn, $subject, $body))==true)
          $msg = '<span style="color:green"><b>Thank you for registering! A welcome message has been sent to the e-mail address you have just registered.</b></span><br /><br />';
        else $msg = "Email not sent. " . $em.' '. $fn.' '. $subject.' '. $body;
        
        //direct to the next page if necessary
        //Header ("Location:process.php?fn=".$fn."&ln=".$ln."&g=".$gender."&s=".$state."&b=".$birthYear) ;
			}
		}
		?>


    <div class="container">
      <form class="well form-horizontal" action="lab2.php" method="post" id="contact_form">
        <fieldset>
          
          <?php
            print $msg;
            print $msg3;
            print $msg2;
            // print $pass_error_msg;
          ?>

          <!-- Text input-->
          <div class="form-group">
            <label class="col-md-4 control-label">First Name<?php print $fnre; ?> </label>
            <div class="col-md-4 inputGroupContainer">
              <div class="input-group">
                <span class="input-group-addon"
                ><i class="glyphicon glyphicon-user"></i
                ></span>
                <input
                  value="<?php print $fn; ?>" 
                  name="first_name"
                  placeholder="First Name"
                  class="form-control"
                  type="text"
                  id="first_name"
                />
              </div>
            </div>
          </div>

          <!-- Text input-->
          <div class="form-group">
            <label class="col-md-4 control-label">Last Name <?php print $lnre; ?> </label>
            <div class="col-md-4 inputGroupContainer">
              <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                <input
                  value="<?php print $ln; ?>" 
                  name="last_name"
                  placeholder="Last Name"
                  class="form-control"
                  type="text"
                  id="last_name"
                />
              </div>
            </div>
          </div>

          <!-- Text input-->
          <div class="form-group">
            <label class="col-md-4 control-label">E-Mail <?php print $emre; ?></label>
            <div class="col-md-4 inputGroupContainer">
              <div class="input-group">
                <span class="input-group-addon"
                  ><i class="glyphicon glyphicon-envelope"></i
                ></span>
                <input
                  value="<?php print $em; ?>" 
                  name="email"
                  placeholder="E-Mail Address"
                  class="form-control"
                  type="email"
                  id="email"
                />
              </div>
            </div>
          </div>
          <!-- Text input I created-->
          <div class="form-group">
                <label class="col-md-4 control-label">Confirm E-Mail <?php print $confirm_emre; ?> </label>
                <div class="col-md-4 inputGroupContainer">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                    <input
                      value="<?php print $confirm_em; ?>" 
                      name="confirm_email"
                      placeholder="Confirm E-Mail Address"
                      class="form-control"
                      type="email"
                      id="confirm_email"
                    />
                  </div>
                </div>
            </div>

            <!-- Text input-->
          <div class="form-group">
                <label class="col-md-4 control-label">Password <?php print $passre; ?> </label>
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
                  <?php print $pass_req_msg; ?>
                </div>
              </div>
              <!-- Text input I created-->
              <div class="form-group">
                    <label class="col-md-4 control-label">Confirm Password <?php print $confirm_passre; ?> </label>
                    <div class="col-md-4 inputGroupContainer">
                      <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                        <input
                          value="<?php print $confirm_pass; ?>" 
                          name="confirm_password"
                          placeholder="Confirm Password"
                          class="form-control"
                          type="password"
                          id="confirm_password"
                        />
                      </div>
                    </div>
				        </div>
				
          <!-- radio checks -->
          <div class="form-group">
            <label class="col-md-4 control-label">Selct your gender: </label>
            <div class="col-md-4">
              <div class="radio">
                <label>
                  <input type="radio" name="gender" value="Male" checked <?php print $male_checked; ?> /> Male
                </label>
              </div>
              <div class="radio">
                <label>
                  <input type="radio" name="gender" value="Female" <?php print $female_checked; ?>  /> Female
                </label>
              </div>
            </div>
          </div>
          

          <!-- Select Basic -->

          <div class="form-group">
            <label class="col-md-4 control-label">Department: </label>
            <div class="col-md-4 selectContainer">
              <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
                <select name="department" class="form-control selectpicker">
                  	<option value = "Computer Engineering" selected>Computer Engineering</option>
  					<option value = "Biomedical Engineering">Biomedical Engineering</option>
  				    <option value = "Finance and Administration">Finance and Administration</option>
  				    <option value = "Geology">Geology</option>
					<option value = "Liberal Arts">Liberal Arts</option>
					<option value = "Mathematical Sciences">Mathematical Sciences</option>
  				    <option value = "Medicine">Medicine</option>
  				    <option value = "Neurology">Neurology</option>
  				    <option value = "Physics">Physics</option>
                </select>
              </div>
            </div>
		  </div>
		  

		  <!-- radio checks for status-->
          <div class="form-group">
            <label class="col-md-4 control-label">Status: </label>
            <div class="col-md-4">
              <div>
                <label>
                  <input type="checkbox" name="status1" value="Student" <?php print $student_checked; ?> /> Student
                </label>
              </div>
              <div>
                <label>
                  <input type="checkbox" name="status2" value="Faculty" <?php print $faculty_checked; ?>  /> Faculty
                </label>
			  </div>
			  <div>
                <label>
                  <input type="checkbox" name="status3" value="Staff" <?php print $staff_checked; ?>  /> Staff
                </label>
              </div>
            </div>
          </div>

          <!-- Terms and Policies -->
          <div class="form-group">
            <label class="col-md-4 control-label"></label>
            <div class="col-md-4 inputGroupContainer">
              <div class="input-group">
                <input type="checkbox" name="terms" id="terms"> Agree to Terms & Policies
                <br><br>
              </div>
            </div>
          </div>

          <!-- Button -->
          <div class="form-group">
            <label class="col-md-4 control-label"></label>
            <div class="col-md-4">
              <button name="enter" type="submit" class="btn btn-success">Submit </button>
            </div>
          </div>
        </fieldset>
      </form>
    </div>

  </body>
</html>








