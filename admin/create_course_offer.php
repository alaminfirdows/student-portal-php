<?php
  include('header.php');
?>
<?php if(is_admin_Loggedin()):?>
<?php
  if (isset($_POST['create'])){
    $year = protect($_POST['year']);
    $semester = protect($_POST['semester']);
    $course_id = protect($_POST['course_id']);
    $teacher_id = protect($_POST['teacher_id']);
    $time_slot = protect($_POST['time_slot']);
    $day = protect($_POST['day']);
    $amount = protect($_POST['amount']);
    

$check = $db->query("SELECT * FROM course_offer WHERE year='$year' and semester='$semester' and course_id='$course_id' and teacher_id='$teacher_id' and time_slot='$time_slot' and day='$day'");
$check2 = $db->query("SELECT * FROM course_offer WHERE year='$year' and semester='$semester' and teacher_id='$teacher_id' and time_slot='$time_slot' and day='$day'");

if(empty($year) or empty($semester) or empty($course_id) or empty($teacher_id) or empty($time_slot) or empty($day) or empty($amount)) {
      echo error("All fields are required.");
    } elseif($check->num_rows>0) {
      echo error("Course Offer, on <b>$semester $year ($day) </b> was exists.");
    } elseif($check2->num_rows>0) {
      echo error("Course Offer by <b>".teacher_info($teacher_id,"name")."</b>, on <b>$semester $year ($day) </b> was exists.");
    } else {
      $insert = $db->query("INSERT course_offer (year,semester,course_id,teacher_id,time_slot,day,amount) VALUES ('$year','$semester','$course_id','$teacher_id','$time_slot','$day','$amount')");
      echo success("Course Offer, on <b>$semester $year ($day) </b> was added successfully.");
    }
  }
?>

<h1 class="page-header">Create New Course Offering/Advising</h1>
<form class="form-horizontal" action="" method="post">
  <div class="form-group">
    <label for="year" class="col-sm-4 control-label">Year</label>
    <div class="col-sm-5">
        <select class="form-control" name="year" id="year">
          <option value="2017">2017</option>
          <option value="2018">2018</option>
          <option value="2019">2019</option>
          <option value="2020">2020</option>
        </select>
    </div>
  </div>

  <div class="form-group">
    <label for="semester" class="col-sm-4 control-label">Semester</label>
    <div class="col-sm-5">
        <select class="form-control" id="semester" name="semester">
          <option value="spring">Spring</option>
          <option value="summer">Summer</option>
          <option value="fall">Fall</option>
        </select>
    </div>
  </div>

  <div class="form-group">
    <label for="course_id" class="col-sm-4 control-label">Course Code</label>
    <div class="col-sm-5">
        <select class="form-control" id="course_id" name="course_id">
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
  <label for="teacher_id" class="col-sm-4 control-label">Teacher's Name</label>
  <div class="col-sm-5">
      <select class="form-control" id="teacher_id" name="teacher_id">
      <?php
        $query = $db->query("SELECT * FROM teacher_profile ORDER BY id");
        if($query->num_rows>0) {
          while($row = $query->fetch_assoc()) {
            echo '<option value="'.$row[id].'">'.$row[name].'</option>';
          }
        } else {
          echo '<option value="null">No Teacher to Display</option>';
        }
      ?>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label for="time_slot" class="col-sm-4 control-label">Time Slot</label>
    <div class="col-sm-5">
      <input type="time" class="form-control" id="time_slot" name="time_slot" placeholder="Time Slot">
    </div>
  </div>

  <div class="form-group">
    <label for="day" class="col-sm-4 control-label">Day</label>
    <div class="col-sm-5">
        <select class="form-control" id="day"  name="day">
          <option value="sat">Sat</option>
          <option value="sun">Sun</option>
          <option value="mon">Mon</option>
          <option value="tue">Tue</option>
          <option value="wed">Wed</option>
          <option value="thu">Thu</option>
        </select>
      </div>
  </div>

  <div class="form-group">
      <label for="name" class="col-sm-4 control-label">Amount</label>
      <div class="col-sm-5">
        <input type="text" class="form-control" id="amount" name="amount" placeholder="Enter Amount">
      </div>
    </div>
  
  <div class="form-group">
    <div class="col-sm-offset-4 col-sm-5">
      <button type="submit" id="create" name="create" class="btn btn-primary btn-block">Save</button>
    </div>
  </div>
</form>

<?php else:?>
<?php header('Location: signin.php');?>
<?php endif?>
<?php
  include('footer.php');
?>