<?php
  include('header.php');
?>
<?php if(is_teacher_Loggedin()):?>
  <br />
<h1 class="page-header">Result</h1>
<br />
<style type="text/css">
  .res_inp {
    width: 70px;
  }
</style>



<?php


if (isset($_POST['sub'])) {

        $str= $_POST['sem_name'];
        $course_id= $_POST['course_name'];
        $sem=explode('-',$str);

        // only registered student come
 
        $query = $db->query("SELECT sp.s_id, sp.s_name FROM student_profile as sp, registration as r where r.s_id=sp.s_id  and r.semester = '".$sem[0]."' and r.year = '".$sem[1]."' and r.cid='".$course_id."' ORDER BY sp.s_id");

        if($query->num_rows>0) {
          $ind=1;
          while($row = $query->fetch_assoc()) {

              $query2 = $db->query("INSERT INTO `result` (`id`, `s_id`, `st_name`, `semester`, `year`, `course_offer_id`) values(null,'".$row['s_id']."','".$row['s_name']."', '".$sem[0]."', '".$sem[1]."', '".$_POST['course_name']."') ");
                
             $ind++;
              }

              echo success("Marks Set Up, <b>$course_id</b> was added successfully.");
            

            }

          }



?>




<form  method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
<div class="row">

  <div class="col-xs-4">
  <label for="exampleInputEmail1">Select Semester</label>
    <select class="form-control" id="sem_id" name="sem_name" onchange="getCourseList(this.value);">
  <option>Select Semester</option>
  <option>Fall-2017</option>
  <option>Summer-2017</option>
  <option>Spring-2017</option>

</select>
  </div>


  


  <div class="col-xs-4">
  <label for="exampleInputEmail1">select Course</label>
 <select class="form-control" id="course_id" name="course_name">
  <option >Select Course</option>
  
</select>
  </div>


<div class="col-xs-2">

  <input type="submit" class="btn btn-primary" id="sub" name="sub" value="Submit">

</div>
</div>
</form>















<?php else:?>
<?php header('Location: signin.php'); ?>
<?php endif?>
<?php
	include('footer.php');
?>