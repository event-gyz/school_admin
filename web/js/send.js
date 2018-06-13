$('[ name="selectService[]" ]').click(function(event){

    select($(this).parents('tr'))
    event.stopPropagation();
})

$('[data-tr = "selectService"]').find('td').eq(0).click(function(){
    $(this).find( '[ name="selectService[]" ]' ).click();
})

$('[ name="selectService_all" ]').click(function(){
    var isChecked = $(this).is(':checked');
    var items = [];
    $('#selectService').find('[data-tr="selectService"]').each(function(i,data){
        items[i] = {
            name    :$(this).find('td').eq(1).text(),
            dataId  :$(this).attr('data-id'),
            type    :typeName,
            addNum  :1
        }
    })

    if( isChecked ){
        $('#selectService').find('[data-tr="selectService"]').addClass('active')
        batchAddSelectItem( items )
    }else{
        $('#selectService').find('[data-tr="selectService"]').removeClass('active')
        batchRemoveSelectItem( items )
    }
})

$('#selectItem').delegate('[data-action="opForSelect"]','click',function(){
    var selectId = $(this).parents('tr').attr('select-id');
    $(this).parents('tr').remove()
    if( 0 != $( '[data-id="'+selectId+'"]' ).length ){
        $( '[data-id="'+selectId+'"]' ).find( '[ name="selectService[]" ]' ).click()
    }else{
        item = { dataId:selectId }
        SelectItemCookie(item,2)
        var num = $('#selectNum').text();
        var newNum = parseInt( num ) -1
        $('#selectNum').text(newNum)
    }
})

$('#sendRfp').click(function(){
    var selectAndSend = $('#selectAndSend').serialize() || {};
    $.post('/brfp/send/send',selectAndSend,function(data){
        if( 1 == data.status ){
            $.cookie('selectItem',null,{path:'/',expires:-1});
            layer.alert(data.msg, function(){
                window.location.reload();
            });
        }else{
            layer.alert(data.msg);
        }
    })
})

$('#sendDemands').click(function(){
    $.get('/brfp/send/select',sendData,function(data){
        $('.modal-body').html(data)
    })
})

function select(target){
    var active = target.hasClass('active')
    var select = {
        name    :target.find('td').eq(1).text(),
        dataId  :target.attr('data-id'),
        type    :typeName,
        addNum  :1
    }
    if( active ){
        target.removeClass('active');
        removeSelectItem(select);
    }else{
        target.addClass('active');
        addSelectItem(select);
    }
}

function addSelectItem(item){
    if( 0 == $( '[select-id="'+item.dataId+'"]' ).length ){
        var itemHtml = '<tr select-id='+item.dataId+'><td>'
            +item.name
            +'</td><td>'
            +item.type
            +'</td><td style="cursor:pointer" data-action="opForSelect">X</td></tr>';
        $('#selectItem').append( itemHtml );
        var num = $('#selectNum').text();
        num = parseInt(num)+item.addNum;
        $('#selectNum').text(num);
        SelectItemCookie(item,1);
    }
}

function batchAddSelectItem(params){
    if( params instanceof Array ){
        $.each(params,function(i,data){
            addSelectItem(data)
        })
    }else{
        console.log('数据有误')
    } 
}

function removeSelectItem(item){
    $( '[select-id="'+item.dataId+'"]' ).remove()
    SelectItemCookie(item,2);
    var num = $('#selectNum').text();
    num = parseInt(num)-item.addNum;
    if( num > -1 ){
        $('#selectNum').text(num);
    }
}

function batchRemoveSelectItem(item){
    if( item instanceof Array ){
        $.each(item,function(i,data){
            removeSelectItem(data)
        })
    }else{
        console.log('数据有误')
    } 
}
//action    1:添加cookie,2:删除cookie
function SelectItemCookie(item,action){
    var cookieItem = JSON.parse( $.cookie('selectItem') || '{}' );
    //console.log( cookieItem )
    if( action == 1 ){
        cookieItem[item.dataId] = { name:item.name,type:item.type }
    }else if( action == 2 ){
        delete cookieItem[item.dataId]
    }
    cookieItem = JSON.stringify(cookieItem)
    $.cookie('selectItem', cookieItem ,{ expires: 7, path: '/' });

    var outTestCookie = JSON.parse( $.cookie('selectItem') );
    console.log(  outTestCookie );
}


$('.modal-body').delegate('[data-type="detail"]','click',function(){
    var flag = $(this).attr('data-flag')
    var relativeId = $(this).attr('relative-id')
    console.log( $(this).parents('.box').find('.box-body') )
    if( flag==1 ){
        $('#'+relativeId).hide()
        $(this).text('查看详情')
        $(this).attr('data-flag',0)
    }else{
        $('#'+relativeId).show()
        $(this).text('收起详情')
        $(this).attr('data-flag',1)
    }
})

$('.modal-body').delegate('.select-on-check-all','click',function(){
    var checked = $(this).is(":checked");
    if( checked ){
        $('.select').not("input:checked").click();
    }else{
        $('.select:checked').click();
    }
})

//删除询单
$('[data-action="delete"]').click(function(){
    var dataId = $(this).attr('data-id');
    layer.confirm('您确定要删除该条询单', {
            btn: ['确定','取消'] //按钮
        }, function(){
            $.post('/brfp/send/delete',{id:dataId},function(data){
                if( data.status == 1 ){
                    layer.alert(data.msg, function(){
                        window.location.reload();
                    });
                }else{
                    layer.alert(data.msg);
                }
            })
        }
    );
})


$('#compareOffer').click(function(){
    var str="";
    $('[name="selection[]"]:checked').each(function(){
        str+=$(this).val()+",";
//alert($(this).val());
    });
    if(str == ''){
        layer.msg('请选择询单', {icon: 2});
        return false;
    }
    //如果为一个对比报价，宽度为自适应
    var n=(str.split(',')).length-1;
    if(n == 1){
        var width = '80%';
        var margin_left = '0%';
    }else{
        var width = '150%';
        var margin_left = '-30%';
    }
    if(str != ''){
        $.get('/brfp/rfp/compare',{id:str},function(data){
            $('.modal-content').css({
                width: width,
                'margin-left': margin_left
            });
            $('#create-modal').find('.modal-body').html(data);
            $('#create-modal').modal('show')
        })
    }else{
        $('#create-modal').find('.modal-body').html('');
        $('#create-modal').modal('show')
    }
})

$('[action-id="offerDetail"]').click(function(){
    var mapId = $(this).attr('action-data');
    $.get('/brfp/rfp/offer',{id:mapId},function(data){
        $('#offer-modal').find('.modal-body').empty();
        $('#offer-modal').find('.modal-body').html(data)
        $('#offer-modal').find('.modal-body').append("<input type='hidden' id='hidden_map_id' value='"+ mapId +"'>");
    })
})


$("#qrxd").click(function(){
    var str="";
    $('[name="selection[]"]:checked').each(function(){
        str+=$(this).val()+",";
//alert($(this).val());
    });
    if(str == ''){
        layer.msg('请选择询单', {icon: 2});
    }else{
        layer.confirm('确定生成订单吗(已经生成的订单会自动过滤)', {
            btn: ['确定', '取消'] //按钮
        }, function () {
            $.post('/index.php/brfp/rfp/create-order', {map_id: str } ,function(data){
                if(data.code == 200){
                    layer.msg(data.msg, {icon: 1});
                }else{
                    layer.msg(data.msg, {icon: 2});
                }
                window.location.reload();
            });
        });
    }
});

$("#qrxd2").click(function(){
    var str="";
    $('[name="selection[]"]:checked').each(function(){
        str+=$(this).val()+",";
//alert($(this).val());
    });
    if(str == ''){
        layer.msg('请选择询单', {icon: 2});
    }else{
        layer.confirm('确定生成订单吗(已经生成的订单会自动过滤)', {
            btn: ['确定', '取消'] //按钮
        }, function () {
            $.post('/index.php/brfp/rfp/create-order', {map_id: str } ,function(data){
                if(data.code == 200){
                    layer.msg(data.msg, {icon: 1});
                }else{
                    layer.msg(data.msg, {icon: 2});
                }
                window.location.reload();
            });
        });
    }
});


function ishide(status){
    if(status == 0){
        $("#detail").show();
    }else{
        $("#detail").hide();
    }
}

$("#detail").click(function(){
    var map_id = $("#hidden_map_id").val();

    if(map_id == ''){
        layer.msg('请选择询单', {icon: 2});
    }else{
        layer.confirm('确定生成订单吗(已经生成的订单会自动过滤)', {
            btn: ['确定', '取消'] //按钮
        }, function () {
            $.post('/index.php/brfp/rfp/create-order', {map_id: map_id } ,function(data){
                //data = JSON.parse(data);
                if(data.code == 200){
                    layer.msg(data.msg, {icon: 1});
                }else{
                    layer.msg(data.msg, {icon: 2});
                }
                window.location.reload();
            });
        });
    }
});


function singlexd(map_id){
    if(map_id == ''){
        layer.msg('请选择询单', {icon: 2});
    }else{
        layer.confirm('确定生成订单吗', {
            btn: ['确定', '取消'] //按钮
        }, function () {
            $.post('/index.php/brfp/rfp/create-order', {map_id: map_id } ,function(data){
                if(data.code == 200){
                    layer.msg(data.msg, {icon: 1});
                }else{
                    layer.msg(data.msg, {icon: 2});
                }
                window.location.reload();
            });
        });
    }
}


