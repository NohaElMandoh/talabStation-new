$(document).ready(function () {

  $(document).ajaxSend(function () {
    // alert('hi');
    $('.addOffer').attr("disabled", true);
  });

  $('#merchant_id').change(function () {
    var merchant_id = $(this).val();
    getItems(merchant_id);

  });
  var total = 0;
  var dis = 0;
  $('#price').change(function () {

    $("#total_price").text($(this).val());
    if (total > 0) {
      dis = total - $('#price').val();
      if (dis > 0) {
        $("#discount").text(dis);
        $('#msg').text("");
      } else
        $('#msg').text("سعر العرض اكبر من السعر قبل العرض تأكد من البيانات ");


    } else {
      $("#discount").text('0.00');
      $("#msg").text("");

    }
  });

  $('#items').change(function () {
    var count = 1;

    total = 0;
    // alert($('#items option:selected').attr('data-price'));
    // alert($(this).children('option:selected').data('price'));
    $('#itemstable > tbody').empty();
    $.each($("#items option:selected"), function () {
      $('#itemstable > tbody').append('<tr><th scope="row"  > <input type="hidden" id="item_id" name="item_id"  value="' + $(this).val() + '">' + count + '</th><td >' + $(this).text() + '</td><td >' + $('#items option:selected').attr('data-price') + '</td></tr>')
      total += parseFloat($('#items option:selected').attr('data-price'));
      // alert ('hi');
      count++;
      {/* <td><input type="number" class="form-control validate[required]" id="quantity" step="0.01" min="1" " name="quantity"></td> */ }
    });

    $("#befor_offer").text(total);

    if (total > 0) {
      dis = total - $('#price').val();
      if (dis > 0) {
        $("#discount").text(dis);
        $('#msg').text("");
      } else {
        $("#discount").text('0.00');
        $('#msg').text("سعر العرض اكبر من السعر قبل العرض تأكد من البيانات ");
      }
    } else {
      $("#discount").text('0.00');
      $('#msg').text("");
      $("#befor_offer").text('0.00');
    }
    if ($('#itemstable tr').length >= 2) {
      $('.item_table').slideDown();
    } else {
      $('.item_table').slideUp();
    }

  });

})

function getItems(merchant_id) {
  $.ajax({
    url: base_url + '/merchant/items_merchant/' + merchant_id,
    type: 'GET',
    // data:{'id' : id},
    success: function (data) {

      if (data.success == true) {

        $('#items').empty().append(' <option  disabled >اختر صنف</option>');
        $.each(data.items, function (i, d) {


          $('#items').append(' <option data-price="' + d.price + '" data-name="' + d.name + '" data-itemID="' + d.id + '" value="' + d.id + '">' + d.name + '</option>');

        });
      }
    }
  });
}
$('.addOffer').click(function (e) {
  e.preventDefault();
  $('.addOffer').attr("disabled", true);
  var selected = new Array();
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
  // console.log(selected);
  if (selected.length > 0) {
    form.append('items', JSON.stringify(selected));

  }
  form.append('merchant_id', $('#merchant_id').val());
  form.append('name', $('#name').val());
  form.append('price', $('#price').val());

  if ($('#offer_title_id').val() > 0) {
    form.append('offer_title_id', $('#offer_title_id').val());

  }
  form.append('description', $('#description').val());
  form.append('ending_at', $('#ending_at').val());
  form.append('starting_at', $('#starting_at').val());
  form.append('befor_offer', $('#befor_offer').text());


  var TotalImages = $('#photo')[0].files.length;
  var images = $('#photo')[0];
  console.log(images)
  for (var i = 0; i < TotalImages; i++) {
    form.append('photo', images.files[i]);
  }


  var url = base_url + '/merchant/offer',
    method = 'POST',
    modal = '#commentModal';
  addForm(e, url, method, form, modal)


});
$('.editOffer').click(function (e) {
  e.preventDefault();
  $('.editOffer').attr("disabled", true);

  var selected = new Array();
  var offer_id = $('#offer_id').val();
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
  if (selected.length > 0) {
    form.append('items', JSON.stringify(selected));
  }
  form.append('merchant_id', $('#edit_merchant_id').val());
  form.append('name', $('#name').val());
  form.append('price', $('#price').val());
  if ($('#offer_title_id').val()) {
    form.append('offer_title_id', $('#offer_title_id').val());

  }
  form.append('description', $('#description').val());
  form.append('ending_at', $('#ending_at').val());
  form.append('starting_at', $('#starting_at').val());
  form.append('befor_offer', $('#befor_offer').text());


  var TotalImages = $('#photo')[0].files.length;
  var images = $('#photo')[0];
  console.log(images)
  for (var i = 0; i < TotalImages; i++) {
    form.append('photo', images.files[i]);
  }


  var url = base_url + '/merchant/offerUpdate/' + offer_id,
    method = 'POST',
    modal = '#commentModal';

  // editForm(e, url, method, data, modal);
  editForm(e, url, method, form, modal)


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
        $('.addOffer').attr("disabled", false);
      }
    },
    //   complete: function(){
    //     //Ajax request is finished, so we can enable
    //     //the button again.
    //     $('.addOffer').attr("disabled", false);
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
    //   beforeSend: function() {
    //     // setting a timeout
    //     $('.editOffer').attr("disabled", false);
    // },
    success: function (data) {
      if (data.success == true) {
        showSwal('success', data.message, '#reModal');
        setTimeout("location.reload(true);", 1500)
      } else {
        console.log(data);
        printErrors(data.errors);
        $('.editOffer').attr("disabled", false);
      }
    },
    //   complete: function(){
    //     //Ajax request is finished, so we can enable
    //     //the button again.
    //     $('.editOffer').attr("disabled", false);
    // }
  });
}


function notify(id) {

  $.ajax({
    url: base_url + '/merchant/offer/' + id + '/notify',
    type: 'POST',
    data: { 'id': id },
    success: function (data) {
      if (data.success == true) {
        showSwal('success', data.message, '#reModal');
        setTimeout("location.reload(true);", 1500)
        // if (data.results.date_signoff != null) {
        //     //show popup window to update value
        //     $('#date_signoff').val(data.results.date_signoff);
        //     $('#edit_id').val(id);
        //     $('#signModal').modal('show');
        // } else {
        //     //call ajax method to assign signoff
        //     project_signoff(id);
        // }
      }
    }
  });
}

function noNotify(id) {

  $.ajax({
    url: base_url + '/merchant/offer/' + id + '/no-notify',
    type: 'POST',
    data: { 'id': id },
    success: function (data) {
      if (data.success == true) {
        showSwal('success', data.message, '#reModal');
        setTimeout("location.reload(true);", 1500)
        // if (data.results.date_signoff != null) {
        //     //show popup window to update value
        //     $('#date_signoff').val(data.results.date_signoff);
        //     $('#edit_id').val(id);
        //     $('#signModal').modal('show');
        // } else {
        //     //call ajax method to assign signoff
        //     project_signoff(id);
        // }
      }
    }
  });
}
function deleteOffer(e) {
  Swal({
    type: 'warning',
    title: 'Are You Sure Delete This Offer?',
    confirmButtonClass: "btn-danger",
    confirmButtonText: "delete",
    showCancelButton: true,
    cancelButtonText: "cancel",
  }).then((result) => {
    if (result.value) {
      var id = $(e).data('id'),
        hitURL = base_url + '/merchant/offer/' + id,
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
