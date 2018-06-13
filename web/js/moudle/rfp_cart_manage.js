/*********************************询单车管理********************************************************/

define(function(require, exports, module) {
require('cookie');
require('layer');
require('Handlebars');


var shopCartManage = {
    data: [],
    timer:null,
    roomIds:[// {'palce_id,room_id,number,checkin,checkout','price'}
    ],
    template: '<h5>询单车</h5>'
    + '<ul id="JshopCartList" class="down_list">'
    + '{{#each this}}<li>{{name}} <i data-btn="{{place_id}}" id="{{place_id}}" class="rm">-</i>'
    + '</li>{{/each}}'
    + '</ul>'
    ,options: {
        cookieName : 'selectItem',
        delay:2e3,
    }
    ,init: function(elContainer) {
        this.container=$(elContainer)
        this.container.html('询单车列表加载中...')
        this.getShopData()
        this.bindEvt()
        }
        //获取购物车数据 from cookie or redis then getInfo
    ,getShopData: function() {
          var cookieData = $.cookie(this.options.cookieName);
          this.placeData=$.parseJSON($.cookie(this.options.cookieName));
          if(this.placeData != null){
              var objLength = Object.keys(this.placeData).length;
          }else{
              var objLength = 0;
          }

          if(objLength > 0){
               var newObj = Object();
               newObj = this.placeData;
               $.each(this.placeData, function(k,v) {
                    var name = k.split("_")
                    newObj[k].place_id = name[1]
               })
              this.data = newObj;
              this.randerListbyData();
              this.setAddBtnDisabled();
          }else{
             this.container.html('询单车空空的')
          }
}
    //渲染询单车dom
    ,randerListbyData: function() {
        //更新数量
       this.showCount();

        //更新列表
        var source = this.template;
        var template = Handlebars.compile(source);
        this.container.html(template(this.data));
        this.setAddBtnDisabled()
    },

    setAddBtnDisabled:function(){
        $.each(this.data,function(k,v){
            $('#btn'+v.place_id).addClass('disabled')
        })
    }

    ,removeRoom: function(e) {
        var btn =$(e.target),index=btn.attr('id'),
        dataBtn=btn.attr('data-btn')
        p= $(btn).parents('li'),
        index=p.index();
        p.animate({
            height:0,
            opacity:0
        },function(){
            $(this).remove()
        })
       $('#'+dataBtn).removeClass('checked');
       this.updateCookie(dataBtn)
        delete this.data['hotel_'+ dataBtn]
//        this.data.splice(index, 1);
        this.randerListbyData()

        this.showCount()
    }
    ,updateCookie:function(id){
        var cookieItem = JSON.parse( $.cookie('selectItem') || '{}' );
        delete cookieItem['hotel_'+ id]
        cookieItem = JSON.stringify(cookieItem)
        $.cookie('selectItem', cookieItem ,{ expires: 7, path: '/' });
        var outTestCookie = JSON.parse( $.cookie('selectItem') );

    }
    ,showCount:function(){
        var count = Object.keys(this.placeData).length;
        $('.floatBtn .number_cart').text(count)
        return count
    }



    ,bindEvt:function(){
        $(this.container).on('click', '.rm', $.proxy(this.removeRoom,this))
        $(this.container).on('click', '#Jsubmit', $.proxy(this.submitOrder,this))
    }



}

 module.exports = shopCartManage
})

