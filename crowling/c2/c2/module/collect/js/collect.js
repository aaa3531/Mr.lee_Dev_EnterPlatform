var collect = (function($) {
    
    var srcIdx = 0;
    var sources = [];
    var source = [];
    var page = 0;
    var spage = 0;
    var epage = 0;
    var isStop = false;
    var isLogin = false;
    var minDelay = 300;
    var delay = 0;
    var rowIdx = 0;
    var row = null;
    var mixContainer = $(document.createElement('tbody'));
    
    function startList() {
        sources = $('.source:checked');
        if (sources.length  <= 0) {
            $.alert({title: '알림', content: '소스를 선택해 주세요'});
            return;
        }
        srcIdx = 0;
        $('#list').empty();
        showLoader();
        doLogin();
    }
    
    function doLogin() {
        var ref = this;
        $.ajax({
            url: '?mod=collect&sec=login',
            method: 'post',
            dataType: 'json',
            data: {
                sc_idx: $(sources[srcIdx]).data('sc_idx'),
            }
        })
        .done(function(result) {
            isLogin = true;
        })
        .fail(function(xhr, textStatus) {
            failHandler(xhr, textStatus);
            isLogin = false;
        })
        .always(function() {
             if (isStop) {
                 hideLoader();
                 return;
             }
             if (!nextPage()) {
                 srcIdx = 0;
                 if (isLogin) {
                     init();
                     listCollect();
                 } else {
                     hideLoader();
                 }
                 return;
             }
             doLogin();
        });
    }
    
    init = function(){
        source = $(sources[srcIdx]);
        spage = Math.max(parseInt(source.data("spage")), parseInt(source.data("epage")));
        epage = Math.min(parseInt(source.data("spage")), parseInt(source.data("epage")));
        delay = Math.max(minDelay, parseInt(source.data("delay")));
        page = spage;
    }
    
    function listCollect() {
        
        $.ajax({
            url: '?mod=collect&sec=list',
            method: 'post',
            dataType: 'json',
            timeout: 10000,
            data: {
                sc_idx: source.data('sc_idx'),
                page: page
            }
        })
        .done(function(result) {
            try {
                var data = result.data;
                for(var i=0; i<data.url.length; i++) {
                    var row = $('#row_tpl .trow').clone();
                    $(row).data('sc_idx', source.data('sc_idx'));
                    $('.sc-name', row).text(source.data('sc_name'));
                    $('.sc-list-url a', row).attr('href', data.url[i]);
                    $('.sc-list-url a', row).text(data.url[i]);
                    $('.sc-title', row).text(data.title[i]);
                    $('.sc-state', row).text('-');
                    $('#list').append(row);
                }
            } catch(e) {
                showError(e.message);
                hideLoader();
                return;
            }
        })
        .fail(failHandler)
        .always(function() {
            if (!nextPage() || isStop) {
                if (!nextSource()) {
                    buildRegDate();
                    hideLoader();
                    return;
                }
                init();
            }
            if (isStop) {
                hideLoader();
                return;
            }
            doSleep(delay);
            listCollect();
        });
    }
    
    function startContent() {
        isStop = false;
        
        rows = $('#list tr');
        if(rows.length <= 0){
            showError("먼저 수집하기를 실행해 주세요");
            return;
        }
        
        var board = $('#board').val();
        if(board == '' || board === undefined){
            showError("게시판을 선택해 주세요");
            return;
        }
        
        rowIdx = 0;
        $('.sc-state').text('-');
        
        showLoader();
        
        contentCollect();
    }
    
    function contentCollect() {
        var row = $(rows[rowIdx]);
        
        var data = {
            target_url: encodeURIComponent($('.sc-list-url', row).text()),
            sc_idx: row.data("sc_idx"),
            regdate: $('.sc-regdate', row).text(),
            board: $('#board').val(),
        };
        
        var ref = this;
        
        $.ajax({url:'?mod=collect&sec=content',
            method:'post',
            data:data,
            dataType:"json"
        })
        .done(function(result){
            try{
                if (!result.success) throw { message: '서버에러' };
                $('.sc-state', row).html("<strong>등록완료</strong>");
                $(row).addClass('reg-fin');
                
            }catch(e){
                $('sc-state', row).html('<strong style="color:red; cursor: pointer;" title="' + e.message + '">실패</strong>');
            }
        })
        .fail(function(xhr, textStatus){
            var msg = '알 수 없는 서버에러입니다';
            var label = '실패';

            if (c2.obj.has(xhr, 'responseJSON.message')) {
                if(xhr.responseJSON.code == 'duplicate'){
                    label = '중복';
                    $(row).addClass('reg-fin');
                }else if(xhr.responseJSON.code == 'skipstr'){
                    label = '수집제외';
                    $(row).addClass('reg-fin');
                }
                msg = xhr.responseJSON.message;
            } else if (c2.obj.has(xhr, 'responseText')){
                msg = xhr.responseText;
            }
            $('.sc-state', row).html('<strong style="color:red; cursor: pointer;" title="' + msg + '">' + label + '</strong>');
        })
        .always(function(){
            
            if(isStop){
                hideLoader();
                return;
            }
            
            if(doSleep(delay)){
            
                if(rowIdx+1 < rows.length){
                    rowIdx++;
                    contentCollect();
                }else{
                    hideLoader();
                }
            }
        });
    }
    
    function failHandler(xhr, textStatus) {
        var msg = textStatus;
        if (c2.obj.has(xhr, 'responseJSON.message'))
            msg = xhr.responseJSON.message;
        showError(msg);
        hideLoader();
    }
    
    function getFormatDate(date){
        return date.getFullYear() + "-" + 
            ("0" + (date.getMonth()+1)).substr(-2) + "-" + 
            ("0" + date.getDate()).substr(-2) + " " +
            ("0" + date.getHours()).substr(-2) + ":" + 
            ("0" + date.getMinutes()).substr(-2) + ":" + 
            ("0" + date.getSeconds()).substr(-2);
    }
    
    function getRandom(min, max){
        return Math.round((Math.random() * (1 + max - min)) + min);
    }
    
    function useRandomDate(b){
        use_rand_date = b;
    }
    
    function buildRegDate(){

        // 사용여부에 체크 해제이면 중단
        if($('#period').is(":checked") == false) {
            $('.sc-regdate').html('-');
            return;
        }
        
        var sdate = $('#sdate').val();
        var edate = $('#edate').val();
        
        // 시작날짜와 마감날짜 중 하나라도 없으면 중단
        if(sdate.trim()=='' || edate.trim()=='') return;

        // 게시물이 하나도 없으면 중단
        var rowcnt = $('.trow').size();
        if(rowcnt <= 0) return;
        
        var s_date = new Date(sdate);
        s_date.setHours(getRandom(0, 23));
        s_date.setMinutes(getRandom(0, 59));
        s_date.setSeconds(getRandom(0, 59));

        var e_date = new Date(edate);
        e_date.setHours(getRandom(0, 23));
        e_date.setMinutes(getRandom(0, 59));
        e_date.setSeconds(getRandom(0, 59));

        var s_utime = Math.round(s_date/1000);
        var e_utime = Math.round(e_date/1000);

        var unit_time = Math.round((e_utime - s_utime) / rowcnt);

        var c_utime = s_utime;
        
        adate = [];
        var i=0;
        while(c_utime <= e_utime){
            var cdate = new Date(c_utime * 1000);
            $('.sc-regdate').eq(i).html(getFormatDate(cdate));
            
            c_utime += unit_time;
            i++;
        }
    }
    
    function doStop(){
        isStop = true;
    }
    
    function doRemoveComplete(){
        $('.reg-fin').remove();
        buildRegDate();
    }
    
    function doMix(){
        console.log('a');
        while($('#list .trow').size()){
            var idx = Math.floor(Math.random() * $('#list .trow').size());
            mixContainer.append($('#list .trow').eq(idx));
        }
        
        $('#list').append(mixContainer.children());
        
        buildRegDate();
    }
    
    function deleteRow(){
        var idx = $('.btn-del').index(this);
        console.log(idx);
        $('#list .trow').eq(idx).remove();
    }
    
    function doSleep(milliseconds){
        var start = new Date().getTime();
        while(true){
            if ((new Date().getTime() - start) > milliseconds){
                break;
            }
        }
        return true;
    }
    
    function nextPage() {
        if (page <= epage) return false;
        page--;
        return true;
    }
    
    nextSource = function(){
        if(srcIdx >= sources.length-1) return false;
        srcIdx++;
        source = $(sources[srcIdx]);
        return true;
    }
    
    function showLoader() {
        $('#loading').addClass('active');
    }
    
    function hideLoader() {
        $('#loading').removeClass('active');
    }
    
    function fetchList() {
        $.ajax({
            url: '?mod=collect&sec=list',
            method: 'post',
            dataType: 'json',
            data: {
                
            }
        })
    }
    
    function gotoBoard(){
        var board = $('#board').val();
        if(board == ''){
            $.alert({title: '오류', content:'게시판을 선택해 주세요'});
            return;
        }
        
        window.open('?mod=collect&sec=goto&board=' + board);
    }
    
    function showError(message){
        $.alert({title: '오류', content: message});
    }
    
    return {
        startList: startList,
        fetchList: fetchList,
        startContent: startContent,
        deleteRow: deleteRow,
        doMix: doMix,
        doStop: doStop,
        doRemoveComplete: doRemoveComplete,
        gotoBoard: gotoBoard,
    }
})(jQuery);

$(document).ready(function() {
    $('#btn_start').click(collect.startList);
    $('#btn_import').click(collect.startContent);
    $('#btn_stop').click(collect.doStop);
    $('#btn_rmcomplete').click(collect.doRemoveComplete);
    $('#btn_board').click(collect.gotoBoard);
    $(document).on('click', '#list .btn-del', collect.deleteRow);
    $(document).on('click', '#btn_mix', collect.doMix);
});
