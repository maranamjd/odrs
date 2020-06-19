$(document).ready(function(){
  $('#tbl_requests').DataTable();


  $(document).on('click', '#editDocument', function(){
    $('#Edocument_price').val($(this).find('#dprice').val());
    $('#Edocument_processtime').val($(this).find('#dprocesstime').val());
    $('select[id=Edocument_type]').val($(this).find('#dtype').val());
    $('select[id=Edocument_graduate]').val($(this).find('#dgraduate').val());
    $('#Edocument_desc').val($(this).find('#ddesc').val());
    $('#Edocument_reqs').val($(this).find('#dreqs').val());
    $('#Edid').val($(this).find('#docid').val());
    $('.selectpicker').selectpicker('refresh');
    $('#modifyDocumentModal').modal('show');
  });

$(document).on('click', '.addDoc', function(){
  $('#addDocModal').modal('show');
});

$(document).on('submit', '#AddDocForm', function(e){
  e.preventDefault();
  console.log($(this).serializeArray());
  swal({
    title: "Are you sure?",
    text: "You are about to update Document information",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  })
  .then((willDelete) => {
    if (willDelete) {
      $.ajax({
        url: 'addDocument',
        method: 'post',
        dataType: 'json',
        data: $(this).serializeArray(),
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
              title: "Failed to Add Document Information!",
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


  $('#updateDocument').click(function(){
    var dprice        = $('#Edocument_price').val();
    var dprocesstime  = $('#Edocument_processtime').val();
    var dtype         = $('#Edocument_type').val();
    var dgraduate     = $('#Edocument_graduate').val();
    var ddesc         = $('#Edocument_desc').val();
    var dreqs         = $('#Edocument_reqs').val();
    var did           = $('#Edid').val();
    if (dprice == '' || dprocesstime == '' || dtype == '' || dgraduate == '' || ddesc == '' || did == ''){
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
        text: "You are about to update Document information",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          $.ajax({
            url: 'updateDocument',
            method: 'post',
            dataType: 'json',
            data: {
              dprice: dprice,
              dprocesstime: dprocesstime,
              dtype: dtype,
              dgraduate: dgraduate,
              ddesc: ddesc,
              dreqs: dreqs,
              did: did
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
                  title: "Failed to Update Document Information!",
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

  $(document).on('click', '.deleteDocument', function(){
    var did = $(this).find('#did').val();
    swal({
      title: "Are you sure?",
      text: "You are about to delete a Document",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        $.ajax({
          url: 'deleteDocument',
          method: 'post',
          dataType: 'json',
          data: {did: did},
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
                title: "Failed to delete Document!",
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

  $(document).on('click', '.recoverDocument', function(){
    var did = $(this).find('#did').val();
    swal({
      title: "Are you sure?",
      text: "You are about to recover this Document",
      icon: "info",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        $.ajax({
          url: 'recoverDocument',
          method: 'post',
          dataType: 'json',
          data: {did: did},
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
                title: "Failed to restore Document!",
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
