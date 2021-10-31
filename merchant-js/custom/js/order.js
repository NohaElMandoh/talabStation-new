$(document).ready(function() {

    var edit_id = '';
    var order_id = '';
    var selected = new Array();
    $('#add').click(function() {
        $('.error').addClass('hidden');
        $('#add_form')[0].reset();
        // $("#add_form").validationEngine();

        // console.log(order_id);
    });
    $('#rej_btn').click(function() {

        edit_id = $(this).data('id');

    });
    $('.add_order_id').click(function() {

        order_id = $(this).data('id');

        console.log(order_id);
    });

    $('#set-price').click(function(e) {
        e.preventDefault();

        $('#order-table tr').each(function() {
            var quantity = $(this).find("#quantity").val();
            var price = $(this).find("#price").val();
            var item_id = $(this).find("#item_id").val();

            if (quantity != undefined) {
                selected.push({
                    id: item_id,
                    quantity: quantity,
                    price: price
                });
            }

        });
        var form = new FormData();
        form.append('selected', JSON.stringify(selected));

        var id = $('#edit_id').val(),
            method = 'POST',
            url = base_url + '/admin/update-order/' + id,
            modal = '#editModal';

        editForm(e, url, method, form, modal)
    });

    $(document).on('click', '.edit', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        getData(id);

        $('#editModal').modal('show');
        $('.error').addClass('hidden');

        $("#edit_form").validationEngine();
    });



    $(document).on('click', '#accept_check', function(e) {
        e.preventDefault();
        alert('hi');
        order_id = $(this).data('id');
        runner_id = $(this).data('runner');


        var form = new FormData();

        form.append('order_id', order_id);
        form.append('runner_id', runner_id);

        var url = base_url + '/admin/acceptDeliverOrder',
            method = 'POST',
            modal = '#taskStatusModal';
        editForm(e, url, method, form, modal);
    });
    $(document).on('submit', '#edit_form', function(e) {
        e.preventDefault();
        var id = $('#edit_id').val(),
            method = 'POST',
            url = base_url + '/admin/opportunity/' + id,
            data = {
                'id': $('#edit_id').val(),
                'title': $('#edit_title').val(),
                'customer_id': $('#edit_customer_id').val(),
                'notes': $('#edit_notes').val(),
                'expected_closed_date': $('#edit_expected_closed_date').val(),
                'services': $('#edit_services').val(),
                'stage_id': $('#edit_stage_id').val(),
            },
            modal = '#editModal';

        editForm(e, id, url, method, data, modal)
    });
    $(document).on('click', '#add_reason', function(e) {
        e.preventDefault();

        var url = base_url + '/merchant/rejectOrder',
            method = 'POST',
            data = {
                'id': edit_id,
                'merchant_reject_reason': $('#merchant_reject_reason').val(),
            },
            modal = '#rejectOrderReason';
        addForm(e, url, method, data, modal)

    });




});

function deliveredOrder(id) {

    $.ajax({
        url: base_url + '/merchant/deliveredOrder/' + id,
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

function rejectOrder(id) {

    $.ajax({
        url: base_url + '/merchant/rejectOrder/' + id,
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


function acceptOrder(id) {

    $.ajax({
        url: base_url + '/merchant/acceptOrder/' + id,
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

function acceptItem(id) {

    $.ajax({
        url: base_url + '/merchant/acceptItem/' + id,
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


function deliverItem(id) {

    $.ajax({
        url: base_url + '/merchant/deliverItem/' + id,
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

function rejecteItem(id) {

    $.ajax({
        url: base_url + '/merchant/rejecteItem/' + id,
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

function getData(id) {
    // console.log (id); 
    $.ajax({
        url: base_url + '/admin/opportunities/getAjaxRequest/' + id,
        type: 'GET',
        // data:{'id' : id},
        success: function(data) {
            // console.log(data)

            if (data.success == true) {
                $('#edit_id').val(data.opportunity.id);
                $('#edit_title').val(data.opportunity.title);
                $('#edit_customer_id').val(data.opportunity.customer_id);
                $('#edit_notes').val(data.opportunity.notes);
                $('#edit_expected_closed_date').val(data.opportunity.expected_closed_date);
                $('#edit_stage_id').val(data.opportunity.stage_id);
                $('#edit_services').val(data.opportunity.services)
            }
        }
    });
}

function deleteOpportunity(id) {
    deleteData(id, 'Are You Sure Delete This Opportunity?', base_url + '/admin/opportunities/' + id);
}

function addForm(e, url, method, dataResult, modal) {
    console.log(url);
    $.ajax({
        url: url,
        type: method,
        data: dataResult,

        success: function(data) {

            if (data.success == true) {
                showSwal('success', data.message, modal);
                setTimeout("location.reload(true);", 1500)
            } else {
                printErrors(data.errors);
            }
        }
    });
}

function printErrors(msgs) {
    //alert('shit')
    $('.error').removeClass('hidden');
    $('.error').addClass('n_hide text-white bg-secondary bg-secondary-errors alert');
    $('.error').find('ul').empty();
    for (var i = 0; i < msgs.length; i++) {
        $('.error').find('ul').append('<li>' + msgs[i] + '</li>');
    }
}

function showSwal(type, message, modal) {
    //hide error
    $('.error').removeClass('n_hide text-white bg-secondary bg-secondary-errors alert');
    $('.error').addClass('hidden');
    $(modal).modal('hide');
    //change swal message

    Swal.fire({
        position: 'top-middle',
        type: type,
        title: message,
        showConfirmButton: false,
        timer: 2000
    })


    // Swal({
    //   type:type,
    //   title:message
    //  });
}

function editForm(e, url, method, data, modal) {
    // alert('hi');
    // alert(data);
    $.ajax({
        url: url,
        type: method,
        data: data,
        dataType: 'json',
        cache: false,
        contentType: false,
        processData: false,
        success: function(data) {
            if (data.success == true) {
                showSwal('success', data.message, '#reModal');
                // page=data.page;
                setTimeout("location.reload(true);", 1500);
                // callback(data.page);
            } else {
                printErrors(data.errors);
            }
        }
    });
}