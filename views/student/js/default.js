$(document).ready(function(){

  $(document).on('hidden.bs.modal', '#statusModal', function(e){
    $('#status').html('');
    $(this).find('input').val('');
  });

  $(document).on('submit', "#login", function(e){
    e.preventDefault();
    var student_number = $("#student_number").val();
    var student_bmonth = $("#student_bmonth").val();
    var student_bday   = $("#student_bday").val();
    var student_byear  = $("#student_byear").val();
    $.ajax({
      url: 'student/login',
      method: 'post',
      dataType: 'json',
      data: {student_number: student_number, student_bmonth: student_bmonth, student_bday: student_bday, student_byear: student_byear},
      success: function(data){
        if (data['res'] == 1) {
          window.location.replace('student/select/'+data['studentNum']);
        }else {
          swal({
            title: "Login error",
            text: data['message'],
            icon: "error",
            button: true,
            dangerMode: false,
          });
        }
      }
    });
  });

  setInterval(function(){
    if ($('#control_number').val() !== '') {
      $.ajax({
        url: 'student/checkStatus',
        method: 'post',
        dataType: 'json',
        data: {control_number: $('#control_number').val()},
        success: function(data){
          let status = '';
          let documents = '';
          if (data['res'] == 1) {
            for (var x in data['status']['documents']) {
              documents += `<li class="list-group-item" title="${data['status']['documents'][x].description}"><span class="d-inline-block text-truncate" style="max-width: 250px;">${data['status']['documents'][x].description}</span><span class="pull-right col-md-4">${data['status']['documents'][x].status}</span></li>`;
            }
            status = `
            <div class="found">
              <p>Request Status: ${data['status']['request']}</p>
              <p>Request Details: </p>
              <ul class="list-group">
                ${documents}
              </ul>
            </div>
            `;
          }else {
            status = `
            <div class="not_found">
              <div class="col mb-4 alert alert-info">
                <h6>Request Not Found!</h6>
                <p class="text-muted">Make sure your <strong>Control Number</strong> is correct.</p>
              </div>
            </div>
            `;
          }
          $('#status').html(status);
        }
      });
    }
  },1000);

});
