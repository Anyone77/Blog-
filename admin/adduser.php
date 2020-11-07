
<?php

session_start();
require "../config/config.php";

if(!empty($_POST)){
    
    $name = $_POST['name'];
    $password = $_POST['password'];
    $email = $_POST['email'];
   

    $eFit = $pdo->prepare("SELECT * FROM users ORDER BY id DESC ");
    
    $eFit->execute();
    
    $res = $eFit->fetchAll();

    
    if($res[0]['email'] != $email){


        if(empty($_POST['role'])){
            $role = 0;      
        }else{
            $role = 1;
        }

            $stmt = $pdo->prepare("INSERT INTO users (name,password,email,role) VALUES(:name,:password,:email,:role) ");
                $result = $stmt->execute(
                    array(':name'=>$name , ':password'=>$password , ':email'=>$email , ':role'=>$role )
                );
            if($result){
                echo "<script>alert('Add New User Successfully ');window.location.href='userlist.php'; </script>";
            }



        

    }else{
        echo "<script>alert('This user email already exit ') </script>";
    }

   

    


}

?>



<?php include "header.php" ?>


  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
            <h3 class="card-title">Create New User</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              
               

                <form action="adduser.php" method="post" enctype="multipart/form-data" > 
                    <div class="form-group">
                        <label for="">Name</label><br>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="">Password</label><br>
                        <input type="password" class="form-control" name="password" required>
                    </div>
                    <div class="form-group">
                        <label for="">Email</label><br>
                        <input type="email" class="form-control" name="email" required>
                    </div>

                    <div class="form-group">
                                            
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="defaultUnchecked" name ='role'>
                            <label class="custom-control-label" for="defaultUnchecked">Admin | User </label>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="SUBMIT">
                        <a href="index.php" class="btn btn-warning" type="button">Back</a>
                    </div>
                </form>

                
              
            </div>
            <!-- /.card-body -->
           
          </div>
          <!-- /.card -->

         
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
  <div class="p-3">
    <h5>Title</h5>
    <p>Sidebar content</p>
  </div>
</aside>
<!-- /.control-sidebar -->

<?php include "footer.php" ?>


