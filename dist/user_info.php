<?php

session_start();

if(!file_exists('users/'. $_SESSION['username']. '.xml')){
	header('Location: login.php'); exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>User Info</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>

<nav class="navbar navbar-inverse">
	<div class="container-fluid">
		<div class="navbar-header">
			<a class="navbar-brand" href="index.php">Add calendar events</a>
		</div>

		<ul class="nav navbar-nav navbar-right">
			<li><a href="user_info.php"><span class="glyphicon glyphicon-user"></span><?php echo ucfirst($_SESSION['username']); ?></a></li>
			<li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Sign Out </a></li>
		</ul>
	</div>
</nav>
  
	<?php
		$user_array = array();
		$users = simplexml_load_file('users/'. $_SESSION['username']. '.xml');
	?>


<div class="container">
      <div class="row">
      <div class="col-md-5  toppad  pull-right col-md-offset-3 ">
		<br>
      </div>
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >
   
   
          <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title"><?php echo ucfirst($users->fname).' '. ucfirst($users->lname); ?></h3>
            </div>
            <div class="panel-body">
              <div class="row">
				<br>
				
                <div class=" col-md-9 col-lg-9 "> 
                  <table class="table table-user-information">
                    <tbody>
					
						<?php
							foreach ($users->contact_info as $contact_det){}
							foreach ($users->academic_info as $academic_det){}
						?>
						<tr>
							<td><b>Contact Info</b></td>
							<td></td>
						</tr>
						<tr>
							<td>Email:</td>
							<td><a href="mailto:<?php echo $contact_det->email; ?>"><?php echo $contact_det->email; ?></a></td>
						</tr>
						<tr>
							<td>Address:</td>
							<td><?php echo $contact_det->address; ?></td>
						</tr>
						<tr>
							<td>Pin Code</td>
							<td><?php echo $contact_det->pincode; ?></td>
						</tr>
						<tr>
							<td>Contact Number</td>
							<td><?php echo $contact_det->c_number; ?></td>
						</tr>
						<tr>
							<td>City</td>
							<td><?php echo $contact_det->city; ?></td>
						</tr>
						<tr>
							<td>State</td>
							<td><?php echo $contact_det->state; ?></td>
						</tr>
						
						<tr>
							<td><b>Academic Info</b></td>
							<td></td>
						</tr>
						<tr>
							<td>School or College/University</td>
							<td><?php echo $academic_det->school; ?></td>
						</tr>
						<tr>
							<td>Degree</td>
							<td><?php echo $academic_det->degree; ?></td>
						</tr>
						<tr>
							<td>Specialization</td>
							<td><?php echo $academic_det->specialization; ?></td>
						</tr>
						<tr>
							<td>Start year</td>
							<td><?php echo $academic_det->s_year; ?></td>
						</tr>
						<tr>
							<td>End year</td>
							<td><?php echo $academic_det->end_year; ?></td>
						</tr>
                     
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</body>

</html>
