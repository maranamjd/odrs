$(document).ready(function(){
  $(document).on('change', '#report_type', function(){
    let date = '';
    if ($(this).val() == 'daily') {
      date = `<h5 class="text-secondary">Date</h5><input type="date" id="date" class="form-control" required>`;
    }else if ($(this).val() == 'weekly') {
      date = `<h5 class="text-secondary">Week</h5><input type="week" id="date" class="form-control" required>`;
    }else {
      date = `<h5 class="text-secondary">Month</h5><input type="month" id="date" class="form-control" required>`;
    }
    $('#date_div').html(date);
  });

  $(document).on('change', '#ver_report_type', function(){
    let date = '';
    if ($(this).val() == 'daily') {
      date = `<h5 class="text-secondary">Date</h5><input type="date" id="ver_date" class="form-control" required>`;
    }else if ($(this).val() == 'weekly') {
      date = `<h5 class="text-secondary">Week</h5><input type="week" id="ver_date" class="form-control" required>`;
    }else {
      date = `<h5 class="text-secondary">Month</h5><input type="month" id="ver_date" class="form-control" required>`;
    }
    $('#ver_date_div').html(date);
  });

  $(document).on('change', '#category', function(){
    if ($(this).val() == 'All') {
      let category = `<h5 class="text-secondary">${$('#category').val()}</h5><input class='form-control' id="category_value" type='text' value="All" disabled>`;
      $('#category_div').html(category);
    }else {
      $.ajax({
        url: 'getCategory',
        method: 'post',
        dataType: 'json',
        data: {table: $(this).val()},
        success: function(data){
          let category = `
          <h5 class="text-secondary">${$('#category').val()}</h5>
          <select class="selectpicker" title="${$('#category').val()}" id="category_value" data-live-search='true' data-style='btn' required>
          `;
          for (var x in data) {
            category += `<option value="${data[x].id}">${data[x].name}</option>`;
          }
          category += '</select>';
          $('#category_div').html(category);
          $('.selectpicker').selectpicker('refresh');
        }
      });
    }
  });


  $(document).on('submit', '.report_form', function(e){
    e.preventDefault();
    swal({
      title: "Continue?",
      text: "You are about to generate a report",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        window.open('report/Document-Request_'+$('#report_type').val()+'_'+$('#date').val()+'_'+$('#category').val()+'_'+$('#category_value').val()+'_'+$('#request_type').val());
      }
    });
  });

  $(document).on('submit', '.ver_report_form', function(e){
    e.preventDefault();
    swal({
      title: "Continue?",
      text: "You are about to generate a report",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        window.open('report/Graduate-Verification_'+$('#ver_report_type').val()+'_'+$('#ver_date').val());
      }
    });
  });
});
