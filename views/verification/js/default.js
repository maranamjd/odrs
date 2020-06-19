$(document).ready(function(){

  $(document).on('submit', '#login', function(e){
    e.preventDefault();
    var email = $("#representative_email").val();
    var password = $("#representative_password").val();
    $.ajax({
      url: 'verification/login',
      method: 'post',
      data: {email: email, password: password},
      success: function(data){
        if (data == false) {
          swal({
            title: "Email or Password do not match!",
            text: "",
            icon: "error",
            button: true,
            dangerMode: false,
          });
        }else {
          window.location.replace('verification/request/'+data);
        }
      }
    });
  });

  $(document).on('submit', '#proceed', function(e){
    e.preventDefault();
    var proceed_code = $('#proceed_code').val();
    $.ajax({
      url: 'verification/submitProceed',
      method: 'post',
      data: {proceed_code: proceed_code},
      success: function(data){
        if (data == false) {
          swal({
            title: "Proceed code do not match!",
            text: "",
            icon: "error",
            button: true,
            dangerMode: false,
          });
        }else {
          window.location.replace('verification/transaction/'+data);
        }
      }
    });
  });

});
