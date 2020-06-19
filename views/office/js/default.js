$(document).ready(function() {
  // $('#clearanceTbl').DataTable();
  var oTable;
  oTable = $('#clearanceTbl').dataTable();

  $('#sortOffices').change( function() {
      var selectedValue = $(this).val();
      oTable.fnFilter("^"+selectedValue+"$", 3, true);
   });

  $('#studno').keyup(function() {
    $('#studentList').html('');
    var query = $(this).val();
    if (query != '') {
      $.ajax({
        url: "getStudentList",
        method: 'POST',
        data: {
          tgr : true,
          query: query
        },
        success:function(data){
          $('#studentList').fadeIn();
          $('#studentList').html(data);
        }
      });
    }else{
      $('#hiddenID').val(null);
      $('#stdName').val(null);
      $('#stdCourse').val(null);
    }
  });

$(document).on('click', 'li', function(){
  var id = $(this).text();
  $('#studno').val(id);
  $('#studentList').fadeOut();

  $.ajax({
    url: "getSelectedStudent",
    method: 'POST',
    data: {
      tgr : true,
      id: id
    },
    success:function(data){
    var display = jQuery.parseJSON(data);
      $('#hiddenID').val(display.studentID);
      $('#stdName').val(display.name);
      $('#stdCourse').val(display.course);
    }
  });

});

$('.readonly').on('keydown paste', function(e){
  e.preventDefault();
});

$('#addCLR').on('submit', function(e) {
  e.preventDefault();
  var id = $('#hiddenID').val();
  var offID = $('#sortOffices').val();
  var desc = $('#desc').val();

  swal({
  title: "Are you sure?",
  text: "",
  icon: "warning",
  buttons: true,
  dangerMode: true,
}).then((willDelete) => {
  if (willDelete) {
    $.ajax({
      url: "addClearanceRecord",
      method: 'POST',
      data: {
        id: id,
        offID: offID,
        desc: desc
      },
      success: function(data){
        if (data == true) {
          swal({
              title: 'Record Added',
              text: "",
              icon: "success",
              button: true,
              dangerMode: false,
            })
            $('#addCLR')[0].reset();
        }else {
          swal({
              title: "An error occured!",
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

$(document).on('click', '.showBtn', function(){
  var id = $(this).attr('id');
  $('.subBtn').attr('id', id);
  $.ajax({
    url: 'showClrRecord',
    type: 'POST',
    data: {
      id: id,
    },
    success:function(data){
      var conv = jQuery.parseJSON(data);

      $('#name').text(conv.name);
      $('#dateAdded').text(conv.dateAdded);
      $('#officeName').text(conv.officeName);
      $('#showTitle').text(conv.studID);
      $('#desc').text(conv.desc);
      if (conv.clr != 1) {
        $('.subBtn').attr('style', 'display:block;');
      }
      $('#showModal').modal('show');
    }
  });
});

$(document).on('click', '.modifyBtn', function(){
  var id = $(this).attr('id');
  $('.uptBtn').attr('id', id);
  $.ajax({
    url: 'showClrRecord',
    type: 'POST',
    data: {
      id: id,
    },
    success:function(data){
      var conv = jQuery.parseJSON(data);
      console.log(conv.rawID);
      $('#edtname').text(conv.name);
      $('#edtDateAdded').text(conv.dateAdded);
      $('#edtOffice').val(conv.rawID);
      $('#edtTitle').text(conv.studID);
      $('#edtDesc').text(conv.desc);
      $('#editsModal').modal('show');

    }
  });
});

$(document).on('click', '.subBtn', function(){
  var id = $(this).attr('id');

  swal({
  title: "Are you sure?",
  text: "",
  icon: "warning",
  buttons: true,
  dangerMode: true,
}).then((willDelete) => {
  if (willDelete) {
    $.ajax({
      url: "clearRecord",
      method: 'POST',
      data: {
        id: id
      },
      success: function(data){
        if (data == true) {
          swal({
            title: "Record Cleared!",
            text: "",
            icon: "success",
            button: true,
            dangerMode: false,
          })
          .then((willDelete) => {
            if (willDelete) {
              location.reload();
            }
          });
        }else {
          swal({
              title: "An error occured!",
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

$(document).on('click', '.uptBtn', function(){
  var id = $(this).attr('id');
  var desc = $('#edtDesc').val();
  var offc = $('#edtOffice').val();
if (desc != '') {
    swal({
    title: "Are you sure?",
    text: "This record will be updated",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  }).then((willDelete) => {
    if (willDelete) {
      $.ajax({
        url: "uptRecord",
        method: 'POST',
        data: {
          id: id,
          desc: desc,
          offc: offc

        },
        success: function(data){
          if (data == true) {
            swal({
              title: "Record Updated!",
              text: "",
              icon: "success",
              button: true,
              dangerMode: false,
            })
            .then((willDelete) => {
              if (willDelete) {
                location.reload();
              }
            });
          }else {
            swal({
                title: "An error occured!",
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
}else {
  swal({
                title: "All fields are Required!",
                text: '',
                icon: "error",
                button: true,
                dangerMode: false,
              });
}
});

$(document).on('click', '.clr', function(){
  $('#addCLR')[0].reset();
});

});
