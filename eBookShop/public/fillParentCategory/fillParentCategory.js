(function($) {
    $.fn.fill_parent_category =function (data){
        $.ajax({
            url:'category/create',
            success:function(data){
                $('#parent_id').html(data);
            }
        })
    }
})( jQuery );
