<?php
  include "include/db_connect.inc.php";
  session_start();
  $name = $gender = $email = $phone = $pass = $con_pass =  $blood = $exist_email = $dob = $error = $success = $sql =  $id = $uid = $address = "";

  if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(!empty($_POST['name'])){
      $name = mysqli_real_escape_string($conn, $_POST['name']);
    }
    if(!empty($_POST['user_email'])){
      $email = mysqli_real_escape_string($conn, $_POST['user_email']);
    }

    if(!empty($_POST['user_type'])){
      $blood = mysqli_real_escape_string($conn, $_POST['user_type']);
    }
    if(!empty($_POST['user_password'])){
      $pass = mysqli_real_escape_string($conn, $_POST['user_password']);
    }
    if(!empty($_POST['user_con_password'])){
      $con_pass = mysqli_real_escape_string($conn, $_POST['user_con_password']);
      $u__hash_pass = password_hash($con_pass, PASSWORD_DEFAULT);
    }

    $user_check = "SELECT p_email FROM puser WHERE p_email = '$email' ";
    $result = mysqli_query($conn, $user_check);

    while($row = mysqli_fetch_assoc($result)){
      $exist_email = $row['email'];
    }

    if($exist_email == $email){
      $error = "You're already a member!!";
    }
    elseif($pass != $con_pass){
      $error = "Password not matched!!";
    }
    else{
      $sql = "INSERT INTO puser (p_name, p_email, p_password,m_type)
              VALUES ('$name','$email', $type', '$u__hash_pass');";
      mysqli_query($conn, $sql);
      $success = "Register Successfull";
      header('location: login.php');
      }
  }
?>


<!DOCTYPE html>
<html>

<head>
    <title>Registration</title>
    <style>
        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
          -webkit-appearance: none;
          margin: 0;
        }

        /* Firefox */
        input[type=number] {
          -moz-appearance: textfield;
        }

        strong {
            color: red;
        }
    </style>
</head>

<body>    
    <table width="1000px" border="1" cellpadding="0" cellspacing="0" align="center">
        <tr height="50px">
            <td colspan="2" align="right">
                <a href="publicHome.php">Home</a>
                <a href="registration.php">Registration</a>
                <a href="login.php">Login</a>
            </td>
        </tr>
        <tr height="auto">
            <td colspan="2" style="padding: 40px 100px 40px 100px;">
                <fieldset style="display: block; width: 500px; margin: 20px auto">
                    <legend><b>REGISTRATION</b></legend>
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                        <br />
                        <table width="100%" cellpadding="2" cellspacing="0">
                            <tr>
                                <td>ID</td>
                                <td><input type="text" name="id" value="<?php echo $id;?>"></td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>
                                    <input type="text" name="email" value="<?php echo $email;?>">
                                    <abbr title="hint: sample@example.com"><b>i</b></abbr>
                                </td>
                            </tr>
                            <tr>
                                <td>User Name</td> 
                                <td><input type="text" name="uname" value="<?php echo $uname;?>"></td>
                            </tr>
                            <tr>
                                <td>Password</td>
                                <td><input name="pass" type="password"></td>
                            </tr>
                            <tr>
                                <td>Confirm Password</td>
                                <td><input name="confPass" type="password"></td>
                            </tr>
                            <tr>
                                <td>
                                    <label>User Type</label>
                                    <select name="uType">
                                        <option value="" >Select</option>
                                        <option value="user" >User</option>
                                        <option value="admin" >Admin</option>
                                    </select>
                                </td>
                            </tr>
                        </table>
                        <br />
                        <?php 
                            if (isset($idErr)) {
                                echo "<strong><span>" . $idErr . "</span></strong><br/>";
                            }
                            if (isset($emailErr)) {
                                echo "<strong><span>" . $emailErr . "</span></strong><br/>";
                            }
                            if (isset($unameErr)) {
                                echo "<strong><span>" . $unameErr . "</span></strong><br/>";
                            }
                            if (isset($passErr)) {
                                echo "<strong><span>" . $passErr . "</span></strong><br/>";
                            }
                            if (isset($utypeErr)) {
                                echo "<strong><span>" . $utypeErr . "</span></strong><br/>";
                            }
                        ?>
                        <br/>
                        <input name="submit" type="submit" value="Submit">
                        <input name="reset" type="reset">
                    </form>
                </fieldset>
            </td>
        </tr>
        <tr height="30px">
            <td colspan="2" align="center">Copyright@ 2017</td>
        </tr>
    </table>
</body>

</html>