<?php
  include "include/db_connect.inc.php";
  session_start();
  $u_email = $u_pass = $error = $email =  $sql = $id = "";

  if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(!empty($_POST['user_log_email'])){
      $u_email = mysqli_real_escape_string($conn, $_POST['user_log_email']);
    }
    if(!empty($_POST['user_log_pass'])){
      $u_pass = mysqli_real_escape_string($conn, $_POST['user_log_pass']);
    }

    $sql = "SELECT m_id, m_email, m_password FROM puser  WHERE m_email = '$u_email';";

    $result = mysqli_query($conn, $sql);
    $user_check = mysqli_num_rows($result);

    while($row = mysqli_fetch_assoc($result)){
        $id = $row['m_id'];
        $email = $row['m_email'];
        $u_pass_db = $row['m_password'];

        if($email == $u_email){
          if(password_verify($u_pass, $u_pass_db)){
            $_SESSION['email'] = $u_email;
            $_SESSION['uid'] = $id;
            if(!isset($utype)){}

                                   else {
                            if($utype == 'user'){
                                header('location: dashboard.php');
                            } elseif ($utype == 'admin') {
                                header('location: dashboardAdmin.php');
                            }
                        }
          }
          else{
            $error = "Wrong email or password!";
          }
        }

      }
  }
 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <style media="screen">
    </style>
    <meta charset="utf-8">
    <title>Login</title>
  </head>
  <body>
    <div align="center">
          <form  method="post">
            <article  >
              WELCOME, PLEASE SIGN IN !
            </article>
            <br>
            <table>
              <tr>
                <td><label >Email:</label></td>
                <!-- <td>First Name:</td> -->
                <td><input type="text" placeholder="Enter Email" name="user_log_email" value="<?php echo $u_email; ?>" required></td>
              </tr>
              <tr>
                <td><label >Password:</label></td>
                <!-- <td>Last Name:</td> -->
                <td><input type="password" placeholder="Enter Password" name="user_log_pass" required></td>
              <tr>
                  <td colspan="2" ><input  type="submit" name="submit" value="SIGN IN"></td>
              </tr>
            </table>
          </form>
          <span style="color:white;"><?php echo $message1; ?></span>
          <span style="color:red;"><?php echo $error; ?></span>
        </div>
    </div>
    <br><br><br> <div align="center"><a href="registration.php" ><p>Not a member? Click here.</p></a></div> <br>
  </body>
</html>
