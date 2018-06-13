
/*********************************询单列表管理********************************************************/
/* 早知道这里用mvvm框架来写。。jq...- - !!!
*$countDom: 显示数量的dom节点
*$shopCart: 列表容器
*$addBtn:  添加按钮
*$rmBtn:   删除按钮
*/


define(function(require,exports,module){

var shopCartManage = require('/js/moudle/rfp_cart_manage.js')
shopCartManage.init('#shopCartBox')
require('cookie');

 var Asklist = (function() {

        var cookieName = "selectItem";
        var cookieNum = 0;
        var place_list_arr = window.place_list_store || (function(){
            var cookie=$.cookie(cookieName);
            var cookieObj= eval("(" + cookie+ ")");
            cookieNum = getJsonLength(cookieObj)
            if(typeof cookie === 'undefined'){
                return []
            }
            return  $.parseJSON($.cookie(cookieName))
        })(); //直接从全局拿一次
        var count =0;

        var opt={
            $countDom:$('.enquiry-box .number') || opt.countDom ,
            $shopCart:$('#place_list_from_cookie') || opt.shopCart,
            $addBtn:$('.add-btn'),
            $rmBtn:'.rmlist'
        }

        function getJsonLength(jsonData) {
            var jsonLength = 0;
            for (var item in jsonData) {
                jsonLength++;
            }
            return jsonLength;
        }


            var isPlaceSelected = function(id) {
                var isIn=false;
                if (cookieNum > 0) {
                    $.each(place_list_arr, function(k, v) {
                        if (k == 'hotel_'+id) {
                            isIn=true
                        }
                    })
                }

                return isIn
            }

            if(isPlaceSelected(opt.$addBtn.attr('id'))){
                opt.$addBtn.addClass('checked')
            }
            var setCookie = function(arr) {
                var cookieItem = JSON.parse( $.cookie('selectItem') || '{}' );
                var place_id = arr[0].id;
                var place_name = arr[0].name;


                cookieItem['hotel_'+ place_id] = { name:place_name,type:'所有酒店' }

                cookieItem = JSON.stringify(cookieItem)

                $.cookie('selectItem', cookieItem ,{ expires: 7, path: '/' });
                var outTestCookie = JSON.parse( $.cookie('selectItem') );
            }



              var add= function(place_id, place_name, callback) {
                      var push_arr = new Array();
                      var push_arr_son = new Array();
                      push_arr_son.id  = place_id;
                      push_arr_son.name  = place_name;
                      push_arr[0] = push_arr_son;
                     $('.has_enquiry').removeClass('hide');
                     $('.no_enquiry').addClass('hide');

//限制可以加入询单车的场地数量
//                   if(cookieNum>=5){
//                      layer.msg('最多选择5个场地',{offset:60,shift:6});
//                       callback.call(null, false)
//                        return
//                    }



                    if (!isPlaceSelected(place_id)) {

                        if ($.type(callback) == 'function') {
                            callback.call(null, true)
                        }
                        setCookie(push_arr);
                        shopCartManage.getShopData();
                        $(document).trigger('add');
                    }else{

                         layer.msg('场地已存在！',{offset:60,shift:6});
                         callback.call(null, false)
                         return
                    }

                }
             var    rm= function(place_id, callback) {
                    if (place_list_arr.length > 0) {
                        $.each(place_list_arr, function(k, v) {
                            if ($.type(v) !== 'undefined' && v.id == id) {
                                place_list_arr.splice(k, 1);
                            }

                        })

                        setCookie(place_list_arr);


                         $(document).trigger('rm',place_id);

                          $('#place-'+place_id).remove();


                        if ($.type(callback) == 'function') {
                            callback.call(null, true)
                        }
                    }

                }

            var  getResult=function(callback) {
                    var placeIdArr = $.cookie(cookieName);
                    callback(placeIdArr);
                }


             module.exports={

                init:function(opts){

                if(opts){
                    $.extend(opt,opts)
                }

                opt.$addBtn.on('click',function(){
                    var _btn=$(this);
                    if(_btn.attr('id') || _btn.attr('name')){

                        add(_btn.attr('id'), _btn.attr('name'),function(boolen){

                            if(boolen){
                                _btn.addClass('checked');
                            }
                        });

                    }else{
                        throw new Error('请为按钮添加id和name属性，对应场地ID，场地名称')
                    }


                })

                opt.$shopCart.delegate(opt.$rmBtn ,'click',function(){
                    var _id=$(this).attr('id');
                    if(_id){
                        rm(_id);
                        $(this).parent('li').remove();
                        $('#'+_id).removeClass('checked');

                    }

                })

             },
             place_list_arr:place_list_arr,
             add:add,
             rm:rm

         }



})()


})




