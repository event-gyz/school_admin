
window.console.log(common_data.option_meet_type,'============');

var meetingmodel = avalon.define({
    $id: "meetingroom",
    meetingroom:$.extend({
        '0': '选择会议室'
    }, common_data.option_meet_type),
    data: common_data.meet_info.data.length == 0 ? [{
        type: 0,
        price: 0
    }] : common_data.meet_info.data,
    note: common_data.meet_info.note,
    offer_note: common_data.meet_info.offer_note || '',
    // price: common_data.meet_info.price,
    rmClick: function(index) {
        if (meetingmodel.data.size() > 1) {
            meetingmodel.data.removeAt(index)
        }else{
            layer.msg('请至少保留一项')
        }
        scanPrice();
    },
    addClick: function() {
        meetingmodel.data.push({
            type: 0,
            price: 0
        })
    }

})


//设备
var meet_equi = avalon.define({
    $id: "meet_equipment_info",
    data: common_data.meet_equipment_info.data,
    note: common_data.meet_equipment_info.note,
    user_data: common_data.meet_equipment_info.equipment,
    offer_note: common_data.meet_equipment_info.offer_note,
    price: common_data.meet_equipment_info.price || 0
})



//餐饮信息
var food = avalon.define({
    $id: "food",
    data: common_data.food_info.data,
    note: common_data.food_info.note,
    offer_note: common_data.food_info.offer_note,
    price: common_data.food_info.price,
     hasData:function(){
        return common_data.food_info.data.length>0;
    },

    change: function(index) {
        food.data[index].total_price = food.data[index].price * food.data[index].people * food.data[index].meal;
    }

})

//房间 住宿
var room = avalon.define({
    $id: "room",
    roomNumber: $('#roomNumber').text(),
    data: common_data.room_info.data,
      hasData:function(){
        return common_data.room_info.data.length>0;
    },

    option: $.extend({
        '0': '选择房间类型'
    }, common_data.option_room_type),
    $note: common_data.room_info.note,
    offer_note: common_data.room_info.offer_note,
    price: common_data.room_info.price,
    change: function(outerindex, index) {

        room.data[outerindex].room_info_price[index].total_price =
            room.data[outerindex].night * room.data[outerindex].room * room.data[outerindex].room_info_price[index].price

    },
    totalPice: function() {
        return (parseInt(room.roomNumber) || 0) * (parseInt(room.price) || 0)
    },
    addClick: function(index) {
        room.data[index].room_info_price.push({
            type: -1,
            price: 0,
            total_price: 0
        })
    },
    rmClick: function(outer, index) {
           if ( room.data[outer].room_info_price.size() > 1) {
        room.data[outer].room_info_price.removeAt(index);

        scanPrice()
    }
    },

})


var others = avalon.define({
    $id: "others",
    data: common_data.other_info.data,


    rmClick: function(index) {

        if (others.data.size() > 0) {
            others.data.removeAt(index);

            scanPrice()


        }

    },
    addClick: function() {
        others.data.push({
            value1: '项目名称',
            value2: 0
        })
    }

})




var allPice = avalon.define({
    $id: "allprice",
    totalPrice: common_data.total_price || 0, //总价
    rebatePrice: common_data.rebate_price || 0, //折后价
    postData: function() {
        var postData = {}
        postData.map_id = common_data.map_id
        postData.offer_id = common_data.offer_id
        postData.meet_price = {
            data:meetingmodel.$model.data,
            offer_note:meetingmodel.offer_note
        }
        postData.food_info = {
            data:food.$model.data,
            offer_note:food.$model.offer_note
        }
        postData.room_info = {
            data:room.$model.data,
            offer_note:room.offer_note
        }

        postData.other_price = {
            data:others.$model.data
        }

        postData.total_price = allPice.totalPrice
        postData.rebate_price = allPice.rebatePrice

        postData.meet_equipment_info = {
            data:meet_equi.$model.data,
            price:meet_equi.price,
            offer_note:meet_equi.offer_note
        }

        var meetPrice=true;
        $.each(postData.meet_price.data,function(k,v){


                if(v.type == 0){
                    layer.msg('请选择会议室,如果无请先添加，否则无法报价！');
                    meetPrice=false;
                    return false;
                }            
        })
        if(!meetPrice){
            return false;
        }


        // $.each(postData.room_info.data,function(k,v){
        //     $.each(v.room_info_price,function(k,v){
        //         if(v.type <= 0){
        //             layer.msg('住宿房间报价中请选择房间类型');
        //             meetPrice=false;
        //             return false;
        //         }    
        //     })
        // })

layer.load(1);

        $.post('/rfp/offer-save', postData, function(res) {

            layer.closeAll();

            if(res.errorno==0){
                  layer.msg('保存成功');

            }
            else{
                  layer.msg('保存失败')
            }

            setTimeout(function(){
                history.go(-1);
            },3000)
          
              
        }, 'json')
    }
})


function scanPrice() {

    allPice.totalPrice = (function() {
        var price = 0;
        //会议室报价
        $.each(meetingmodel.$model.data, function(k, obj) {
            price += parseInt(obj.price)
        })


        //设备报价
        price += parseInt(meet_equi.$model.price) || 0;

        // price+=parseInt(room.totalPice())
        // price+=parseInt(food.totalPice())

        //餐饮报价

        $.each(food.$model.data, function(k, obj) {

            price += parseInt(obj.total_price) || 0


        })

        //住宿

        $.each(room.$model.data, function(k, obj) {


            $.each(obj.room_info_price, function(k, v) {

                price += parseInt(v.total_price) || 0

            })

        })

        //其它

        $.each(others.$model.data, function(k, obj) {
            price += parseInt(obj.value2) || 0;
            console.log(price)
        })

        return price
    })()

}


$(document).delegate('.number-limit', 'keyup', function() {
    var val = $(this).val();
    $(this).val($(this).val().replace(/\D/g, '').replace('/^[0]+/', '0'));
    if (val == '') {
        $(this).val(0);

        }
        scanPrice();
    })
