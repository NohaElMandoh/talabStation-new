$(document).ready(function() {
    var selectedCity = 0;
    $('.categories').change(function() {

        var ids = [];
        var count = 1;
        var selectedCategories = [];

        $('#categoriestable > tbody').empty();
        $.each($(".categories option:selected"), function() {
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
    $(".city").change(function() {
        // alert('hi');
        selectedCity = $(this).children("option:selected").val();
        getRegions(selectedCity)
            // alert("You have selected the country - " + selectedCity);
    });

    $(".type").change(function() {

        selectedType = $(this).children("option:selected").val();
        getCategories(selectedType)
    });
})

function getCategories(type_id) {

    $.ajax({
        url: base_url + '/merchant/getCategories/' + type_id,
        type: 'GET',
        // data:{'id' : id},
        success: function(data) {

            if (data.success == true) {

                $('.categories').children().remove().end().append(' <option disabled >اختر تصنيف</option>');
                $.each(data.categories, function(i, d) {
                    if (d.id == data.categories.id)

                        $('.categories').append(' <option selected data-name="' + d.name + '" value="' + d.id + '">' + d.name + '</option>');
                    else
                        $('.categories').append(' <option data-name="' + d.name + '" value="' + d.id + '">' + d.name + '</option>');
                });
            }
        }
    });
}

function getRegions(city_id) {
    // alert('city_id');

    $.ajax({
        url: base_url + '/merchant/getRegions/' + city_id,
        type: 'GET',
        // data:{'id' : id},
        success: function(data) {

            if (data.success == true) {
                $('#region_id').children().remove().end().append(' <option disabled >اختر منطقة</option>');
                $.each(data.regions, function(i, d) {
                    if (d.id == data.regions.id)
                        $('#region_id').append(' <option selected data-name="' + d.name_ar + '" value="' + d.id + '">' + d.name_ar + '</option>');
                    else
                        $('#region_id').append(' <option data-name="' + d.name_ar + '" value="' + d.id + '">' + d.name_ar + '</option>');
                });
            }
        }
    });
}
$('.editProfile').click(function(e) {
    e.preventDefault();
    $('.editProfile').attr("disabled", true);

    var selectedCategories = new Array();
    var merchant_id = $('#merchant_id').val();

    $("#categories :selected").map(function(i, el) {
        selectedCategories.push($(el).val());
    }).get();
    // alert(selectedCategories);
    var form = new FormData();
    // form.append('items', JSON.stringify(selected));
    form.append('name', $('#name').val());
    form.append('email', $('#email').val());
    form.append('phone', $('#phone').val());
    form.append('availability', $('#availability').val());
    form.append('address', $('#address').val());
    form.append('categories', selectedCategories);
    // if ($('#type_id').val() > 0) {
    //     form.append('type_id', $('#type_id').val());
    // }
    if ($('#region_id').val() > 0) {
        form.append('region_id', $('#region_id').val());
    }
    form.append('merchant_id', $('#merchant_id').val());


    var TotalImages = $('#photo')[0].files.length;
    var images = $('#photo')[0];
    console.log(images)
    for (var i = 0; i < TotalImages; i++) {
        form.append('photo', images.files[i]);
    }


    var url = base_url + '/merchant/updateProfile',
        method = 'POST',
        modal = '#commentModal';

    // editForm(e, url, method, data, modal);
    editForm(e, url, method, form, modal)


});
$('.changePassword').click(function(e) {
    e.preventDefault();
    $('.changePassword').attr("disabled", true);



    var form = new FormData();
    // form.append('items', JSON.stringify(selected));
    form.append('password_confirmation', $('#password_confirmation').val());
    form.append('password', $('#password').val());
    form.append('merchant_id', $('#merchant_id').val());

    var url = base_url + '/merchant/changePassword',
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
        success: function(data) {
            if (data.success == true) {
                showSwal('success', data.message, '#reModal');
                setTimeout("location.reload(true);", 1500)
            } else {
                console.log(data);
                printErrors(data.errors);
                $('.editProfile').attr("disabled", false);
                $('.changePassword').attr("disabled", false);
            }
        },
        //   complete: function(){
        //     //Ajax request is finished, so we can enable
        //     //the button again.
        //     $('.editProfile').attr("disabled", false);
        //     $('.changePassword').attr("disabled", false);

        // }
    });
}