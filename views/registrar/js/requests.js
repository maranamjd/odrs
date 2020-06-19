$(document).ready(function(){
  $(document).on('hidden.bs.modal', '#updatesModal', function(e){
    $(this).find('textarea').val('');
    $(this).find('select').val('');
    $('.selectpicker').selectpicker('refresh');
  });
  let dataTable = $('#tbl_requests').DataTable({
    "processing":false,
    "serverSide":true,
    "order":[],
    "ajax":{
        url:"getRequests",
        type:"POST",
        data:{fetch: true}
    }
  });

  $(document).on('click', '.updates', function(){
    $('#controlNumber').text($(this).attr('rel'));
    $('#name').text($(this).parent().parent().parent().children().eq(2).text());
    $('#updatesModal').modal('show');
  });

  $(document).on('submit', '.update_form', function(e){
    e.preventDefault();
    swal({
      title: "Continue?",
      text: "Send Updates",
      icon: "info",
      buttons: true,
      dangerMode: false,
    })
    .then((willSend) => {
      if (willSend) {
        $.ajax({
        url: 'sendUpdates',
        method: 'post',
        dataType: 'json',
        data: {
          control: $('#controlNumber').text(),
          notes: $('#note').val(),
          name: $('#name').text(),
          type: $('#updateType').val()
        },
        beforeSend: function(){
          $('#updatesModal').modal('hide');
          $('#loadModal').modal('show');
        },
        success: function(data){
          if (data['res'] == 1) {
            swal({
              title: data['message'],
              text: '',
              icon: "success",
              button: true,
              dangerMode: false,
            })
            .then((willDelete) => {
              if (willDelete) {
                $('#loadModal').modal('hide');
              }
            });
          }else if (data['res'] == 0 || data['res'] == 2) {
            swal({
              title: "There was an error sending the email!",
              text: data['message'],
              icon: "error",
              button: true,
              dangerMode: false,
            })
            .then((willDelete) => {
              if (willDelete) {
                $('#loadModal').modal('hide');
              }
            });
          }
         }
      });
      }
    });
  });

  $('#sortID').change( function() {
    dataTable
      .columns(6)
      .search($(this).val())
      .draw();
    // var selectedValue = $(this).val();
    // $('#tbl_requests').dataTable().fnFilter("^"+selectedValue+"$", 6, true);
  });

  setInterval(function(){
    $.ajax({
      url: 'requestChanges',
      method: 'post',
      dataType: 'json',
      data: {fetch: 0},
      success: function(data){
        for (var x in data) {
          let {dateFinished, status, action} = data[x];
          $('#'+x).html(data[x]);
        }
      }
    });
  }, 2000);

  setInterval(function(){
    dataTable.ajax.reload();
  },300000);

   $(document).on('dblclick', '#tbl_requests tbody tr', function(){
     window.open("view/"+$(this).children().first().text(), '_blank');
   });


  $(document).on("click", '.payment', function(){
     var control =  $(this).attr('rel');
     $('#payTitle').text('Request ID: '+control);
     $('#control').val(control);
    $('#viewPaymentModal').modal('show');
  });

  $(document).on("click", '.submitReciept', function(){
    var control = $('#control').val();
    var datepay = $('#payDate').val();
    var reciept = $('#recieptNum').val();
    var type = $('#payType').val();
    if (datepay != '' || reciept != '' || type != '') {
      swal({
      title: "Are you sure?",
      text: "the request will be marked as paid.",
      icon: "warning",
      buttons: true,
      dangerMode: false,
    }).then((willDelete) => {
      if (willDelete) {
        var controlNumber = $(this).attr('rel');
        $.ajax({
          url: '../registrar/recievePayment',
          method: 'post',
          dataType: 'json',
          data: {
            control: control,
            datepay: datepay,
            type: type,
            reciept: reciept
          },
          success: function(data){
            if (data == true) {
              swal({
                  title: 'Status Updated',
                  text: "",
                  icon: "success",
                  button: true,
                  dangerMode: false,
                });
                dataTable.ajax.reload();
            }else {
              swal({
                  title: "An error occured!",
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

    }else{
      swal('All fields are required!','','error');
    }

  });


  $(document).on("click", '.claim', function(){
    swal({
        title: "Are you sure?",
        text: "the request will be marked as claimed.",
        icon: "warning",
        buttons: true,
        dangerMode: false,
      }).then((willDelete) => {
        if (willDelete) {
          var controlNumber = $(this).attr('rel');
          $.ajax({
            url: '../registrar/claimDocument',
            method: 'post',
            dataType: 'json',
            data: {controlNumber: controlNumber},
            success: function(data){
              if (data['res'] == 1) {
                swal({
                    title: data['message'],
                    text: "",
                    icon: "success",
                    button: true,
                    dangerMode: false,
                  });
                  dataTable.ajax.reload();
              }else {
                swal({
                    title: "An error occured!",
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
  });


});
