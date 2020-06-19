$(document).ready(function(){
  $('#tbl_subjects').DataTable();

  $(document).on('click', '#addSubject', function(){
    var subject_code = $('#subject_code').val();
    var subject_title = $('#subject_title').val();
    var subject_credit = $('#subject_credit').val();
    if (subject_code == '' || subject_title == '' || subject_credit == ''){
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
        text: "You are about to add a new Subject",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          $.ajax({
            url: 'addSubject',
            method: 'post',
            dataType: 'json',
            data: {subject_code: subject_code, subject_title: subject_title, subject_credit: subject_credit},
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
                  title: "Failed to add Subject!",
                  text: data['message'],
                  icon: "error",
                  button: true,
                  dangerMode: false,
                });
              }
            }
          });
        }
      });
    }
  });

  $(document).on('click', '#editSubject', function(){
    $('#Esubject_code').val($(this).find('#ecode').val());
    $('#Esubject_title').val($(this).find('#etitle').val());
    $('#Esubject_credit').val($(this).find('#ecredit').val());
    $('#modifySubjectModal').modal('show');
  });

  $('#updateSubject').click(function(){
    var ecode = $('#Esubject_code').val();
    var etitle = $('#Esubject_title').val();
    var ecredit = $('#Esubject_credit').val();
    if (ecode == '' || etitle == '' || ecredit == ''){
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
        text: "You are about to update Subject information",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          $.ajax({
            url: 'updateSubject',
            method: 'post',
            dataType: 'json',
            data: {ecode: ecode, etitle: etitle, ecredit: ecredit},
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
                  title: "Failed to Update Subject Information!",
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

  $(document).on('click', '.deleteSubject', function(){
    var ecode = $(this).find('#ecode').val();
    swal({
      title: "Are you sure?",
      text: "You are about to delete a Subject",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        $.ajax({
          url: 'deleteSubject',
          method: 'post',
          dataType: 'json',
          data: {ecode: ecode},
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
                title: "Failed to delete Subject!",
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


  $(document).on('click', '.recoverSubject', function(){
    var recID = $(this).find('#recID').val();
    swal({
      title: "Are you sure?",
      text: "You are about to restore this Subject",
      icon: "info",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        $.ajax({
          url: 'recoverSubject',
          method: 'post',
          dataType: 'json',
          data: {recID: recID},
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
                title: "Failed to recover Subject!",
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
