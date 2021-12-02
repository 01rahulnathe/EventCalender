<?php
session_start();

if(!isset($_SESSION['username'])){
	header('Location: index.php'); 
	exit;
}

$errors = [];

if(isset($_POST['register_c'])){
		
	$e_mail = $_POST['email'];
	$address = $_POST['address'];
	$pincode = $_POST['pincode'];
	$c_number = $_POST['c_number'];
	$city = $_POST['city'];
	$state = $_POST['state'];
	
	
	if($e_mail == ''){
		$errors[] = 'Please enter Email Id';
	}else{
		if(preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $e_mail)){
			
		}else{
			$errors[] = 'Please enter valid Email Id';
		}
	}
	
	
	if($address == ""){
		$errors[] = 'Enter Address';
	}
	
	if($c_number == ""){
		$errors[] = 'Enter Mobile Number';
	}
	
	if($city == ""){
		$errors[] = 'Enter City';
	}
	
	if($state == ""){
		$errors[] = 'Enter State';
	}
	
	if($pincode == ""){
		$errors[] = 'Enter Postal Code';
	}
	
	if(count($errors) == 0){
	
		$xml = simplexml_load_file('users/'. $_SESSION['username']. '.xml');
		$sxe = new SimpleXMLElement($xml->asXML());
		$cinfo = $sxe->addChild("contact_info");
		$cinfo->addChild('email',  $e_mail);
		$cinfo->addChild('address', $address);
		$cinfo->addChild('pincode', $pincode);
		$cinfo->addChild('c_number', $c_number);
		$cinfo->addChild('city', $city);
		$cinfo->addChild('state', $state);

		$sxe->asXML('users/' . $_SESSION['username'] . '.xml');
		header('Location: academic_register.php');
		exit;
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
        <title>Contact Info</title>
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
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Create Account (Contact Info)</h3></div>
									
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
                                       <form action="contact_register.php" method="POST">
											<div class="form-group required control-label"><label class="small mb-1" for="inputEmailAddress">Email</label><input class="form-control py-4" id="inputEmailAddress" type="email" name="email" aria-describedby="emailHelp" placeholder="Enter Email Id" /></div>
											
											<div class="form-group required control-label"><label class="small mb-1" for="inputAddress">Address</label>
												<textarea placeholder="Enter your address here" class="form-control" id="inputAddress" name="address" rows="4"></textarea>
											</div>
											
											<div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group required control-label"><label class="small mb-1" for="inputFirstName">Postal / Zip Code</label><input class="form-control py-4" id="pincode" name="pincode" type="text" placeholder="Enter Pincode" /></div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group required control-label"><label class="small mb-1" for="inputLastName">Mobile Number</label><input class="form-control py-4" id="c_number" name="c_number" type="text" placeholder="Enter Mobile Number" /></div>
                                                </div>
                                            </div>
											
											
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group required control-label"><label class="small mb-1" for="inputPassword">City</label><input class="form-control py-4" id="inputPassword" name="city" type="text" placeholder="Enter City" /></div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group required control-label"><label class="small mb-1" for="inputConfirmPassword">State / Province</label><input class="form-control py-4" id="inputConfirmPassword" name="state" type="text" placeholder="Enter State" /></div>
                                                </div>
                                            </div>
                                            <div class="form-group mt-4 mb-0">
											<button class="btn btn-primary" type="submit" class="signupbtn" name="register_c">Save information</button>
											</div>
                                        </form>
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
