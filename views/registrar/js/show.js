$(document).ready(function(){
  $('#tbl_requests').DataTable({
    "lengthChange": false,
    "searching": false,
    "columnDefs": [ {
         "targets": 'action',
         "orderable": false,
   } ]
  });

  $(document).on('click', '.viewFile', function() {
    if ($(this).attr('rel') == null) {
      var docType = $('#doctypeID').val()
      var fname = $('#fileName').text();
    }else {
      var docType = $(this).attr('rel');
      var fname = $(this).attr('id');
    }
    // console.log(docType, fname);
    window.open('../../system/verification/files/upload/'+docType+'/'+fname, '_blank', 'fullscreen=yes');
    });

    $(document).on('click', '.verifyBtn', function(){
      var control = $(this).attr('id');
      var fileName = $(this).attr('data-name');
      var doctype = $(this).attr('data-docType');
      var docID = $(this).attr('data-docTypeID');
      var result = $(this).attr('data-result');


      $('#control').val(control);
      $('#fileName').text(fileName);
      $('#doctype').text(doctype);
      $('#statusResult').val(result);
      $('#doctypeID').val(docID);


      $('#viewVerifyModal').modal('show');

 });

      $(document).on('click', '.verifySub', function(){
        var vercontrol = $('#control').val();
        var control = $('#allControl').text();
        var result = $('#statusResult').val();

        if (result != '') {
          swal({
            title: "Are you sure you want to submit?",
            text: "",
            icon: "info",
            buttons: true,
            dangerMode: false,
          })
          .then((willSubmit) => {
            if (willSubmit) {

                        $.ajax({
                          url: '../../registrar/verifyResults',
                          method: 'post',
                          data: {
                            control: control,
                            vercontrol: vercontrol,
                            result: result
                            },
                          success: function(data){

                            if (data = 1) {
                              swal({
                                title: "Result Updated!",
                                text: "",
                                icon: "success",
                                button: true,
                                dangerMode: false,
                              })
                              .then((willDelete) => {
                                if (willDelete) {
                                  window.location.reload();
                                    $('#viewVerifyModal').modal('hide');
                                }
                              });
                            }else if (data = 2) {
                              swal({
                                title: "Status Updated!",
                                text: "",
                                icon: "success",
                                button: true,
                                dangerMode: false,
                              })
                              .then((willDelete) => {
                                if (willDelete) {
                                  window.location.reload();
                                    $('#viewVerifyModal').modal('hide');
                                }
                              });

                            }else if (data = 0) {
                              swal("Failed to Update result", {
                                icon: "error",
                              });
                            }

                          }
                        });

            } else {
              //
            }
          });

        }else {
          swal("Error", "Result field is required", "error");

        }
       });



});
