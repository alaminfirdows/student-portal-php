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
    $course_code = protect($_POST['course_code']);
    $course_title = protect($_POST['course_title']);
    $description = protect($_POST['description']);
    $credit = protect($_POST['credit']);
    $prerequ_1 = protect($_POST['prerequ_1']);
    $prerequ_2 = protect($_POST['prerequ_2']);
    $cost = protect($_POST['cost']);

    $check = $db->query("SELECT * FROM course_list WHERE course_code='$course_code'");
    if(empty($course_code) or empty($course_title) or empty($description) or empty($credit) or empty($prerequ_1) or empty($prerequ_2) or empty($cost)) {
      echo error("All fields are required.");
    } elseif($check->num_rows>1) {
      echo error("Course, <b>$course_title ($course_code) </b> was exists.");
    } else {
      $update = $db->query("UPDATE course_list SET course_code='$course_code', course_title='$course_title', description='$description', credit='$credit', prerequ_1='$prerequ_1', prerequ_2='$prerequ_2', cost='$cost' WHERE id='$id'");
      echo success("Course, <b>$course_title ($course_code) </b> was edited successfully.");
    }
  }

  $query = $db->query("SELECT * FROM course_list WHERE id=$id ");
  if ($query->num_rows > 0) {
    $row = $query->fetch_assoc();
  }
?>

<div class="panel-heading">
  <h1 class="page-title">Edit Course</h1>
</div>
<div class="panel-body">
  <form class="form-horizontal" action="" method="post">
  <div class="form-group">
      <label for="course_code" class="col-sm-4 control-label">Course Code</label>
      <div class="col-sm-5">
        <input type="text" class="form-control" id="course_code" name="course_code" placeholder="Enter Course Code" value="<?php echo $row['course_code']; ?>">
      </div>
    </div>

    <div class="form-group">
      <label for="course_title" class="col-sm-4 control-label">Course Title</label>
      <div class="col-sm-5">
        <input type="text" class="form-control" id="course_title" name="course_title" placeholder="Enter Course Title" value="<?php echo $row['course_title']; ?>">
      </div>
    </div>

    <div class="form-group">
      <label for="description" class="col-sm-4 control-label">Description</label>
      <div class="col-sm-5">
        <input type="text" class="form-control" id="description" name="description" placeholder="Enter Course Description" value="<?php echo $row['description']; ?>">
      </div>
    </div>

    <div class="form-group">
      <label for="credit" class="col-sm-4 control-label">Credit</label>
      <div class="col-sm-5">
          <select class="form-control" id="credit" name="credit">
            <option value="1" <?php if($row['credit'] == "1") { echo 'selected'; } ?>>1</option>
            <option value="1.5" <?php if($row['credit'] == "1.5") { echo 'selected'; } ?>>1.5</option>
            <option value="2" <?php if($row['credit'] == "2") { echo 'selected'; } ?>>2</option>
            <option value="3" <?php if($row['credit'] == "3") { echo 'selected'; } ?>>3</option>
            <option value="4" <?php if($row['credit'] == "4") { echo 'selected'; } ?>>4</option>
            <option value="5" <?php if($row['credit'] == "5") { echo 'selected'; } ?>>5</option>
            <option value="6" <?php if($row['credit'] == "6") { echo 'selected'; } ?>>6</option>
            <option value="12" <?php if($row['credit'] == "12") { echo 'selected'; } ?>>12</option>
          </select>
      </div>
    </div>

    <div class="form-group">
      <label for="prerequ_1" class="col-sm-4 control-label">Prerequisite 1</label>
      <div class="col-sm-5">
        <select class="form-control" id="prerequ_1" name="prerequ_1">
          <?php
            $query = $db->query("SELECT * FROM course_list ORDER BY id");
            if($query->num_rows>0) {
              echo '<option value="null">'.'NULL'.'</option>';
              while($course = $query->fetch_assoc()) {
                if($course['id'] == $row['id']) {
                  continue;
                } else if($course['id'] == $row['prerequ_1']) {
                  $selected = "selected";
                } else {
                  $selected = "";
                }
                if($course['id'] == $row['id']) {
                  continue;
                }
                echo '<option value="'.$course[id].'"'.$selected.'>'.$course[course_code].'</option>';
              }
            } else {
              echo '<option value="null>No Course to Display</option>';
            }
          ?>
        </select>
      </div>
    </div>

    <div class="form-group">
      <label for="prerequ_2" class="col-sm-4 control-label">Prerequisite 2</label>
      <div class="col-sm-5">
        <select class="form-control" id="prerequ_2" name="prerequ_2">
          <?php
            $query = $db->query("SELECT * FROM course_list ORDER BY id");
            if($query->num_rows>0) {
              echo '<option value="null">'.'NULL'.'</option>';
              while($course = $query->fetch_assoc()) {
                if($course['id'] == $row['id']) {
                  continue;
                } else if($course['id'] == $row['prerequ_2']) {
                  $selected = "selected";
                } else {
                  $selected = "";
                }
                echo '<option value="'.$course[id].'"'.$selected.'>'.$course[course_code].'</option>';
              }
            } else {
              echo '<option value="null>No Course to Display</option>';
            }
          ?>
        </select>
      </div>
    </div>
    <div class="form-group">
      <label for="cost" class="col-sm-4 control-label">Cost</label>
      <div class="col-sm-5">
        <input type="text" class="form-control" id="cost" name="cost" placeholder="Enter Course Cost" value="<?php echo $row['cost']; ?>">
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
  $query = $db->query("SELECT * FROM course_list WHERE id='$id'");
  if($query->num_rows==0) { header("Location: course_list.php"); }
  $row = $query->fetch_assoc();
?>
<h2 class="sub-header">Delete Course</h2>
<?php

  if(isset($_GET['confirm'])) {
    $delete = $db->query("DELETE FROM course_list WHERE id='$row[id]'");
    echo success("Course, <b>$row[course_title] ($row[course_code]) </b> was deleted successfully.");
  } else {
    echo info("Are you sure you want to delete Teacher, <b>$row[course_title] ($row[course_code]) </b>?");
    echo '<a href="./course_list.php?&action=delete&id='.$id.'&confirm=1" class="btn btn-success"><i class="fa fa-check"></i> Yes</a>&nbsp;&nbsp;
      <a href="./course_list.php" class="btn btn-danger"><i class="fa fa-times"></i> No</a>';
  }
?>
<?php } else { ?>
<h2 class="sub-header">All Course List</h2>
<div class="table-responsive">
  <table class="table table-striped">
    <thead>
      <tr>
        <th>#</th>
        <th>Course Code</th>
        <th>Course Title</th>
        <th>Credit</th>
        <th>Cost</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
        $query = $db->query("SELECT * FROM course_list ORDER BY id");
        if($query->num_rows>0) {
          while($row = $query->fetch_assoc()) {
            echo '<tr><td>'.$row['id'].'</td><td>'.$row['course_code'].'</td><td>'.$row['course_title'].'</td><td>'.$row['credit'].'</td><td>'.$row['cost'].'</td><td><a href="course_list.php?action=edit&id='.$row['id'].'">Edit</a> | <a href="course_list.php?action=delete&id='.$row['id'].'">Delete</a></td></tr>';
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