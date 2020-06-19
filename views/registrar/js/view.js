$(document).ready(function(){
  $('#tbl_requests').DataTable({
    "lengthChange": false,
    "searching": false,
    "columnDefs": [ {
         "targets": 'action',
         "orderable": false,
   } ]
  });

  $(document).on('blur', '#dipNum', function(){
    var dip = $(this).val();
    var student =  $('#studentNumber').val();
    $.ajax({
      url: '../../registrar/saveDiplomaNumber',
      type: 'POST',
      dataType: 'json',
      data: {
        dip: dip,
        student: student
      },
      success:function(data){
        console.log(data);
      }
    });
  });

  $(document).on('click', '.printDocument', function(){
    var docID         = $(this).find("#docID").val();
    var studentNumber = $(this).find("#studentNumber").val();
    var reqID         = $(this).find("#reqID").val();
    var gen           = $(this).attr('rel');


    if (gen == 1) {
      if (docID == '12') {
        if($('#dipNum').val() == ''){
          swal({
            title: "Please provide Diploma Number",
            text: "",
            icon: "info",
            button: true,
            dangerMode: false,
          });
          $('#dipNum').focus();
          return false;
        }
      }
      swal({
          title: "Print Document?",
          text: "",
          icon: "warning",
          buttons: true,
          dangerMode: false,
        }).then((willDelete) => {
          if (willDelete) {
            window.open('../../registrar/printDocument/'+docID+'_'+studentNumber+"_"+reqID, '_blank');
            setTimeout(function(){
              window.location.reload();
            }, 1000);
          }
        });
    }else {
      swal({
          title: "Are you sure?",
          text: "This document will be marked as Printed.",
          icon: "warning",
          buttons: true,
          dangerMode: false,
        }).then((willDelete) => {
          if (willDelete) {
            $.ajax({
              url: '../../registrar/markAsPrinted',
              method: 'post',
              dataType: 'json',
              data: {
                reqID: reqID
              },
              success: function(data){
                if (data == 1) {
                  swal({
                      title: "Request Updated!",
                      text: "",
                      icon: "success",
                      button: true,
                      dangerMode: false,
                    }).then((willDelete) => {
                      if (willDelete) {
                        window.location.reload();
                      }
                    });
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
    }
  });

  $(document).on("click", '.validate', function(){
    swal({
        title: "Are you sure?",
        text: "The document will be marked as Validated.",
        icon: "warning",
        buttons: true,
        dangerMode: false,
      }).then((willDelete) => {
        if (willDelete) {
          var reqID = $(this).attr('rel');
          var controlNum = $(this).attr('id');
          $.ajax({
            url: '../../registrar/validateDocument',
            method: 'post',
            dataType: 'json',
            data: {
              requestID: reqID,
              controlNumber: controlNum
            },
            success: function(data){

              if (data) {
                swal({
                    title: "Request Updated!",
                    text: "",
                    icon: "success",
                    button: true,
                    dangerMode: false,
                  }).then((willDelete) => {
                    if (willDelete) {
                      window.location.reload();
                    }
                  });
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
