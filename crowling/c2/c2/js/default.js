$(function(){
	$("#all_chk").click(function(){
		if($(this).is(":checked")){
			$(".chk").prop("checked", true);
		}else{
			$(".chk").prop("checked", false);
		}
	});
	
	//$.validate();
});

var c2 = {};

c2.Win = {
	open:function(url, wname, w, h, s, r){
		var l = screen.availWidth / 2 - w / 2;
		var t = screen.availHeight / 2 - h / 2;

		var str = "left=" + l + ", top=" + t + ", width=" + w +
			", height=" + h + ", toolbar=no, location=no";

		if(s == undefined) s = "yes";  //auto는 IE만 먹음
		str += ", scrollbars=" + s;

		if(r == undefined) r = "no";
		str += ", resizable=" + r;

		return window.open(url, wname, str);
	}
};

c2.Date = {
    datepicker:function(ele, opt){
        
        var dopt = {
            closeText: "닫기",
            prevText: "이전달",
            nextText: "다음달",
            currentText: "오늘",
            monthNames: ["1월(JAN)","2월(FEB)","3월(MAR)","4월(APR)","5월(MAY)","6월(JUN)", "7월(JUL)","8월(AUG)","9월(SEP)","10월(OCT)","11월(NOV)","12월(DEC)"],
            monthNamesShort: ["1월","2월","3월","4월","5월","6월", "7월","8월","9월","10월","11월","12월"],
            dayNames: ["일","월","화","수","목","금","토"],
            dayNamesShort: ["일","월","화","수","목","금","토"],
            dayNamesMin: ["일","월","화","수","목","금","토"],
            weekHeader: "Wk",
            dateFormat: "yy-mm-dd",
            firstDay: 0,
            isRTL: false,
            showMonthAfterYear: true,
            yearSuffix: ""
        }
        
        /*var dopt = {
            changeMonth: true,
            changeYear: true,
            dateFormat: "yy-mm-dd",
            firstDay: 0,
            
            yearRange: "c-99:c",
            
        }*/
        
        var option = $.extend(dopt, opt);
        $(ele).datepicker(option);
    }
}

c2.obj = {
    get: function(obj, key) {
        return key.split('.').reduce(function(o, x) {
            return (typeof o == 'undefined' || o === null) ? o : o[x];
        }, obj);
    },
    has: function(obj, key) {
        return key.split('.').every(function(x) {
            if(typeof obj != 'object' || obj === null || ! x in obj)
                return false;
            obj = obj[x];
            return true;
        });
    }
}

$(document).ready(function(){
    $('#allchk').click(function(){
        $('.chk').prop('checked', $(this).prop('checked'));
    })
});