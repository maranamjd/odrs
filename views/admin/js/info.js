$(document).ready(function(){
  $('#tbl_requests').DataTable();


  $('#addBranch').click(function(){
    var branch_name = $('#branch_name').val();
    var branch_acronym = $('#branch_acronym').val();
    var director = $('#director').val();
    if (branch_name == '' || branch_acronym == '' || director == ''){
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
        text: "You are about to add a new branch",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          $.ajax({
            url: 'addBranch',
            method: 'post',
            dataType: 'json',
            data: {branch_name: branch_name, branch_acronym: branch_acronym, director: director},
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
                  title: "Failed to add Branch!",
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

  $(document).on('click', '#editBranch', function(){
    $('#Ebranch_name').val($(this).find('#bname').val());
    $('#Ebranch_acronym').val($(this).find('#bacronym').val());
    $('#Edirector').val($(this).find('#bdirector').val());
    $('#Ebid').val($(this).find('#bid').val());
    $('#modifyBranchModal').modal('show');
  });

  $('#updateBranch').click(function(){
    var bname = $('#Ebranch_name').val();
    var bacronym = $('#Ebranch_acronym').val();
    var bdirector = $('#Edirector').val();
    var bid = $('#Ebid').val();
    if (bname == '' || bacronym == '' || bdirector == ''){
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
        text: "You are about to update branch information",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          $.ajax({
            url: 'updateBranch',
            method: 'post',
            dataType: 'json',
            data: {bname: bname, bacronym: bacronym, bdirector:bdirector, bid: bid},
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
                  title: "Failed to Update Branch Information!",
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

  $(document).on('click', '.deleteBranch', function(){
    var bid = $(this).find('#bid').val();
    swal({
      title: "Are you sure?",
      text: "You are about to delete a branch",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        $.ajax({
          url: 'deleteBranch',
          method: 'post',
          dataType: 'json',
          data: {bid: bid},
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
                title: "Failed to delete Branch!",
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

  $(document).on('click', '.recoverBranch', function(){
    var bid = $(this).find('#bid').val();
    swal({
      title: "Are you sure?",
      text: "You are about to restore this branch",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        $.ajax({
          url: 'recoverBranch',
          method: 'post',
          dataType: 'json',
          data: {bid: bid},
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
                title: "Failed to restore Branch!",
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
