<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Signup - GSUniversity</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css"> <!-- Reusing the same CSS file as login.php -->
	<link rel="icon" href="logo.png">
</head>
<body class="body-login"> <!-- Keeping the same class as in login.php for consistency -->
    <div class="black-fill"><br /> <br />
    	<div class="d-flex justify-content-center align-items-center flex-column">
    	<form class="signup" 
    	      method="post"
    	      action="req/signup_process.php">

    		<div class="text-center">
    			<img src="logo.png"
    			     width="100">
    		</div>
    		<h3>SIGN UP</h3>
    		<?php if (isset($_GET['error'])) { ?>
    		<div class="alert alert-danger" role="alert">
			  <?=$_GET['error']?>
			</div>
			<?php } ?>
			<?php if (isset($_GET['success'])) { ?>
    		<div class="alert alert-success" role="alert">
			  <?=$_GET['success']?>
			</div>
			<?php } ?>
			<div class="mb-3">
		   <!-- <label class="form-label">Image</label>
		    <input type="file" id="myFile" name="gender" 
		           class="form-control"
		            required>-->
		  </div>
		  <div class="mb-3">
		    <label class="form-label">First name</label>
		    <input type="text" 
		           class="form-control"
		           name="fname" required>
		  </div>
		  <div class="mb-3">
		    <label class="form-label">Last name</label>
		    <input type="text" 
		           class="form-control"
		           name="lname" required>
		  </div>
		  <div class="mb-3">
		    <label class="form-label">Address</label>
		    <input type="text" 
		           class="form-control"
		           name="address" required>
		  </div>
		  <div class="mb-3">
		    <label class="form-label">Date of birth</label>
		    <input type="date" 
		           class="form-control"
		           name="date_of_birth" required>
		  </div>
		
		  <div class="mb-3">
		    <label class="form-label">Email address</label>
		    <input type="email" 
		           class="form-control"
		           name="email_address" required>
		  </div>
		    <div class="mb-3">
		    <label class="form-label">Gender</label><br>
			<input type="radio" name="gender" value="male" required> Male<br>
  <input type="radio" name="gender"  value="female"> Female<br>
		  
		  </div>
		  <div class="mb-3">
		    <label class="form-label">Date of joined</label>
		    <input type="date" 
		           class="form-control"
		           name="date_of_joined" required>
		  </div>
		  <div class="mb-3">
		  <!--  <label class="form-label">Grade</label>
			
		   <input type="text" 
		           class="form-control"
		           name="grade" required>
				   -->
				   
		  </div>
		  <div class="mb-3">
		    <label class="form-label">Section</label>
		    <input type="text" 
		           class="form-control"
		           name="section" required>
		  </div>
		  <div class="mb-3">
		    <label class="form-label">Parent first name</label>
		    <input type="text" 
		           class="form-control"
		           name="parent_fname" required>
		  </div>
		  <div class="mb-3">
		    <label class="form-label">Parent last name</label>
		    <input type="text" 
		           class="form-control"
		           name="parent_lname" required>
		  </div>
		  <div class="mb-3">
		    <label class="form-label">Parent phone number</label>
		    <input type="text" 
		           class="form-control"
		           name="parent_phone_number" required>
		  </div>
		  <div class="mb-3">
		    <label class="form-label">Username</label>
		    <input type="text" 
		           class="form-control"
		           name="username" required>
		  </div>
		  
		  
		  
		  <div class="mb-3">
		    <label class="form-label">Password</label>
		    <input type="password" 
		           class="form-control"
		           name="password" required>
		  </div>

		  <div class="mb-3">
		    <label class="form-label">Confirm Password</label>
		    <input type="password" 
		           class="form-control"
		           name="confirm_password" required>
		  </div>
		    <div class="mb-3">
		    <label class="form-label">Signup As</label>
		    <select class="form-control"
		            name="role" required>
		    	<option value="1">Admin</option>
		    	<option value="2">Teacher</option>
		    	<option value="3">Student</option>
		    	<option value="4">Registrar Office</option>
		    </select>
		  </div>

		  <button type="submit" class="btn btn-primary">Signup</button>
		  <a href="index.php" class="text-decoration-none">Home</a>
		  <a href="login.php" class="text-decoration-none">Login</a>
		</form>
        
        <br /><br />
        <div class="text-center text-light">
        	Copyright &copy; 2024 GSUniversity. All rights reserved.
        </div>

    	</div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>	
</body>
</html>
