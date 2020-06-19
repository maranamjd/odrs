$(document).ready(function(){

  var dataTable = $('#tbl_offices').DataTable({
      "processing":false,
      "serverSide":true,
      "order":[],
      "ajax":{
          url:"getTrashOfficeData",
          type:"POST",
          data:{fetch: true}
      }
  });


  $(document).on('click', '.recoverOffice', function(){
    var oid = $(this).find('#oid').val();
    swal({
      title: "Are you sure?",
      text: "You are about to restore an Office",
      icon: "info",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        $.ajax({
          url: 'recoverOffice',
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
                title: "Failed to restore Office!",
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
