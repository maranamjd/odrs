$(document).ready(function(){

  $(document).on('hidden.bs.modal', '#verificationModal', function(e){
    $(this).find('input').val('');
    $(this).find('select').val('');
    $('.selectpicker').selectpicker('refresh');
  });

  let append = $('#docDiv').html();
  let fastlane = false;
  let verify = '';

  setInterval(function(){

    let selected = false;
    $('.document').each(function(index) {
      if ($(this).val()== null) {
        selected = true;
      }
    });
    if (selected) {
      $('#addDoc').prop('disabled', true);
    }else {
      $('#addDoc').prop('disabled', false);
    }
  },100);

  $(document).on('click', '#addDoc', function(){
    let selected = true;
    let option = $('.document').find('option');
    option.each(function(index) {
      if ($(this).attr('class') != undefined) {
        if ($(this).is(':hidden')) {
          let style = $(this).attr('style');
          // console.log(style);
          if (style == undefined || style == '') {
            selected = false;
          }
        }
      }
    });
    if (selected) {
      return false;
    }else {
      $('#docDiv').append(append);
      $('.document').each(function(index) {
        var doc = $(this).find('option:selected').attr('class');
        $('.'+doc).each(function(index) {
          $(this).attr('style', 'display:none;');
        });
      });
      $('#docDiv').children().last().find('a').attr('style', 'display:');
    }
  });


  function getPendingRequest(){
    $.ajax({
      url: '../checkStatus',
      method: 'post',
      dataType: 'json',
      data: {control_number: $('.pending').val()},
      success: function(data){
        let status = '';
        let documents = '';
        if (data['res'] == 1) {
          if (data['status']['requestnum'] > 2) {
            window.location.reload();
          }
          for (var x in data['status']['documents']) {
            documents += `<li class="list-group-item" title="${data['status']['documents'][x].description}">${data['status']['documents'][x].description}<span class="pull-right">${data['status']['documents'][x].status}</span></li>`;
          }
          status = `
          <div class="found">
            <p>Request Status: ${data['status']['request']}</p>
            <p class="mb-1"><small>Requested Documents</small></p>
            <ul class="list-group">
              ${documents}
            </ul>
          </div>
          `;
          $('#requested_docs').html(status);
        }
      }
    });
  }
  getPendingRequest();
  setInterval(function(){
    if ($('.pending').val() != 0) {
      getPendingRequest();
    }
  },10000);

  setInterval(function(){
    if (parseInt($('#total').text()) <= 0 || $('#total').text() == 'NaN') {
      $('#fastlane').prop('disabled', 'true');
      $('#proceed').prop('style', 'display: none');
    }else {
      $('#fastlane').prop('disabled', '');
      $('#proceed').prop('style', 'display:');
    }
  }, 100);

  $(document).on('click', '#cancel', function(){
    swal({
        title: "Continue?",
        text: "You are about to cancel your request",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willAccept) => {
        if (willAccept) {
          $.ajax({
            url: '../cancelRequest',
            method: 'post',
            dataType: 'json',
            data: {control_number: $('.pending').val()},
            success: function(data){
              if (data['res'] == 1) {
                swal({
                  title: data['message'],
                  text: '',
                  icon: "success",
                  button: true,
                  dangerMode: false,
                })
                .then((willAccept) => {
                  if (willAccept) {
                    window.location.reload();
                  }
                });
              }else {
                swal({
                    title: "Could not Cancel your Request!",
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

  $(document).on('click', '#fastlane', function(){
    if ($(this).is(':checked')) {
      swal({
        title: "Avail Fast Lane?",
        text: 'Your request will be prioritized and the request price will be doubled',
        icon: "info",
        buttons: true,
        dangerMode: false,
      })
      .then((willDelete) => {
        if (willDelete) {
          $('#total').text(parseInt($('#total').text()) * 2);
          fastlane = true;
        }else {
          $(this).prop('checked', false);
        }
      });
    }else {
      $('#total').text(parseInt($('#total').text()) / 2);
      fastlane = false
    }
  });

  $(document).on('change', '.document', function(){
    var doc = $(this).find('option:selected').attr('class');
    $('.'+doc).each(function(index) {
      $(this).attr('style', 'display:none;');
    });
    let totalPrice = 0;
    var price = $(this).find('option:selected').attr('rel');
    $(this).parent().last().find('span').html('&#8369; '+price);
    $(this).parent().last().find('input').val(price);
    $('.price').each(function(index){
      totalPrice += fastlane == true ? parseInt($(this).val()) * 2 : parseInt($(this).val());
    });
    $('#total').text(totalPrice);
    // console.log(totalPrice);
  });

  $(document).on('click', '.removeDoc', function(){
    let doc = $(this).parent().parent().find('.inputs');
    let select = doc.find('.document')
    let selected = select.find('option:selected').attr('class');
    $('.'+selected).each(function(index) {
      $(this).prop('style', 'display:');
    });
    let totalPrice = 0;
    $(this).parent().parent().remove();
    $('.price').each(function(index){
      totalPrice += fastlane == true ? parseInt($(this).val()) * 2 : parseInt($(this).val());
    });
    $('#total').text(totalPrice);
    // console.log(totalPrice);
  });



  $(document).on('submit', '#document_form', (e) => {
    e.preventDefault();
    verify = 'docs';
    $("#verificationModal").modal('show');
  });

  $(document).on('submit', '.contact_form', function(e){
    e.preventDefault();
    verify = 'contact';
    $("#contactModal").modal('hide');
    $("#verificationModal").modal('show');
  });


  $(document).on('submit', '.verify_form', function(e){
    e.preventDefault();
    var attempt = $('#attempt').html();
    var formData = new FormData();
    formData.append('lname', $("#lname").val().toLowerCase().trim());
    formData.append('fname', $("#fname").val().toLowerCase().trim());
    formData.append('mname', $("#mname").val() == '' ? null : $("#mname").val().toLowerCase().trim());
    formData.append('suffix', $("#suffix").val() == '' ? null : $("#suffix").val());
    formData.append('course', $("#course").val());
    formData.append('year_graduated', $("#year_graduated").val() == '' ? null : $("#year_graduated").val());

    if (verify == 'docs') {
      var request = new Object();
      var documents = new Array();
      var quantities = new Array();
      var fastlane = $("#fastlane").is(":checked") ? 1 : 0;

      $('.document').each(function(index){
        documents.push($(this).val());
      });
      $('.quantity').each(function(index){
        quantities.push($(this).val());
      });
      request.quantities = quantities;
      request.documents = documents;
      request.fastlane = fastlane;
      if ($('#ver_mobile_number').val() != undefined && $('#ver_email').val() != undefined) {
        request.mobile_number = $('#ver_mobile_number').val();
        request.email = $('#ver_email').val();
      }
      // console.log(request);
      $.ajax({
        url: '../getInfo',
        method: 'post',
        dataType: 'json',
        data: formData,
        processData: false,
        contentType: false,
        success: function(data){
          if (data['res']) {
            sendRequest(request);
          }else {
            reduceAttempt(attempt);
          }
        }
      });
    }else if (verify == 'contact') {
      $.ajax({
        url: '../getInfo',
        method: 'post',
        dataType: 'json',
        data: formData,
        processData: false,
        contentType: false,
        success: function(data){
          if (data['res']) {
            updateContact();
          }else {
            reduceAttempt(attempt);
          }
        }
      });
    }
  });

  function updateContact(){
    var formData = new FormData();
    formData.append('mobile_number', $("#mobile_number").val());
    formData.append('email', $("#email").val());
    swal({
      title: "Continue?",
      text: 'Contact Information will be updated',
      icon: "warning",
      buttons: true,
      dangerMode: false,
    })
    .then((willDelete) => {
      if (willDelete) {
        $.ajax({
          url: '../updateContact',
          method: 'post',
          dataType: 'json',
          data: formData,
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
              .then((proceed) => {
                if (proceed) {
                  window.location.reload();
                }
              });
            }else {
              swal({
                title: "Cannot update contact information",
                text: data['message'],
                icon: "error",
                button: true,
                dangerMode: false,
              })
            }
          }
        });
      }
    });
  }

  function reduceAttempt(attempt){
    attempt--;
    $.ajax({
      url: '../reduceAttempt',
      method: 'post',
      data: {attempt: attempt},
      dataType: 'json',
      success: function(data){
        console.log(data['message']);
      }
    });
    if (attempt == 0) {
      swal({
        title: "Attempt used",
        text: 'Your account will be block for 24 hours',
        icon: "warning",
        button: true,
        dangerMode: false,
      })
      .then((willDelete) => {
        if (willDelete) {
          $.ajax({
            url: '../blockAccount',
            method: 'post',
            dataType: 'json',
            data: {req: true},
            success: function(data){
              console.log(data);
              if (data['res'] == 1) {
                window.location.reload();
              }else {
                console.log(data['message']);
              }
            }
          });
        }
      });
    }else {
      swal({
        title: "Data do not match",
        text: "you have "+attempt+" remaining attempts",
        icon: "warning",
        button: true,
        dangerMode: true,
      }).then((willDelete) => {
        if (willDelete) {
          $("#attempt").html(attempt);
        }
      });
    }
  }

  function sendRequest(request){
    console.log(request);
    swal({
        title: "Send Request?",
        text: "your request will be sent to the registrar.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willAccept) => {
        if (willAccept) {
          $.ajax({
            url: '../sendRequest',
            method: 'post',
            dataType: 'json',
            data: request,
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
                    window.location.replace('../voucher');
                  }
                });
              }else {
                swal({
                    title: "Could not send your Request!",
                    text: data['message'],
                    icon: "error",
                    button: true,
                    dangerMode: true,
                  });
              }
            }
          });
        } else {
          //
        }
      });
  }

});
