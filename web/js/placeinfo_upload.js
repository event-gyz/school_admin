/**
照片上传功能 基于webupload组件
yaojia 2016.1.11
*/


(function() {

    //批量上传


function batchUpload(config) {

    var batchUploader = WebUploader.create({
        // swf文件路径
        swf: BASE_URL+'Uploader.swf',
        // 文件接收服务端。
        server: '/js/demo/upload.php',
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
        fileVal: config.data['name'], // {Object} [可选] [默认值：'file']设置文件上传域的name。
        formData: {
            'name': config.data['name']
        }
    });


    // 当有文件添加进来的时候
    batchUploader.on('fileQueued', function(file) {
        var $li = $(
                '<div id="' + file.id + '" class="file-item thumbnail">' +
                '<img>' +
                '<div class="info">' + file.name + '</div>' +
                '<span class="del hide glyphicon glyphicon-remove "> </span>' +
                '</div>'
            ),
            $img = $li.find('img');

        config.$list.append($li);

        // 创建缩略图
        batchUploader.makeThumb(file, function(error, src) {
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

                if (json.errorno == 0) {
                    var option = json.data['u-option'] || '';
                    var name = json.data['u-name'] || '';





                    $('#' + file.id).append($('<div class="success" ><span class="glyphicon glyphicon-ok"></span></div'));
                } else {

                   $('#' + file.id).append($('<div class="error" ><span class="glyphicon glyphicon-remove"></span></div'));

                        batchUploader.removeFile(file);
                        setTimeout(function(){
                          $('#' + file.id).remove()
                        },2000)

                    // return;
                }

               setTimeout(function(){
                 $('#' + file.id).find('.progress').remove();
               },200)

        //绑定删除
        $('#' + file.id).find('.del').removeClass('hide').one('click', function() {

            batchUploader.removeFile(file);
            $(this).parent('.file-item').remove();



        })



    });

        // 文件上传失败，现实上传出错。
        batchUploader.on('uploaderror', function(file) {
            alert('上传失败！')
            $('#' + file.id).append($('<div class="error" ><span class="glyphicon glyphicon-remove"></span></div'));

        });

        // 完成上传完了，成功或者失败，先删除进度条。
        batchUploader.on('uploadComplete', function(file) {

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





})()