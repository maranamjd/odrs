$(document).ready(function() {
  $('#dateGrads').hide();
  $('#form-data').validate({
    debug: true,
    success: "valid",
   ignore: ":hidden"
});

    $('#next-1').click(function(e) {

      e.preventDefault();
      if($('#form-data').valid()){
      $('#bar1, #icon2').removeClass('bg-secondary');
      $('#bar1, #icon2').addClass('bg-danger');
      $('#second').show();
      $('#first').hide();
      }

    });
    $('#next-2').click(function(e) {

            e.preventDefault();
            if($('#form-data').valid()){
            $('#bar2, #icon3').removeClass('bg-secondary');
            $('#bar2, #icon3').addClass('bg-danger');
            $('#third').show();
            $('#second').hide();
            }
    });
    $('#prev-2').click(function(e) {
      e.preventDefault();
      $('#bar1, #icon2').removeClass('bg-danger');
      $('#bar1, #icon2').addClass('bg-secondary');
      $('#second').hide();
      $('#first').show();
    });

    $('#prev-3').click(function(e) {
      e.preventDefault();
      $('#bar2, #icon3').removeClass('bg-danger');
      $('#bar2, #icon3').addClass('bg-secondary');
      $('#third').hide();
      $('#second').show();
    });

$(document).on('change', '#HSGrad', function(){
  var limit = $(this).val();
  $('#elemGrad').empty();
  $('#elemGrad').append('<option value="" selected disabled>Select Year</option>');
  $('#elemGrad').removeAttr('readOnly');
  for (var i = limit-1; i >= 1950; i--) {
    $('#elemGrad').append('<option>'+i+'</option>');
  }
});

$('#isGrad').change(function(event) {
if ($(this).prop('checked')) {
  $('#dateGrads').show();
  $('#dateGrad').attr('required', true);
}else {
  $('#dateGrads').hide();
  $('#dateGrad').removeAttr('required');
}
});
  $(document).on('submit', '#form-data', function(e){
    e.preventDefault();
    swal({
    title: "Are you sure?",
    text: "This student record will be stored.",
    icon: "warning",
    buttons: true,
    dangerMode: false,
  }).then((willDelete) => {
    if (willDelete) {

    $.ajax({
      url: '../registrar/addStudent',
      method: 'post',
      dataType: 'json',
      data: $( this ).serializeArray(),
      success: function(data){
        if (data == true) {
          swal({
              title: 'Student Record Added!',
              text: "",
              icon: "success",
              button: true,
              dangerMode: false,
            })
            location.reload();
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
window.onload = function() {
	var $ = new City();
	$.showProvinces("#province");
	$.showCities("#city");

}
