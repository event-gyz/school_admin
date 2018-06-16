
function advertiseUpload(config){

    // 实例化
    var uploader = WebUploader.create({
        // 选完文件后，是否自动上传。
        auto: true,
        // swf文件路径
    //    swf: BASE_URL + '/js/Uploader.swf',
        // 文件接收服务端。
        server: 'http://v0.api.upyun.com/eventdb/',
        compress:false,
        // 选择文件的按钮。可选。
        // 内部根据当前运行是创建，可能是input元素，也可能是flash.
        pick: {
            id:"#filePicker",
            multiple: false
        },

        // 只允许选择图片文件。
        accept: {
            title: 'Images',
            extensions: 'jpg,gif,png',
            mimeTypes: 'image/jpeg,image/gif,image/png'
        },
        formData: {
            'signature':GLO.signature,
            'policy':GLO.policy
        }
    });

    // 当有文件添加进来的时候
    uploader.on( 'fileQueued', function( file ) {

        $img = $("#div-img");
        var picWidth = $('#filePicker').attr('picWidth');
        var picHeight = $('#filePicker').attr('picHeight');
        // 创建缩略图
        uploader.makeThumb(file, function(error, src) {
            if(typeof file._info== 'undefined'){
                $('#' + file.id).remove();
                return alert('图片有误');
            }
            var w=file._info.width,h=file._info.height;
            if(w != picWidth || h != picHeight){
                uploader.removeFile(file);
                $('#' + file.id).remove();
                return alert('图片尺寸：'+picWidth+'像素*'+picHeight+'像素');
            }

            if (error) {
                $img.replaceWith('<span>不能预览</span>');
                return;
            }
            $img.attr('src', src);
        }, 358, 155);
        var $li = $('#upload-pic');
        $percent = $li.find('.progress .progress-bar');
        if ($percent.size()<= 0) {
            $percent = $('<div class="progress progress-striped active ">' +
                    '<div class="progress-bar  progress-bar-info" role="progressbar" style="width: 10%">' +
                    '</div>' +
                    '</div>').appendTo($li) ;
        }
    });

    // 文件上传过程中创建进度条实时显示。
    uploader.on('uploadProgress', function(file, percentage) {
        var $li = $('#upload-pic'),
        $percent = $li.find('.progress .progress-bar');
        $percent.css('width', percentage * 100 + '%');
    });

    // 文件上传成功
    uploader.on('uploadSuccess', function(file, json) {
        if (json.code == 200) {
            $('#upload-pic').find('.progress').remove();
            $("#img").val(json.url);
        }
    });

    // 文件上传失败，现实上传出错。
    uploader.on('uploaderror', function(file) {
        return alert("图片上传失败");
    });
}

$('.update-img').each(function (k, v) {
    var item = {
        picWidth: $(v).attr('picWidth'),
        picHeight: $(v).attr('picHeight')
    }
    advertiseUpload(item)
})


