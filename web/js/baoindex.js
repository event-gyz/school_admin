define(function(require, exports) {
    require('jquery');
    require('layer');
    require('/js/dropdown.js');
    var cityLayer=require('/js/citylayer.js').cityLayer;
    require('layer');
    layer.config({
        path:'//links.eventown.com.cn/vendor/layer/'
    })
    var newcitylayer=new cityLayer('#searchCity','#evt_cityLayer',{
        'hiddenInput':'#cityid',
        'triggerElem':'#cityIcon'
    });
    newcitylayer.idAttr=function(obj){
            var id=$(obj).attr('data-city_id');
            var txt=$(obj).text();
            if(id!=undefined){
                $(this.opt.hiddenInput).val(id).attr('cityName',txt);
                $(this.target).val(txt);
                this.hide();
            }
    }

   /**城市搜索start**/

})

//返回顶部
$(function() {
    'use strict';

    $.fn.toTop = function(opt) {

        //variables
        var elem = this;
        var win = $(window);
        var doc = $('html, body');

        //Extended Options
        var options = $.extend({
            autohide: true,
            offset: 420,
            speed: 500,
        }, opt);

        elem.css({
            'cursor': 'pointer'
        });

        if (options.autohide) {
            elem.css('display', 'none');
        }

        if (options.position) {
            elem.css(
                'display', 'block'
            );
        }

        elem.click(function() {
            doc.animate({ scrollTop: 0 }, options.speed);
        });

        win.scroll(function() {
            var scrolling = win.scrollTop();

            if (options.autohide) {
                if (scrolling > options.offset) {
                    elem.fadeIn(options.speed);
                } else elem.fadeOut(options.speed);
            }

        });

    };

}(jQuery));
$('.elevator-top').toTop();
