$(document).ready(function() {
    //check current password start
    $('#current_password').keyup(function() {
        var current_password = $('#current_password').val();
        //alert(current_password);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url: '/admin/check-current-password',
            data: { current_password: current_password },
            success: function(resp) {
                //alert(resp);
                if (resp == 'false') {
                    $('#check_password').html("<font color='red'><b>Current password is incorrect!<b></b></font>");
                    // current password icinde olan span teqine aiddi..icinde yazilir bu msj
                } else if (resp == 'true') {
                    $('#check_password').html("<font color='green'><b>Current password is correct!</b></font>");
                }
            },
            error: function(resp) {
                //alert('Error');
            }
        });
    });
    //check current password end

    //update section status start
    $(document).on('click', '.updateSectionStatus', function() {
        var status = $(this).children('i').attr('status');
        //alert(status);
        var section_id = $(this).attr('section_id');
        //alert(section_id);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url: '/admin/update-section-status',
            data: { status: status, section_id: section_id },
            success: function(resp) {
                //alert(resp);
                if (resp['status'] == 0) {
                    // $('#admin-' + admin_id).html("<i class='la la-bookmark' status='Inactive'></i>");
                    $('#section-' + section_id).html("<i class='fa fa-toggle-off fa-lg' status='Inactive'></i>");
                } else if (resp['status'] == 1) {
                    // $('#admin-' + admin_id).html("<i class='la la-bookmark' status='Inactive'></i>");
                    $('#section-' + section_id).html("<i class='fa fa-toggle-on fa-lg' status='Active'></i>");
                }
            },
            error: function() {
                alert(error);
            }
        });
    });
    //update section status end

    //update category status start
    $(document).on('click', '.updateCategoryStatus', function() {
        var status = $(this).children('i').attr('status');
        //alert(status);
        var category_id = $(this).attr('category_id');
        //alert(category_id);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url: '/admin/update-category-status',
            data: { status: status, category_id: category_id },
            success: function(resp) {
                //alert(resp);
                if (resp['status'] == 0) {
                    // $('#admin-' + admin_id).html("<i class='la la-bookmark' status='Inactive'></i>");
                    $('#category-' + category_id).html("<i class='fa fa-toggle-off fa-lg' status='Inactive'></i>");
                } else if (resp['status'] == 1) {
                    // $('#admin-' + admin_id).html("<i class='la la-bookmark' status='Inactive'></i>");
                    $('#category-' + category_id).html("<i class='fa fa-toggle-on fa-lg' status='Active'></i>");
                }
            },
            error: function() {
                alert(error);
            }
        });
    });
    //update category status end

    //append categories level 
    $('#section_id').change(function() {
        var section_id = $(this).val();
        //alert(section_id);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'get',
            url: '/admin/append-categories-level',
            data: { section_id: section_id },
            success: function(resp) {
                $('#appendCategoryLevel').html(resp);
            },
            error: function(resp) {
                alert('Error');
            }
        });
    });
    //append categories level end

    //sweetalert in jquery start
    $('.confirmDelete').click(function() {
        var module = $(this).attr('module');
        var moduleid = $(this).attr('moduleid');
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                )
                window.location = '/admin/delete-' + module + '/' + moduleid;
            }
        })
    });
    //sweet alert end
});