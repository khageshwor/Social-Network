<!DOCTYPE html>
<?php
    session_start();
    include("includes/header.php");

    if(!isset($_SESSION['user_email'])){
        header("location:index.php");
    }
?>
<html lang="en">
<head>
    <title>Edit Account Setting</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="style/home_style2.css">
</head>
<body>
    <div class="row">
       <div class="col-sm-2">
       </div>
       <div class="col-sm-8">
            <form action="" method="post" enctype="multipart/form-data">
                <table class="table table-bordered table-hover">
                    <tr align="center">
                        <td colspan="6" class="active"><h2>Edit Your Profile</h2></td>
                    </tr>
                    <tr>
                        <td style="font-weight:bold;">Change Your Firstname</td>
                        <td>
                            <input class="form-control" type="text" name="f_name" required value="<?php echo $first_name;?>">
                        </td>
                    </tr>
                    <tr>
                        <td style="font-weight:bold;">Change Your lastname</td>
                        <td>
                            <input class="form-control" type="text" name="l_name" required value="<?php echo $last_name;?>">
                        </td>
                    </tr>
                    <tr>
                        <td style="font-weight:bold;">Change Your Username</td>
                        <td>
                            <input class="form-control" type="text" name="u_name" required value="<?php echo $user_name;?>">
                        </td>
                    </tr>
                    <tr>
                        <td style="font-weight:bold;">Change Your Description</td>
                        <td>
                            <input class="form-control" type="text" name="describe_user" required value="<?php echo $describe_user;?>">
                        </td>
                    </tr>
                    <tr>
                        <td style="font-weight:bold;">Change Your Relationship status</td>
                        <td>
                            <select class="form-control" name="relationship">
                                <option><?php echo $relationship_status?></option>
                                <option>Engaged</option>
                                <option>Married</option>
                                <option>Single</option>
                                <option>In a Relationship</option>
                                <option>It's Complicated</option>
                                <option>Separated</option>
                                <option>Divorced</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td style="font-weight:bold;">Change Your Password</td>
                        <td>
                            <input class="form-control" type="password" name="u_pass" id="mypass" required value="<?php echo $user_pass;?>">
                            <input type="checkbox" onclick="Show_password()"><strong>Show Password</strong>
                        </td>
                    </tr>
                    <tr>
                        <td style="font-weight:bold;">Change Your Email</td>
                        <td>
                            <input class="form-control" type="email" name="u_email" required value="<?php echo $user_email;?>">
                        </td>
                    </tr>
                    <tr>
                        <td style="font-weight:bold;">Change Your Country</td>
                        <td>
                            <select name="u_country" class="form-control">
                                <option><?php echo $user_country; ?></option>
                                <option>Nepal</option>
                                <option>Germany</option>
                                <option>China</option>
                                <option>Japan</option>
                                <option>USA</option>
                                <option>Norway</option>
                                <option>Finland</option>
                                <option>India</option>
                                <option>Pakistan</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td style="font-weight:bold;">Change Your Gender</td>
                        <td>
                            <select class="form-control" name="u_gender">
                                <option><?php echo $user_gender?></option>
                                <option>Male</option>
                                <option>Female</option>
                                <option>Others</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td style="font-weight:bold;">Change Your Birthdate</td>
                        <td>
                            <input class="form-control input-md" type="date" name="u_birthday" required value="<?php echo $user_birthday;?>">
                        </td>
                    </tr>
                    <!-- Recovery password option -->
                    <tr>
                        <td style="font-weight:bold;">Forget Password</td>
                        <td>
                            <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal">Turn On</button>
                            <div id="myModal" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Modal Header</h4>
                                        </div>
                                        <div class="modal-body">
                                            <form action="recovery.php?id=<?php $user_id; ?>" method="post" id="f">
                                                <strong>What is Your School Best Friend Name ?</strong>
                                                <textarea class="form-control" name="content" id="" cols="83" rows="4" placeholder="Someone"></textarea><br>
                                                <input class="btn btn-default" type="submit" name="sub" value="Submit" style="width:100px;"><br><br>
                                                <pre>Answer the above question we will ask this question if you forget your<br>Password</pre>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="Modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr align="center">
                        <td colspan="6">
                            <input type="submit" class="btn btn-info" name="update" style="width:250px;" value="Update">
                        </td>
                    </tr>
                </table>
            </form>
            <?php
                if(isset($_POST['sub'])){
                    $bfn = htmlentities($_POST['content']);
                    if($bfn == ""){
                        echo "<script>alert('Please Enter Something!')</script>";
                        echo "<script> window.open('edit_profile.php?u_id = $user_id','_self')</script>";
                        exit();
                    }else{
                        $update = "UPDATE users SET recovery_account = '$bfn' WHERE user_id = '$user_id'";

                        $run = mysqli_query($con,$update);

                        if($run){
                            echo "<script>alert('Updated Successfully!')</script>";
                            echo "<script> window.open('edit_profile.php?u_id = $user_id','_self')</script>";
                        }else{
                            echo "<script>alert('Error while Updating information!')</script>";
                            echo "<script> window.open('edit_profile.php?u_id = $user_id','_self')</script>";
                        
                        }
                    }
                    
                }
            ?>
       </div>
       <div class="col-sm-2"></div>
    </div>   
</body>
</html>
<?php
    if(isset($_POST['update'])){
        $f_name = htmlentities($_POST['f_name']);
        $l_name = htmlentities($_POST['l_name']);
        $u_name = htmlentities($_POST['u_name']);
        $describe_user = htmlentities($_POST['describe_user']);
        $relationship_status = htmlentities($_POST['relationship']);
        $u_pass = htmlentities($_POST['u_pass']);
        $u_email = htmlentities($_POST['u_email']);
        $u_country = htmlentities($_POST['u_country']);
        $u_gender = htmlentities($_POST['u_gender']);
        $u_birthday = htmlentities($_POST['u_birthday']);

        $update = "UPDATE users SET f_name = '$f_name', l_name = '$l_name', user_name = '$u_name',
        describe_user = '$describe_user', relationship = '$relationship_status', user_pass = '$u_pass',
        user_email = '$u_email', user_country = '$u_country', user_gender = '$u_gender', user_birthdate ='$u_birthday' WHERE user_id = '$user_id'";

         $run = mysqli_query($con,$update);

        if($run){
            echo "<script>alert('Updated Successfully!')</script>";   
            echo "<script> window.open('edit_profile.php?u_id = $user_id','_self')</script>";
        }else{
            echo "<script>alert('Error while Updating information!')</script>";
            echo "<script> window.open('edit_profile.php?u_id = $user_id','_self')</script>";
        }
    }

?>