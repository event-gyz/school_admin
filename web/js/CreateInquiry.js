var Model,postDate,jsp=false;
var baseMeet_info=$.extend({},json.meeting_info);
json["gdarr"]=[{
    "name": "请选择会议室",
    "acreage": "",
    "venueL": "",
    "venueW": "",
    "venueH": "",
    "venueF": "",
    "herringbone": "",
    "classroom": "",
    "banquet": "",
    "pillar": "Y",
    "projectorLM": "",
    "screen_size": "",
    "uplink":"",
    "downlink":"",
    "ping":"",
    "facility_price": "0",
    "venue_rental_full_day": "",
    "venue_rental_half_day": "",
    "venue_rental_night_day": "",
    "virtual_meeting_4m_price": "",
    "virtual_meeting_10m_price": ""
}];
// //给飞机场合火车站添加默认值
// for(var i=0;i<json.place_rfi.traffic.airfild.length;i++){
//     if(json.place_rfi.traffic.airfild[i].airfildname==""){
//          json.place_rfi.traffic.airfild[i].airfildname="请选择飞机场";
//     }
//
// }
// for(var h=0;h<json.place_rfi.traffic.trainstation.length;h++){
//     if(json.place_rfi.traffic.trainstation[h].trainstationname==""){
//         json.place_rfi.traffic.trainstation[h].trainstationname="请选择火车站";
//     }
//
// }
//给会议包报价添加默认会议室
for(var i=0;i<json.meeting_package_price.length;i++){
    json.meeting_package_price[i]["meet_info_sl"]="请选择会议室";
}
if(json.meeting_price.length>0){
    json["gdarr"]=json.meeting_price;
}
json["free_facility_base"]="";
if(json.place_rfi.group_name=="0"){
    json.place_rfi.group_name="";
}
if(json.place_rfi.ast_repair_time=="0"){
    json.place_rfi.ast_repair_time="";
}
if(json.place_rfi.feature=="0"){
    json.place_rfi.feature="";
}
Model=new Vue({
    el:'#offer_content',
    data:json,
    methods:{
        add_plane:function(index){

                if(Model.place_rfi.traffic.airfild[index].airfildname=="" || Model.place_rfi.traffic.airfild[index].distance=="" || Model.place_rfi.traffic.airfild[index].drive==""){
                    layer.msg("暂时不能添加,请补全本条信息内容");
                }else{
                    Model.place_rfi.traffic.airfild.push({
                        "airfildname": "请选择飞机场",
                        "distance": "",
                        "drive": ""
                    })
                }
            
        },
        plane_change:function(value,index){
            if(value=="自定义飞机场"){
                this.$data.place_rfi.traffic.airfild[index].airfildname="";
            }
        },
        loadPlan:function(value){
            var bool=false;
            for(var i=0;i<this.$data.airfild.length;i++){
                if(this.$data.airfild[i].airport_name==value || value=="请选择飞机场"){
                    bool=true;
                }
            }
            return bool;
        },
        loadIp_plan:function(value){
            var bool=true;
            for(var i=0;i<this.$data.airfild.length;i++){
                if(this.$data.airfild[i].airport_name==value || value=="请选择飞机场"){
                    bool=false;
                }
            }
            return bool;
        },
        reduce_plane:function(index){
            if(Model.place_rfi.traffic.airfild.length==1){
                layer.msg("不能删了已经是最后一个了");
            }else{
                layer.confirm("确定要删除吗", {
                        title:"信息",
                        btn: ["是","再想一下"] //按钮
                    }, function(){
                        Model.place_rfi.traffic.airfild.splice(index,1);
                        layer.msg("删除成功", {icon: 1});
                    }, function(){
                        return;
                    }
                );
            }
        },
        add_train:function(index){
                console.log(Model.place_rfi.traffic[index]);
                if(Model.place_rfi.traffic.trainstation[index].trainstationname=='' || Model.place_rfi.traffic.trainstation[index].distance=='' || Model.place_rfi.traffic.trainstation[index].drive==''){
                    layer.msg("暂时不能添加,请补全本条信息内容");
                }else{
                    Model.place_rfi.traffic.trainstation.push({
                        "trainstationname": "请选择火车站",
                        "distance": "",
                        "drive": ""
                    })
                }
            
        },
        train_change:function(value,index){
            if(value=="自定义火车站"){
                this.$data.place_rfi.traffic.trainstation[index].trainstationname="";
            }
        },
        loadTrain:function(value){
            var bool=false;
            for(var i=0;i<this.$data.trainstation.length;i++){
                if(this.$data.trainstation[i].train_station_name==value || value=="请选择火车站"){
                    bool=true;
                }
            }
            return bool;
        },
        loadIp_train:function(value){
            var bool=true;
            for(var i=0;i<this.$data.trainstation.length;i++){
                if(this.$data.trainstation[i].train_station_name==value || value=="请选择火车站"){
                    bool=false;
                }
            }
            return bool;
        },
        reduce_train:function(index){
            if(Model.place_rfi.traffic.trainstation.length==1){
                layer.msg("不能删了已经是最后一个了");
            }else{
                layer.confirm("确定要删除吗", {
                        title:"信息",
                        btn: ["是","再想一下"] //按钮
                    }, function(){
                        Model.place_rfi.traffic.trainstation.splice(index,1);
                        layer.msg("删除成功", {icon: 1});
                    }, function(){
                        return;
                    }
                );
            }
        },
        isset:function(index){
            var rs=true;
            for(var i=0;i<this.$data.meeting_info.length;i++){
                if(this.$data.meeting_info[i].Name==this.$data.gdarr[index].name || this.$data.gdarr[index].name=="请选择会议室"){
                    rs=false;
                }
            }
            return rs;
        },
        isfist:function(index){
            var rs=false;
            for(var i=0;i<this.$data.meeting_info.length;i++){
                if(this.$data.meeting_info[i].Name==this.$data.gdarr[index].name || this.$data.gdarr[index].name=="请选择会议室"){
                    rs=true;
                }
            }
            return rs;
        },
        meet_price_change:function(value,index){
            if(value!="自定义会议室" && value!="请选择会议室"){
                for(var i=0;i<Model.meeting_info.length;i++){
                    if(Model.meeting_info[i].Name==value){
                        Model.gdarr[index].name=Model.meeting_info[i].Name;
                        Model.gdarr[index].acreage=Model.meeting_info[i].area;
                        Model.gdarr[index].venueH=Model.meeting_info[i].height;
                        Model.gdarr[index].venueL=Model.meeting_info[i].length;
                        Model.gdarr[index].venueW=Model.meeting_info[i].width;
                        Model.gdarr[index].venueF=Model.meeting_info[i].floor;
                        if(Model.meeting_info[i].HasPillar=="无"){
                            Model.gdarr[index].pillar="N";
                        }
                    }
                }
            }else if(value=="自定义会议室" || value=="" || value=="请选择会议室"){
                for(var i=0;i<Model.meeting_info.length;i++){
                    if(value=="请选择会议室"){
                        Model.gdarr[index].name='';
                    }else{
                        Model.gdarr[index].name='';
                    }
                    Model.gdarr[index].acreage='';
                    Model.gdarr[index].venueH='';
                    Model.gdarr[index].venueL='';
                    Model.gdarr[index].venueW='';
                    Model.gdarr[index].venueF='';
                    Model.gdarr[index].herringbone='';
                    Model.gdarr[index].classroom='';
                    Model.gdarr[index].banquet='';
                    Model.gdarr[index].pillar="Y";
                }
            }
        },
        add_meet:function(index){
            var bool=true;
            var arr=[];
            for(var i=0;i<Model.gdarr.length;i++){
                if(arr.indexOf(Model.gdarr[i].name)<0){
                    arr.push(Model.gdarr[i].name);
                }else{
                    bool=false;
                }
            }
            if(bool){
                if((Model.gdarr[index].name=="请选择会议室" || Model.gdarr[index].name=="") || Model.gdarr[index].acreage=="" || Model.gdarr[index].venueF=="" || Model.gdarr[index].venueL=="" ||
                    Model.gdarr[index].venueW=="" || Model.gdarr[index].venueH=="" ||  Model.gdarr[index].venue_rental_full_day=="" || Model.gdarr[index].venue_rental_half_day=="" ||
                    Model.gdarr[index].venue_rental_night_day=="" ){
                    layer.msg("暂时不能添加,请补全本条信息内容");
                }else{
                    Model.gdarr.push({
                        "name": "请选择会议室",
                        "acreage": "",
                        "venueL": "",
                        "venueW": "",
                        "venueH": "",
                        "venueF": "",
                        "pillar": "Y",
                        "projectorLM": "",
                        "screen_size": "",
                        "uplink":"",
                        "downlink":"",
                        "ping":"",
                        "facility_price": "0",
                        "venue_rental_full_day": "",
                        "venue_rental_half_day": "",
                        "venue_rental_night_day": "",
                        "virtual_meeting_4m_price": "",
                        "virtual_meeting_10m_price": ""
                    })
                }
            }else{
                layer.msg("您已经添加过该选项")
            }
        },
        delete_meet:function(index){
            if(Model.gdarr.length==1){
                layer.msg("不能删了已经是最后一个了");
            }else{
                layer.confirm("确定要删除吗", {
                        title:"信息",
                        btn: ["是","再想一下"] //按钮
                    }, function(){
                        Model.gdarr.splice(index,1);
                        layer.msg("删除成功", {icon: 1});
                    }, function(){
                        return;
                    }
                );
            }
        },
        add_new_item:function(event){
            var _this=event.currentTarget;
            $(_this).parents('.ConferTable').find(".select_packge").css('display',"inline-block");
            $(_this).parents('.ConferTable').find('.ConferButton').css('display',"inline-block");
        },
        add_packgeName:function(index,event){
            var _this=event.currentTarget;
            var nArr=Model.meeting_package_price[index]["name"];
            var rg=true;
            if(Model.meeting_package_price[index]["meet_info_sl"]=="请选择会议室"){
                rg=false;
                layer.msg("请选择会议室");
            }
            if(Model.meeting_package_price[index]["meet_info_sl"]==""){
                rg=false;
                layer.msg("请填写会议室");
            }
            for(var i=0;i<nArr.length;i++){
                if(nArr[i]==Model.meeting_package_price[index]["meet_info_sl"]){
                    rg=false;
                    layer.msg("已经添加过该会议室了");
                }
            }
            if(rg){
                $(_this).parents('.ConferTable').find(".select_packge").hide();
                $(_this).parents('.ConferTable').find('.ConferButton').hide();
                Model.meeting_package_price[index]["name"].push(Model.meeting_package_price[index]["meet_info_sl"]);
                Model.meeting_package_price[index]["meet_info_sl"]="请选择会议室";
            }
        },
        cancel_packgeName:function(index,event){
            var _this=event.currentTarget;
            $(_this).parents('.ConferTable').find(".select_packge").hide();
            $(_this).parents('.ConferTable').find('.ConferButton').hide();
            Model.meeting_package_price[index]["meet_info_sl"]="请选择会议室";
        },
        remove_pkItem:function(index,event){
            var _this=event.currentTarget;
            var _index=$(_this).parents('.ConferTable').attr("attr-index");
            Model.meeting_package_price[_index]["name"].splice(index,1);
        },
        add_equip:function(index){
            if( Model.equip_price[index].facility_name=="" || Model.equip_price[index].type=="" || Model.equip_price[index].brand=="" || Model.equip_price[index].unit=="" || Model.equip_price[index].unit_price==""){
                layer.msg("暂时不能添加,请补全本条信息内容")
            }else{
                Model.equip_price.push({
                    "facility_name": "",
                    "type": "",
                    "brand": "",
                    "unit": "",
                    "unit_price": ""
                })
            }
        },
        delete_equip:function(index){
            if(Model.equip_price.length==1){
                layer.msg("不能删了已经是最后一个了");
            }else{
                layer.confirm("确定要删除吗", {
                        title:"信息",
                        btn: ["是","再想一下"] //按钮
                    }, function(){
                        Model.equip_price.splice(index,1);
                        layer.msg("删除成功", {icon: 1});
                    }, function(){
                        return;
                    }
                );
            }
        },
        add_Car:function(index){
            for(var i=0;i<Model.other_price.vehicle_rental[index].all_route.length;i++){
                if(Model.other_price.vehicle_rental[index].all_route[i].per_time_price==""){
                    layer.msg("暂时不能添加,请补全本条信息内容");
                    return false;
                }
            }
            if(Model.other_price.vehicle_rental[index].type=="" || Model.other_price.vehicle_rental[index].seats=="" || Model.other_price.vehicle_rental[index].num==""){
                layer.msg("暂时不能添加,请补全本条信息内容");
            }else{
                Model.other_price.vehicle_rental.push({
                    "type": "",
                    "seats": "",
                    "num": "",
                    "all_route": [
                        {
                            "route": "接送机",
                            "per_time_price": "",
                            "remark": ""
                        },
                        {
                            "route": "接火车",
                            "per_time_price": "",
                            "remark": ""
                        },
                        {
                            "route": "包车",
                            "per_time_price": "",
                            "remark": ""
                        }
                    ]
                })
            }
        },
        delete_Car:function(index){
            if(Model.other_price.vehicle_rental.length==1){
                layer.msg("不能删了已经是最后一个了");
            }else{
                layer.confirm("确定要删除吗", {
                        title:"信息",
                        btn: ["是","再想一下"] //按钮
                    }, function(){
                        Model.other_price.vehicle_rental.splice(index,1);
                        layer.msg("删除成功", {icon: 1});
                    }, function(){
                        return;
                    }
                );
            }
        },
        add_OtherOk:function(){
            if(Model.free_facility_base==""){
                layer.msg("请输入您想添加的项目")
            }else{
                Model.other_price.free_facility.push(Model.free_facility_base);
                Model.free_facility_base="";
            }
        },
        remove_otherFree:function(index){
            Model.other_price.free_facility.splice(index,1);
        },
        post_Date:function(){
            if($("body").find('.error').length==0 && $("body").find('.error-border').length==0){
                $(".Toggele").removeClass("aformError").find(".okForm").removeClass("formError");
                var url;
                Model.meeting_price=Model.gdarr;
                postDate=JSON.stringify(Model.$data);
                if(Model.id){
                    url="/yrfp/offer-update";
                }else{
                    url="/yrfp/offer-insert";
                }
                var ly=layer.load(1);
                $.post(url,{data:postDate},function(res){
                    layer.close(ly);
                    layer.msg(res.msg);
                    if(res.errorno==1){
                        window.location.href="/yrfp/detail?pid="+res.msgdata.pid+"&rid="+res.msgdata.rid+"&map_id="+res.msgdata.mid;
                    }
                },'json')
            }else{
                $('.isAccept').removeClass("isAccept");
                // for(var i<0;i<$(".Toggele").length;i++){
                //   $(".Toggele")
                // }
                $(".Toggele").each(function(index){
                    if($(this).find(".error-border").length>0){
                        $(this).addClass("aformError").find(".okForm").addClass("formError");
                    }
                })
                // $(".Toggele").addClass("aformError").find(".okForm").addClass("formError");
                layer.msg("您有信息没有填写完整,请填写");
            }
        },
        isfrees:function(index){
            var rs=false
            if(this.$data.gdarr[index].facility_price!="0" ){
                if(this.$data.gdarr[index].facility_price=="不免费"){
                    this.$data.gdarr[index].facility_price="";
                }
                rs=true;
            }
            return rs;
        },
        isfreei:function(index){
            var rs=false
            if(this.$data.gdarr[index].facility_price=="0"){
                rs=true;
            }
            return rs;
        },
        meetShow:function(value){
            var bool=false;
            if(value=="请选择会议室"){
                bool=true;
            }
            for(var i=0;i<this.$data.meeting_info.length;i++){
                if(value==this.$data.meeting_info[i].Name){
                    bool=true
                }
            }
            return bool;
        },
        meet_change:function(value){
            if(value=="自定义会议室"){
                this.$data.meeting_package_price[0].meet_info_sl="";
            }
        },
        meet_input:function(value){
            var bool=true;
            for(var i=0;i<this.$data.meeting_info.length;i++){
                if((value==this.$data.meeting_info[i].Name || value=="请选择会议室")){
                    bool=false
                }
            }
            return bool;
        },
        //验证电话
        relTel:function(value){
            var reg = /^1[3|4|5|7|8][0-9]{9}$/,bool;
            if(reg.test(value)){
                bool=false;
            }else{
                bool=true
            }
            return bool;
        },
        relEmail:function(value){
            var reg=/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/,bool;
            if(reg.test(value)){
                bool=false;
            }else{
                bool=true
            }
            return bool;
        },
        toggle:function(e){
            var _this=e.currentTarget;
            _this=$(_this).find(".modelTitle .icon");
            if($(_this).hasClass("down")){
                if($(".icon.up").parents(".Toggele").find(".error-border").length>0){
                    $(".icon.up").parents(".Toggele").addClass("aformError");
                    $(".icon.up").parents(".Toggele").find(".okForm").addClass("formError").removeClass("formOk");
                }else{
                    $(".icon.up").parents(".Toggele").find(".okForm").addClass("formOk").removeClass("formError");
                }
                $(".up").removeClass("up").addClass("down");
                $(_this).removeClass("down").addClass("up");
                $(".toggleContent").hide();
                $(_this).parents(".Toggele").find(".toggleContent").show();
            }
        }
    }
})