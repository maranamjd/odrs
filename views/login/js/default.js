$(document).ready(function(){

  $(document).on('submit', "#login", function(e){
    e.preventDefault();
    var username = $("#username").val();
    var password = $("#password").val();
    $.ajax({
      url: 'login/login',
      method: 'post',
      data: {username: username, password: password},
      success: function(data){
        if (data < 1) {
          swal({
              title: "Username or Password do not match!",
              text: "",
              icon: "error",
              button: true,
              dangerMode: false,
            });
        }else {
          if (data == 1) {
            window.location.replace('admin/dashboard');
          }else if (data == 2) {
            window.location.replace('registrar/dashboard');
          }else if (data == 3) {
            window.location.replace('registrar/dashboard');
          }else if (data == 4) {
            window.location.replace('office/');
          }
        }
      }
    });
  });

});
