<?php

  ob_start();
  session_start();
  include('../includes/connect.php');
  include('../includes/function.php');
  if(isset($_POST['saveData']))
  {
    $row_sid = $_POST['row_sid']; 
    $row_attend = $_POST['row_attend']; 
    $row_ct = $_POST['row_ct'];
    $row_quiz = $_POST['row_quiz'];
    $row_assignment = $_POST['row_assignment'];
    $row_presentation = $_POST['row_presentation'];
    $row_final_exam = $_POST['row_final_exam'];
    $row_total = $_POST['row_total'];
    $row_gpa = $_POST['row_gpa'];
    $row_lg = $_POST['row_lg'];
    $row_sem = $_POST['row_sem'];
    $row_course = $_POST['row_course'];
    $row_id = $_POST['row_id'];

    //$row_id will be 0 when this row wasn't exixt on result table
    if($row_id != 0) {
      $update = $db->query("UPDATE result SET attend = '$row_attend', ct='$row_ct', quize = '$row_quiz', assignment = '$row_assignment', presentation = '$row_presentation', final_exam = '$row_final_exam', total = '$row_total', lg = '$row_lg', gp ='$row_gpa' WHERE id = '$row_id' ");
      echo "success";
      exit();
    } else {
      $insert = $db->query("INSERT INTO result (s_id, semester, course_offer_id, attend, ct, quize, assignment, presentation, final_exam, total, lg, gp) VALUES ('$row_sid', '$row_sem', '$row_course', '$row_attend', '$row_ct', '$row_quiz', '$row_assignment', '$row_presentation', '$row_final_exam', '$row_total', '$row_lg', '$row_gpa'");
      echo "success";
      exit();
    }
  }
?>
   