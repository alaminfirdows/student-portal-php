<?php
  include('header.php');
?>
<?php if(is_admin_Loggedin()):?>
<?php
  if (isset($_POST['create'])){
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
    } elseif($check->num_rows>0) {
      echo error("Course, <b>$course_title ($course_code) </b> was exists.");
    } else {
      $insert = $db->query("INSERT course_list (course_code,course_title,description,credit,prerequ_1,prerequ_2,cost) VALUES ('$course_code','$course_title','$description','$credit','$prerequ_1','$prerequ_2','$cost')");
      echo success("Course, <b>$course_title ( $course_code) </b> was added successfully.");
    }
  }
?>
<div class="panel-heading">
  <h1 class="page-title">Create New Course</h1>
</div>
<div class="panel-body">
  <form class="form-horizontal" action="" method="post">
  <div class="form-group">
      <label for="course_code" class="col-sm-4 control-label">Course Code</label>
      <div class="col-sm-5">
        <input type="text" class="form-control" id="course_code" name="course_code" placeholder="Enter Course Code">
      </div>
    </div>

    <div class="form-group">
      <label for="course_title" class="col-sm-4 control-label">Course Title</label>
      <div class="col-sm-5">
        <input type="text" class="form-control" id="course_title" name="course_title" placeholder="Enter Course Title">
      </div>
    </div>

    <div class="form-group">
      <label for="description" class="col-sm-4 control-label">Description</label>
      <div class="col-sm-5">
        <input type="text" class="form-control" id="description" name="description" placeholder="Enter Course Description">
      </div>
    </div>

    <div class="form-group">
      <label for="credit" class="col-sm-4 control-label">Credit</label>
      <div class="col-sm-5">
          <select class="form-control" id="credit" name="credit">
            <option value="1">1</option>
            <option value="1.5">1.5</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="12">12</option>
          </select>
      </div>
    </div>

    <div class="form-group">
      <label for="prerequ_1" class="col-sm-4 control-label">Prerequisite 1</label>
      <div class="col-sm-5">
        <select class="form-control" id="prerequ_1" name="prerequ_1">
          <option value="null">NULL</option>
          <?php
            $query = $db->query("SELECT * FROM course_list ORDER BY id");
            if($query->num_rows>0) {
              while($row = $query->fetch_assoc()) {
                echo '<option value="'.$row[id].'">'.$row[course_code].'</option>';
              }
            } else {
              echo '<option value="null">No Course to Display</option>';
            }
          ?> 
        </select>
      </div>
    </div>

    <div class="form-group">
      <label for="prerequ_2" class="col-sm-4 control-label">Prerequisite 2</label>
      <div class="col-sm-5">
          <select class="form-control" id="prerequ_2" name="prerequ_2">
            <option value="null">NULL</option>
            <?php
              $query = $db->query("SELECT * FROM course_list ORDER BY id");
              if($query->num_rows>0) {
                while($row = $query->fetch_assoc()) {
                  echo '<option value="'.$row[id].'">'.$row[course_code].'</option>';
                }
              } else {
                echo '<option value="null">No Course to Display</option>';
              }
            ?>
          </select>
      </div>
    </div>
    <div class="form-group">
      <label for="cost" class="col-sm-4 control-label">Cost</label>
      <div class="col-sm-5">
        <input type="text" class="form-control" id="cost" name="cost" placeholder="Enter Course Cost">
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