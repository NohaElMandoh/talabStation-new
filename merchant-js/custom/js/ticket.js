$(document).ready(function () {



$('.addTicket').click(function (e) {
  e.preventDefault();
  $('.addTicket').attr("disabled", true);

  var form = new FormData();
 
  form.append('content', content.getData());
  form.append('type', $('#type').val());


  var url = base_url + '/merchant/ticket',
    method = 'POST',
    modal = '#commentModal';
  addForm(e, url, method, form, modal)


});
$('.updateSettings').click(function (e) {
  e.preventDefault();
  // var unit_id=$('#unit_id').val();

  var form = new FormData();
  form.append('facebook', $('#facebook').val());
  form.append('twitter', $('#twitter').val());
  form.append('instagram', $('#instagram').val());

  form.append('delivery_cost', $('#delivery_cost').val());
  form.append('shopping_cost', $('#shopping_cost').val());
  form.append('about_app', about_app.getData());

  form.append('terms',terms.getData());


  var url = base_url + '/admin/updateSettings' ,
    method = 'POST',
    modal = '#commentModal';

  editForm(e, url, method, form, modal)


});
});

function addForm(e, url, method, dataResult, modal) {
  $.ajax({
    url: url,
    type: method,
    data: dataResult,
    cache: false,
    contentType: false,
    // contentType: 'application/json; charset=utf-8',
    processData: false,
    success: function (data) {
      //console.log(data);
      if (data.success == true) {
        showSwal('success', data.message, modal);
        setTimeout("location.reload(true);", 1500);
  

      } else {
        printErrors(data.errors);
        $('.addTicket').attr("disabled", false);
      }
    },
  //   complete: function(){
  //     //Ajax request is finished, so we can enable
  //     //the button again.
  //     $('.addTicket').attr("disabled", false);
  // }
  });
}
function editForm(e, url, method, data, modal) {

  $.ajax({
    url: url,
    type: method,
    data: data,
    cache: false,
    contentType: false,
    // contentType: 'application/json; charset=utf-8',
    processData: false,
    success: function (data) {
      if (data.success == true) {
        showSwal('success', data.message, '#reModal');
        setTimeout("location.reload(true);", 1500)
      } else {
        console.log(data);
        printErrors(data.errors);
      }
    }
  });
}


function deleteUnit(e) {
  Swal({
    type: 'warning',
    title: 'Are You Sure Delete This Unit?',
    confirmButtonClass: "btn-danger",
    confirmButtonText: "delete",
    showCancelButton: true,
    cancelButtonText: "cancel",
  }).then((result) => {
    if (result.value) {
      var id = $(e).data('id'),
        hitURL = base_url + '/admin/unit/' + id,
        currentRow = $(e);
      var text = '';
      jQuery.ajax({
        type: "DELETE",
        dataType: "json",
        url: hitURL,
        data: { _method: 'DELETE' }
      }).done(function (data) {
        currentRow.parents('tr').remove();
        if (data.success == true) {
          showSwal('success', data.message, '');
          // Swal({
          //   type:'success',
          //   title:data.message,
          // });
        } else if (data.success == false) {
          showSwal('error', data.message, '');
          //         Swal({
          //   type:'error',
          //   title:data.message,
          // });
        }
      });
    }
  });
}
