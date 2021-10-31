$(document).ready(function () {
    $('.categories').change(function () {

        var ids = [];
        var count = 1;
        var selectedCategories=[];

        $('#categoriestable > tbody').empty();
        $.each($(".categories option:selected"), function () {
            // $('#categoriestable > tbody').append('<tr><td>' + $(this).data('name') + '</td></tr>')
            $('#categoriestable > tbody').append('<tr><th scope="row">' + count + '</th><td>' + $(this).data('name') + '</td></tr>')
        count++;
            
        });
        if ($('#categoriestable tr').length >= 2) {
            $('.category_table').slideDown();
        } else {
            $('.category_table').slideUp();
        }

    });

})
$(".city").change(function(){
    // alert('hi');
    var selectedCity = $(this).children("option:selected").val();
    alert("You have selected the country - " + selectedCity);
});


// $(document).on('click', '#city_id', function (e) {
//     $('.error').addClass('hidden');

//    city_id = $(this).val();
// alert($(this).val());
//    getRegions(user_id);


//   });

function getRegions(city_id) {
    // alert('city_id');

    $.ajax({
      url: base_url + '/admin/getRegions/' + city_id,
      type: 'GET',
      // data:{'id' : id},
      success: function (data) {
  
        if (data.success == true) {
          $('#users').append(' <option disabled >Select Employee</option>');
          $.each(data.users, function (i, d) {
            if (d.id == data.user.id)
              $('#users').append(' <option selected data-name="' + d.name + '" value="' + d.id + '">' + d.name + '</option>');
            else
              $('#users').append(' <option data-name="' + d.name + '" value="' + d.id + '">' + d.name + '</option>');
          });
        }
      }
    });
  }
  $('.editMerchant').click(function (e) {
    e.preventDefault();
    var selected = new Array();
    var merchant_id=$('#merchant_id').val();
    $('#itemstable tr').each(function () {
      var quantity = $(this).find("#quantity").val();
      var item_id = $(this).find("#item_id").val();
  
      if (item_id != undefined) {
        selected.push({
          item_id: item_id,
          // quantity: quantity,
  
        });
      }
  
  
    });
   
  
    var form = new FormData();
    // form.append('items', JSON.stringify(selected));
    form.append('type_id', $('#type_id').val());
    form.append('name', $('#name').val());
    form.append('email', $('#email').val());
    form.append('phone', $('#phone').val());
    form.append('availability', $('#availability').val());
    form.append('address', $('#address').val());
    form.append('categories[]', $('#categories').val());
    form.append('region_id', $('#city_id').val());

    var TotalImages = $('#photo')[0].files.length;
    var images = $('#photo')[0];
    console.log(images)
    for (var i = 0; i < TotalImages; i++) {
      form.append('photo', images.files[i]);
    }
  
  
    var url = base_url + '/admin/merchantUpdate/'+merchant_id,
      method = 'POST',
      modal = '#commentModal';
     
      // editForm(e, url, method, data, modal);
    editForm(e, url, method, form, modal)
  
  
  });
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
  
  function deleteMerchant(e) {
    Swal({
        type: 'warning',
        title: 'Are You Sure Delete This Merchant?',
        confirmButtonClass: "btn-danger",
        confirmButtonText: "delete",
        showCancelButton: true,
        cancelButtonText: "cancel",
    }).then((result) => {
        if (result.value) {
            var id = $(e).data('id'),
                hitURL = base_url + '/admin/merchant/' + id,
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
  
  
function deleteItem(e) {
  Swal({
      type: 'warning',
      title: 'Are You Sure Delete This Item?',
      confirmButtonClass: "btn-danger",
      confirmButtonText: "delete",
      showCancelButton: true,
      cancelButtonText: "cancel",
  }).then((result) => {
      if (result.value) {
          var id = $(e).data('id'),
              hitURL = base_url + '/admin/item/delete/' + id,
              currentRow = $(e);
          var text = '';
          jQuery.ajax({
              type: "POST",
              dataType: "json",
              url: hitURL,
              // data: { _method: 'DELETE' }
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