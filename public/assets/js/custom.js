$(document).ready(function() {
  'use strict';
  /* FIT VIDEOS WITH SCREEN SIZE */
   $(".video-player").fitVids();

   /* CONTENT LOADER */
   $('.content-to-load').jscroll({
      nextSelector: 'a.jscroll-load-more',
     loadingHtml: '<div class="progress"> <div class="progress-bar" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%;"><span> 75% </span></div></div>',
     autoTrigger: true,
     callback: function() {
      $(".video-player").fitVids();
      $('.mejs-player').mediaelementplayer();
     }
   });
});


/* TWEETER FEED */
if($('.widget-tweets .tweet').length){
  'use strict';
$('.widget-tweets .tweet').twittie({
  dateFormat: "%B %d, %Y",
  template: '<p class="twt">{{tweet}}</p> <p class="date">{{date}}</p>',
  count: 2,
  hideReplies: true
});
}


var Custom = function() {

    var runGlobal = function() {
        $(".action-btn").on('click', function() {
            var object = $(this).data('object');
            var sub_object = $(this).data('sub-object');
            var method = $(this).data('method');
            var route = $(this).data('route');
            var current_parent = $(this).parent().parent();
            var action_name = '';
            switch(method) {
                case 'DELETE':
                    action_name = '删除';
                    break;
                case 'PUT':
                    action_name = '更新';
                    break;
                default:
                    action_name = '操作';
                    break;
            }
            if (bootbox.confirm) {
                bootbox.confirm("确认"+ action_name +"该项目?", function(e) {
                    if (e) {
                        $.ajax({
                            url: sub_object ? window.route(route, object, sub_object) : window.route(route, object),
                            type: method,
                            data: { _token: csrf_token },
                            cache: false,
                            dataType: 'json',
                            success: function(data) {
                                if (method == 'DELETE' && data.code == 204) {
                                    toastr.success('删除成功');
                                    current_parent.remove();
                                } else if(method == 'PUT' && data.code == 200) {
                                    toastr.success('操作成功');
                                    window.setTimeout(function(){ window.location.reload(true);} ,1000);
                                } else {
                                    toastr.error(data.msg);
                                }
                            },
                        });
                    } else {
                        return;
                    }
                });
            }
        });
        $('.date').datetimepicker({
            timeText: '时间',
            hourText: '小时',
            minuteText: '分钟',
            secondText: '秒',
            currentText: '现在',
            closeText: '关闭',
            monthNames: ['一月', '二月', '三月', '四月', '五月', '六月', '七月', '八月', '九月', '十月', '十一月', '十二月'],
            dayNamesMin: ['日', '一', '二', '三', '四', '五', '六'],
            dateFormat: 'yy-mm-dd',
            timeFormat: 'HH:mm:ss',
            showMonthAfterYear: true,
            prevText: '<i class="fa fa-chevron-left"></i>',
            nextText: '<i class="fa fa-chevron-right"></i>',
            beforeShow: function(input, inst) {
                var newclass = 'admin-form';
                var themeClass = $(this).parents('.admin-form').attr('class');
                var smartpikr = inst.dpDiv.parent();
                if (!smartpikr.hasClass(themeClass)) {
                    inst.dpDiv.wrap('<div class="' + themeClass + '"></div>');
                }
            }
        });
        $('.date-range').daterangepicker({
            timePicker: true,
            timePickerIncrement: 15,
            timePicker24Hour: true,
            autoUpdateInput: false,
            locale: {
                format: 'YYYY-MM-DD HH:mm',
                "separator": " - ",
                "applyLabel": "应用",
                "cancelLabel": "清除",
                "fromLabel": "从",
                "toLabel": "至",
                "customRangeLabel": "自定义",
                "weekLabel": "周",
                "daysOfWeek": [
                    "日",
                    "一",
                    "二",
                    "三",
                    "四",
                    "五",
                    "六"
                ],
                "monthNames": [
                    "一月",
                    "二月",
                    "三月",
                    "四月",
                    "五月",
                    "六月",
                    "七月",
                    "八月",
                    "九月",
                    "十月",
                    "十一月",
                    "十二月"
                ]
            }
        });
        $('.date-range').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('YYYY-MM-DD HH:mm') + ' - ' + picker.endDate.format('YYYY-MM-DD HH:mm'));
        });
        $('.date-range').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
        });
        $('[data-toggle="tooltip"]').tooltip();
        $('[data-toggle="distpicker"]').distpicker();
        if($('select[name=category_id]').length && $('select[name=brand_id]').length) {
            $('select[name=category_id]').on('change', function() {
                $('select[name=brand_id]').html('<option value="0">无</option>');
                if($(this).val() > 0) {
                    $.ajax({
                        url: route('admin.category.category.brand.index', $(this).val()),
                        type: 'GET',
                        data: { json: 1 },
                        cache: false,
                        dataType: 'json',
                        success: function(data) {
                            if(data.brands.length) {
                                $.each(data.brands, function (i, v) {
                                    $('select[name=brand_id]').append('<option value="'+v.id+'">'+v.name+'</option>');
                                });
                            }
                        }
                    });
                }
            });
        }
    };

    var runWangEditor = function() {
        if($('#editor_container').length) {
            var object = $('#editor_container').data('object');
            var E = window.wangEditor
            var editor = new E('#editor_container')
            editor.customConfig.menus = [
                'head',
                'bold',
                'italic',
                'underline',
                'strikeThrough',
                'foreColor',
                'backColor',
                'link',
                'list',
                'justify',
                'quote',
                'image',
                'table',
                'undo',
                'redo'
            ];
            editor.customConfig.uploadImgServer = '/admin/upload';
            editor.customConfig.uploadFileName = 'image';
            editor.customConfig.zIndex = 200;
            editor.customConfig.uploadImgParams = {
                '_token': window.csrf_token
            };
            editor.customConfig.customAlert = function (info) {
                toastr.error(info);
            };
            editor.customConfig.uploadImgHooks = {
                fail: function (xhr, editor, result) {
                    toastr.error(result.msg);
                }
            }
            editor.create();
            $('form').on('submit', function(){
                $('<input>').attr({
                    type: 'hidden',
                    name: object,
                    value: editor.txt.html()
                }).appendTo('form');
            });
        }
    };

    var runNestable = function() {
        $('#nestable-alt').nestable({
            group: 2,
            maxDepth: 2
        }).on('change', updateNestable);
        updateNestable($('#nestable-alt').data('output', $('#nestable-output')));
        $('#nestable-menu').on('change', function(e) {
            var target = $(e.target),
                action = target.data('action');
            if (action === 'expand-all') {
                $('.dd').nestable('expandAll');
            }
            if (action === 'collapse-all') {
                $('.dd').nestable('collapseAll');
            }
        });
    };

    var updateNestable = function(e) {
        var list = e.length ? e : $(e.target),
            output = list.data('output');
        if (window.JSON) {
            output.val(window.JSON.stringify(list.nestable('serialize'))); //, null, 2));
        } else {
            output.val('JSON browser support required for this demo.');
        }
    };

    return {
        init: function() {
            var route = window.location.pathname.substr(1);
            runGlobal();
            if (/^admin\/(merchant|sample)\/(\d+|create)/.test(route)) {
                runWangEditor();
            } else if (route == 'admin/category'){
                runNestable();
            }
        }

    }
}();