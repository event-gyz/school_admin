
$(function () {
    // 报价提交
    $('#submit_btn').click(function () {
        var btn = $(this);
        layer.msg("数据处理中...");
        btn.attr('disabled', 'disabled');
        $.ajax({
            type: 'post',
            url: $('#priceForm').attr('action'),
            dataType: 'json',
            data: $('#priceForm').serialize(),
            async: true,
            success: function (json) {
                if (json.code == '1') {
                    layer.msg('操作成功！页面跳转中...');
                    window.location.href = json.url;
                } else {
                    btn.removeAttr('disabled');
                    layer.msg(json.message);
                    return false;
                }
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                btn.removeAttr('disabled');
                layer.msg("网络忙，请稍后再试。");
                return false;
            },
        });
    });




})

$(document).on('blur keyup', '.personal', function () {
    if ($.trim($(this).val()) == '') {
        var inputname = $(this).attr('name');
        $(this).hide()
        $(this).siblings('select').val(1).show();

        if ($.trim($(this).siblings('select').val(1).attr("name")) == '') {
            $(this).siblings('select').val(1).attr("name", inputname);
        }
        $(this).attr('name', '');
    }
    // body...
})

function addCtrl(e) {
    e.preventDefault();
    var btn = $(e.target);
    var room = {
        "1": "标准房",
        "2": "商务房",
        "3": "行政房",
        "4": "套房",
        "personal": "自定义房间类型",
    };
    var rownumName = btn.parents('table').find('tr:last input[type=text]:first').attr('name');
    var rownum = parseInt(rownumName.split('[')[2].split(']')[0]) + 1;
    var html = btn.parents('tr').html();

    //如果没有点击的最后一个没有删除按钮时
    html = html.replace(/meeting_price\[data\]\[\d+\]/g,'meeting_price[data]['+ rownum +']')
    html = html.replace(/room_price\[data\]\[\d+\]/g,'room_price[data]['+ rownum +']')
    html = html.replace(/food_price\[data\]\[\d+\]/g,'food_price[data]['+ rownum +']')
    html = html.replace(/equip_price\[data\]\[\d+\]/g,'equip_price[data]['+ rownum +']')
    html = html.replace(/other_price\[data\]\[\d+\]/g,'other_price[data]['+ rownum +']')
    html = html.replace(/meeting_package_price\[data\]\[\d+\]/g,'meeting_package_price[data]['+ rownum +']')
    html = html.replace(/fit_price\[data\]\[\d+\]/g, 'fit_price[data][' + rownum + ']')
    if (html.indexOf('btn_remove') < 0) {

        html = html.replace('<!---->', '<a href="##" class="btn_remove">删除</a>')

    }


    var row = '<tr>' + html + '</tr>'
    // $(row).insertAfter(btn.parents('table').find('tr').eq(rownum))
    btn.parents('table').append(row);
    btn.parents('table').find("tr").last().find("input").attr("value", "");
    console.log($('table tr:last input'));


}

function removeCtrl(e) {
    e.preventDefault();
    var btn = $(e.target);
    btn.parents('tr').remove()
}

$(document).on('click.control', '.btn_add', addCtrl)
$(document).on('click.control', '.btn_remove', removeCtrl)

function validate() {
    $('form').submit()
    var isvalidate = true
    /*$('input.text').each(function(k, v) {
        if ($(this).val() == '') {
            $(this).addClass('input-error')
            isvalidate = false
        }
    })*/

    $('input.price').each(function (k, v) {
        var value = $(this).val() != "" ? $(this).val() : 1;
        if (!$.isNumeric(value)) {
            $(this).addClass('input-error')
            isvalidate = false
        }
        if (!$(this).val()) {
            $(this).addClass('input-error')
            isvalidate = false
        }
    })
}

//$('#submit_btn').on('click', validate)

$('#priceForm').on('focus', 'input', function () {
    if ($(this).hasClass('input-error')){
        $(this).removeClass('input-error');
    }
})
