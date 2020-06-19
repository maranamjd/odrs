$(document).ready(function(){
  $('#msgModal').modal({
    onCloseEnd:function(){
      $('#read').prop('checked', false);
    }
  });
  $('#alrtModal').modal();

  function confirmModal(title, msg, yescb){
    $('#msgTitle').text(title);
    $('#msgBody').text(msg);
    $('#msgModal').modal('open');
    $('#msgModalCancel').click(function(){
      $('#modalConfirm').modal('close');
    });
    $('#msgModalOk').click(function(){
      yescb();
      $('#msgModal').modal('close');
    });
  }
  function alertModal(title, msg, duration = 1500, cb){
    $('#alrtTitle').text(title);
    $('#alrtBody').text(msg);
    $('#alrtModal').modal('open');
    $('#alrtModalOk').click(function(){
      $('#alrtModal').modal('close');
      cb();
    });
    setTimeout(function () {
      $('#alrtModal').modal('close');
      cb();
    }, duration);
  }

  $.ajax({
    url: 'dashboard/getData',
    method: 'post',
    dataType: 'json',
    success: function(data){
      $('#users').html(data['users']);
      $('#encoders').html(data['encoders']);
      $('#visitors').html(data['visitors']);
      $('#inactives').html(data['inactives']);
    }
  });

});
