$(document).ready(function(){

  $('#tbl_choices').DataTable();

  $(document).on('click', '#addChoice', function(){
    var choice_desc = $('#choice_desc').val();
    var question_id = $('#question_id').val();
    if (choice_desc == '' || question_id == ''){
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
        text: "You are about to add a new Choice",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          $.ajax({
            url: '../addChoice',
            method: 'post',
            dataType: 'json',
            data: {choice_desc: choice_desc, question_id: question_id},
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
                  title: "Failed to add Choice!",
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

  $(document).on('click', '#editChoice', function(){
    $('#Echoice_id').val($(this).find('#cid').val());
    $('#Echoice_desc').val($(this).find('#cdesc').val());
    $('#modifyChoiceModal').modal('show');
  });


  $('#updateChoice').click(function(){
    var choice_id   = $('#Echoice_id').val();
    var choice_desc = $('#Echoice_desc').val();
    if (choice_id == '' || choice_desc == ''){
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
        text: "You are about to update Choice information",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          $.ajax({
            url: '../updateChoice',
            method: 'post',
            dataType: 'json',
            data: {choice_id: choice_id, choice_desc: choice_desc},
            success: function(data){
              if (data) {
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
                  title: "Failed to Update Choice Information!",
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

  $(document).on('click', '.deleteChoice', function(){
    var choice_id = $(this).find('#cid').val();
    swal({
      title: "Are you sure?",
      text: "You are about to delete a Choice",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        $.ajax({
          url: '../deleteChoice',
          method: 'post',
          dataType: 'json',
          data: {choice_id: choice_id},
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
                title: "Failed to delete Choice!",
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

  $(document).on('click', '.recoverChoice', function(){
    var choice_id = $(this).find('#cid').val();
    swal({
      title: "Are you sure?",
      text: "You are about to restore this Choice",
      icon: "info",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        $.ajax({
          url: 'recoverChoice',
          method: 'post',
          dataType: 'json',
          data: {choice_id: choice_id},
          success: function(data){
            if (data) {
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
                title: "Failed to delete Choice!",
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
