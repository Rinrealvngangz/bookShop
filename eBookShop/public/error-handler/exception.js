(function($) {
    $.fn.handlerError =function (data){
        $('#overlay').hide();
        var nameKey = [];
        var nameValue = [];
        var dataError = data.responseJSON.errors;
        $.map(dataError, function (value, key) {
            nameKey.push(key);
            nameValue.push(value);
        });
        $.each(nameKey, function (index, value) {

            $('input[id=' + value + ']').addClass('is-invalid');

            $('div.invalid-feedback.' + nameKey[index]).append(nameValue[index]);
            //console.log(htmlError);
        })
        //remove valid
        $.each(nameKey, function (index, value) {
            setTimeout(function () {
                $('input[id=' + value + ']').removeClass('is-invalid');
                $('div.invalid-feedback.' + nameKey[index]).html('');
            }, 3000)
        })
    }
})( jQuery );
