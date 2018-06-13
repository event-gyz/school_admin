var storage=window.localStorage;
var time=new Date();
var month,day;
if(time.getMonth()+1<10){
  month="0"+(time.getMonth()+1);
}else{
  month=time.getMonth()+1;
}
if(time.getDate()<10){
    day="0"+time.getDate();
}else{
    day=time.getDate();
}
// var timestring=time.getFullYear()+"-"+month+"-"+day+" "+time.getHours()+":"+time.getMinutes()+":"+time.getSeconds();
// var endtime=time.getFullYear()+"-"+month+"-"+day+" "+time.getHours()+":"+time.getMinutes()+":"+time.getSeconds();
if($("#start").val() === ""){
    $("#start").val(laydate.now(0, 'YYYY-MM-DD hh:mm:ss'));
}
var start = {
    elem: '#start',
    event:"click",
    format: 'YYYY-MM-DD hh:mm:ss',
    min: laydate.now(0, 'YYYY-MM-DD hh:mm:ss'), //设定最小日期为当前日期
    max: $('#end').val() !== '' ? $('#end').val() : '2099-06-16 23:59:59', //最大日期
    istime: true,
    istoday: false,
    choose: function(datas){
        end.min = datas; //开始日选好后，重置结束日的最小日期
        end.start = datas //将结束日的初始值设定为开始日
    }
};

var end = {
    elem: '#end',
    format: 'YYYY-MM-DD hh:mm:ss',
    // min: endtime,
    min: $("#start").val() > laydate.now(0, 'YYYY-MM-DD hh:mm:ss') ? $("#start").val() : laydate.now(0, 'YYYY-MM-DD hh:mm:ss'),
    max: '2099-06-16 23:59:59',
    istime: true,
    istoday: false,
    choose: function(datas){
        start.max = datas; //结束日选好后，重置开始日的最大日期
    }
};

// 创建

$(".food_info").on("change",".food_food",function(){
    var odtype=$(this).parents("tbody").find(".food_dtype");
    if($(this).val()=="午餐" || $(this).val()=="晚餐"){
       createoption(odtype,1);
    }
    else{
        createoption(odtype,2); 
    }
})

$(".yaoqiu").on("click",".Add",function(){
    if($(this).hasClass("hc")){
        creatediv("huichang","hc"); 
    }else if($(this).hasClass("cy")){
        creatediv("canyin","cy"); 
    }else{
        creatediv("zhusu","zs"); 
    }
})
$(".yaoqiu").on("click",".Del",function(){
    $(this).parent().remove();
    //$(this).parents(".binfomation").children("div:last-child").remove();
})
// 创建option
function createoption(odtype,type){
   var length=odtype.children().length;
   var aoption=odtype.find('option');
   if(length!=1){
       for(var i=length-1;i>0;i--){
        aoption[i].remove();
       }
   }
   if(type==1){
     odtype.append("<option value='Set Meal桌餐'>Set Meal桌餐</option><option value='Buffet自助'>Buffet自助</option>")
   }else{
     odtype.append("<option value='茶歇'>茶歇</option>")
   }  
}
// 创建
function creatediv(obj,obj2){
    var textareaConfig = {
        "huichang":"meet_info[]",
        "canyin":"food_info[]",
        "zhusu":"room_info[]"
    };
    var textareaName = textareaConfig[obj];
    var div=$("<div></div>");
    var input=$('<textarea name="'+textareaName+'" type="text" rows="1"></textarea>');
    var add=$('<input type="button" value="'+adds+'" class="button Add">');
    add.addClass(obj2);
    var Delete=$('<input type="button" value="'+dels+'" class="button Del">');
    div.append(input);
    div.append(add);
    div.append(Delete);
    $("."+obj).append(div);
}



$('#search_btn').click(function(){
    layer.open({
        type: 2,
        title: selectHotel,
        shadeClose: true,
        shade: false,
        maxmin: true, //开启最大化最小化按钮
        area: ['1100px', '600px'],
        content:['/sendrfp/selectmini?cookiePrefix=brfp_place_&inviteId='+inviteId+'&type=1','no'],
        btn:[selected],
        yes:function(){
            layer.load();
            var StrCookieData =storage.getItem(cookieName);
            console.log(StrCookieData);
            if(StrCookieData){
                var objectCookieData = JSON.parse(StrCookieData)
                if( StrCookieData.length > 0 ){
                    $(".hotelClassForJs").show()
                    $("#bchangeprice").hide()
                }
                var hotelHtml = creatDivForHotel(objectCookieData);
                statisPlace(objectCookieData);
                $(".showHotel").html(hotelHtml);
            }
            layer.closeAll()
//                $.get('/novartis/meeting/get-place',{ cookieName:cookieName },function(data){
//                    if( data.status == 0 ){
//                        var hotelHtml = creatDivForHotel(data.data)
//                        $(".showHotel").html(hotelHtml);
//                        layer.closeAll()
//                    }
//                })
        },
    });
})

$(".Hotel").delegate("[data-action='hotelDelete']","click",function(){
    var StrstorageData = storage.getItem(cookieName);
    var CookieData = $.cookie(cookieName);
    var objectstorageData = JSON.parse(StrstorageData);
    var objectCookieData= JSON.parse(CookieData);
    var placeId = $(this).attr("data-id");
    $.each(objectstorageData, function (k, v) {
        if ($.type(v) !== 'undefined' && v.id == placeId) {
            objectstorageData.splice(k, 1);
        }
    })
    $.each(objectCookieData, function (k, v) {
        if ($.type(v) !== 'undefined' && v.id == placeId) {
            objectCookieData.splice(k, 1);
        }
    })
    var storgestr = JSON.stringify(objectstorageData);
    var cookiestr = JSON.stringify(objectCookieData);
    $.cookie(cookieName, cookiestr, {
        path: "/",
        expires: 7
    });
    storage.setItem(cookieName,storgestr);
    console.log($.cookie(cookieName));
    console.log(storage.getItem(cookieName));
    $(this).parents(".hotelInformation").remove()
    statisPlace(objectstorageData);
})

$("#bchangeprice").click(function(){
    $("#search_btn").click();
})

function creatDivForHotel(data){
    var html='';
    var tmpHtml='';
    
    $.each(data,function(i,item){
        var isProtocol = '';
        if( item.type == 2 ){
            isProtocol = '<span class="dis xieyi">'+notProtocol+'</span>'
        }
        tmpHtml = '<div class="hotelInformation col-md-12 col-lg-3">'
            +'<span><span class="itemname">'+item.name+'</span>'+isProtocol+'</span><br>'
            +'<span class="hotelAddress">'+item.address+'</span>'
            +'<input type="hidden" name="place_id[]" value="'+item.id+'">'
            +'<span class="hotelDelete" data-id="'+item.id+'" data-action="hotelDelete">'+dels+'</span>'
        +'</div>';
        html += tmpHtml;
    })
    return html;
}
/**
 * 
 * @param {type} data
 * @returns {object}
 */
function statisPlace(data){
    var staticPlaceData = { 
        "protocol":0,
        "disprotocol":0,
        "total":0
    };
    $.each(data,function(k,v){
        if( v.type == 2 ){
            staticPlaceData.disprotocol = parseInt(staticPlaceData.disprotocol) + 1;
        }else if( v.type == 1 ){
            staticPlaceData.protocol = parseInt(staticPlaceData.protocol) + 1;
        }
    });
    staticPlaceData.total = data.length;
    $("#protocol").text(staticPlaceData.protocol);
    $("#disprotocol").text(staticPlaceData.disprotocol);
    $("#total").text(staticPlaceData.total);
    return staticPlaceData;
}
var layerIndex;
var uploader = WebUploader.create({
    // swf文件路径
    swf:'/js/Uploader.swf',
    // 文件接收服务端。
    server: '/novartis/meeting/upload',
    // 选择文件的按钮。可选。
    // 内部根据当前运行是创建，可能是input元素，也可能是flash.
    pick: {
        id:"#demand_url",
        multiple:false,
        label:'<span><i class="fa fa-plus"></i>'+uploadFile+'</span><span></br></span>'+needs,
    },
    // 不压缩image, 默认如果是jpeg，文件上传前会压缩一把再上传！
    resize: false,
    auto:true,
    accept:{
        title:"intoTypes",
        extensions:"xls,xlsx",
        mimeTypes:".xls,.xlsx"
    }
});
uploader.on( 'fileQueued', function( file ) {
    layerIndex = layer.load();
});
uploader.on( 'uploadSuccess', function( file,response ) {
//        console.log(response);
//        console.log(file.name);
    $("#fileName").text(filename+"："+response.fileName);
    $("[name='excel_name']").val(response.fileName);
    $('[name="excel"]').val(response.fileLink);

    $(".showExcel").show();
    $("#demands_upload").hide();

    $(".delete").click(function(){
        uploader.removeFile(file);
    });

    layer.close(layerIndex);
});


$(".delete").click(function(){
    $("[name='excel_name']").val('');
    $('[name="excel"]').val('');

    $(".showExcel").hide();
    $("#demands_upload").show();

    uploader.refresh();
});


$(".reset").click(function(){
    $(".webuploader-element-invisible").click();
})

$('[data-action="meeting-type"]').click(function(){
    var meetingType = $(this).attr("data-value");
    $(".hotel_active").hide();
    $(this).siblings().find(".form-control").removeClass("active");
    $(this).find(".hotel_active").show();
    $(this).find(".form-control").addClass("active");

    $('[name="meeting_type"]').val(meetingType);
})

$("#send_rfp").click(function(){
    var indexLoad = layer.load();
    $.get("/novartis/meeting/send?id="+id+"&cookieName="+cookieName,function(data){
        layer.close(indexLoad);
        if(data.status == 1){
            $.cookie(cookieName, '', {
                path: "/",
                expires: -1
            });
            storage.clear();
            window.location.href="/novartis/meeting/success";
        }else{
            layer.alert(data.msg);
        }
    })
})

function initHotel(){
    var StrCookieData = storage.getItem(cookieName)

    if(StrCookieData ==null){
        return false;
    }
    $("#bchangeprice").hide();
    $(".hotelClassForJs").show();
    var objectCookieData = JSON.parse(StrCookieData);

    if( objectCookieData.length == 0 ){
        $("#bchangeprice").show();
        $(".hotelClassForJs").hide();
    }
    var hotelHtml = creatDivForHotel(objectCookieData);
    statisPlace(objectCookieData);
    $(".showHotel").html(hotelHtml);
}
function getQueryString(name) { 
    var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i"); 
    var r = window.location.search.substr(1).match(reg); 
    if (r != null) return unescape(r[2]); return null; 
} 
$(function(){
    if(getQueryString("id")){
        var id=getQueryString("id");
        var ali=$(".dropdown-menu").find("li");
        for(var i=0;i<ali.length;i++){
           if($(ali[i]).attr("data-demand-id")==id) {
            $("#historyText").html($(ali[i]).find("a").html());
           }
        }
    }

})

$('#w0').change(function (e) {
    window.location.href = "/novartis/meeting/create?id="+$(this).val();
});
