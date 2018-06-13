inputNumberIe({
	"Id": "inputNumber",
	"Max": -5,
	"Speed": 3
});
/**
 * 在IE里面兼容input type="number"
 * option.Id[需要兼容的input的id名]
 * option.Min[input可以输入的最小值]
 * option.Max[input可以输入的最大值]
 * option.Speed[input值每次改变的大小]
 */
function inputNumberIe(option){
	$(".inputNumber-relative").css({
		"width": $("#" + option.Id).width(),
		"height": $("#" + option.Id).height()
	})
	$("#" + option.Id).after('<div class="inputNumber-absolute"><div class="inputNumber-up"></div><div class="inputNumber-down"></div></div>');
	
	$.each($(".inputNumber-up"), function(i, n){
		$(n).on("mouseenter", function(){
			$(this).css("background-position","0 -17px");
		}).on("mouseleave", function(){
			$(this).css("background-position","0 0");
		}).on("mousedown", function(){
			$(this).css("background-position","0 -34px");
		}).on("mouseup", function(){
			$(this).css("background-position","0 0");
		}).on("click", function(){
			var inputNumberValue = $("#" + option.Id).val() * 1;
			if(inputNumberValue){
				if(option.Max){
					if(inputNumberValue < option.Max){
						if(option.Speed && ((inputNumberValue + option.Speed) <= option.Max)){
							inputNumberValue += option.Speed;
						}else{
							return;
						}
					}else{
						return;
					}
				}else{
					if(option.Speed){
						inputNumberValue += option.Speed;
					}else{
						inputNumberValue++;
					}
				}
				$("#" + option.Id).val(inputNumberValue);
			}else{
                if(option.Min){
                    if(option.Min != 0){
                        inputNumberValue = option.Min;
                        $("#" + option.Id).val(inputNumberValue);
                    }else{
                        return;
                    }
                }else{
                    if(option.Max){
                        inputNumberValue = option.Max;
                        $("#" + option.Id).val(inputNumberValue);
                    }else{
                        if(option.Speed && ((inputNumberValue + option.Speed) <= option.Max)){
                            inputNumberValue += option.Speed;
                            $("#" + option.Id).val(inputNumberValue);
                        }else{
                            $("#" + option.Id).val(1);
                        }
                    }
                }
			}
		});
	})
	
	$.each($(".inputNumber-down"), function(i, n){
		$(n).on("mouseenter", function(){
			$(this).css("background-position","0 -26px");
		}).on("mouseleave", function(){
			$(this).css("background-position","0 -9px");
		}).on("mousedown", function(){
			$(this).css("background-position","0 -43px");
		}).on("mouseup", function(){
			$(this).css("background-position","0 -9px");
		}).on("click", function(){
			var inputNumberValue = $("#" + option.Id).val() * 1;
			if(inputNumberValue){
				if(option.Min){
					if(inputNumberValue > option.Min){
						if(option.Speed && ((inputNumberValue - option.Speed) >= option.Min)){
							inputNumberValue -= option.Speed;
						}else{
							return;
						}
					}else{
						return;
					}
				}else{
					if(option.Speed){
						inputNumberValue -= option.Speed;
					}else{
						inputNumberValue--;
					}
				}
				$("#" + option.Id).val(inputNumberValue);
			}else{
                if(option.Max){
                    if(option.Max != 0){
                        inputNumberValue = option.Max;
                        $("#" + option.Id).val(inputNumberValue);
                    }else{
                        return;
                    }
                }else{
                    if(option.Min){
                        inputNumberValue = option.Min;
                        $("#" + option.Id).val(inputNumberValue);
                    }else{
                        if(option.Speed && ((inputNumberValue - option.Speed) >= option.Min)){
                            inputNumberValue -= option.Speed;
                            $("#" + option.Id).val(inputNumberValue);
                        }else{
                            $("#" + option.Id).val(-1);
                        }
                    }
                }
			}
		});
	})

	var scrollFunc = function (e) {  
        e = e || window.event;             
        if (e.wheelDelta > 0) { 
            //当滑轮向上滚动时执行的代码段 
        	$("#" + option.Id).siblings(".inputNumber-absolute").children().eq(0).trigger("click");
        }  
        if (e.wheelDelta < 0) { 
            //当滑轮向下滚动时执行的代码段
        	$("#" + option.Id).siblings(".inputNumber-absolute").children().eq(1).trigger("click");
        }   
    }
    //滚动滑轮触发scrollFunc方法 ie 谷歌  
    window.onmousewheel = scrollFunc;  
}