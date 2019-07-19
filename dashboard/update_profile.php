<?php
  include('header.php');
?>
<?php if(is_student_Loggedin()):?>
<?php
  if(isset($_POST['update'])) {
    $id = student_info($_SESSION['s_id'],'s_id');
    //Student's info
    if(isset($_POST['s_id'])) {
      $s_id = protect($_POST['s_id']);
    }
    if(isset($_POST['s_name'])) {
      $s_name = protect($_POST['s_name']);
    }
    if(isset($_POST['date_of_birth'])) {
      $date_of_birth = protect($_POST['date_of_birth']);
    }
    if(isset($_POST['nationality'])) {
      $nationality = protect($_POST['nationality']);
    }
    if(isset($_POST['s_nid'])) {
      $s_nid = protect($_POST['s_nid']);
    }
    if(isset($_POST['gender'])) {
      $gender = protect($_POST['gender']);
    }
    if(isset($_POST['present_address'])) {
      $present_address = protect($_POST['present_address']);
    }
    if(isset($_POST['permanent_address'])) {
      $permanent_address = protect($_POST['permanent_address']);
    }
    if(isset($_POST['s_mobile'])) {
      $s_mobile = protect($_POST['s_mobile']);
    }
    if(isset($_POST['s_email'])) {
      $s_email = protect($_POST['s_email']);
    }
    if(isset($_POST['password'])) {
      $password = protect($_POST['password']);
    }

    //father's info
    if(isset($_POST['f_name'])) {
      $f_name = protect($_POST['f_name']);
    }
    if(isset($_POST['f_mobile'])) {
      $f_mobile = protect($_POST['f_mobile']);
    }
    if(isset($_POST['f_nid'])) {
      $f_nid = protect($_POST['f_nid']);
    }

    //mother's info
    if(isset($_POST['m_name'])) {
      $m_name = protect($_POST['m_name']);
    }
    if(isset($_POST['m_mobile'])) {
      $m_mobile = protect($_POST['m_mobile']);
    }
    if(isset($_POST['m_nid'])) {
      $m_nid = protect($_POST['m_nid']);
    }

    //Guardian's info
    if(isset($_POST['g_name'])) {
      $g_name = protect($_POST['g_name']);
    }
    if(isset($_POST['g_mobile'])) {
      $g_mobile = protect($_POST['g_mobile']);
    }
    if(isset($_POST['g_nid'])) {
      $g_nid = protect($_POST['g_nid']);
    }

    //admission info
    if(isset($_POST['a_year'])) {
      $a_year = protect($_POST['a_year']);
    }
    if(isset($_POST['a_sem'])) {
      $a_sem = protect($_POST['a_sem']);
    }
    if(isset($_POST['a_sec'])) {
      $a_sec = protect($_POST['a_sec']);
    }
    if(isset($_POST['a_program'])) {
      $a_program = protect($_POST['a_program']);
    }
    if(isset($_POST['cur_year'])) {
      $cur_year = protect($_POST['cur_year']);
    }
    if(isset($_POST['cur_sem'])) {
      $cur_sem = protect($_POST['cur_sem']);
    }
    if(isset($_POST['cur_section'])) {
      $cur_section = protect($_POST['cur_section']);
    }
    if(isset($_POST['reg_no'])) {
      $reg_no = protect($_POST['reg_no']);
    }
    if(isset($_POST['studentship'])) {
      $studentship = protect($_POST['studentship']);
    }
    $update = $db->query("UPDATE student_profile SET f_name='$f_name', m_name='$m_name', g_name='$g_name', permanent_address='$permanent_address', present_address='$present_address', gender='$gender', s_nid='$s_nid', f_nid='$f_nid', m_nid='$m_nid', g_nid='$g_nid', s_mobile='$s_mobile', f_mobile='$f_mobile', m_mobile='$m_mobile', g_mobile='$g_mobile', a_year='$a_year', a_sem='$a_sem', a_sec='$a_sec', a_program='$a_program', cur_sem='$cur_sem', cur_section='$cur_section', cur_year='$cur_year', reg_no='$reg_no', studentship='$studentship', experience='', date_of_birth='$date_of_birth', nationality='$nationality', form_submitted='1' WHERE id='$id'");
    if($update) echo "done!";
    else echo "string";
  }
?>

<h1 class="page-header">Update Student Profile</h1>
<form class="form-horizontal" action="" method="post">
<div class="col-sm-12">
  <h2><b>Personal Information:</b></h2>
  <div class="col-sm-6">
    <div class="form-group">
      <label for="s_id" class="col-sm-4 control-label">ID</label>
      <div class="col-sm-8">
        <input type="text" class="form-control" id="s_id" name="s_id" value="<?php echo student_info($_SESSION['s_id'],'s_id'); ?>" disabled>
      </div>
    </div>

    <div class="form-group">
      <label for="s_name" class="col-sm-4 control-label">Name</label>
      <div class="col-sm-8">
        <input type="text" class="form-control" id="s_name" name="s_name" value="<?php echo student_info($_SESSION['s_id'],'s_name'); ?>" disabled>
      </div>
    </div>

    <div class="form-group">
      <label for="date_of_birth" class="col-sm-4 control-label">Date of Birth</label>
      <div class="col-sm-8">
        <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" placeholder="Date of Birth" value="<?php echo student_info($_SESSION['s_id'],'date_of_birth'); ?>">
      </div>
    </div>
    <div class="form-group">
      <label for="nationality" class="col-sm-4 control-label">Nationality</label>
      <div class="col-sm-8">
        <input type="text" class="form-control" id="nationality" name="nationality" placeholder="Nationality" value="<?php echo student_info($_SESSION['s_id'],'nationality'); ?>">
      </div>
    </div> 

     <div class="form-group">
      <label for="s_nid" class="col-sm-4 control-label">NID No.</label>
      <div class="col-sm-8">
        <input type="text" class="form-control" id="s_nid" name="s_nid" placeholder="Student NID No." value="<?php echo student_info($_SESSION['s_id'],'s_nid'); ?>">
      </div>
    </div>

    <div class="form-group">
      <label for="gender" class="col-sm-4 control-label">Gender</label>
      <div class="col-sm-8">
          <select class="form-control" id="gender" name="gender">
            <option value="male" <?php if(student_info($_SESSION['s_id'],'gender') == 'male') echo 'selected'; ?>>Male</option>
            <option value="female" <?php if(student_info($_SESSION['s_id'],'gender') == 'female') echo 'selected'; ?>>Female</option>
          </select>
      </div>
    </div>
  </div>

  <div class="col-sm-6">
    <div class="form-group">
      <label for="present_address" class="col-sm-4 control-label">Present Address</label>
      <div class="col-sm-8">
        <textarea id="present_address" name="present_address" class="form-control" rows="3" placeholder="Present Address" value="<?php echo student_info($_SESSION['s_id'],'present_address'); ?>"></textarea>
      </div>
    </div>

    <div class="form-group">
      <label for="permanent_address" class="col-sm-4 control-label">Permanent Address</label>
      <div class="col-sm-8">
        <textarea id="permanent_address" name="permanent_address" class="form-control" rows="3" placeholder="Permanent Address" value="<?php echo student_info($_SESSION['s_id'],'permanent_address'); ?>"></textarea>
      </div>
    </div>

     <div class="form-group">
      <label for="s_mobile" class="col-sm-4 control-label">Mobile Number</label>
      <div class="col-sm-8">
        <input type="text" class="form-control" id="s_mobile" name="s_mobile" placeholder="Student Mobile Number" value="<?php echo student_info($_SESSION['s_id'],'s_mobile'); ?>">
      </div>
    </div>
    <div class="form-group">
      <label for="s_email" class="col-sm-4 control-label">Email</label>
      <div class="col-sm-8">
        <input type="email" class="form-control" id="s_email" name="s_email" value="<?php echo student_info($_SESSION['s_id'],'s_email'); ?>" disabled>
      </div>
    </div>

    <div class="form-group">
      <label for="password" class="col-sm-4 control-label">Password</label>
      <div class="col-sm-8">
        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
      </div>
    </div>
  </div>
</div>

<div class="col-sm-12">
  <h2><b>Parents and Guardians Information:</b></h2>
  <div class="col-sm-6">
    <h4 style="color:red;"><b>Father's Info:</b></h4>
    <div class="form-group">
      <label for="f_name" class="col-sm-4 control-label">Father's Name</label>
      <div class="col-sm-8">
        <input type="text" class="form-control" id="f_name" name="f_name" placeholder="Student Father Name" value="<?php echo student_info($_SESSION['s_id'],'f_name'); ?>">
      </div>
    </div>

    <div class="form-group">
      <label for="f_mobile" class="col-sm-4 control-label">Mobile Number</label>
      <div class="col-sm-8">
        <input type="text" class="form-control" id="f_mobile" name="f_mobile" placeholder="Student Father Mobile Number" value="<?php echo student_info($_SESSION['s_id'],'f_mobile'); ?>">
      </div>
    </div>

    <div class="form-group">
      <label for="f_nid" class="col-sm-4 control-label">NID</label>
      <div class="col-sm-8">
        <input type="text" class="form-control" id="f_nid" name="f_nid" placeholder="Student Father's NID" value="<?php echo student_info($_SESSION['s_id'],'f_nid'); ?>">
      </div>
    </div>

    <h4 style="color:red;"><b>Guardian's Info:</b></h4>
    <div class="form-group">
      <label for="g_name" class="col-sm-4 control-label">Guirdian Name</label>
      <div class="col-sm-8">
        <input type="text" class="form-control" id="g_name" name="g_name" placeholder="Student Guirdian Name" value="<?php echo student_info($_SESSION['s_id'],'g_name'); ?>">
      </div>
    </div>

    <div class="form-group">
      <label for="g_mobile" class="col-sm-4 control-label">Mobile Number</label>
      <div class="col-sm-8">
        <input type="text" class="form-control" id="g_mobile" name="g_mobile" placeholder="Student Guirdian Mobile Number" value="<?php echo student_info($_SESSION['s_id'],'g_mobile'); ?>">
      </div>
    </div>
    
    <div class="form-group">
      <label for="g_nid" class="col-sm-4 control-label">NID</label>
      <div class="col-sm-8">
        <input type="text" class="form-control" id="g_nid" name="g_nid" placeholder="Student Guirdian's NID" value="<?php echo student_info($_SESSION['s_id'],'g_nid'); ?>">
      </div>
    </div>
  </div>

  <div class="col-sm-6">
  <h4 style="color:red;"><b>Mother's Info:</b></h4>
    <div class="form-group">
      <label for="m_name" class="col-sm-4 control-label">Mother's Name</label>
      <div class="col-sm-8">
        <input type="text" class="form-control" id="m_name" name="m_name" placeholder="Student Mother Name" value="<?php echo student_info($_SESSION['s_id'],'m_name'); ?>">
      </div>
    </div>

    <div class="form-group">
      <label for="m_mobile" class="col-sm-4 control-label">Mobile Number</label>
      <div class="col-sm-8">
        <input type="text" class="form-control" id="m_mobile" name="m_mobile" placeholder="Student Mother Mobile Number" value="<?php echo student_info($_SESSION['s_id'],'m_mobile'); ?>">
      </div>
    </div>

    <div class="form-group">
      <label for="m_nid" class="col-sm-4 control-label">NID</label>
      <div class="col-sm-8">
        <input type="text" class="form-control" id="m_nid" name="m_nid" placeholder="Student Mother's NID" value="<?php echo student_info($_SESSION['s_id'],'m_nid'); ?>">
      </div>
    </div>
  </div>
</div>

<div class="col-sm-12">
  <h2><b>Admission Details:<b></h2>
  <div class="col-sm-4">
    <div class="form-group">
      <label for="a_year" class="col-sm-5 control-label">Admission Year</label>
      <div class="col-sm-7">
        <select class="form-control" name="a_year" id="a_year">
          <?php
            for($y=date("Y")-5; $y<date("Y")+5; $y++){
              if($y == student_info($_SESSION['s_id'],'a_year')) {
                  $selected = "selected";
                } else {
                  $selected = "";
                }
              echo '<option value="'.$y.'"'.$selected.'>'.$y.'</option>';
            }
          ?>
        </select>
      </div>
    </div>
    <div class="form-group">
      <label for="a_sem" class="col-sm-5 control-label">Admission Semester</label>
      <div class="col-sm-7">
        <select class="form-control" id="a_sem" name="a_sem">
          <option value="spring" <?php if(student_info($_SESSION['s_id'],'a_sem') == 'spring') echo 'selected'; ?>>Spring</option>
          <option value="summer" <?php if(student_info($_SESSION['s_id'],'a_sem') == 'summer') echo 'selected'; ?>>Summer</option>
          <option value="fall" <?php if(student_info($_SESSION['s_id'],'a_sem') == 'fall') echo 'selected'; ?>>Fall</option>
        </select>
      </div>
    </div>
    <div class="form-group">
      <label for="a_sec" class="col-sm-5 control-label">Admission Section</label>
      <div class="col-sm-7">
        <select class="form-control" id="a_sec" name="a_sec">
          <option value="a" <?php if(student_info($_SESSION['s_id'],'a_sec') == 'a') echo 'selected'; ?>>A</option>
          <option value="b" <?php if(student_info($_SESSION['s_id'],'a_sec') == 'b') echo 'selected'; ?>>B</option>
          <option value="c" <?php if(student_info($_SESSION['s_id'],'a_sec') == 'c') echo 'selected'; ?>>C</option>
        </select>
      </div>
    </div>
  </div>
  <div class="col-sm-4">
    <div class="form-group">
      <label for="cur_year" class="col-sm-5 control-label">Current Year</label>
      <div class="col-sm-7">
        <select class="form-control" name="cur_year" id="cur_year">
          <?php
            for($y=date("Y")-5; $y<date("Y")+5; $y++){
              if($y == student_info($_SESSION['s_id'],'cur_year')) {
                  $selected = "selected";
                } else {
                  $selected = "";
                }
              echo '<option value="'.$y.'"'.$selected.'>'.$y.'</option>';
            }
          ?>
        </select>
      </div>
    </div>
    <div class="form-group">
      <label for="cur_sem" class="col-sm-5 control-label">Current Semester</label>
      <div class="col-sm-7">
        <select class="form-control" id="cur_sem" name="cur_sem">
          <option value="spring" <?php if(student_info($_SESSION['s_id'],'cur_sem') == 'spring') echo 'selected'; ?>>Spring</option>
          <option value="summer" <?php if(student_info($_SESSION['s_id'],'cur_sem') == 'summer') echo 'selected'; ?>>Summer</option>
          <option value="fall" <?php if(student_info($_SESSION['s_id'],'cur_sem') == 'fall') echo 'selected'; ?>>Fall</option>
        </select>
      </div>
    </div>
    <div class="form-group">
      <label for="cur_section" class="col-sm-5 control-label">Current Section</label>
      <div class="col-sm-7">
        <select class="form-control" id="cur_section" name="cur_section">
          <option value="a" <?php if(student_info($_SESSION['s_id'],'cur_section') == 'a') echo 'selected'; ?>>A</option>
          <option value="b" <?php if(student_info($_SESSION['s_id'],'cur_section') == 'b') echo 'selected'; ?>>B</option>
          <option value="c" <?php if(student_info($_SESSION['s_id'],'cur_section') == 'c') echo 'selected'; ?>>C</option>
        </select>
      </div>
    </div>
  </div>
  <div class="col-sm-4">
    <div class="form-group">
      <label for="a_program" class="col-sm-5 control-label">Admission Program</label>
      <div class="col-sm-7">
        <select class="form-control" id="a_program" name="a_program">
          <option value="bsc" <?php if(student_info($_SESSION['s_id'],'a_program') == 'bsc') echo 'selected'; ?>>BSc</option>
          <option value="msc" <?php if(student_info($_SESSION['s_id'],'a_program') == 'msc') echo 'selected'; ?>>MSc</option>
          <option value="others" <?php if(student_info($_SESSION['s_id'],'a_program') == 'others') echo 'selected'; ?>>Others</option>
        </select>
      </div>
    </div>
    <div class="form-group">
      <label for="reg_no" class="col-sm-5 control-label">Registration No.</label>
      <div class="col-sm-7">
          <input class="form-control" type="text" name="reg_no" id="reg_no" value="<?php echo student_info($_SESSION['s_id'],'reg_no'); ?>">
      </div>
    </div>
   <div class="form-group">
      <label for="studentship" class="col-sm-5 control-label">Studentship</label>
      <div class="col-sm-7">
        <select class="form-control" id="studentship" name="studentship">
          <option value="1" <?php if(student_info($_SESSION['s_id'],'studentship') == '1') echo 'selected'; ?>>YES</option>
          <option value="0" <?php if(student_info($_SESSION['s_id'],'studentship') == '0') echo 'selected'; ?>>NO</option>
        </select>
      </div>
    </div>
  </div>
</div>

<div class="col-sm-12">
<h3> <b>Educational Information:</b></h3>





  <table id="dataTable">
    <TR>

  



    <div class="col-sm-2">
      <TD>
      <div class="form-group">
      <div class="col-sm-12"> 
      <input type="text" class="form-control" id="email" placeholder="Enter Degree Name">
      </div>
      </div>
      </TD>
    </div>


<div class="col-sm-2">
      <TD> 
      <div class="form-group">
       <div class="col-sm-12">
      <input type="text" class="form-control" id="email" placeholder="Enter Group Name">
      </div>
      </div>
      </TD>
   </div>


 <div class="col-sm-6">
      <TD> 
      <div class="form-group">
       <div class="col-sm-12">
      <input type="text" class="form-control" id="email" placeholder="Institution Name">
      </div>
      </div>
      </TD>
 </div>


 <div class="col-sm-1">
      <TD> 
      <div class="form-group">
       <div class="col-sm-12">
      <input type="text" class="form-control" id="email" placeholder="Enter Gpa/ Division">
      </div>
      </div>  
      </TD>
  </div>



<div class="col-sm-1">
      <TD> 
      <div class="form-group">
      <div class="col-sm-12">
      <input type="text" class="form-control" id="email" placeholder="Enter Passing Year">
      </div>
      </div>
      </TD>
   </div>



    </TR>

  </table>
  <input type="button" value="Add New Row" onclick="addRow('dataTable')"/>


 </div>



<h2><b>Others Information:</b></h2>
  



  <div class="form-group">

     <div class="col-sm-offset-4 col-sm-5">
      <img src="upload/1.jpg" name="blah" width="150px" height="150px" id = "blah" class="img-rounded" alt="Responsive image"/>
  </div>
  </div>

<div class="form-group">
    <label for="exampleInputFile" class="col-sm-4 control-label">Upload Your Picture</label>
     <div class="col-sm-5">
    <input type="file" id="file" name="file" onchange="readURL(this);">
    <p class="help-block">Size must be less than 250 KB</p>
    <span style="color:Red;">Only JPEG Format</span> 
</div>
</div>

 <div class="form-group">
    <label for="inputEmail3" class="col-sm-4 control-label">Job Experience Description</label>
    <div class="col-sm-5">
      <textarea class="form-control" rows="3" placeholder="Job Experience Description"></textarea>
    </div>
  </div>


 <div class="form-group">
    <label for="exampleInputFile" class="col-sm-4 control-label">Upload Your Academic Transcript</label>
     <div class="col-sm-5">
    <input type="file" id="exampleInputFile">
    <p class="help-block">Only PDF file is allowed</p>
    </div>
  </div>



<div class="form-group">
    <div class="col-sm-offset-4 col-sm-5"><br/>
<br/>
      <button type="submit" name="update" id="update" class="btn btn-primary form-control">Update</button>
    </div>
  </div>



 


</form>



<SCRIPT language="javascript">
    function addRow(tableID) {

      var table = document.getElementById(tableID);

      var rowCount = table.rows.length;
      var row = table.insertRow(rowCount);

      var colCount = table.rows[0].cells.length;

      for(var i=0; i<colCount; i++) {

        var newcell = row.insertCell(i);

        newcell.innerHTML = table.rows[0].cells[i].innerHTML;
        //alert(newcell.childNodes);
        switch(newcell.childNodes[0].type) {
          case "text":
              newcell.childNodes[0].value = "";
              break;
          case "checkbox":
              newcell.childNodes[0].checked = false;
              break;
          case "select-one":
              newcell.childNodes[0].selectedIndex = 0;
              break;
        }
      }
    }

    function deleteRow(tableID) {
      try {
      var table = document.getElementById(tableID);
      var rowCount = table.rows.length;

      for(var i=0; i<rowCount; i++) {
        var row = table.rows[i];
        var chkbox = row.cells[0].childNodes[0];
        if(null != chkbox && true == chkbox.checked) {
          if(rowCount <= 1) {
            alert("Cannot delete all the rows.");
            break;
          }
          table.deleteRow(i);
          rowCount--;
          i--;
        }


      }
      }catch(e) {
        alert(e);
      }
    }

  </SCRIPT>




<?php else:?>
<?php header('Location: signin.php'); ?>
<?php endif?>
<?php
include('footer.php');
?>