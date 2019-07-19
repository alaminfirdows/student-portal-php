<?php
  include('header.php');
?>
<?php if(is_teacher_Loggedin()):?>
  <br />
<h1 class="page-header">Students</h1>
<br />
<style type="text/css">
  .res_inp {
    width: 70px;
  }
</style>

<form  method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
<div class="row">

  <div class="col-xs-4">
    <select class="form-control" id="sem_id" name="sem_name" onchange="getCourseList(this.value);">
  <option>Select Semester</option>
  <option>Fall-2017</option>
  <option>Summer-2017</option>
  <option>Spring-2017</option>

</select>
  </div>


  


  <div class="col-xs-4">
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