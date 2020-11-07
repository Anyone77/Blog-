
<?php

session_start();
require "../config/config.php";

if($_SESSION['role'] != 1){
  header('location:login.php');
}

$stmt = $pdo->prepare("SELECT * FROM users WHERE id =".$_GET['id']);
$stmt->execute();
    $res = $stmt->fetchAll();

    if(!empty($_POST)){
        $id = $_POST['id'];
        $name = $_POST['name'];
        $email = $_POST['email'];

        if(empty($_POST['role'])){
            $role = 0;
        }else{
            $role = 1;
        }
      
        
                $sql = $pdo->prepare("UPDATE users SET name='$name',email='$email',role='$role' WHERE id = '$id' ");
                $result = $sql->execute();

                if($result){
                    echo "<script>alert('Update Successfully ');window.location.href='userlist.php'; </script>";
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
            <h3 class="card-title">User Profile Edit</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              
               

                <form action="" method="post" enctype="multipart/form-data" > 
                    <input type="hidden" name="id" value="<?php echo $res[0]['id']?>">
                    <div class="form-group">
                        <label for="">Title</label><br>
                        <input type="text" class="form-control" name="name" value="<?php echo $res[0]['name']?>" required>
                    </div>
                    <div class="form-group">
                        <label for="">Content</label><br>
                        <input type="email" class="form-control" name="email" value="<?php echo $res[0]['email']?>" required>
                    </div>
                    <div class="form-group">    
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="defaultUnchecked" name ='role' <?= ( $res[0]['role']=='1'?  "checked" : "") ?> >
                            <label class="custom-control-label" for="defaultUnchecked">Admin | User </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Update">
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


