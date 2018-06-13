/**
 * author yaojia 2016.3.1
 *根据cookie渲染询单列表。
 */

define(function(require, exports) {

    var cookieName = "place_list";
    require('cookie');

    console.log('is_place_in_cookie', $.cookie(cookieName));
    var localplaceArr = (function() {
        var localplaceArr;

        if ($.cookie(cookieName) === 'undefined' || $.type($.cookie(cookieName)) !== 'string') {
            return []
        }

        localplaceArr = $.parseJSON($.cookie(cookieName))

        return localplaceArr

    })()


    var len = localplaceArr.length;

    console.log(len)


    if (len > 0) {
        $('.has_enquiry').removeClass('hide');
        $('.number').text(len);
        var html = '';
        $.each(localplaceArr, function(k, v) {

            html += '<li><a href="/place/view/' + v.id + '" target="_blank">' + v.name + '</a></li>'

        })

        $('#place_list_from_cookie').html(html)


    } else {

        $('.no_enquiry').removeClass('hide');
        $('.number').text(len)


    }

});
