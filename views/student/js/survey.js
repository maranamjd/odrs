$(document).ready(() => {


  function getAnswers(){
    let answers = [];
    $('.choices').each(function(index){
      if ($(this).val() == 'other') {
        answers.push({
          questionID: $(this).attr('rel'),
          choiceID: null,
          other: $('#other_'+$(this).attr('rel')).val()
        });
      }else {
        answers.push({
          questionID: $(this).attr('rel'),
          choiceID: $(this).val(),
          other: null
        });
      }
    });
    return answers;
  }
  $(document).on('submit', '#survey_form', (e) => {
    e.preventDefault();
    swal({
      title: 'Continue?',
      text: 'you are about to submit your answers',
      icon: "warning",
      buttons: true,
      dangerMode: false,
    })
    .then((willSubmit) => {
      if (willSubmit) {
        $.ajax({
          url: 'submitSurvey',
          method: 'post',
          data: {answers: getAnswers()},
          dataType: 'json',
          success: (data) => {
            if (data['res'] == 1) {
              swal({
                title: data['message'],
                text: 'thank you for participating in our survey',
                icon: "success",
                button: true,
                dangerMode: false,
              })
              .then((willDelete) => {
                if (willDelete) {
                  window.location.replace('select/'+data['studentNum']);
                }
              });
            }else if (data['res'] == 0) {
              swal({
                  title: "Could not save your answers!",
                  text: data['message'],
                  icon: "error",
                  button: true,
                  dangerMode: true,
                });
            }
          }
        });
      }
    });
  });

  $(document).on('change', '.choices', function(){
    if ($(this).val() == 'other') {
      $(this).parent().children().last().attr('style', 'display:');
      $(this).parent().children().last().find('input').prop('disabled', false);
    }else {
      $(this).parent().children().last().attr('style', 'display: none');
      $(this).parent().children().last().find('input').prop('disabled', true).val('');
    }
  });

});
