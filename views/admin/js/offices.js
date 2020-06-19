$(document).ready(function(){

  // $('#tbl_offices').DataTable();
  var dataTable = $('#tbl_offices').DataTable({
      "processing":false,
      "serverSide":true,
      "order":[],
      "ajax":{
          url:"getOfficeData",
          type:"POST",
          data:{fetch: true}
      }
  });
  $(document).on('hidden.bs.modal', '#addOfficeModal', function(e){
    $(this).find('input').val('');
  });

  $(document).on('click', '#addOffice', function(){
    var office_name = $('#office_name').val();
    if (office_name == ''){
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
        text: "You are about to add a new Office",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          $.ajax({
            url: 'addOffice',
            method: 'post',
            dataType: 'json',
            data: {office_name: office_name},
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
                    dataTable.ajax.reload();
                  }
                });
              }else {
                swal({
                  title: "Failed to add Office!",
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

  $(document).on('click', '#editOffice', function(){
    $('#Eoffice_name').val($(this).find('#oname').val());
    $('#Eoid').val($(this).find('#oid').val());
    $('#modifyOfficeModal').modal('show');
  });


  $('#updateOffice').click(function(){
    var oname = $('#Eoffice_name').val();
    var oid = $('#Eoid').val();
    if (oname == ''){
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
        text: "You are about to update Office information",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          $.ajax({
            url: 'updateOffice',
            method: 'post',
            dataType: 'json',
            data: {oname: oname, oid: oid},
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
                    dataTable.ajax.reload();
                  }
                });
              }else {
                swal({
                  title: "Failed to Update Office Information!",
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

  $(document).on('click', '.deleteOffice', function(){
    var oid = $(this).find('#oid').val();
    swal({
      title: "Are you sure?",
      text: "You are about to delete an Office",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        $.ajax({
          url: 'deleteOffice',
          method: 'post',
          dataType: 'json',
          data: {oid: oid},
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
                  dataTable.ajax.reload();
                }
              });
            }else {
              swal({
                title: "Failed to delete Office!",
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
