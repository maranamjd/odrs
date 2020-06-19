$(document).ready(() =>{

  let activeStep = 1;
  let step = "step" + activeStep;
  let birth_day = '', birth_month = '', birth_year = '', student_number = '';
  $(document).on('submit', '.request_form', (e) => {
    e.preventDefault();
    if (activeStep == 2) {
      swal({
        title: "Continue?",
        text: "Submit Information",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willSubmit) => {
        if (willSubmit) {
          hideStep(step);
          step = "step" + ++activeStep;
          nextStep(step);
          submitInfo();
        }
      });
    }
    if (activeStep == 1) {
      hideStep(step);
      step = "step" + ++activeStep;
      nextStep(step);
    }
  });

  $(document).on('click', '.back_btn', () => {
      hideStep(step);
      step = "step" + --activeStep;
      nextStep(step);
  });


  function nextStep(step){
    $('.'+step).fadeIn();
  }
  function hideStep(step){
    $('.'+step).fadeOut();
  }

  function submitInfo(){
    let formData = new FormData();
    formData.append('first_name', $('#first_name').val());
    formData.append('last_name', $('#last_name').val());
    formData.append('birth_day', $('#birth_day').val());
    formData.append('birth_month', $('#birth_month').val());
    formData.append('birth_year', $('#birth_year').val());
    formData.append('course', $('#course').val());
    formData.append('branch', $('#branch').val());

    $.ajax({
      url: '../student/getStudentNum',
      method: 'post',
      data: formData,
      dataType: 'json',
      processData: false,
      contentType: false,
      success: (data) => {
        let result = '';
        if (data['res'] == 1) {
          birth_day = data['info'].birth_day;
          birth_month = data['info'].birth_month;
          birth_year = data['info'].birth_year;
          student_number = data['info'].studentNumber;
          result = `
            <div class="row">
              <div class="col">
                <div class="container px-4 py-3 px-sm-2 px-md-3 py-lg-4">
                  <h3>Hi, ${data['info'].fname}</h3>
                  <p class="font-weight-light my-2">
                    Your Student Number is <span class="font-weight-bold">${data['info'].studentNumber}</span>.
                  </p>
                  <a href="#" id="sign_in">Click here</a> to Sign in.
                </div>
              </div>
              <div class="col-md-2 offset-md-10">
                <a href="../student" class="btn btn-danger w-100">Return Home</a>
              </div>
            </div>
          `;
        }else if (data['res'] == 0) {
          result = `
            <div class="row">
              <div class="col">
                <div class="container px-4 py-3 px-sm-2 px-md-3 py-lg-4">
                  <h3>No Data Found.</h3>
                  <p class="font-weight-light my-2">
                    The information you provided does not have a match in the system.
                  </p>
                </div>
              </div>
              <div class="col-md-2 offset-md-10">
                <a href="../student" class="btn btn-danger w-100">Return Home</a>
              </div>
            </div>
          `;
        }
        $('#result').html(result);
      }
    });
  }

  $(document).on('click', '#sign_in', () => {
    $.ajax({
      url: 'login',
      method: 'post',
      dataType: 'json',
      data: {student_number: student_number, student_bmonth: birth_month, student_bday: birth_day, student_byear: birth_year},
      success: function(data){
        if (data['res'] == 1) {
          window.location.replace('select/'+data['studentNum']);
        }else {
          swal({
            title: "No data found!",
            text: '',
            icon: "error",
            button: true,
            dangerMode: false,
          });
        }
      }
    });
  });

});
