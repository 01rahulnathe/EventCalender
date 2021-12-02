<?php

session_start();

if(!isset($_SESSION['username'])){
	header('Location: index.php'); 
	exit;
}

$errors = [];

if(isset($_POST['register_a'])){
	
	##echo '<pre>'; print_r($_POST); echo '</pre>'; exit;
	
	$school = $_POST['school'];
	$degree = $_POST['degree'];
	$specialization = $_POST['specialization'];
	$s_year = $_POST['s_year'];
	$end_year = $_POST['end_year'];
	
	
	if($school == ''){
		$errors[] = 'Enter "School or College/University"';
	}
	
	if($degree == ''){
		$errors[] = 'Enter Degree';
	}
	
	if($specialization == ""){
		$errors[] = 'Enter Specialization';
	}
	
	if($s_year == ""){
		$errors[] = 'Enter Start year';
	}
	
	if($end_year == ""){
		$errors[] = 'Enter End year';
	}
	
	if(count($errors) == 0){
		
		$xml = simplexml_load_file('users/'. $_SESSION['username']. '.xml');
		$sxe = new SimpleXMLElement($xml->asXML());
		$cinfo = $sxe->addChild("academic_info");
		$cinfo->addChild('school',  $school);
		$cinfo->addChild('degree', $degree);
		$cinfo->addChild('specialization', $specialization);
		$cinfo->addChild('s_year', $s_year);
		$cinfo->addChild('end_year', $end_year);

		$sxe->asXML('users/' . $_SESSION['username'] . '.xml');
		header('Location: index.php');
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
        <title>Academic Info</title>
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
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Create Account (Academic Info)</h3></div>
									
																		
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
                                       <form action="academic_register.php" method="POST">
											
											<div class="form-group required control-label"><label class="small mb-1" for="inputEmailAddress">School or College/University </label><input required="required" class="form-control py-4" id="inputEmailAddress" type="text" name="school" /></div>
											
											<div class="form-group required control-label"><label class="small mb-1" for="inputEmailAddress">Degree </label><input class="form-control py-4" id="inputEmailAddress" required="required" type="text" name="degree" /></div>
											
											<div class="form-group required control-label"><label class="small mb-1" for="inputEmailAddress">Specialization </label><input required="required" class="form-control py-4" id="inputEmailAddress" type="text" name="specialization" /></div>
											
											<div class="form-row required control-label">
                                                <div class="col-md-6">
                                                    <div class="form-group required control-label"><label class="small mb-1" for="inputFirstName">Start year </label><input required="required" class="form-control py-4" id="s_year" name="s_year" type="text" /></div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group required control-label"><label class="small mb-1" for="inputLastName">End year </label><input required="required" class="form-control py-4" id="end_year" name="end_year" type="text" /></div>
                                                </div>
                                            </div>
											
                                            <div class="form-group mt-4 mb-0">
											<button class="btn btn-primary" type="submit" class="signupbtn" name="register_a">Create Account</button>
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
