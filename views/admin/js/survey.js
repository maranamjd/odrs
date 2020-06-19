$(document).ready(function(){

  $('#tbl_questions').DataTable();

  $(document).on('click', '#addQuestion', function(){
    var question_desc = $('#question_desc').val();
    var question_other = $('#question_other').is(':checked') ? 1 : 0;
    if (question_desc == ''){
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
        text: "You are about to add a new Question",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          $.ajax({
            url: 'addQuestion',
            method: 'post',
            dataType: 'json',
            data: {question_desc: question_desc, question_other: question_other},
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
                  title: "Failed to add Question!",
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

  $(document).on('click', '#editQuestion', function(){
    $('#Equestion_id').val($(this).find('#qid').val());
    $('#Equestion_desc').val($(this).find('#qdesc').val());
    $(this).find('#qother').val() == 1 ? $('#Equestion_other').prop('checked', true) : $('#Equestion_other').prop('checked', false);
    $('#modifyQuestionModal').modal('show');
  });


  $('#updateQuestion').click(function(){
    var question_id   = $('#Equestion_id').val();
    var question_desc = $('#Equestion_desc').val();
    var question_other = $('#Equestion_other').is(':checked') ? 1 : 0;
    if (question_id == '' || question_desc == ''){
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
        text: "You are about to update Question information",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          $.ajax({
            url: 'updateQuestion',
            method: 'post',
            dataType: 'json',
            data: {question_id: question_id, question_desc: question_desc, question_other: question_other},
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
                  title: "Failed to Update Question Information!",
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

  $(document).on('click', '.deleteQuestion', function(){
    var question_id = $(this).find('#qid').val();
    swal({
      title: "Are you sure?",
      text: "You are about to delete a Question",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        $.ajax({
          url: 'deleteQuestion',
          method: 'post',
          dataType: 'json',
          data: {question_id: question_id},
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
                title: "Failed to delete Question!",
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

  $(document).on('click', '#viewQuestion', function(){
    window.open($(this).attr('rel'), '_blank');
  });

  $(document).on('click', '.recoverQuestion', function(){
    var question_id = $(this).find('#qid').val();
    swal({
      title: "Are you sure?",
      text: "You are about to restore this Question",
      icon: "info",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        $.ajax({
          url: 'recoverQuestion',
          method: 'post',
          dataType: 'json',
          data: {question_id: question_id},
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
                title: "Failed to restore Question!",
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
