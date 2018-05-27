<?php

require_once 'config.php';

$display = mysql_query("SELECT * FROM `user`");


if(isset($_GET['user_id']))
{
	$user_id = $_GET['user_id'];
	$delete = mysql_query("DELETE FROM `user` WHERE user_id = $user_id");
	if($delete == 1)
	{
		header('location:index.php');
	}
	else
	{
		echo "Error Accured";
	}
}

if(isset($_POST['register']))
{
    $username = $_POST['name'];
    if($username == "")
    {
        $usernameerr = " * Enter Username";
    }
    else
    {
        $usernamechk = "SELECT * FROM user WHERE name = '".$_POST['name']."'";
        $usernamechk1 = mysql_query($usernamechk);
        $usernamechk2 = mysql_num_rows($usernamechk1);
        if($usernamechk2 != 0)
        {
            $usernameerr = " * Username Already Exist";
        }
    }
    
    $password = $_POST['password'];
    if($password == "")
    {
        $passworderr = " * Enter Password";
    }
    
    if(!isset($_POST['gender']))
    {
        $gendererr = " * Select Gender";
    }
    
    if(!isset($_POST['hobby']))
    {
        $hobbyerr = " * Select Hobby";
    }
    
    $city = $_POST['city'];
    if($city == "")
    {
        $cityerr = " * Select City";
    }
    
    
    $date = $_POST['dob'];
    if($date == "")
    {
        $dateerr = " * Select Date";
    }
    
    if(!isset($usernameerr) && !isset($gendererr) && !isset($hobbyerr) && !isset($hobbyerr) && !isset($dateerr) && !isset($passworderr))
    {
        
        $hobbycheckbox = implode(',', $_POST['hobby']);
        $insertqry = "INSERT INTO user VALUES(0,'".$_POST['name']."','".$_POST['gender']."','".$hobbycheckbox."','".$_POST['city']."','".$_POST['dob']."','".$_POST['password']."')";
    
        //mysql_query($insertqry);
        $result = mysql_query($insertqry);
        if($result == 1)
        {
            $msg = "Inserted Sucessfully";
        }
    }
    
    
    
}


?>



<html>
	<head>
		<title>View Data</title>
	</head>
	<body>
		<fieldset>
			<legend>View Data</legend>
			<form method="post">
				<table border="1" width="100%">
					<tr>
						<th>#</th>
						<th>Name</th>
						<th>Gender</th>
						<th>Hobby</th>
						<th>City</th>
						<th>DOB</th>
						<th>Password</th>
						<th>Action</th>
					</tr>
					<?php
					while($data = mysql_fetch_object($display))
					{

					?>
					<tr align="center">
						<td><?php echo $data->user_id; ?></td>
						<td><?php echo $data->name; ?></td>
						<td><?php echo $data->gender; ?></td>
						<td><?php echo $data->hobby; ?></td>
						<td><?php echo $data->city; ?></td>
						<td><?php echo $data->dob; ?></td>
						<td><?php echo $data->password; ?></td>
						<td>
							<a href="index.php?user_id=<?php echo $data->user_id; ?>" onclick="return alert('Are You Sure ?')"> Delete</a>
							<a href="update.php?user_id=<?php echo $data->user_id; ?>"> Update </a>
						</td>
					</tr>
					<?php
					}	
					?>
				</table>
				</table>
			</form>
		</fieldset>		
		<br />
		<fieldset>
			<legend>Insert Data</legend>
			<form method="post">
				<table border="1" align="center">
					<tr>
						<th>Name</th>
						<td> 
							<input type="text" name="name" value="" placeholder="Enter Name">
							<?php
		                        if(isset($usernameerr))
		                        {
		                            echo $usernameerr;
		                        }
		                    ?>
						</td>                        
					</tr>
					<tr>
						<th> Gender </th>
	                    <td> 
	                        <input type="radio" name="gender" value="male" 
	                               <?php
	                                    if(isset($_POST['gender']))
	                                    {
	                                        if($_POST['gender'] == 'male')
	                                        {
	                                            echo "selected";
	                                        }
	                                    }
	                               ?>
	                               >Male 
	                        <input type="radio" name="gender" value="female"
	                               <?php
	                                    if(isset($_POST['gender']))
	                                    {
	                                        if($_POST['gender'] == 'female')
	                                        {
	                                            echo "selected";
	                                        }
	                                    }
	                               ?>
	                               >Female  
	                        <?php
	                            if(isset($gendererr))
	                            {
	                                echo $gendererr;
	                            }
	                        ?>
	                    </td>
					</tr>
					<tr>
                    <th> Hobby </th>
                    <td> 
                        <input type="checkbox" name="hobby[]" value="cricket"
                               <?php
                                if(isset($_POST['hobby']))
                                {
                                    if(in_array("cricket", $_POST['hobby']))
                                    {
                                        echo "checked";
                                    }
                                }
                               ?>
                               >Cricket 
                        <input type="checkbox" name="hobby[]" value="football"
                               <?php
                               if(isset($_POST['hobby']))
                                {
                                    if(in_array("football", $_POST['hobby']))
                                    {
                                        echo "checked";
                                    }
                                }
                               ?>
                               >Football
                        <input type="checkbox" name="hobby[]" value="hockey"
                               <?php
                               if(isset($_POST['hobby']))
                                {
                                    if(in_array("hockey", $_POST['hobby']))
                                    {
                                        echo "checked";
                                    }
                                }
                               ?>
                               >Hockey
                        <?php
                            if(isset($hobbyerr))
                            {
                                echo $hobbyerr;
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <th>City</th>
                    <td>
                        <select name="city">
                            <option value=""> Select City </option>
                            <option value="Surat" <?php if(isset($_POST['city'])) { if($_POST['city'] == 'Surat') { echo "selected"; } } ?>> Surat </option>
                            <option value="Vapi" <?php if(isset($_POST['city'])) { if($_POST['city'] == 'Vapi') { echo "selected"; } } ?>> Vapi </option>
                            <option value="Vadodara" <?php if(isset($_POST['city'])) { if($_POST['city'] == 'Vadodara') { echo "selected"; } } ?>> Vadodara </option>
                            <option value="Ahmedabad" <?php if(isset($_POST['city'])) { if($_POST['city'] == 'Ahmedabad') { echo "selected"; } } ?>> Ahmedabad </option>
                        </select>
                        <?php
                            if(isset($cityerr))
                            {
                                echo $cityerr;
                            }
                        ?>
                    </td>
                </tr>
                <tr>                    
                    <th> Date Of Birth</th>
                    <td> <input type="date" name="dob"> 
                        <?php
                            if(isset($dateerr))
                            {
                                echo $dateerr;
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <th> Password </th>
                    <td> <input type="text" name="password" value="" placeholder="Enter Password"> <?php
                        if(isset($passworderr))
                        {
                            echo $passworderr;
                        }
                    ?> </td>
                    
                </tr>
                <tr>
                    <td> </td>
                    <td> <input type="submit" name="register" value="Insert">
                         <input type="reset" name="reset" value="Reset"></td>
                </tr>
                <br /><center><?php if(isset($msg)){ echo $msg; }?></center>
				</table>
			</form>
		</fieldset>


	</body>
</html>