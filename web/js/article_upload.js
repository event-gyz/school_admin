/**
 照片上传功能 基于webupload组件
 yaojia 2016.1.11-13
 */


(function() {

    //批量上传


    function batchUpload(config) {


        console.log(config.data.name)

        var batchUploader = WebUploader.create({
            // swf文件路径
            // swf: BASE_URL+'Uploader.swf',
            // 文件接收服务端。
            server: 'http://v0.api.upyun.com/eventdb/',
            // 选择文件的按钮。可选。
            // 内部根据当前运行是创建，可能是input元素，也可能是flash.
            auto: true,
            pick: {
                id: config.picker,
                multiple: true
            },
            accept: {
                title: 'Images',
                extensions: 'gif,jpg,jpeg,png',
                mimeTypes: 'image/*'
            },
            formData: {
                'signature':GLO.signature,
                'policy':GLO.policy
            }
        });


        // 当有文件添加进来的时候
        batchUploader.on('fileQueued', function(file) {
            //alert(222);
            var $li = $(
                    '<div id="' + file.id + '" class="file-item thumbnail">' +
                        '<img>' +
                        '<div class="info">' + file.name + '</div>' +
                        '<span class="del  glyphicon glyphicon-remove "> </span>' +
                        '</div>'
                ),
                $img = $li.find('img');

            config.$list.append($li);

            // 创建缩略图
            batchUploader.makeThumb(file, function(error, src) {
                if(typeof file._info== 'undefined'){
                    $('#' + file.id).remove();
                    return alert('图片有误');
                }
                var w=file._info.width,h=file._info.height;
                if(w<290 || h<124){
                    batchUploader.removeFile(file);
                    $('#' + file.id).remove();
                    return alert('图片尺寸不能小于290✕124');
                }

                if (error) {
                    $img.replaceWith('<span>不能预览</span>');
                    return;
                }
                $img.attr('src', src);
            }, 120, 160);

            var $li = $('#' + file.id),
                $percent = $li.find('.progress .progress-bar');

            // 避免重复创建
            if ($percent.size()<= 0) {
                $percent = $('<div class="progress progress-striped active ">' +
                    '<div class="progress-bar  progress-bar-info" role="progressbar" style="width: 10%">' +
                    '</div>' +
                    '</div>').appendTo($li) ;


            }



        });

        // 文件上传过程中创建进度条实时显示。
        batchUploader.on('uploadProgress', function(file, percentage) {

            var $li = $('#' + file.id),
                $percent = $li.find('.progress .progress-bar');


            $percent.css('width', percentage * 100 + '%');
        });

        // 文件上传成功，给item添加成功class, 用样式标记上传成功。
        batchUploader.on('uploadSuccess', function(file, json) {


            if (json.code == 200) {
                $(".thumbnail").prev().remove();
                //alert(3);

                $('#' + file.id).find('.progress').remove();

                $('#' + file.id).append($('<input type="hidden" name="'+config.data.name+'[]" value="'+json.url+'">'))

                //$('#' + file.id).append($('<button style="display:none" class="setCoverbtn" type="button">设为封面</button>'))

            }



        });

        // 文件上传失败，现实上传出错。
        batchUploader.on('uploaderror', function(file) {
            $('#' + file.id).append($('<div class="error" ><span class="glyphicon glyphicon-remove"></span></div'));

        });


        batchUploader.on('hasuploaded', function(json) {

            var $li = $(
                    '<div  class="file-item thumbnail" id="' + json.id + '">' +
                        '<img>' +
                        '<span class="del glyphicon glyphicon-remove "> </span>' +

                        '</div>'
                ),
                $img = $li.find('img');

            config.$list.append($li);

            $img.attr('src', '/' + json.url);
            $img.attr('width', 120);
            $img.attr('height', 150);




            //绑定删除
            $('#' + json.id).find('.del').removeClass('hide').one('click', function() {

                //如果是大客户

                $(this).parent('.file-item').remove();

            });




        });


    }


    $('.uploader-batch').each(function(k, v) {
        var item = {
            data: $.parseJSON($(v).attr('data')),
            picker: $(v).find('.filePicker-batch'),
            $list: $(v).find('.fileList-batch')
        }
        batchUpload(item)
    })

//删除

    $(document).delegate('.del','click', function() {

        var url=$(this).parent('.file-item').find('input').val();
        //如果删除的是封面
        if($(this).parent('.file-item').hasClass('iscover')){

            $('input[name="cover"]').val('')

        }
        //可用可不用
        $('<input name="removeArr[]" value="'+url+'" type="hidden"> ').appendTo($('form'))

        $(this).parent('.file-item').remove();

    })

//设为封面
    $(document).delegate('.setCoverbtn','click',function(){

        $('.cover').remove();
        $('<i class="cover">封面<i>').appendTo($(this).parent('.file-item'))

        var coverurl= $(this).siblings('input').val();

        $('input[name="cover"]').val(coverurl)

        $(this).hide();

    })


    $(document).delegate('.file-item','mouseenter',function(){

        if(!$(this).find('.cover').size()){
            $(this).find('.setCoverbtn').show();

        }
    })




    $(document).delegate('.file-item','mouseleave',function(){
        $(this).find('.setCoverbtn').hide();
    })

//设为封面
    $(document).delegate('.setCoverbtn','click',function(){

        $('.cover').remove();
        $('<i class="cover">封面<i>').appendTo($(this).parent('.file-item'))

        var coverurl= $(this).siblings('input').val();

        $('input[name="cover"]').val(coverurl)

        $(this).hide();

    })


    $(document).delegate('.file-item','mouseenter',function(){

        if(!$(this).find('.cover').size()){
            $(this).find('.setCoverbtn').show();

        }
    })




    $(document).delegate('.file-item','mouseleave',function(){
        $(this).find('.setCoverbtn').hide();
    })


})()
/**
 * Created by Administrator on 16-3-23.
 */
