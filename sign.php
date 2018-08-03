<?php include_once("connection.php"); ?>



<?php 
    if(isset($_POST['submit1'])){

		if (empty($_POST['e_mail1']) || empty($_POST['password1'])){

			$errorMassage='fild is empty! ';
		}
                else
                {   $user_name=$_POST['e_mail1'];
                    $pass = $_POST['password1'];
					

      			$sql = " SELECT COUNT(*) FROM users WHERE( mail='".$user_name."'AND password='".$pass."') ";

				$qury = mysqli_query($conn, $sql);

				$result = mysqli_fetch_array($qury);
			
				if($result[0]>0)
                    {
						
                    $sessionSql = " SELECT id,user_name,password,type,supervisor,gender FROM users WHERE ( mail='".$user_name."' AND password='".$pass."') ";
					$sessionQury = mysqli_query($conn, $sessionSql);
					
					while($sessionResult = mysqli_fetch_array($sessionQury, MYSQLI_BOTH))
					{
						
						 $u_id = $sessionResult['id'];
						 $u_name = $sessionResult['user_name'];
						 $u_type = $sessionResult['type'];
						 $u_gender = $sessionResult['gender'];
						 $u_s = $sessionResult['supervisor'];
						 
					}
					
					session_start();
					
					$_SESSION['user_id'] = $u_id;
					$_SESSION['user_name'] = $u_name;
					$_SESSION['user_type'] = $u_type;
					$_SESSION['user_gender'] = $u_gender;
					$_SESSION['user_supervisor'] = $u_s;
					
					if($u_type == 3)
					{header('location: req_fac.php');}
					
					if($u_type == 2)
					{header('location: req_std.php');}
				
					if($u_type == 1)
					{header('location: admin_approve.php');}
				
					exit;				
                    }
                else
                {
                $errorMassage=' Invalid User Name or Password ';
                }
            }
        }
     			
?>


<?php
$errorMassage ="";
$succ = "";
$emailErr="";
$u_id="";
if(isset($_POST['submit'])){

		if (empty($_POST['user_name']) || empty($_POST['password']) || empty($_POST['mail']) || empty($_POST['phone']) ||  empty($_POST['gender']) || empty($_POST['type']) || empty($_POST['supervisor'])) {

			$errorMassage='fild is empty! ';
		}
                else{
                    
                    $mail = $_POST['mail'];
			

			if (!filter_var($mail, FILTER_VALIDATE_EMAIL))
                                {
                                $emailErr = 'Invalid email format'; 
                                }
                        else{            
						$name = $_POST['user_name'];
                        $password=$_POST['password'];
                        $phone = $_POST['phone'];
                        $sex = $_POST['gender'];
						$type = $_POST['type'];
						$supervisor = $_POST['supervisor'];
			

			$sql = "INSERT INTO users (user_name, password, type, phone, mail, supervisor,gender)
				VALUES ('".$name."','".$password."','".$type."','".$phone."','".$mail."','".	$supervisor."','".$sex."')";

				if (mysqli_query($conn, $sql)) {
				     $succ = "New record created successfully";
				} else {
				    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
				}
                        }
		}
	}
?>
	
<html>
<head>
<title>Leave Management</title>
<meta charset="UTF-8">
<link rel="stylesheet" href="styles/w3.css">
<link rel="stylesheet" type="text/css" href="css/style.css">

<style> 
        .bgimg 
		{
    background-image:url('./img/4.jpg');
    background-size: 150% 100%;
    background-repeat: no-repeat;
        }
    .font 
	{
    font-family: "Comic Sans MS", cursive, sans-serif;
    }
</style>
</head>

<body class="bgimg">
         <nav class="menu">        
    <ul>
      <li > <a href="index.php"> <b>Home</b> </a></li>                  
      <li><a href="contant_us.php"><b>Contact us</b></a></li>
      <li id='current'><a href="sign.php"><b>SignIn</b></a></li>
    </ul>              
  </nav>
		<div class = 'w3-container w3-third'></div>
	<div class="w3-container w3-cyan w3-card-4 w3-third w3-margin-top">
  <h2>Sign In</h2>
 
</div>

		<div class = 'w3-container w3-third'></div>
		
		
		
		
		<div class = 'w3-container w3-third'></div>	
		
	<div class = 'w3-container w3-margin-top'>
	<form class="w3-container w3-card-4 w3-round-xlarge" action="" method="post">
	  <p>
	  <label>Email</label>
	  <input class="w3-input w3-round-large" type="text" name="e_mail1" required></p>
		<p>
	  <label>Password</label>
	  <input class="w3-input w3-round-large" type="password" name="password1" required></p>
	  <p>
	  
	   <p class = 'w3-center'>
	  <input type="submit" class="w3-btn w3-round-xlarge w3-green" name="submit1" value="Log In">
	  </p>
	</form>
      </div>
	  	<div class = 'w3-container w3-third'></div>
		</br>
	  
	  <div class = 'w3-container w3-third'></div>
	<div class="w3-container w3-cyan w3-card-4 w3-third w3-margin-top">
  <h2>Sign UP</h2>
 
</div>

		<div class = 'w3-container w3-third'></div>

	<div class = 'w3-container w3-third'></div>

	<div class = 'w3-container w3-margin-top'>
	<form class="w3-container w3-card-4 w3-round-xlarge" action="" method="post">
	  <p>
	  <label>User Name</label>
	  <input class="w3-input w3-round" type="text" name = 'user_name' required></p>
	  <p>
	  <label>Password</label>
	  <input class="w3-input w3-round" type="password" name = 'password'required></p>
	  <p>
	  <label>Email</label>
	  <input class="w3-input w3-round" type="text" name = 'mail' required></p>
	  <label>Contact</label>
	  <p>
	  <input class="w3-input w3-round" type="text" name ='phone' required></p>
	  <p>
	  <label>Gender</label></br>
	  <input class="w3-radio" type="radio" name="gender" value="male" checked>
		<label>Male</label>

		<input class="w3-radio" type="radio" name="gender" value="female">
		<label>Female</label>
	
		
	  </p>
	  <p>
	  <label>Enrol As<label>
	  </p>
	  <p>
	  <select class="w3-select w3-round" name="type">
		<option value="" disabled selected>Type</option>
    <option value="1">Admin</option>
    <option value="2">Student</option>
    <option value="3">Faculty</option>
		</select>
	  </p>
	  
	  <p>
	  <label>Enrol By<label>
	  <input class="w3-input w3-round" type="text" name ='supervisor' required></p>
	  
	  <p class = 'w3-center'>
	  <input type="submit" name = 'submit' class="w3-btn w3-green w3-round-xlarge" value="Sign Up">
	  </p>
	</form>
      </div>
	  
	  
	  <div class = 'w3-container w3-third'></div>
	  <?php
         mysqli_close($conn);
        ?>   
    </body>
	


</html>