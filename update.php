<?php

require_once 'config.php';

if(!isset($_GET['user_id']))
{
    header('location:display.php');
}
    $updateqry = "SELECT * FROM user WHERE user_id='".$_GET['user_id']."'";
    $get_result = mysql_query($updateqry);
    $result = mysql_fetch_object($get_result);

if(isset($_POST['update']))
{
    $username = $_POST['name'];
    if($username == "")
    {
        $usernameerr = " * Enter Name";
    }
    else
    {
        $usernamechk = "SELECT * FROM user WHERE name = '".$_POST['name']."'";
        $usernamechk1 = mysql_query($usernamechk);
        $usernamechk2 = mysql_num_rows($usernamechk1);
        if($usernamechk2 != 0)
        {
            $usernameerr = " * Name Already Exist";
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
        
        $updateqry = "UPDATE user SET name='".$_POST['name']."',gender='".$_POST['gender']."',hobby='".$hobbycheckbox."',city='".$_POST['city']."',dob='".$_POST['dob']."',password='".$_POST['password']."' WHERE user_id='".$_GET['user_id']."'";
    
        $r = mysql_query($updateqry);
        if($r == 0)
        {
            $msg = "Try Again";
        }
        else
        {
            header('location:index.php');
        }
        
    }
    
}

?>


<html>
    <head>
        <title> Update </title>
    </head>
    <body>
        <form method="post">
            <fieldset>
            <table border="1" align="center">
                <tr align="center">
                <legend>Update Data</legend>
                </tr>
                <tr>
                    <th> UserID</th>
                    <td> <input type="text" disabled="" name="userid" value="<?php echo $result->user_id; ?>"> </td>
                <tr>
                    <th> Name </th>
                    <td> <input type="text" name="name" value="<?php echo $result->name; ?>" placeholder="Enter Name"> <?php
                        if(isset($usernameerr))
                        {
                            echo $usernameerr;
                        }
                    ?> </td>
                    
                </tr>
                <tr>
                    <th> Gender </th>
                    <td> 
                        <input type="radio" name="gender" value="male" <?php if($result->gender == "male") { echo'checked'; } ?> >Male 
                        <input type="radio" name="gender" value="female" <?php if($result->gender=="female") { echo'checked'; } ?>>Female  
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
                        <?php
                        $hb = explode(",", $result->hobby);
                        ?>
                        <input type="checkbox" name="hobby[]" value="cricket" <?php if(in_array("cricket", $hb)) { echo "checked"; } ?>>Cricket 
                        <input type="checkbox" name="hobby[]" value="football" <?php if(in_array("football", $hb)) { echo "checked"; } ?>>Football
                        <input type="checkbox" name="hobby[]" value="hockey" <?php if(in_array("hockey", $hb)) { echo "checked"; } ?>>Hockey
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
                            <option value="Surat" <?php if($result->city=="Surat")echo'selected'; ?>> Surat </option>
                            <option value="Vapi" <?php if($result->city=="Vapi")echo'selected'; ?>> Vapi </option>
                            <option value="Vadodara" <?php if($result->city=="Vadodara")echo'selected'; ?>> Vadodara </option>
                            <option value="Ahmedabad" <?php if($result->city=="Ahmedabad")echo'selected'; ?>> Ahmedabad </option>
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
                    <td> <input type="date" name="dob" value="<?php echo $result->dob; ?>"> 
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
                    <td> <input type="text" name="password" value="<?php echo $result->password; ?>" placeholder="Enter Password"> <?php
                        if(isset($passworderr))
                        {
                            echo $passworderr;
                        }
                    ?> </td>
                    
                </tr>
                <tr>
                    <td> </td>
                    <td> <input type="submit" name="update" value="Update">
                         <input type="reset" name="reset" value="Reset"></td>
                </tr>
                <br /> <center><?php if(isset($msg)){ echo $msg; }?></center>
            </table>
            </fieldset>
        </form>
    </body>
</html>