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

function changePreview(e, k, v) {
    console.log(e);
    var files = e.target.files;
    //  console.log(files);

    $.each(files, function(key, file) {
        var reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = function(e) {
            $(".img-prev").empty();

            var prev = base_url + '/public/admin/uploads/projects/files/file_preview.png';
            var img = '<div class="img-prev">' +
                '<img class="img-thumbnails" src="' + e.target.result + '" onError="this.onerror=null;this.src=' + prev + ';">' +
                '</div>';



            if (v == 'addUser') {
                $('#' + v).html(img);
            } else if (v == 'editUser') {
                $('#' + v).html(img);
            } else {
                $('#' + v).append(img);

            }


        }
    });
}

function changePreview_multi(e, k, v) {
    console.log(e);
    var files = e.target.files;
    //  console.log(files);
    alert('hi');
    $.each(files, function(key, file) {
        var reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = function(e) {
            $(".img-prev").empty();

            var prev = base_url + '/public/admin/uploads/projects/files/file_preview.png';
            var img = '<div class="img-prev">' +
                '<img class="img-thumbnails" src="' + e.target.result + '" onError="this.onerror=null;this.src=' + prev + ';">' +
                '</div>';



        }
    });
}


function editFormData(e, url, method, data, modal) {
    $.ajax({
        url: url,
        type: method,
        data: data,
        success: function(data) {
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

function printErrors(msgs) {
    //alert('shit')
    $('.error').removeClass('hidden');
    $('.error').addClass('n_hide text-white bg-danger bg-danger-errors alert');
    $('.error').find('ul').empty();
    for (var i = 0; i < msgs.length; i++) {
        $('.error').find('ul').append('<li>' + msgs[i] + '</li>');
    }
}