var forms = (function($) {
    
    var sendData = function(event){
        event.preventDefault();
        $('#frm_forms').c2Validate()
            .then(function() {
                var data = $('#frm_forms').serialize();
                var act = $('#act').val();
                console.log(act);
                $.ajax({
                    url: '?mod=source',
                    type: 'post',
                    method: 'post',
                    data: data,
                    dataType: 'json'
                }).then(function(response){
                    $.confirm({title: '알림', content: '저장되었습니다', buttons: {
                        confirm: {
                            text: '확인',
                            action: function() {
                                if (act == 'new') {
                                    location.href = '?mod=source';
                                }
                            }
                        }
                    }});
                }).fail(function(xhr, textStatus){
                    var msg = textStatus;
                    if (c2.obj.has(xhr, 'responseJSON.message')) {
                        msg = xhr.responseJSON.message;
                    }
                    $.alert({title: '오류', content: msg});
                    console.log(error) ;
                });
            })
            .catch(function(error){
                $.alert({title: '오류', content: error});
            });
    }
    
    var step = {
        up: function() {
            var idx = $('#detail_fields .btn-up').index(this);
            if(idx <= 0) return;
            var row = $(this).parent().parent();
            $(row).prev().before(row);
        },

        down: function() {
            var idx = $('#detail_fields .btn-dn').index(this);
            if(idx >= $('#detail_fields .btn-dn').size()-1) return;
            var row = $(this).parent().parent();
            $(row).next().after(row);
        },
        remove: function() {
            var idx = $('#detail_fields .btn-del').index(this);
            $('#detail_fields .row').eq(idx).remove();
        }
    }
    
    var content = {
        append: function(data) {
            var row = $('#detail_fields_tpl > .row').clone();
            $('#detail_fields').append(row);
            if (data) {
                $('.sc-fld', row).val(data.key);
                $('.sc-exp', row).val(data.val);
            } else {
                $('.sc-fld:eq(0)').attr('selected', 'selected');
            }
        },
    }
    
    return {
        sendData: sendData,
        content: content,
        step: step,
    }
    
})(jQuery);


$(document).ready(function() {
    $('#btn_add_field').click(function() { forms.content.append() });
    $('#frm_forms').submit(forms.sendData);
    $('.btn-exp-tool').click(function() {
        c2.Win.open('?mod=regextool', '', 800, 800);
    })
    $(document).on('click', '#detail_fields .btn-up', forms.step.up);
    $(document).on('click', '#detail_fields .btn-dn', forms.step.down);
    $(document).on('click', '#detail_fields .btn-del', forms.step.remove)
    
    $("._fld").each(function(i, e){
        forms.content.append({
            key: $(e).val(),
            val: $("._exp").eq(i).val()
        });
    });
});