<?php
include_once('connection.php'); 

session_start();
if (!isset($_SESSION['user_id'])) 
    {
      header('Location: sign.php');
      exit;
  	}
?>
<?php 
    if(isset($_POST['submit'])){

		if (empty($_POST['date_from']) || empty($_POST['date_to'])){

			$errorMassage='fild is empty! ';
		}
                else
                {   $start_date=$_POST['date_from'];
                    $end_date= $_POST['date_to'];
                    $details= $_POST['details'];
					$user_id=$_SESSION['user_id'];
					$mamun = "SELECT supervisor as t FROM users WHERE (id='".$user_id."')";
					$res=$conn->query($mamun);
							  $row=mysqli_fetch_assoc($res);

					
					
					
					
      			$sql = "INSERT INTO leaves(req_user_id,app_user_id,start_date,end_date,req_date,details,status) VALUES('".$user_id."','".$row['t']."','".$start_date."','".$end_date."',CURDATE(),'".$details."',1)";

				if (mysqli_query($conn, $sql)) {
				     $succ = "Leave Request Sent";
                                     
				} else {
				    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
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
   
</style>
</head>

<body class="bgimg">
         <nav class="menu">        
    <ul>
      <li > <a href="index.php"> <b>Home</b> </a></li>                  
      <li><a href="contant_us.php"><b>Contact us</b></a></li>
      <li><a href="logout.php"><b>Log Out</b></a></li>
    </ul>              
  </nav>
        
        <div >
            <h1 class=" w3-animate-left w3-text-black">User Name:  <?php echo $_SESSION['user_name'] ?></h1>
            <p class=" w3-animate-right w3-text-black"><?php if(($_SESSION['user_type'])=='1')
 {echo 'Admin';}
 else if(($_SESSION['user_type'])=='2')
 {
	 echo 'Student';
 } 
 else if(($_SESSION['user_type'])=='3')
 {
	 echo 'Faculty';
 }?></p>
  
 
          
        </div>
		<div class = ' w3-margin-top'>
		<div class = '  w3-padding-top'>
		
		
			<form class="w3-container w3-light-grey  w3-round-xxlarge" action="" method="post">
				  
					<div class = 'w3-container'>
					<h2 class = 'w3-text-indigo'>Apply Leave</h2>
						
						<h4>Leave from</h4>						 
						 <input type = 'date' name = 'date_from' class = 'w3-round-large'>
						  
						  
							<h4>To</h4>
						  <input type = 'date' name ='date_to' class = 'w3-round-large'>
						
						
						
						<br><br>
						

			</div>
			
			<br><br>
		</div>
		
		<div class = 'w3-container w3-padding-top'>
		<div class="w3-container  w3-light-grey  w3-round-xlarge">
		<h2 class ='w3-text-indigo'>Details :</h2>
		
		  <p>      
		  <input class="w3-input w3-border-0 w3-round-xlarge" type="text" name = 'details'></p>
		  
		  <div class = 'w3-container w3-center w3-margin-top'>
							<p><input type="submit" class="w3-btn w3-light-green" name="submit" value="Submit">
	  </p>
					</div>
		</div>
		
				</form>
        </div>
    </div>
	<br><br>
	
		<?php
		
		$sql = "SELECT * FROM `leaves` WHERE req_user_id = '".$_SESSION['user_id']."'";
		$result = mysqli_query($conn, $sql);

			if ($result->num_rows > 0) {
				echo "<div class = 'w3-container w3-margin-top'>
				<div class='w3-container w3-round-xlarge'>
				  <h2>My Leave:</h2>

				  <table class='w3-table w3-striped w3-border'>
				<tr>
				<th class='w3-light-grey'> Requested On </th>
				<th class='w3-light-grey'> Start Date </th>
				<th class='w3-light-grey'> End Date </th>
				
				<th class='w3-light-grey'> Details </th>
				<th class='w3-light-grey'> Status </th>
				</tr>";
				// output data of each row
				
				
				while($row = $result->fetch_assoc()) 
						{
							if($row["status"]==0)
							{
								$var = "Approved";
							}
							else
							{
								$var = "Pending";
							}
							
					echo "<tr align=center>
					<td>".$row["req_date"]."</td>
					<td>".$row["start_date"]."</td>
					<td>".$row["end_date"]."</td>
					<td>".$row["details"]."</td>
					<td>".$var."</td>
					</tr>
					";
							
							
            }
			
            echo "</table>
				  <br>
				</div>";
			
            } else {
            echo "No results";
            
            }
?> 
	
	<?php
         mysqli_close($conn);
        ?> 
    </body>
	


</html>