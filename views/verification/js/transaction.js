$(document).ready(function(){

  $(document).on('change', '#receipt_file', function(){
    if ($(this)[0].files[0].type != 'application/pdf') {
      swal({
        title: "File must be a PDF!",
        text: "",
        icon: "error",
        button: true,
        dangerMode: false,
      });
      $(this).val('');
    }
  });

  $('#submit').click(function(){
    if ($('#receipt_file').val() == '') {
      swal({
        title: "Please select a file!",
        text: "",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
    }else {
      var formData = new FormData();
      formData.append('file', $('#receipt_file')[0].files[0]);
      swal({
        title: "Are you sure?",
        text: "Submit receipt",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          $.ajax({
            url: '../submitReceipt',
            method: 'post',
            data: formData,
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function(data){
              if (!data) {
                  swal({
                      title: "There was an error submitting your receipt!",
                      text: "",
                      icon: "error",
                      button: true,
                      dangerMode: false,
                    });
                  }else {
                    swal({
                        title: "Receipt successfuly sent! ",
                        text: "",
                        icon: "success",
                        button: true,
                        dangerMode: false,
                      }).then((willDelete) => {
                        if (willDelete) {
                          window.location.replace('http://pup.odrs/verification');
                        }
                      });
                    }
                  }
                });
              }
            });
    }
  });

  $('#cancel').click(function(){
    swal({
      title: "Are you sure?",
      text: "Cancel receipt submission",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        $.ajax({
          url: '../cancelProceed',
          method: 'post',
          success: function(data){
            if (data) {
              window.location.reload();
            }
          }
        });
      }
    });
  });

});
