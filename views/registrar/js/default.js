$(document).ready(function(){

  $("#login").click(function(){
    var username = $("#username").val();
    var password = $("#password").val();
    if (username != '' && password != '') {
      $.ajax({
        url: 'registrar/login',
        method: 'post',
        data: {username: username, password: password},
        success: function(data){
          if (data) {
            window.location.replace('registrar/home');
          }else {
            alert("Username or Password do not match!");
          }
        }
      });
    }else {
      alert('Please fill up the form!');
    }
  });


});
