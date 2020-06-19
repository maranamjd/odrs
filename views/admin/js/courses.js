$(document).ready(function(){

  $('#tbl_courses').DataTable();

  $(document).on('click', '#addCourse', function(){
    var course_desc = $('#course_desc').val();
    var course_college = $('#course_college').val();
    if (course_desc == '' || course_college == ''){
      swal({
        title: "Form incomplete",
        text: "Please fill up the form!",
        icon: "warning",
        button: true,
        dangerMode: false
      });
    }else {
      swal({
        title: "Are you sure?",
        text: "You are about to add a new Course",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          $.ajax({
            url: 'addCourse',
            method: 'post',
            dataType: 'json',
            data: {course_desc: course_desc, course_college: course_college},
            success: function(data){
              if (data['res'] == 1) {
                swal({
                  title: data['message'],
                  text: "",
                  icon: "success",
                  button: true,
                  dangerMode: false,
                })
                .then((willDelete) => {
                  if (willDelete) {
                    window.location.reload();
                  }
                });
              }else {
                swal({
                  title: "Failed to add Course!",
                  text: data['message'],
                  icon: "error",
                  button: true,
                  dangerMode: false,
                })
              }
            }
          });
        }
      });
    }
  });

  $(document).on('click', '#editCourse', function(){
    $('#Ecourse_id').val($(this).find('#cid').val());
    $('#Ecourse_desc').val($(this).find('#cdesc').val());
    $('#Ecourse_college option[value='+$(this).find('#ccollege').val()+']').attr('selected', 'selected');
    $('.selectpicker').selectpicker('refresh');
    $('#modifyCourseModal').modal('show');
  });


  $('#updateCourse').click(function(){
    var course_id      = $('#Ecourse_id').val();
    var course_desc    = $('#Ecourse_desc').val();
    var course_college = $('#Ecourse_college').val();
    if (course_id == '' || course_desc == '' || course_college == ''){
      swal({
        title: "Form incomplete",
        text: "Please fill up the form!",
        icon: "warning",
        button: true,
        dangerMode: false
      });
    }else {
      swal({
        title: "Are you sure?",
        text: "You are about to update Course information",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          $.ajax({
            url: 'updateCourse',
            method: 'post',
            dataType: 'json',
            data: {course_id: course_id, course_desc: course_desc, course_college: course_college},
            success: function(data){
              if (data['res'] == 1) {
                swal({
                  title: data['message'],
                  text: "",
                  icon: "success",
                  button: true,
                  dangerMode: false,
                })
                .then((willDelete) => {
                  if (willDelete) {
                    window.location.reload();
                  }
                });
              }else {
                swal({
                  title: "Failed to Update Course Information!",
                  text: data['message'],
                  icon: "error",
                  button: true,
                  dangerMode: false,
                })
              }
            }
          });
        }
      });
    }
  });

  $(document).on('click', '.deleteCourse', function(){
    var course_id = $(this).find('#cid').val();
    swal({
      title: "Are you sure?",
      text: "You are about to delete a Course",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        $.ajax({
          url: 'deleteCourse',
          method: 'post',
          dataType: 'json',
          data: {course_id: course_id},
          success: function(data){
            if (data['res'] == 1) {
              swal({
                title: data['message'],
                text: "",
                icon: "success",
                button: true,
                dangerMode: false,
              })
              .then((willDelete) => {
                if (willDelete) {
                  window.location.reload();
                }
              });
            }else {
              swal({
                title: "Failed to delete Course!",
                text: data['message'],
                icon: "error",
                button: true,
                dangerMode: false,
              })
            }
          }
        });
      }
    });
  });

  $(document).on('click', '.recoverCourse', function(){
    var cid = $(this).find('#cid').val();
    swal({
      title: "Are you sure?",
      text: "You are about to restore a Course",
      icon: "info",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        $.ajax({
          url: 'recoverCourse',
          method: 'post',
          dataType: 'json',
          data: {cid: cid},
          success: function(data){
            if (data['res'] == 1) {
              swal({
                title: data['message'],
                text: "",
                icon: "success",
                button: true,
                dangerMode: false,
              })
              .then((willDelete) => {
                if (willDelete) {
                  window.location.reload();
                }
              });
            }else {
              swal({
                title: "Failed to restore Course!",
                text: data['message'],
                icon: "error",
                button: true,
                dangerMode: false,
              })
            }
          }
        });
      }
    });
  });

});
