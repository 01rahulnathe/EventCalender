<?php

session_start();

if(isset($_SESSION['username']) && file_exists('users/'. $_SESSION['username']. '.xml')){
	header('Location: index.php'); exit;
}

$errors = [];

if(isset($_POST['register'])){
	
	// echo '<pre>'; print_r($_POST); echo '</pre>'; exit;
	
	$user_name = preg_replace('/[^A-Za-z]/', '', $_POST['username']);
	// $e_mail = $_POST['email'];
	$pass = $_POST['password'];
	$c_pass = $_POST['c_password'];
	
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	// $c_number = $_POST['c_number'];
	
	if($fname == ''){
		$errors[] = 'Enter the valid First Name';
	}
	
	if($lname == ''){
		$errors[] = 'Enter the valid Last Name';
	}
	
	if($user_name == ''){
		$errors[] = 'Enter the valid Username';
	}
	
	if(file_exists('users/'. $user_name. '.xml')){
		$errors[] = $user_name.' Username alredy exists.';
	}
	
	
	// if($e_mail == ''){
		// $errors[] = 'Please enter the valid Email address.';
	// }
	
	if($pass == "" || $c_pass == ""){
		$errors[] = 'Enter the valid Password';
	}
	
	if($pass != $c_pass ){
		$errors[] = 'Passwords do not match';
	}
	
	if(count($errors) == 0){
		$xml = new SimpleXMLElement('<user></user>');
		$xml->addChild('fname', $fname);
		$xml->addChild('lname', $lname);
		// $xml->addChild('c_number', $c_number);
		$xml->addChild('password', md5($pass));
		$xml->addChild('email', $e_mail);
		$xml->asXML('users/' . $user_name . '.xml');
		
		session_start();
		$_SESSION['username'] = $user_name;
		header('Location: contact_register.php');
	}
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Personal Info</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
    </head>
	
	<style>
		.form-group.required.control-label:before{
		color: red;
		content: "*";
		position: absolute;
		margin-left: -10px;
		}
	</style>
	
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Create Account (Personal Info)</h3></div>
										<?php
	 
										 if(count($errors) > 0){	
											echo '<ul>';
											foreach ($errors as $error){
												echo '<li class="text-danger">'.$error.'</li>';
											}
											echo '</ul>';
										 }
										
										?>
                                    <div class="card-body">
                                       <form action="register.php" method="POST">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group required control-label"><label class="small mb-1" for="inputFirstName">First Name</label><input class="form-control py-4" id="inputFirstName" name="fname" type="text" placeholder="Enter first name" /></div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group required control-label"><label class="small mb-1" for="inputLastName">Last Name</label><input class="form-control py-4" id="inputLastName" name="lname" type="text" placeholder="Enter last name" /></div>
                                                </div>
                                            </div>
											
											<div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group required control-label"><label class="small mb-1" for="inputFirstName">Username</label><input class="form-control py-4" id="username" name="username" type="text" placeholder="Enter Username" /></div>
                                                </div>
                                            </div>
											
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group required control-label"><label class="small mb-1" for="inputPassword">Password</label><input class="form-control py-4" id="inputPassword" name="password" type="password" placeholder="Enter password" /></div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group required control-label"><label class="small mb-1" for="inputConfirmPassword">Confirm Password</label><input class="form-control py-4" id="inputConfirmPassword" name="c_password" type="password" placeholder="Confirm password" /></div>
                                                </div>
                                            </div>
                                            <div class="form-group mt-4 mb-0">
											<button class="btn btn-primary" type="submit" class="signupbtn" name="register">Create Account</button>
											</div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center">
                                        <div class="small"><a href="login.php">Have an account? Go to login</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; </div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
