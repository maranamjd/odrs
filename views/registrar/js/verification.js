$(document).ready(function(){

      var oTable;
      oTable = $('#tbl_requests').dataTable();

      $('#sortID').change( function() {
          var selectedValue = $(this).val();
          oTable.fnFilter("^"+selectedValue+"$", 5, true);
       });

   setInterval(function(){
     $.ajax({
       url: 'requestChanges',
       method: 'post',
       dataType: 'json',
       data: {fetch: 1},
       success: function(data){
         for (var x in data) {
           let {dateFinished, status, action} = data[x];
           $('#'+x).html(data[x]);
         }
       }
     });
   }, 1000);

$(document).on('dblclick', '#tbl_requests tr', function(){
    window.open($(this).attr('rel'), '_blank');
  });

  $(document).on('click', '.declineBtn', function(){
    var controlID = $('#controlDecline').val();
    var repEmail = $('#repEmailDecline').text();
    var repName = $('#repNameDecline').text();
    var reason = $('#declineReason').val();
    if (reason == '') {
      swal({
          title: "Please provide a reason!",
          text: "",
          icon: "info",
          button: true,
          dangerMode: false,
        });
    }else {
      swal({
          title: "Are you sure you want to decline?",
          text: "",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willAccept) => {
          if (willAccept) {
              $.ajax({
              url: '../registrar/declinePayment',
              method: 'post',
              dataType: 'json',
              beforeSend: function(){
                $('#verifyVerificationModal').modal('hide');
                $('#loadModal').modal({
                  backdrop: 'static',
                  keyboard: false
                });
              },
              data: {controlID: controlID, repEmail: repEmail, repName: repName, reason: reason},
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
                      window.location.reload();
                    }
                  });
                }else if (data['res'] == 0) {
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
                }else if (data['res'] == 2){
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
          } else {
            //
          }
        });
    }
  });


  $(document).on('click', '.approveBtn', function(){
    var control = $(this).attr('rel');

    $.ajax({
      url: '../registrar/showPayment',
      method: 'post',
      data: {control: control},
      success: function(data){
        var show = JSON.parse(data);
        var fileName = show.fileName;
        var payType = show.type;
        $('#payDate').text(show.created);
        $('#payOR').text(show.reciept);
        $('#payCurrency').text(show.currency);
        $('#repNameDecline').text(show.repname);
        $('#repEmailDecline').text(show.repemail);
        $('#controlDecline').val(control);
        var attrib = "../system/verification/files/payments/"+payType+"/"+fileName;
        $('#showFile').attr("src", attrib);
      }
    });


    $('#control').val(control);
    $('#approvalTitle').text('Controller ID: '+control);
    $('#viewApprovalModal').modal('show');
   });



   $(document).on('click', '.verifyBtn', function(){
     var control = $(this).attr('rel');
     $('#control').val(control);
         $.ajax({
           url: '../registrar/showForVerification',
           method: 'post',
           data: {control: control},
           success: function(data){
             var show = JSON.parse(data);
             var verify = show.info;

             for (x in verify) {
               var fname = verify[x]['fileName'];
               var id = verify[x]['verificationID'];
               var result = verify[x]['result'];
               $("#verifyList").append("<li class='my-1'><div class='row'><div class='col-md-7'><p id=''>"+fname+"</p></div> <div class='col-md-4'>"+result+"</div> </div> </li>");
              }

            $('#control').val(show.details.control);
             $('#repName').text(show.details.repName);
             $('#repEmail').text(show.details.email);

           }
         });
     $('#verifyTitle').text('Controller ID: '+control);
     $('#verifyVerificationModal').modal('show');
    });

    $(document).on('click', '.acceptReciept', function() {
      var conrt = $('#control').val();
      swal({
          title: "",
          text: "Are you sure you want to accept this payment?",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willAccept) => {
          if (willAccept) {
            $.ajax({
              url: '../registrar/acceptPayment',
              method: 'post',
              data: {control: conrt},
              success: function(data){
                if (data) {
                  swal({
                    title: "Status Updated!",
                    text: "",
                    icon: "success",
                    button: true,
                    dangerMode: false,
                  })
                  .then((willDelete) => {
                    if (willDelete) {
                        $('#viewApprovalModal').modal('hide');
                    }
                  });
                }else {
                  swal("Failed to update Status!", {
                   icon: "error",
                  });
                }
              }
            });
          } else {
            //
          }
        });

      });



      $(document).on('click', '.declineReciept', function() {
        $('#declineRecieptModal').modal('show');
        });

    $(document).on('click', '.viewReciept', function() {
      var fname = $('#fileName').val();
      var type = $('#payType').val();

      window.open('../system/verification/files/payments/'+type+'/'+fname, '_blank', 'fullscreen=yes');
      });

      $(document).on('click', '.sendBtn', function() {
        var notes = $('#regiNote').val();
        var control = $('#control').val();
        var repName = $('#repName').text();
        var repEmail = $('#repEmail').text();

        swal("Poof! Your imaginary file has been deleted!", {
          icon: "success",
        });

        swal({
          title: "Are you sure?",
          text: "Send results",
          icon: "info",
          buttons: true,
          dangerMode: false,
        })
        .then((willSend) => {
          if (willSend) {
            $.ajax({
            url: '../registrar/sendResult',
            method: 'post',
            dataType: 'json',
            data: {
              control: control,
              notes: notes,
              repName: repName,
              repEmail: repEmail
            },
            beforeSend: function(){
              $('#verifyVerificationModal').modal('hide');
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

          } else {
            //
          }
        });


      });

});




  $('#verifyVerificationModal').on('hidden.bs.modal', function(e) {
    $('#verifyList').empty();
  });
