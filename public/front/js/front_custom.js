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
        var url = $('#url').val();
        //alert(url);
        $.ajax({
            url:url,
            method:'Post',
            data:{fabric:fabric,sort:sort,url:url},
            success:function(data){
                $('.filter_products').html(data);
            },
        });
    });

    $('.fabric').on('click',function(){
        var fabric = get_filter(this);
        var sort = $('#sort option:selected').text();
        //alert(sort);
        var url = $('#url').val();
        //alert(url);
        $.ajax({
            url:url,
            method:'Post',
            data:{fabric:fabric,sort:sort,url:url},
            success:function(data){
                $('.filter_products').html(data);
            },
        });
    });

    function get_filter(class_name){
        var filter = [];
        $('.'+class_name+':checked').each(function(){
            filter.push($(this).val());
        });
        return filter;
    }
});