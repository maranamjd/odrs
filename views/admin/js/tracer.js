$(document).ready(function(){
  $(document).on('click', '#generate', function(){
    swal({
      title: "Continue?",
      text: "You are about to generate a tracer study report",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        window.open('tracer_export');
      }
    });
  });
});
