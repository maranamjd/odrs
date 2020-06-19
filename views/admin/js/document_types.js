$(document).ready(function(){

  $('#tbl_doctypes').DataTable();

  $(document).on('click', '#addDoctype', function(){
    var doctype_desc = $('#doctype_desc').val();
    if (doctype_desc == ''){
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
        text: "You are about to add a new Document Type",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          $.ajax({
            url: 'addDoctype',
            method: 'post',
            dataType: 'json',
            data: {doctype_desc: doctype_desc},
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
                  title: "Failed to add Document Type!",
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

  $(document).on('click', '#editDoctype', function(){
    $('#Edoctype_desc').val($(this).find('#doctypedesc').val());
    $('#Edoctypeid').val($(this).find('#doctypeid').val());
    $('#modifyDoctypeModal').modal('show');
  });


  $('#updateDoctype').click(function(){
    var doctype_desc  = $('#Edoctype_desc').val();
    var doctype_id    = $('#Edoctypeid').val();
    if (doctype_desc == '' || doctype_id == ''){
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
        text: "You are about to update Document Type information",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          $.ajax({
            url: 'updateDoctype',
            method: 'post',
            dataType: 'json',
            data: {doctype_desc: doctype_desc, doctype_id: doctype_id},
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
                  title: "Failed to Update Document Type Information!",
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

  $(document).on('click', '.deleteDoctype', function(){
    var doctype_id = $(this).find('#doctypeid').val();
    swal({
      title: "Are you sure?",
      text: "You are about to delete a Document Type",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        $.ajax({
          url: 'deleteDoctype',
          method: 'post',
          dataType: 'json',
          data: {doctype_id: doctype_id},
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
                title: "Failed to delete Document Type!",
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


    $(document).on('click', '.recoverDoctype', function(){
      var doctype_id = $(this).find('#doctypeid').val();
      swal({
        title: "Are you sure?",
        text: "You are about to restore this Document Type",
        icon: "info",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          $.ajax({
            url: 'recoverDoctype',
            method: 'post',
            dataType: 'json',
            data: {doctype_id: doctype_id},
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
                  title: "Failed to restore Document Type!",
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
