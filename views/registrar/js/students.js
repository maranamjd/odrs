$(document).ready(function() {
  $('#tbl_students').dataTable();


  $('#tbl_subjects').DataTable( {
       "order": [[ 3, "asc" ]]
   } );


   if ($('#isGrad').val()==1) {
     for (i = $('#yrGrad').val()-1; i >= $('#yearAdmitted').val(); i--)
     {
       var limit = i +1;

         $('#yearpicker').append($('<option />').val(i+'-'+limit).html(i+'-'+limit));
         $('#edtschoolYear').append($('<option />').val(i+'-'+limit).html(i+'-'+limit));
     }
   }else {
     for (i = new Date().getFullYear(); i >= $('#yearAdmitted').val(); i--)
     {
       var limit = i +1;
         $('#yearpicker').append($('<option />').val(i+'-'+limit).html(i+'-'+limit));
         $('#edtschoolYear').append($('<option />').val(i+'-'+limit).html(i+'-'+limit));

     }
   }



  $(document).on('dblclick', '#tbl_students tr', function(){
      window.open($(this).attr('rel'), '_blank');
    });

  $(document).on('click', '#addBtn', function(){
    var stdnum = $('#studentNumber').val();
    $('#subjectTitle').text(stdnum);
    $('#studno').val(stdnum);
    $('#addSubjectModal').modal('show');

  });


$(document).on('submit', '#form-subject', function(e){
  e.preventDefault();

swal({
title: "Are you sure?",
text: "",
icon: "warning",
buttons: true,
dangerMode: false,
}).then((willDelete) => {
if (willDelete) {

$.ajax({
  url: '../../registrar/addSubjects',
  method: 'post',
  dataType: 'json',
  data: $( this ).serializeArray(),
  success: function(data){
    if (data == true) {
      swal({
      title: "Student subject record added! ",
      text: "",
      icon: "success",
      buttons: {
        cancel: false,
        confirm: "OK",
      },
      dangerMode: false,
      }).then((willDelete) => {
      if (willDelete) {
          location.reload();
      }
    })
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

$(document).on('click', '.uptbtn', function(){
  var id = $(this).attr('id');

  $.ajax({
    url: '../../registrar/selectSub',
    method: 'post',
    dataType: 'json',
    data: {
      id: id,
    },
    success: function(data){
      $('#subCode').val(data.subjectCode);
      $('#subName').val(data.title);
      $('#edtschoolYear').val(data.schoolYear);
      $('#edtsems').val(data.sem);
      $('#edtgrade').val(data.grade);
      $('#edtTitle').text(data.studentNumber);
      $('#recID').val(data.subjtakenId);
      $('#edtSubjectModal').modal('show');
    }
  });

});
$(document).on('submit', '#form-uptsubject', function(e){
  e.preventDefault();


swal({
title: "Are you sure?",
text: "This record will be change.",
icon: "warning",
buttons: true,
dangerMode: false,
}).then((willDelete) => {
if (willDelete) {

$.ajax({
  url: '../../registrar/updateSubjects',
  method: 'post',
  dataType: 'json',
  data: $( this ).serializeArray(),
  success: function(data){
    if (data == true) {
      swal({
      title: "Student subject record added! ",
      text: "",
      icon: "success",
      buttons: {
        cancel: false,
        confirm: "OK",
      },
      dangerMode: false,
      }).then((willDelete) => {
      if (willDelete) {
          location.reload();
      }
    })
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

$(document).on('click', '.delbtn', function(){
  var id = $(this).attr('id');

  swal({
  title: "Are you sure?",
  text: "This record will be remove.",
  icon: "warning",
  buttons: true,
  dangerMode: true,
  }).then((willDelete) => {
  if (willDelete) {

  $.ajax({
    url: '../../registrar/delSubjects',
    method: 'post',
    dataType: 'json',
    data: {
      id: id,
    },
    success: function(data){
      console.log(data);
      if (data == true) {

        swal({
        title: "Student's subject record deleted! ",
        text: "",
        icon: "success",
        buttons: {
          cancel: false,
          confirm: "OK",
        },
        dangerMode: false,
        }).then((willDelete) => {
        if (willDelete) {
            location.reload();
        }
      })
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
});
