$(document).ready(function(){
  // window.onbeforeunload = function(){
  //   return "Transaction not complete. Your data will not be saved. Continue?";
  // }
  // $("#gds-cr-one").on('change',function() {
  //     $("#display").html("You have selected " + $("#countrySelection").children("option").filter(":selected").text() + " > " + $(this).children("option").filter(":selected").text());
  //     jQuery("#country_h").val($("#countrySelection").children("option").filter(":selected").text());
  //     jQuery("#region_h").val($(this).children("option").filter(":selected").text());
  //     console.log($('#address_country').val());
  // });

  $(document).on('blur', '#representative_email', function(e){
    let dom = $(this);
    if (dom.val() != '') {
      $.ajax({
        url: '../checkEmail',
        method: 'post',
        dataType: 'json',
        data: {email: dom.val()},
        success: function(data){
          if (data['res'] == 1) {
            if (data['match'] > 0) {
              let option = `<a href="#" class="btn btn-sm btn-secondary col-md-1 offset-md-11 btn_no">Close</a>`;
              if (data['account'] == 0) {
                option = `<p>It appears that you already had a transaction with us. Would you like to have an account?</p>
                          <div class="col-md-3 offset-md-9">
                            <a href="#" class="btn btn-danger btn-sm btn_yes" rel="${data['rep']}">Yes</a>
                            <a href="#" class="btn btn-sm btn-secondary btn_no">No</a>
                          </div>`;
              }
              dom.parent().append(
                `<div class="col-md-12 alert alert-warning row" id="alert_email">
                  <h6>The Email Address you provided already exists in our System.</h6>
                  ${option}
                </div>`
              );
              dom.prop('disabled', true);
              $('#representative_submit_btn').prop('disabled', true);
            }
          }
        }
      });
    }
  });

  $(document).on('click', '.btn_no', function(){
    $('#representative_email').val('');
    $('#representative_email').prop('disabled', false);
    $('#representative_email').focus();
    $('#representative_submit_btn').prop('disabled', false);
    $('#alert_email').remove();
  });

  $(document).on('click', '.btn_yes', function(){
    swal({
      title: "Continue?",
      text: "Your account info will be sent to your Email Address",
      icon: "info",
      buttons: ['no', 'yes'],
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        var repID = $(this).attr('rel');
        $.ajax({
          url: '../createAccount',
          method: 'post',
          dataType: 'json',
          data: {repID: repID},
          beforeSend: function(){
            $('#verifyVerificationModal').modal('hide');
            $('#loadModal').modal({
              backdrop: 'static',
              keyboard: false
            });
          },
          success: function(data){
            if (data['res'] == 1) {
              swal({
                title: data['message'],
                text: 'Thank you for using Online Verification Request!',
                icon: "success",
                button: true,
                dangerMode: false,
              })
              .then((willDelete) => {
                if (willDelete) {
                  window.location.reload();
                }
              });
            }else if (data['res'] == 0 || data['res'] == 2) {
              swal({
                title: "There was an error sending the email!",
                text: data['message'],
                icon: "error",
                button: true,
                dangerMode: false,
              })
              .then((willDelete) => {
                if (willDelete) {
                  $('#loadModal').modal('hide');
                }
              });
            }
          }
        });
      }else {
        window.location.replace('../../verification');
      }
    });
  });

  $(document).on('change', '#gds-cr-one', function(){
    let city = '<option value="">Please select a city</option>';
    if ($(this).val() == '') {
      city = '';
    }else {
      if (cities[$(this).val()] == undefined) {
        city = '';
      }else {
        for (var x in cities[$(this).val()]) {
          city += `<option value="${cities[$(this).val()][x]}">${cities[$(this).val()][x]}</option>`;
        }
      }
    }
    if (city == '') {
      $('#address_city').prop('required', '');
    }else {
      $('#address_city').prop('required', 'true');
    }
    $('#address_city').html(city);
    $('.selectpicker').selectpicker('refresh');
  });


  $(document).on('change', '#address_country', function(){
    $('#address_city').html('');
    $('.selectpicker').selectpicker('refresh');
  });

  // $('#address_country option[value='+$('#select_country').val()+']').attr('selected', 'selected');
  // $('select[id=gds-cr-one]').val($('#select_region').val());
  // $('.selectpicker').selectpicker('refresh');


  let applicantCount = 1;
  let activeStep = 1;
  let step = "step" + activeStep;
  $(document).on('submit', '.request_form', (e) => {
    e.preventDefault();
    var proceed = true;
    if (activeStep < 6) {
        hideStep(step);
        $('#'+step).attr('class', 'done');
        step = "step" + ++activeStep;
        // console.log(step);
        nextStep(step);
        $('#'+step).attr('class', 'active');

      if (activeStep == 4) {
        getRequestSummary();
      }
    }
  });

  $(document).on('click', '.back_btn', function(){
      hideStep(step);
      $('#'+step).attr('class', '');
      step = "step" + --activeStep;
      // console.log(step);
      nextStep(step);
      $('#'+step).attr('class', 'active');
  });

  $(document).on('submit', '#terms_form', function(e){
    e.preventDefault();
    $('#terms').modal('hide');
      swal({
        title: "Are you sure?",
        text: "Submit Verification Request",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willSubmit) => {
        if (willSubmit) {
          if (submitRequest()) {
            hideStep(step);
            $('#'+step).attr('class', 'done');
            step = "step" + ++activeStep;
            // console.log(step);
            nextStep(step);
            $('#'+step).attr('class', 'active');
          }
        }
      });
  });

  $(document).on('click', '#finish_btn', () => {
    hideStep(step);
    $('#'+step).attr('class', 'done');
    step = "step" + ++activeStep;
    // console.log(step);
    nextStep(step);
    $('#'+step).attr('class', 'active');
    $('.progressbar').attr('style', 'display: none');
  });

  function nextStep(step){
    $('.'+step).fadeIn();
  }
  function hideStep(step){
    $('.'+step).fadeOut();
  }


  let applicantField = $('#applicant_field').html();
  $(document).on('click', '#addApplicant', function(){
    $('#applicant_field').append(applicantField);
  });

  $(document).on('change', '.file', function(){
    if ($(this)[0].files[0].type != 'application/pdf') {
      swal({
        title: "file must be in PDF format!",
        text: "",
        icon: "error",
        button: true,
        dangerMode: false,
      });
      $(this).val('');
    }
  });

  $(document).on('click', '#removeApplicant', function(){
    $(this).parent().parent().parent().remove();
  });


  function getRequestSummary(){
    let summary = "";
    let file = "";
    let reqCount = 0;
    $('.file').each(function(index){
      file += '<li>'+$(this)[0].files[0].name+'</li>';
      reqCount++;
    });
    summary += '<p>Number of Verification request: <span class="font-weight-bold">'+reqCount+'</span></p>';
    summary += '<p>Files Updloaded:</p>';
    summary += '<ul>';
    summary += file;
    summary += '</ul>';
    $("#request_summary").html(summary);
  }

  function submitRequest(){
    let status = true;
    var formData = new FormData();
    var applicantNo = -1;
    $('.doctype').each(function(index){
      formData.append('doctype'+index, $(this).val());
      applicantNo++;
    });
    $('.file').each(function(index){
      formData.append('file'+index, $(this)[0].files[0]);
    });
    formData.append('applicantNo', applicantNo);
    formData.append('company_name', $('#company_name').val().trim());
    formData.append('company_nature', $('#company_nature').val().trim());
    formData.append('company_addressNumber', $('#company_addressNumber').val().toLowerCase().trim());
    formData.append('company_addressSt', $('#company_addressSt').val().toLowerCase().trim());
    formData.append('company_addressBrgy', $('#company_addressBrgy').val().toLowerCase().trim());
    formData.append('address_city', $('#address_city').val());
    formData.append('address_country', $('#address_country').val());
    formData.append('address_region', $('#gds-cr-one').val());
    formData.append('address_postalOrZipCode', $('#address_postalOrZipCode').val().toLowerCase().trim());
    formData.append('representative_lastName', $('#representative_lastName').val().toLowerCase().trim());
    formData.append('representative_firstName', $('#representative_firstName').val().toLowerCase().trim());
    formData.append('representative_middleName', $('#representative_middleName').val().toLowerCase().trim());
    formData.append('representative_suffix', $('#representative_suffix').val());
    formData.append('representative_email', $('#representative_email').val().trim());
    // for (var pair of formData.entries()) {
    //   console.log(pair[0]+', '+pair[1]);
    // }
    $.ajax({
      url: '../submitVerification',
      method: 'post',
      data: formData,
      dataType: 'json',
      processData: false,
      contentType: false,
      success: function(data){
        // console.log(data);
        if (data['res']) {
          $('#verID').text(data['verID']);
          $('#voucher').attr('href', '../../verification/voucher/'+data['verID']);
          $('#repID').val(data['repID']);
        }else {
          swal({
            title: "There was an error submitting your request!",
            text: data['message'],
            icon: "error",
            button: true,
            dangerMode: false,
          });
          status = false;
        }
      }
    });
    return status;
  }

  $(document).on('click', '#askAccount', function(){
    swal({
      title: "Do you want to have an account?",
      text: "an email will be sent at the email you provided containing the account info.",
      icon: "warning",
      buttons: ['no', 'yes'],
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        var repID = $('#repID').val();
        $.ajax({
          url: '../createAccount',
          method: 'post',
          dataType: 'json',
          data: {repID: repID},
          beforeSend: function(){
            $('#verifyVerificationModal').modal('hide');
            $('#loadModal').modal({
              backdrop: 'static',
              keyboard: false
            });
          },
          success: function(data){
            if (data['res'] == 1) {
              swal({
                title: data['message'],
                text: 'Thank you for using Online Verification Request!',
                icon: "success",
                button: true,
                dangerMode: false,
              })
              .then((willDelete) => {
                if (willDelete) {
                  window.location.reload();
                }
              });
            }else if (data['res'] == 0 || data['res'] == 2) {
              swal({
                title: "There was an error sending the email!",
                text: data['message'],
                icon: "error",
                button: true,
                dangerMode: false,
              })
              .then((willDelete) => {
                if (willDelete) {
                  $('#loadModal').modal('hide');
                }
              });
            }
          }
        });
      }else {
        window.location.replace('../../verification');
      }
    });
  });


});
