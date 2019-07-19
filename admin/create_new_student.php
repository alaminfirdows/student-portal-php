<?php
  include('header.php');
?>
<?php if(is_admin_Loggedin()):?>
<?php
  if (isset($_POST['create'])){
    $s_id = protect($_POST['s_id']);
    $s_name = protect($_POST['s_name']);
    $s_mobile = protect($_POST['s_mobile']);
    $studentship = protect($_POST['studentship']);
    $s_email = protect($_POST['s_email']);
    $password = protect($_POST['password']);

    $check = $db->query("SELECT * FROM student_profile WHERE s_id='$s_id'");
    if(empty($s_id) or empty($s_name) or empty($s_mobile) or empty($studentship) or empty($s_email) or empty($password)) { echo error("All fields are required."); }
    elseif($check->num_rows>0) { echo error("Student, <b>$s_name ($s_id) </b> was exists."); }
    else {
      $pass = md5($password);
      $insert = $db->query("INSERT student_profile (s_id,s_name,s_mobile,studentship,s_email,password) VALUES ('$s_id','$s_name','$s_mobile','$studentship','$s_email','$pass')");
      echo success("Student, <b>$s_name ($s_id) </b> was added successfully.");
    }
  }
?>

<div class="panel-heading">
  <h1 class="page-title">Create New Student</h1>
</div>
<div class="panel-body">
  <form action="" method="POST" class="form-horizontal">
    <div class="form-group">
      <label for="s_id" class="col-sm-4 control-label">Student ID</label>
      <div class="col-sm-5">
        <input type="text" class="form-control" id="s_id" name="s_id" placeholder="Student Id">
      </div>
    </div>

    <div class="form-group">
      <label for="s_name" class="col-sm-4 control-label">Student Name</label>
      <div class="col-sm-5">
        <input type="text" class="form-control" id="s_name" name="s_name" placeholder="Student Name">
      </div>
    </div>

    <div class="form-group">
      <label for="s_mobile" class="col-sm-4 control-label">Mobile Number</label>
      <div class="col-sm-5">
        <input type="text" class="form-control" id="s_mobile" name="s_mobile" placeholder="Student Mobile Number">
      </div>
    </div>

    <div class="form-group">
      <label for="s_email" class="col-sm-4 control-label">Email</label>
      <div class="col-sm-5">
        <input type="email" class="form-control" id="s_email" name="s_email" placeholder="Email">
      </div>
    </div>

    <div class="form-group">
      <label for="password" class="col-sm-4 control-label">Password</label>
      <div class="col-sm-5">
        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
      </div>
    </div>

    <div class="form-group">
      <label for="studentsihp" class="col-sm-4 control-label">Studentship</label>
      <div class="col-sm-5">
          <select class="form-control" id="studentship" name="studentship">
            <option value="1">Yes</option>
            <option value="0">No</option>
          </select>
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-offset-4 col-sm-5">
        <button type="submit" id="create" name="create" class="btn btn-primary btn-block">Create</button>
      </div>
    </div>
  </form>
</div>

<?php else:?>
<?php header('Location: signin.php');?>
<?php endif?>
<?php
  include('footer.php');
?>