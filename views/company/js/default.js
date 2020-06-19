$(document).ready(function(){
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



  $('#suffix').val() !== '' ? $('#representative_suffix option[value='+$('#suffix').val()+']').attr('selected', 'selected') : '';
  $('#representative_suffix').selectpicker('refresh');


  $('#info_tab a').on('click', function (e) {
    e.preventDefault();
    $(this).tab('show');
  });

$(document).on('submit', '#company_form', function(e){
  e.preventDefault();
  console.log($('#address_city').val());
  swal({
    title: "Update Information?",
    text: "changes will be saved.",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  })
  .then((willUpdate) => {
    if (willUpdate) {
      var formData = new FormData();
      formData.append('company_id', $('#company_id').val());
      formData.append('company_name', $('#company_name').val().trim());
      formData.append('company_nature', $('#company_nature').val().trim());
      formData.append('company_addressNumber', $('#company_addressNumber').val().trim());
      formData.append('company_addressSt', $('#company_addressSt').val().trim());
      formData.append('company_addressBrgy', $('#company_addressBrgy').val().trim());
      formData.append('address_postalOrZipCode', $('#address_postalOrZipCode').val().trim());
      formData.append('address_city', $('#address_city').val());
      if ($('#address_city').val() == null) {
        formData.append('address_city', $('#select_city').val());
      }
      formData.append('address_country', $('#address_country').val());
      if ($('#address_country').val() == '') {
        formData.append('address_country', $('#select_country').val());
      }
      formData.append('address_region', $('#gds-cr-one').val());
      if ($('#gds-cr-one').val() == '') {
        formData.append('address_region', $('#select_region').val());
      }
      $.ajax({
        url: '../updateCompany',
        method: 'post',
        data: formData,
        dataType: 'json',
        processData: false,
        contentType: false,
        success: function(data){
          if (data['res'] == 1) {
            swal({
              title: data['message'],
              text: '',
              icon: "success",
              button: true,
              dangerMode: false,
            })
            .then((willDelete) => {
              if (willDelete) {
                window.location.reload();
              }
            });
          }else if (data['res'] == 0) {
            swal({
              title: "There was an error updating your info!",
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

$(document).on('submit', '#representative_form', function(e){
  e.preventDefault();
  swal({
    title: "Update Information?",
    text: "changes will be saved.",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  })
  .then((willUpdate) => {
    if (willUpdate) {
      var formData = new FormData();
      formData.append('representative_lastName', $('#representative_lastName').val().trim());
      formData.append('representative_firstName', $('#representative_firstName').val().trim());
      formData.append('representative_middleName', $('#representative_middleName').val().trim());
      formData.append('representative_suffix', $('#representative_suffix').val());
      formData.append('representative_email', $('#representative_email').val());
      $.ajax({
        url: '../updateRepresentative',
        method: 'post',
        data: formData,
        dataType: 'json',
        processData: false,
        contentType: false,
        success: function(data){
          if (data['res'] == 1) {
            swal({
              title: data['message'],
              text: '',
              icon: "success",
              button: true,
              dangerMode: false,
            })
            .then((willDelete) => {
              if (willDelete) {
                window.location.reload();
              }
            });
          }else if (data['res'] == 0) {
            swal({
              title: "There was an error updating your info!",
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

$(document).on('change', '#fastlane', function(){
  if ($(this).is(':checked')) {
    $('.password').attr('type', 'text');
  }else {
    $('.password').attr('type', 'password');
  }
});

$(document).on('keyup', '.password', function(){
  if ($('#account_password').val() !== $('#account_verify').val()) {
    $('#account_save').prop('disabled', 'disabled');
    $('#not_match').attr('style', 'display:');
  }else {
    $('#not_match').attr('style', 'display:none');
    $('#account_save').prop('disabled', '');
  }
});

$(document).on('submit', '#account_form', function(e){
  e.preventDefault();
  swal({
    title: "Update Password?",
    text: "changes will be saved.",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  })
  .then((willUpdate) => {
    if (willUpdate) {
      var formData = new FormData();
      formData.append('password', $('#account_password').val());
      $.ajax({
        url: '../updatePassword',
        method: 'post',
        data: formData,
        dataType: 'json',
        processData: false,
        contentType: false,
        success: function(data){
          if (data['res'] == 1) {
            swal({
              title: data['message'],
              text: '',
              icon: "success",
              button: true,
              dangerMode: false,
            })
            .then((willDelete) => {
              if (willDelete) {
                window.location.reload();
              }
            });
          }else if (data['res'] == 0) {
            swal({
              title: "There was an error updating your info!",
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
