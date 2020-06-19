$(document).ready(function(){
  $.ajax({
    url: 'getConfig',
    method: 'post',
    dataType: 'json',
    data: {fetch: true},
    success: function(data){
      $('#block_time option[value="'+data['RESET_INTERVAL_TYPE']+'"]').attr('selected', 'selected');
      $('#block_value option[value="'+data['RESET_INTERVAL_NUM']+'"]').attr('selected', 'selected');
      $('#attempt option[value="'+data['MAX_ATTEMPT']+'"]').attr('selected', 'selected');
      $('#claim_days option[value="'+data['FORFEITION_NUM']+'"]').attr('selected', 'selected');
      $('.selectpicker').selectpicker('refresh');
    }
  });

  $(document).on('change', '.configUpdate', function(){
    $.ajax({
      url: 'updateConfig',
      method: 'post',
      dataType: 'json',
      data: {key: $(this).attr('rel'), val: $(this).val()},
      success: function(data){
        if (data['res'] == 1) {
          swal({
            title: data['message'],
            text: "",
            icon: "success",
            button: true,
            dangerMode: false,
          })
        }else {
          swal({
            title: "Failed to Update!",
            text: data['message'],
            icon: "error",
            button: true,
            dangerMode: false,
          })
        }
      }
    });
  });

  $(document).on('click', '.savePres', function(){
    var id = $(this).attr('rel');
    var value = $('#presName').val();
    swal({
      title: "Are you sure?",
      text: "You are about to change University President's name",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        $.ajax({
          url: 'updatePresident',
          method: 'post',
          dataType: 'json',
          data: {
            id: id,
            value: value
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
            }else {
              swal({
                title: "Failed to Update!",
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

  });

  $(document).on('click', '.saveRegi', function(){
    var id = $(this).attr('rel');
    var value = $('#regiName').val();
    swal({
      title: "Are you sure?",
      text: "You are about to change University Registrar's name",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        $.ajax({
          url: 'updateRegistrar',
          method: 'post',
          dataType: 'json',
          data: {
            id: id,
            value: value
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
            }else {
              swal({
                title: "Failed to Update!",
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
  });

  $(document).on('click', '.saveCopy', function(){
    var id = $(this).attr('rel');
    var value = $('#copies').val();
    swal({
      title: "Are you sure?",
      text: "You are about to change University Registrar's name",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        $.ajax({
          url: 'updateCopies',
          method: 'post',
          dataType: 'json',
          data: {
            id: id,
            value: value
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
            }else {
              swal({
                title: "Failed to Update!",
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
  });
});
