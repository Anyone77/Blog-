


<?php

session_start();
require "../config/config.php";
require "../config/common.php";

if(!empty($_POST)){
  
    $email = $_POST['email'];
    $password =password_hash( $_POST['password'],PASSWORD_DEFAULT);
    $name = $_POST['name'];



    if(empty($name) || empty($password) || empty($email) || strlen($password) < 4 ){
      if(empty($name)){
        $nameError = ' * Fill name';
      }
      if(empty($password)){
        $passwordError = ' * Fill password';
      }
      if(empty($email)){
        $emailError = ' * Fill email';
      }
      if(strlen($password) < 4) {
        $passwordError = '* Password must be at least 4 ';
      }
    }else{

      $sql = $pdo->prepare("SELECT * FROM users WHERE email=:email");
      $sql->bindValue(":email",$email);
  
      $sql->execute();
  
      $result = $sql->fetch(PDO::FETCH_ASSOC);
  
      if($result['email']){
          
          
          echo "<script>alert('This user email already exist ! ')</script>";
      }else{
  
          $stmt = $pdo->prepare("INSERT INTO users (name,password,email) VALUES(:name,:password,:email) ");
          $result = $stmt->execute(
              array(':name'=>$name , ':password'=>$password , ':email'=>$email  )
          );
  
          if($result){
              echo "<script>alert('User Registration Successfully ');window.location.href='login.php'; </script>";
          }
          
      }

    }

       

        
}




?>


<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Admin | Log in</title>
<!-- Tell the browser to be responsive to screen width -->
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Font Awesome -->
<link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
<!-- Ionicons -->
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<!-- icheck bootstrap -->
<link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="../dist/css/adminlte.min.css">
<!-- Google Font: Source Sans Pro -->
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page">
<div class="login-box">
<div class="login-logo">
<a href="../../index2.html"><b>User</b> Registration</a>
</div>


<div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Registration Form</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" action="register.php" method="post">
              <input name="token" type="hidden" value="<?php echo $_SESSION['token']; ?>"> 
                <div class="card-body">
                    <div class="form-group row">
                    <p style="color:red;"><?php echo empty($nameError) ? '' : $nameError; ?></p>
    
                        <div class="col-sm-12">
                        <input type="text" class="form-control" name="name" id="inputEmail3" placeholder="Name">
                        </div>
                  </div>
                  <div class="form-group row">
                  <p style="color:red;"><?php echo empty($emailError) ? '' : $emailError; ?></p>
                    <div class="col-sm-12">
                      <input type="email" class="form-control" name="email" id="inputEmail3" placeholder="Email" >
                    </div>
                  </div>
                  <div class="form-group row">
                  <p style="color:red;"><?php echo empty($passwordError) ? '' : $passwordError; ?></p>
                    <div class="col-sm-12">
                      <input type="password" class="form-control" name="password" id="inputPassword3" placeholder="Password">
                    </div>
                  </div>
                
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-info">Sign in</button>
                  <button type="submit" class="btn btn-default float-right"><a href="login.php" target="_blank" rel="noopener noreferrer">Cancel</a></button>
                </div>
                <!-- /.card-footer -->
              </form>
            </div>

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>

</body>
</html>























<!-- Horizontal Form -->
 
            <!-- /.car