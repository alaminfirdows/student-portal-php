<?php
  include('header.php');
?>
<?php if(is_teacher_Loggedin()):?>
  <br />
<h1 class="page-header">Result</h1>

<style type="text/css">
  .res_inp {
    width: 70px;
  }
</style>


<form  method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
<div class="row">
  <div class="col-xs-4">
    <select class="form-control" id="sem_id" name="sem_name" onchange="getCourseList(this.value);">
      <option >Select Course</option>
      <?php
        $query_sem = $db->query("SELECT * from semester");
        if($query_sem->num_rows>0) {
          while($row_sem = $query_sem->fetch_assoc()) {
            echo '<option value="'.$row_sem["id"].'">'.$row_sem["semester"]."-".$row_sem["year"].'</option>';
          }
        }
      ?>
    </select>
  </div>

  <div class="col-xs-4">
    <select class="form-control" id="course_id" name="course_name">
      <option value="" disabled selected>Select Course</option>
    </select>
  </div>

  <div class="col-xs-2">

    <input type="submit" class="btn btn-primary" id="sub" name="sub" value="Submit">
  </div>
</div>
</form>


<div class="table-responsive">
  <table class="table table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Attend</th>
        <th>CT</th>
        <th>Quiz</th>
        <th>Assign</th>
        <th>Present</th>
        <th>Final</th>
        <th>Total</th>
        <th>CGPA</th>
        <th>Grade Point</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
      if (isset($_POST['sub'])) {

        $sem= $_POST['sem_name'];
        $course_id= $_POST['course_name'];
        $stu_list = $db->query("SELECT * from registration where semester = '".$sem."' and cid='".$course_id."' ");

        if($stu_list->num_rows>0) {
          $ind=1;
          while($stu_row = $stu_list->fetch_assoc()) {

            $stu_res = $db->query("SELECT * from result where semester = '".$sem."' and course_offer_id='".$course_id."' and s_id='".$stu_row['s_id']."' ");
            $res_row = $stu_res->fetch_assoc();


            // to track it was exist on result tabole or not
            // set 0 when it wasn't exixt
            if ($res_row["id"] > 0) {
              $res_row_id = $res_row["id"];
            } else {
              $res_row_id = 0;
            }

            print '<tr id1="'.$ind.'">
            <div class="col-sm-5">
            <td width="40%"><input type="text" id="s_id'.$ind.'" class="form-control s_id'.$ind.'" name="s_id'.$ind.'"  value='.$stu_row['s_id'].' disabled></td>
            <td width="80%"><input type="text" id="s_name'.$ind.'" class="form-control s_name'.$ind.'" name="s_name'.$ind.'" value="'.student_info($stu_row['s_id'], "s_name").'" disabled></td>
            </div>

            <div class="col-sm-7">
            <td><input type="text" id="attend'.$ind.'" class="form-control res_inp attend'.$ind.'" name="attend'.$ind.'" value="'.$res_row['attend'].'" onchange="get_total('.$ind.');"></td>
            <td><input type="text" id="ct'.$ind.'" class="form-control res_inp ct'.$ind.'" name="ct'.$ind.'" value="'.$res_row['ct'].'" onchange="get_total('.$ind.');"></td>
            <td><input type="text" id="quiz'.$ind.'" class="form-control res_inp quiz'.$ind.'" name="quiz'.$ind.'" value="'.$res_row['quize'].'" onchange="get_total('.$ind.');"></td>
            <td><input type="text" id="assignment'.$ind.'" class="form-control res_inp assignment'.$ind.'" name="assignment'.$ind.'" value="'.$res_row['assignment'].'" onchange="get_total('.$ind.');"></td>
            <td><input type="text" id="presentation'.$ind.'" class="form-control res_inp presentation'.$ind.'" name="presentation'.$ind.'" value="'.$res_row['presentation'].'" onchange="get_total('.$ind.');"></td>
            <td><input type="text" id="final_exam'.$ind.'" class="form-control res_inp final_exam'.$ind.'" name="final_exam'.$ind.'" value="'.$res_row['final_exam'].'" onchange="get_total('.$ind.');"></td>
            <td><input type="text" id="total'.$ind.'" class="form-control res_inp total'.$ind.'" name="total'.$ind.'" value="'.$res_row['total'].'" disabled  onchange="get_total('.$ind.');"></td>
            <td><input type="text" id="gpa'.$ind.'" class="form-control res_inp gpa'.$ind.'" name="gpa'.$ind.'" value="'.$res_row['gp'].'"  disabled onchange="get_total('.$ind.');" ></td>
            <td><input type="text" id="grade'.$ind.'" class="form-control res_inp grade'.$ind.'" name="grade'.$ind.'" value="'.$res_row['lg'].'"  disabled onchange="get_total('.$ind.');" ></td>

            <input type="hidden" id="sem'.$ind.'" name="sem'.$ind.'" value="'.$sem.'">
            <input type="hidden" id="course'.$ind.'" name="course'.$ind.'" value="'.$course_id.'">
            <input type="hidden" id="result_row_id'.$ind.'" name="result_row_id'.$ind.'" value="'.$res_row_id.'">
          
            <td><input type="submit" class="btn btn-primary save_button'.$ind.'" value="Save" id="save_button'.$ind.'"  onclick="insert_data('.$ind.');"> </td>

            </div>
            </tr>';
            $ind++;
          }
        } else {
          echo '<tr><td colspan="12">No Student to Display</td></tr>';
        }
      }
    ?>
    </tbody>
  </table>
</div>


<?php else:?>
<?php header('Location: signin.php'); ?>
<?php endif?>

<?php
  include('footer.php');
?>