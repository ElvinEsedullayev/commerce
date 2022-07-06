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


    //update attribute status start
    $(document).on('click', '.updateAttributeStatus', function() {
        var status = $(this).children('i').attr('status');
        //alert(status);
        var attribute_id = $(this).attr('attribute_id');
        //alert(attribute_id);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url: '/admin/update-attribute-status',
            data: { status: status, attribute_id: attribute_id },
            success: function(resp) {
                //alert(resp);
                if (resp['status'] == 0) {
                    // $('#admin-' + admin_id).html("<i class='la la-bookmark' status='Inactive'></i>");
                    $('#attribute-' + attribute_id).html("<i class='fa fa-toggle-off fa-lg' status='Inactive'></i>");
                } else if (resp['status'] == 1) {
                    // $('#admin-' + admin_id).html("<i class='la la-bookmark' status='Inactive'></i>");
                    $('#attribute-' + attribute_id).html("<i class='fa fa-toggle-on fa-lg' status='Active'></i>");
                }
            },
            error: function() {
                alert(error);
            }
        });
    });
    //update attribute status end

    //update images status start
    $(document).on('click', '.updateImageStatus', function() {
        var status = $(this).children('i').attr('status');
        //alert(status);
        var image_id = $(this).attr('image_id');
        //alert(image_id);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url: '/admin/update-image-status',
            data: { status: status, image_id: image_id },
            success: function(resp) {
                //alert(resp);
                if (resp['status'] == 0) {
                    // $('#admin-' + admin_id).html("<i class='la la-bookmark' status='Inactive'></i>");
                    $('#image-' + image_id).html("<i class='fa fa-toggle-off fa-lg' status='Inactive'></i>");
                } else if (resp['status'] == 1) {
                    // $('#admin-' + admin_id).html("<i class='la la-bookmark' status='Inactive'></i>");
                    $('#image-' + image_id).html("<i class='fa fa-toggle-on fa-lg' status='Active'></i>");
                }
            },
            error: function() {
                alert(error);
            }
        });
    });
    //update images status end

    //update images status start
    $(document).on('click', '.updateBrandStatus', function() {
        var status = $(this).children('i').attr('status');
        //alert(status);
        var brand_id = $(this).attr('brand_id');
        //alert(brand_id);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url: '/admin/update-brand-status',
            data: { status: status, brand_id: brand_id },
            success: function(resp) {
                //alert(resp);
                if (resp['status'] == 0) {
                    // $('#admin-' + admin_id).html("<i class='la la-bookmark' status='Inactive'></i>");
                    $('#brand-' + brand_id).html("<i class='fa fa-toggle-off fa-lg' status='Inactive'></i>");
                } else if (resp['status'] == 1) {
                    // $('#admin-' + admin_id).html("<i class='la la-bookmark' status='Inactive'></i>");
                    $('#brand-' + brand_id).html("<i class='fa fa-toggle-on fa-lg' status='Active'></i>");
                }
            },
            error: function() {
                alert(error);
            }
        });
    });
    //update images status end

    //update product status start
    $(document).on('click', '.updateProductStatus', function() {
        var status = $(this).children('i').attr('status');
        //alert(status);
        var product_id = $(this).attr('product_id');
        //alert(product_id);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url: '/admin/update-product-status',
            data: { status: status, product_id: product_id },
            success: function(resp) {
                //alert(resp);
                if (resp['status'] == 0) {
                    // $('#admin-' + admin_id).html("<i class='la la-bookmark' status='Inactive'></i>");
                    $('#product-' + product_id).html("<i class='fa fa-toggle-off fa-lg' status='Inactive'></i>");
                } else if (resp['status'] == 1) {
                    // $('#admin-' + admin_id).html("<i class='la la-bookmark' status='Inactive'></i>");
                    $('#product-' + product_id).html("<i class='fa fa-toggle-on fa-lg' status='Active'></i>");
                }
            },
            error: function() {
                alert(error);
            }
        });
    });
    //update product status end

    //update product status start
    $(document).on('click', '.updateBannerStatus', function() {
        var status = $(this).children('i').attr('status');
        //alert(status);
        var banner_id = $(this).attr('banner_id');
        //alert(banner_id);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url: '/admin/update-banner-status',
            data: { status: status, banner_id: banner_id },
            success: function(resp) {
                //alert(resp);
                if (resp['status'] == 0) {
                    // $('#admin-' + admin_id).html("<i class='la la-bookmark' status='Inactive'></i>");
                    $('#banner-' + banner_id).html("<i class='fa fa-toggle-off fa-lg' status='Inactive'></i>");
                } else if (resp['status'] == 1) {
                    // $('#admin-' + admin_id).html("<i class='la la-bookmark' status='Inactive'></i>");
                    $('#banner-' + banner_id).html("<i class='fa fa-toggle-on fa-lg' status='Active'></i>");
                }
            },
            error: function() {
                alert(error);
            }
        });
    });
    //update product status end

    //append categories level 
    $("#section_id").change(function() {
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
                //alert(section_id);
                $('#appendCategoryLevel').html(resp);
            },
            error: function(resp) {
                alert('Error');
            }
        });
    });
    //append categories level end

    //sweetalert in jquery start
    // $(document).on('click', '.confirmDelete', function() { //eger paginatonda bu islemese asagidaki ile deyis
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


    //attribute add and edit start
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var fieldHTML = '<div><div style="height: 10px;"></div><input type="text" name="size[]" placeholder="Size" required style="width: 200px;"/> <input type="text" name="sku[]" placeholder="Sku" required style="width: 200px;"/> <input type="text" name="price[]" placeholder="Price" required style="width: 200px;"/> <input type="text" name="stock[]" placeholder="Stock" required style="width: 200px;"/> <a href="javascript:void(0);" class="remove_button">Delete</a></div>'; //New input field html 
    var x = 1; //Initial field counter is 1

    //Once add button is clicked
    $(addButton).click(function() {
        //Check maximum number of input fields
        if (x < maxField) {
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });

    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e) {
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });
    //atribute add and edit end
});