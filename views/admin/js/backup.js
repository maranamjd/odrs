$(document).ready(function(){
  $('#backup_tab a').on('click', function (e) {
    e.preventDefault();
    $(this).tab('show');
  });

  setInterval(function(){
    if ($('#restore_point').val() == '') {
      $.ajax({
        url: 'getRestores',
        method: 'post',
        dataType: 'json',
        data: {target: true},
        success: function(data){
          if (data['res'] == 1) {
            let restorePoint = '';
            for (var x in data['restore']) {
              restorePoint += `<option value="${data['restore'][x].name}">${data['restore'][x].date}</option>`;
            }
            $('#restore_point').html(restorePoint);
            $('.selectpicker').selectpicker('refresh');
          }
        }
      });
    }
  },1500);

  $(document).on('change', '#restore_point', function(){
    $('#restore_file').prop('disabled', true);
  });

  $(document).on('change', '#restore_file', function(){
    if ($(this).val() != '') {
      let formData = new FormData();
      formData.append('file', $(this)[0].files[0]);
      $.ajax({
        url: 'checkRestoreFile',
        method: 'post',
        dataType: 'json',
        data: formData,
        processData: false,
        contentType: false,
        success: function(data){
          if (data['res'] != 1) {
            swal({
              title: "Invalid File",
              text: data['message'],
              icon: "warning",
              button: true,
              dangerMode: true,
            })
            $('#restore_file').val('');
          }else {
            $('#restore_point').prop('disabled', true);
          }
        }
      });
    }else {
      $('#restore_point').prop('disabled', false);
    }
  });

  $(document).on('click', '#backup_data', function(){
    swal({
      title: "Are you sure?",
      text: `You are about to backup System Data`,
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        window.location.href = 'dataBackup';
      }
    });
  });

  $(document).on('submit', '#restore_form', function(e){
    e.preventDefault();
    let formData = new FormData();
    if ($('#restore_point').val() == '') {
      formData.append('file', $('#restore_file')[0].files[0])
      formData.append('type', 2);
    }else {
      formData.append('file', $('#restore_point').val());
      formData.append('type', 1);
    }
    swal({
      title: "Are you sure?",
      text: `Restore System Data from ${$('#restore_point').children('option').filter(':selected').text()}`,
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        $.ajax({
          url: 'dataRestore',
          method: 'post',
          dataType: 'json',
          data: formData,
          processData: false,
          contentType: false,
          beforeSend: function(){
            $('#loadModal').modal({
              backdrop: 'static',
              keyboard: false
            });
          },
          success: function(data){
            if (data['res'] == 1) {
              swal({
                title: data['message'],
                text: "",
                icon: "success",
                button: true,
                dangerMode: false,
              })
              .then((willDelete) => {
                if (willDelete) {
                  window.location.reload();
                }
              });
            }else {
              swal({
                title: "Failed to Restore Data!",
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
      }
    });
  });
});
