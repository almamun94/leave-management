<?php
include_once('connection.php'); 

session_start();
if (!isset($_SESSION['user_id'])) 
    {
      header('Location: sign.php');
      exit;
  	}
?>

<html>
<head>
<title>Leave Management</title>
<meta charset="UTF-8">
<link rel="stylesheet" href="styles/w3.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<style> 
        .bgimg 
		{
    background-image:url('./img/4.jpg');
    background-size: 150% 100%;
    background-repeat: no-repeat;
        }
    .font 
	{
    font-family: 'Tangerine', serif
    }
</style>
</head>

<body class="bgimg">
         <nav class="menu">        
    <ul>
      <li id = "current"> <a href="index.php"> <b>Home</b> </a></li>                  
      <li><a href="contant_us.php"><b>Contact us</b></a></li>
      <li ><a href="logout.php"><b>Log Out</b></a></li>
    </ul>              
  </nav>

        <div >
            <h1 class="w3-text-RED">User Name: <?php echo $_SESSION['user_name'] ?></h1>
			<p class=" w3-text-RED"><?php if(($_SESSION['user_type'])=='1')
 {echo	 'Admin';}
 else if(($_SESSION['user_type'])=='2')
 {
	 echo 'Student';
 } 
 else if(($_SESSION['user_type'])=='3')
 {
	 echo 'Faculty';
 }?></p>
            
           
         
        </div>
		
		<?php
		
		$var=$_SESSION['user_supervisor'];
		
		
		$sql = "select users.user_name, leaves.* from  leaves,users where leaves.req_user_id = users.id  and leaves.status = 1 and leaves.app_user_id = $var";
		$result = mysqli_query($conn, $sql);

			if ($result->num_rows > 0) {
				echo "<div class = 'w3-container w3-margin-top'>
				<div class='w3-container '>
				  <h2>List of Leave Request :</h2>

				  <table class='w3-table w3-striped w3-border'>
				<tr>
				<th class='w3-light-grey'> User </th> 
				<th class='w3-light-grey'> Start Date </th>
				<th class='w3-light-grey'> End Date </th>
				<th class='w3-light-grey'> Requested On </th>
				<th class='w3-light-grey'> Details </th>
				<th class='w3-light-grey'> Action </th>
				</tr>";
				// output data of each row
				
				
				while($row = $result->fetch_assoc()) 
						{
					echo "<tr align=center>
					
					<td>".$row["user_name"]."</td>
					<td>".$row["start_date"]."</td>
					<td>".$row["end_date"]."</td>
					<td>".$row["req_date"]."</td>
					<td>".$row["details"]."</td>
					<td><a class='w3-text-green' href='approve.php?id=".$row['req_user_id']."&req_id=".$row['id']."'>Approve</a>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp	<a class='w3-text-green' href='deny.php?id=".$row['req_user_id']."&req_id=".$row['id']."'>Deny</a></td>
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