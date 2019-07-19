<?php
  include('header.php');
  if(isset($_GET['action'])) {
    $action = protect($_GET['action']);
  }
?>
<?php if(is_admin_Loggedin()):?>

<?php if(isset($_GET['action']) and $action == 'edit') {
  $id = protect($_GET['id']);
  if (isset($_POST['save'])){
    $username = protect($_POST['username']);
    $name = protect($_POST['name']);
    $mobile = protect($_POST['mobile']);
    $email = protect($_POST['email']);
    $password = protect($_POST['password']);
    $status = protect($_POST['status']);

    $check = $db->query("SELECT * FROM teacher_profile WHERE username='$username' or email='$email'");
    if(empty($username) or empty($name) or empty($mobile) or empty($email)) {
      echo error("All fields are required.");
    } elseif($check->num_rows>1) {
      echo error("Teacher, <b>$name ($username) </b> was exists.");
    } else {
      $pass = md5($password);
      $update = $db->query("UPDATE teacher_profile SET username='$username', name='$name', mobile='$mobile', email='$email', status='$status', password='$pass' WHERE id='$id'");
      echo success("Teacher, <b>$name ($username) </b> was edited successfully.");
    }
  }

  $query = $db->query("SELECT * FROM teacher_profile WHERE id=$id ");
  if ($query->num_rows > 0) {
    $row = $query->fetch_assoc();
  }
?>

<div class="panel-heading">
  <h1 class="page-title">Edit Teacher Profile</h1>
</div>
<div class="panel-body">
  <form action="" method="post" class="form-horizontal">
    <div class="form-group">
      <label for="name" class="col-sm-4 control-label">Name</label>
      <div class="col-sm-5">
        <input type="text" class="form-control" id="name" name="name" placeholder="Teacher Name" value="<?php echo $row['name']; ?>">
      </div>
    </div>
    <div class="form-group">
      <label for="email" class="col-sm-4 control-label">Email</label>
      <div class="col-sm-5">
        <input type="email" class="form-control" id="email" name="email" placeholder="Teacher Email" value="<?php echo $row['email']; ?>">
      </div>
    </div>
    <div class="form-group">
      <label for="mobile" class="col-sm-4 control-label">Mobile</label>
      <div class="col-sm-5">
        <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Teaher Mobile Number" value="<?php echo $row['mobile']; ?>">
      </div>
    </div>
    <div class="form-group">
      <label for="username" class="col-sm-4 control-label">Username</label>
      <div class="col-sm-5">
        <input type="text" class="form-control" id="username" name="username" placeholder="Enter User Name" value="<?php echo $row['username']; ?>">
      </div>
    </div>
    <div class="form-group">
      <label for="password" class="col-sm-4 control-label">Password</label>
      <div class="col-sm-5">
        <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password">
      </div>
    </div>
    <div class="form-group">
      <label for="status" class="col-sm-4 control-label">Teachership</label>
      <div class="col-sm-5">
          <select class="form-control" id="status" name="status">
            <option value="1" <?php if($row['status'] == "1") { echo 'selected'; } ?>>Yes</option>
            <option value="0" <?php if($row['status'] == "0") { echo 'selected'; } ?>>No</option>
          </select>
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-offset-4 col-sm-5">
        <button type="submit" id="save" name="save" class="btn btn-primary btn-block">Save</button>
      </div>
    </div>
  </form>
</div>

<?php } else if(isset($_GET['action']) and $action == 'delete') { 
  $id = protect($_GET['id']);
  $query = $db->query("SELECT * FROM teacher_profile WHERE id='$id'");
  if($query->num_rows==0) { header("Location: teacher_list.php"); }
  $row = $query->fetch_assoc();
?>
<?php
      if(isset($_GET['confirm'])) {
        $delete = $db->query("DELETE FROM teacher_profile WHERE id='$row[id]'");
        echo success("Teacher, <b>$name ($username) </b> was deleted successfully.");
      } else {
        echo info("Are you sure you want to delete Teacher, <b>$row[name] ($row[username]) </b>?");
        echo '<a href="./teacher_list.php?&action=delete&id='.$id.'&confirm=1" class="btn btn-success"><i class="fa fa-check"></i> Yes</a>&nbsp;&nbsp;
          <a href="./teacher_list.php" class="btn btn-danger"><i class="fa fa-times"></i> No</a>';
      }
      ?>
<?php } else { ?>
<h2 class="sub-header">All Teacher List</h2>
<div class="table-responsive">
  <table class="table table-striped">
    <thead>
      <tr>
        <th>#</th>
        <th>Username</th>
        <th>Name</th>
        <th>Email</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
        $query = $db->query("SELECT * FROM teacher_profile ORDER BY id");
        if($query->num_rows>0) {
          while($row = $query->fetch_assoc()) {
            echo '<tr><td>'.$row['id'].'</td><td>'.$row['username'].'</td><td>'.$row['name'].'</td><td>'.$row['email'].'</td><td><a href="teacher_list.php?action=edit&id='.$row['id'].'">Edit</a> | <a href="teacher_list.php?action=delete&id='.$row['id'].'">Delete</a></td></tr>';
          }
        } else {
          echo '<tr><td>No Teacher to Display</td></tr>';
        }
      ?>
    </tbody>
  </table>
</div>
<?php } ?>




<?php else:?>
<?php header('Location: signin.php');?>
<?php endif?>
<?php
  include('footer.php');
?>