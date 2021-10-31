$(document).ready(function () {



$('.addRegion').click(function (e) {
  e.preventDefault();

  var form = new FormData();
 
  form.append('name_ar', $('#name_ar').val());
  form.append('name_en', $('#name_en').val());
  form.append('city_id', $('#city_id').val());
  form.append('delivery_cost', $('#delivery_cost').val());


  var url = base_url + '/admin/region',
    method = 'POST',
    modal = '#commentModal';
  addForm(e, url, method, form, modal)


});
$('.editRegion').click(function (e) {
  e.preventDefault();
  var region_id=$('#region_id').val();

  var form = new FormData();
  form.append('name_ar', $('#name_ar').val());
  form.append('name_en', $('#name_en').val());
  form.append('city_id', $('#city_id').val());
  form.append('delivery_cost', $('#delivery_cost').val());

  var url = base_url + '/admin/regionUpdate/' + region_id,
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
        setTimeout("location.reload(true);", 1500)
      } else {
        printErrors(data.errors);
      }
    }
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


function deleteRegion(e) {
  Swal({
    type: 'warning',
    title: 'Are You Sure Delete This Region?',
    confirmButtonClass: "btn-danger",
    confirmButtonText: "delete",
    showCancelButton: true,
    cancelButtonText: "cancel",
  }).then((result) => {
    if (result.value) {
      var id = $(e).data('id'),
        hitURL = base_url + '/admin/region/' + id,
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
