function get_total(id) {

  var s_id = $("#s_id"+id).val();
  var sname = $("#same"+id).val();
  var attend = $("#attend"+id).val();
  var ct = $("#ct"+id).val();
  var quiz = $("#quiz"+id).val();
  var assignment = $("#assignment"+id).val();
  var presentation = $("#presentation"+id).val();
  var final_exam = $("#final_exam"+id).val();
  var sum = (1*attend)+(1*ct)+(1*quiz)+(1*assignment)+(1*presentation)+(1*final_exam);
  var data1 = sum.toFixed(1);
  $("#total"+id).val(data1);

  if(data1 >= 80 && data1 <= 100) { 
    $("#gpa"+id).val("4.00");
    $("#grade"+id).val("A+");
  } else if(data1 >= 75 && data1 <= 79) { 
    $("#gpa"+id).val("3.75");
    $("#grade"+id).val("A");
  } else if(data1 >= 70 && data1 <= 74) { 
    $("#gpa"+id).val("3.50");
    $("#grade"+id).val("A-");
  } else if(data1 >= 65 && data1 <= 69) { 
    $("#gpa"+id).val("3.25");
    $("#grade"+id).val("B+");
  } else if(data1 >= 60 && data1 <= 64) { 
    $("#gpa"+id).val("3.00");
    $("#grade"+id).val("B");
  } else if(data1 >= 55 && data1 <= 59) { 
    $("#gpa"+id).val("2.75");
    $("#grade"+id).val("C+");
  } else if(data1 >= 50 && data1 <= 54) { 
    $("#gpa"+id).val("2.50");
    $("#grade"+id).val("C");
  } else if(data1 >= 45 && data1 <= 49) { 
    $("#gpa"+id).val("2.25");
    $("#grade"+id).val("D+");
  } else if(data1 >= 40 && data1 <= 44) { 
    $("#gpa"+id).val("2.00");
    $("#grade"+id).val("D");
  } else {
    $("#gpa"+id).val("0.00");
    $("#grade"+id).val("F");
  }

}

function insert_data(id) {

  var s_id = $("#s_id"+id).val();
  var attend = $("#attend"+id).val();
  var ct = $("#ct"+id).val();
  var quiz = $(".quiz"+id).val();
  var assignment = $("#assignment"+id).val();
  var presentation = $("#presentation"+id).val();
  var final_exam = $("#final_exam"+id).val();
  var total_marks = $("#total"+id).val();
  var gpa= $("#gpa"+id).val();
  var lg = $("#grade"+id).val();

  var sem= $("#sem"+id).val();
  var course= $("#course"+id).val();
  var result_row_id= $("#result_row_id"+id).val();
     
/*
  alert(s_id);
  alert(attend);
  alert(ct);
  alert(quiz);
  alert(assignment);
  alert(presentation);
  alert(final_exam);
  alert(total_marks);
  alert(gpa);
  alert(lg);

  alert(sem);
  alert(course);
  alert(result_row_id);
*/
  $.ajax({
    method:'POST',
    url:'modify_marks_records.php',
    data:{
      row_sid: s_id,
      row_attend: attend,
      row_ct: ct,
      row_quiz: quiz,
      row_assignment: assignment,
      row_presentation: presentation,
      row_final_exam: final_exam,
      row_total: total_marks,  
      row_gpa: gpa,
      row_lg: lg,
      row_sem: sem,
      row_course: course,
      row_id: result_row_id,
      saveData: result_row_id
    },
    success:function(response) {
      if(response=="success") {
        alert("Data Inserted");
      } else {
        alert("Data not Inserted");
      }
    }
  });

}


function getCourseList(sem_id) {
  $.ajax({
    url: "course_list_dropdown.php",
    method:"POST",
    data:{
      sem_id:sem_id
    },
    datatype:"text",
    success:function(data){
      $('#course_id').html(data);
    }

  });
}