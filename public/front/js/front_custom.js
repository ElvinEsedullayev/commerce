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
                $('.getAttrPrice').html('Rs.'+resp);
            },
            error:function(){
                alert('Error');
            }
        });
    });

});