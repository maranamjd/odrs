$(document).ready(function(){

  $('#tbl_employees').DataTable();

  $('#addEmployee').click(function(){
    var employee_id       = $('#employee_id').val();
    var employee_fname    = $('#employee_fname').val();
    var employee_mname    = $('#employee_mname').val();
    var employee_lname    = $('#employee_lname').val();
    var employee_email    = $('#employee_email').val();
    var employee_branch   = $('#employee_branch').val();
    var employee_office   = $('#employee_office').val();
    var employee_position = $('#employee_position').val();
    var employee_utype    = $('#employee_utype').val();

    if (employee_id == '' || employee_fname == '' || employee_lname == '' || employee_email == '' || employee_branch == '' || employee_office == '' || employee_position == '' || employee_utype == ''){
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
        text: "You are about to add a new Employee",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          $.ajax({
            url: 'addEmployee',
            method: 'post',
            dataType: 'json',
            data: {
              employee_id: employee_id,
              employee_fname: employee_fname,
              employee_lname: employee_lname,
              employee_mname: employee_mname,
              employee_email: employee_email,
              employee_branch: employee_branch,
              employee_office: employee_office,
              employee_position: employee_position,
              employee_utype: employee_utype,
            },
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
                  title: "Failed to add Employee!",
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


  $(document).on('click', '#editEmployee', function(){
    $('#Eemployee_id').val($(this).find('#eid').val());
    $('#Eemployee_fname').val($(this).find('#efname').val());
    $('#Eemployee_mname').val($(this).find('#emname').val());
    $('#Eemployee_lname').val($(this).find('#elname').val());
    $('#Eemployee_email').val($(this).find('#eemail').val());
    $('#Eemployee_position').val($(this).find('#eposition').val());
    $('select[id=Eemployee_branch]').val($(this).find('#ebranch').val());
    $('select[id=Eemployee_office]').val($(this).find('#eoffice').val());
    $('select[id=Eemployee_utype]').val($(this).find('#eutype').val());
    $('.selectpicker').selectpicker('refresh');
    $('#modifyEmployeeModal').modal('show');
  });

  $('#updateEmployee').click(function(){
    var employee_id       = $('#Eemployee_id').val();
    var employee_fname    = $('#Eemployee_fname').val();
    var employee_mname    = $('#Eemployee_mname').val();
    var employee_lname    = $('#Eemployee_lname').val();
    var employee_email    = $('#Eemployee_email').val();
    var employee_branch   = $('#Eemployee_branch').val();
    var employee_office   = $('#Eemployee_office').val();
    var employee_position = $('#Eemployee_position').val();
    var employee_utype    = $('#Eemployee_utype').val();
    if (employee_id == '' || employee_fname == '' || employee_lname == '' || employee_email == '' || employee_branch == '' || employee_office == '' || employee_position == '' || employee_utype == ''){
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
        text: "You are about to update Employee information",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          $.ajax({
            url: 'updateEmployee',
            method: 'post',
            dataType: 'json',
            data: {
              employee_id: employee_id,
              employee_fname: employee_fname,
              employee_lname: employee_lname,
              employee_mname: employee_mname,
              employee_email: employee_email,
              employee_branch: employee_branch,
              employee_office: employee_office,
              employee_position: employee_position,
              employee_utype: employee_utype,
            },
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
                  title: "Failed to update Employee Information!",
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



  $(document).on('click', '.deleteEmployee', function(){
    var eid = $(this).find('#eid').val();
    swal({
      title: "Are you sure?",
      text: "You are about to delete an Employee",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        $.ajax({
          url: 'deleteEmployee',
          method: 'post',
          dataType: 'json',
          data: {eid: eid},
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
                title: "Failed to disable Employee",
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

  $(document).on('click', '.activateAccount', function(){
    var eid = $(this).find('#eid').val();
    swal({
      title: "Are you sure?",
      text: "You are about to Activate an employee account",
      icon: "info",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        $.ajax({
          url: 'activateAccount',
          method: 'post',
          dataType: 'json',
          data: {eid: eid},
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
                title: "Failed to activate Account!",
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
