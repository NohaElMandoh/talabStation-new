$(document).ready(function() {


    $('#merchant_id').change(function() {
        var merchant_id = $(this).val();
        getItems(merchant_id);

    });


})

$('.addItem').click(function(e) {
    e.preventDefault();
    $('.addItem').attr("disabled", true);
    var form = new FormData();

    form.append('merchant_id', $('#merchant_id').val());
    form.append('name', $('#name').val());
    form.append('price', $('#price').val());
    // form.append('category_id', $('#category_id').val());
    // form.append('unit_id', $('#unit_id').val());
    if ($('#unit_id').val() > 0) {
        form.append('unit_id', $('#unit_id').val());
    }
    if ($('#category_id').val() > 0) {
        form.append('category_id', $('#category_id').val());
    }
    form.append('discount', $('#discount').val());
    form.append('description', $('#description').val());


    var TotalImages = $('#photo')[0].files.length;
    var images = $('#photo')[0];
    console.log(images)
    for (var i = 0; i < TotalImages; i++) {
        form.append('photo', images.files[i]);
    }
    //upload multi image
    var TotalImages2 = $('#images')[0].files.length;
    alert(TotalImages2);
    var images2 = $('#images')[0];

    console.log(images)
    for (var i = 0; i < TotalImages2; i++) {
        //form.append('require_filename[]', images.files[0]);
        form.append('images[]', images2.files[i]);
    }
    // var TotalImages = $('#images')[0].files.length;
    // var item_images = $('#images')[0];
    // console.log(item_images)
    // for (var i = 0; i < TotalImages; i++) {
    //     form.append('images[]', item_images.files[i]);
    //     alert(item_images.files[i]);
    // }
    // // Read selected files
    // var totalfiles = document.getElementById('images').files.length;
    // for (var index = 0; index < totalfiles; index++) {
    //     form.append("images[]", document.getElementById('images').files[index]);
    // }

    // form.append('images[]', $('images').val());
    var url = base_url + '/merchant/item',
        method = 'POST',
        modal = '#commentModal';
    addForm(e, url, method, form, modal)


});
$('.editItem').click(function(e) {
    e.preventDefault();
    $('.editItem').attr("disabled", true);

    var item_id = $('#item_id').val();
    var form = new FormData();

    form.append('name', $('#name').val());
    form.append('price', $('#price').val());

    if ($('#category_id').val() > 0) {
        form.append('category_id', $('#category_id').val());
    }
    if ($('#unit_id').val() > 0) {
        form.append('unit_id', $('#unit_id').val());
    }

    form.append('discount', $('#discount').val());
    form.append('description', $('#description').val());

    var TotalImages = $('#photo')[0].files.length;
    var images = $('#photo')[0];
    console.log(images)
    for (var i = 0; i < TotalImages; i++) {
        form.append('photo', images.files[i]);
    }



    var url = base_url + '/merchant/item/update/' + item_id,
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
        success: function(data) {
            //console.log(data);
            if (data.success == true) {
                showSwal('success', data.message, modal);
                setTimeout("location.reload(true);", 1500)
            } else {
                // alert('hi');
                printErrors(data.errors);
                $('.addItem').attr("disabled", false);

            }
        },
        //   complete: function(){
        //     //Ajax request is finished, so we can enable
        //     //the button again.
        //     $('.addItem').attr("disabled", false);
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
        success: function(data) {
            if (data.success == true) {
                showSwal('success', data.message, '#reModal');
                setTimeout("location.reload(true);", 1500)
            } else {
                console.log(data);
                printErrors(data.errors);
                $('.editItem').attr("disabled", false);

            }
        },
        //   complete: function(){
        //     //Ajax request is finished, so we can enable
        //     //the button again.
        //     $('.editItem').attr("disabled", false);
        // }
    });
}


function notify(id) {

    $.ajax({
        url: base_url + '/admin/offer/' + id + '/notify',
        type: 'POST',
        data: { 'id': id },
        success: function(data) {
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
        url: base_url + '/admin/offer/' + id + '/no-notify',
        type: 'POST',
        data: { 'id': id },
        success: function(data) {
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
                hitURL = base_url + '/merchant/item/delete/' + id,
                currentRow = $(e);
            var text = '';
            jQuery.ajax({
                type: "DELETE",
                dataType: "json",
                url: hitURL,
                data: { _method: 'DELETE' }
            }).done(function(data) {
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