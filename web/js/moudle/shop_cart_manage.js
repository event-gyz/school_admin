/*********************************购物车管理********************************************************/
/*cookie 顺序  ["12947334,85,10,2016-08-23,2016-08-24,427"]，room_id，place_id，number，checkin，checkout，price; */
define(function(require, exports, module) {
require('cookie');
require('layer');
require('Handlebars');


var shopCartManage = {
    data: [],
    timer:null,
    roomIds:[// {'palce_id,room_id,number,checkin,checkout','price'}
    ],
    template: '<h5>购物车<span id="Jnumber" class="num">{{this.length}}</span></h5>' 
    + '<ul id="JshopCartList" class="down_list">' 
    + '{{#each this}}<li><img width="25" height="25" src="http://api.eventown.com{{pic_url}}">{{house_type}} <i data-btn="{{room_id}}" id="{{@index}}" class="rm">-</i>'
    + '<p>¥{{price}}/天  数量:{{number}}  {{place_name}} </p>'
    + '</li>{{/each}}' 
    + '</ul>'
    + '<button  class="btn btn-lg btn-block btn_yellow"  id="Jsubmit" >下一步</button>'
    ,options: {
        postUrl: '/Cart/submit',
        getListByIdsUrl:'/tuanfang/cart/get-list-by-ids',
        jumpUrl: '/tuanfang/cart',
        cookieName : 'rooms_list_store',
        delay:2e3,
    }
    ,init: function(elContainer) {
        this.container=$(elContainer)
        this.container.html('购物车列表加载中...')
        this.getShopData()
        this.bindEvt()
        }
        //获取购物车数据 from cookie or redis then getInfo
    ,getShopData: function() {
          var cookieData = $.cookie(this.options.cookieName);
            if (typeof cookieData !== 'undefined' &&  cookieData!='') {
                this.roomIds=$.parseJSON($.cookie(this.options.cookieName));
                $.post(this.options.getListByIdsUrl,{roomIds:this.roomIds.length==0?'':this.roomIds},$.proxy(this._setData,this),'json')
                return
            }


//        else
//        {
//            var cookieData = $.cookie(this.options.cookieName);
//            if (typeof cookieData !== 'undefined') {
//                this.roomIds=$.parseJSON($.cookie(this.options.cookieName));
//                $.post(this.options.getListByIdsUrl,{roomIds:this.roomIds.length==0?'':this.roomIds},$.proxy(this._setData,this),'json')
//            }else{
//                //没登录 没cookie
//                /**************测试代码待删除**************/
//                this._setData({errorno:-1})
//                /**************测试代码待删除**************/
//            }
//        }
}
    ,_setData:function(res){
        if(res.errorno==0){
                this.data=res.data;
                this.randerListbyData();
                this.setAddBtnDisabled();
            }else{
               this.container.html('购物车空空的')
            }
    }
    //渲染购物车dom
    ,randerListbyData: function() {
        //更新数量
       this.showCount()

        //更新列表
        var source = this.template;
        var template = Handlebars.compile(source);
        this.container.html(template(this.data));
        this.setAddBtnDisabled()
    },

    setAddBtnDisabled:function(){
        $.each(this.data,function(k,v){
            $('#btn'+v.room_id).addClass('disabled')
        })
    }

    //添加房间 直接操作数据
    ,addRoom: function(data) {

    this.data.push(data)
    this.showCount()
    this.updateCookie()
    //添加数据 更新dom 这里可以优化 为展开时渲染一次
    this.randerListbyData()
    }
    ,removeRoom: function(e) {
        var btn =$(e.target),index=btn.attr('id'),
        dataBtn=btn.attr('data-btn')
        p= $(btn).parents('li'),
        index=p.index();
        console.log(index)
        p.animate({
            height:0,
            opacity:0
        },function(){
            $(this).remove()
        })

       $('#btn'+dataBtn).removeClass('disabled');
       this.data.splice(index, 1);
        // this.randerListbyData()
        this.updateCookie()
        this.showCount()
        this.toggleSubmitBtn()
    }
    ,toggleSubmitBtn:function(){

        this.data.length == 0 ? $('#Jsubmit').attr('disabled','disabled'):$('#Jsubmit').removeAttr('disabled')

    }
    ,updateCookie:function(){


        var arr=[];
        $.each(this.data,function(k,v){
           var strItem=v.room_id+','+ v.place_id+','+ v.number+','+ v.checkin+','+ v.checkout+','+ v.price;
            arr.push(strItem);
        })
     var str = JSON.stringify(arr);

    //写入cookie
        $.cookie(this.options.cookieName, str, {
            path: "/",
            expires: 7
        });

    }
    ,showCount:function(){
        var count = this.data.length
        $('.floatBtn .number').text(count)
        $('#Jnumber').text(count)
        return count
    }
    ,showCount:function(){
        var count = this.data.length
        $('.floatBtn .number_cart').text(count)
        $('#Jnumber').text(count)
        return count
    }

    ,computedRoomIdsFormData:function(){
     shopCartManage.roomIds=[]
     var _this=this;
        //计算抽取roomIDs
         this.roomIds=[]
        $.each(this.data,function(k,v){
           var strItem=v.room_id+','+ v.place_id+','+ v.number+','+ v.checkin+','+ v.checkout;
            _this.roomIds.push(strItem);
        })

        this.updateCookie()
        return this.roomIds.length==0?'':this.roomIds

    }

    ,submitOrder: function(e) {
        var _this = this;
        $(e.target).text('提交中...').addClass('disabled');
        location.href = _this.options.jumpUrl

    }

    ,bindEvt:function(){
        $(this.container).on('click', '.rm', $.proxy(this.removeRoom,this))
        $(this.container).on('click', '#Jsubmit', $.proxy(this.submitOrder,this))
    }



}

 module.exports = shopCartManage
})

