$(document).ready(function() {
    //alert('salam');
    // $('#sort').on('change', function() {
    //     //alert('salam');
    //     this.form.submit();
    // });
    $('#sort').on('change', function() {
        var sort = $(this).val();
        //alert(sort);
        var fabric = get_filter('fabric');
        var sleeve = get_filter('sleeve');
        var pattern = get_filter('pattern');
        var fit = get_filter('fit');
        var occasion = get_filter('occasion');
        var url = $('#url').val();
        //alert(url);
        $.ajax({
            url: url,
            method: 'Post',
            data: { fabric: fabric, sleeve: sleeve, pattern: pattern, fit: fit, occasion: occasion, sort: sort, url: url },
            success: function(data) {
                $('.filter_products').html(data);
            },
        });
    });

    $('.fabric').on('click', function() {
        var fabric = get_filter('fabric');
        var sleeve = get_filter('sleeve');
        var pattern = get_filter('pattern');
        var fit = get_filter('fit');
        var occasion = get_filter('occasion');
        var sort = $('#sort option:selected').text();
        //alert(sort);
        var url = $('#url').val();
        //alert(url);
        $.ajax({
            url: url,
            method: 'Post',
            data: { fabric: fabric, sleeve: sleeve, pattern: pattern, fit: fit, occasion: occasion, sort: sort, url: url },
            success: function(data) {
                $('.filter_products').html(data);
            },
        });
    });
    $('.sleeve').on('click', function() {
        var fabric = get_filter('fabric');
        var sleeve = get_filter('sleeve');
        var pattern = get_filter('pattern');
        var fit = get_filter('fit');
        var occasion = get_filter('occasion');
        var sort = $('#sort option:selected').text();
        //alert(sort);
        var url = $('#url').val();
        //alert(url);
        $.ajax({
            url: url,
            method: 'Post',
            data: { fabric: fabric, sleeve: sleeve, pattern: pattern, fit: fit, occasion: occasion, sort: sort, url: url },
            success: function(data) {
                $('.filter_products').html(data);
            },
        });
    });
    $('.pattern').on('click', function() {
        var fabric = get_filter('fabric');
        var sleeve = get_filter('sleeve');
        var pattern = get_filter('pattern');
        var fit = get_filter('fit');
        var occasion = get_filter('occasion');
        var sort = $('#sort option:selected').text();
        //alert(sort);
        var url = $('#url').val();
        //alert(url);
        $.ajax({
            url: url,
            method: 'Post',
            data: { fabric: fabric, sleeve: sleeve, pattern: pattern, fit: fit, occasion: occasion, sort: sort, url: url },
            success: function(data) {
                $('.filter_products').html(data);
            },
        });
    });
    $('.fit').on('click', function() {
        var fabric = get_filter('fabric');
        var sleeve = get_filter('sleeve');
        var pattern = get_filter('pattern');
        var fit = get_filter('fit');
        var occasion = get_filter('occasion');
        var sort = $('#sort option:selected').text();
        //alert(sort);
        var url = $('#url').val();
        //alert(url);
        $.ajax({
            url: url,
            method: 'Post',
            data: { fabric: fabric, sleeve: sleeve, pattern: pattern, fit: fit, occasion: occasion, sort: sort, url: url },
            success: function(data) {
                $('.filter_products').html(data);
            },
        });
    });
    $('.occasion').on('click', function() {
        var fabric = get_filter('fabric');
        var sleeve = get_filter('sleeve');
        var pattern = get_filter('pattern');
        var fit = get_filter('fit');
        var occasion = get_filter('occasion');
        var sort = $('#sort option:selected').text();
        //alert(sort);
        var url = $('#url').val();
        //alert(url);
        $.ajax({
            url: url,
            method: 'Post',
            data: { fabric: fabric, sleeve: sleeve, pattern: pattern, fit: fit, occasion: occasion, sort: sort, url: url },
            success: function(data) {
                $('.filter_products').html(data);
            },
        });
    });

    function get_filter(class_name) {
        var filter = [];
        $('.' + class_name + ':checked').each(function() {
            filter.push($(this).val());
        });
        return filter;
    }

    $('#getPrice').on('change',function(){
        var size = $(this).val();
        //alert(size);
        var product_id = $(this).attr('product-id');
        if(size == ''){
            alert('Please select size!');
            return false;
        }
        //alert(product_id);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url:'/get-product-price',
            type:'post',
            data:{size:size,product_id:product_id},
            success:function(resp){
                //alert(resp['product_price']); 
                //alert(resp['discount_price']);
                //return false;
                if(resp['discount'] > 0){
                    $('.getAttrPrice').html('<del>Rs.'+resp['price']+'</del> Rs.'+resp['discount_price']);
                }else{
                    $('.getAttrPrice').html('Rs.'+resp);
                }
                
            },
            error:function(){
                alert('Error');
            }
        });
    });

    //cart item update
    $(document).on('click','.btnItemUpdate',function(){
        if($(this).hasClass('qtyMinus')){
            var quantity = $(this).prev().val();
            //alert(quantity);
            //return false;
            if(quantity <=1){
                alert('Item quantity must be 1 or greater!');
                return false;
            }else{
                new_qty = parseInt(quantity) - 1;
            }
        }
        if($(this).hasClass('qtyPlus')){
            var quantity = $(this).prev().prev().val();
            //alert(quantity); return false;
            new_qty = parseInt(quantity) + 1;
        }
        //alert(new_qty);
        var cartid = $(this).data('cartid');
        //alert(cartid);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url:'/update-cart-item-qty',
            data:{"cartid":cartid,"qty":new_qty},
            type:'post',
            success:function(resp){
                //alert(resp);
                //alert(resp.status);
                if(resp.status == false){
                    alert(resp.message);
                }
                $('#AppendCartItems').html(resp.view);
            },
            error:function(){
                //alert('Error');
            }
        })
    });

    //cart item delete
    $(document).on('click','.btnItemDelete',function(){
        var cartid = $(this).data('cartid');
        //alert(cartid);
        var result = confirm('Want to delete this cart item?');
        if(result){
            $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url:'/delete-cart-item',
            data:{"cartid":cartid},
            type:'post',
            success:function(resp){
                $('#AppendCartItems').html(resp.view);
            },
            error:function(){
                //alert('Error');
            }
        });
        }
        
    });

    // validate signup form on keyup and submit
        $("#registerForm").validate({
            rules: {
                name: "required",
                mobile: {
                    required: true,
                    minlength: 10,
                    maxlenght: 10,
                    digits: true
                },
                
              
                email: {
                    required: true,
                    email: true,
                    remote: "check-email"
                },
                password: {
                    required: true,
                    minlength: 5
                },
              
            },
            messages: {
                name: "Please enter your name",
    
                mobile: {
                    required: "Please enter your mobile",
                    minlength: "Your mobile must consist of 10 digits",
                    maxlength: "Your mobile must consist of 10 digits",
                    digits: "Please enter your valid mobile"
                },
                email: {
                    required: "Please enter your email",
                    email: "Please enter your valid email",
                    remote: "Email already exists"
                },
                password: {
                    required: "Please choose your password",
                    minlength: "Your password must be at least 5 characters long"
                },
                
              
            }
        });

        // validate login form on keyup and submit
        $("#loginForm").validate({
            rules: {

              
                email: {
                    required: true,
                    email: true,

                },
                password: {
                    required: true,
                    minlength: 5
                },
              
            },
            messages: {

                email: {
                    required: "Please enter your email",
                    email: "Please enter your valid email",

                },
                password: {
                    required: "Please choose your password",
                    minlength: "Your password must be at least 5 characters long"
                },
                
              
            }
        });

        // validate account form on keyup and submit
        $("#accountForm").validate({
            alert('salam');
            rules: {
                name: {
                    required: true,
                    accept: "[a-zA-Z]+",
                },
                mobile: {
                    required: true,
                    minlength: 10,
                    maxlenght: 10,
                    digits: true
                },
                
              
            },
            messages: {
                name: {
                    required: "Please enter your name",
                    accept: "Please enter valid name",
                },
    
                mobile: {
                    required: "Please enter your mobile",
                    minlength: "Your mobile must consist of 10 digits",
                    maxlength: "Your mobile must consist of 10 digits",
                    digits: "Please enter your valid mobile"
                },
                
              
            }
        });

});