'use strict';
//  Author: AdminDesigns.com
// 
//  This file is reserved for changes made by the use. 
//  Always seperate your work from the theme. It makes
//  modifications, and future theme updates much easier 
// 

var Custom = function() {

    var runGlobal = function() {
        $(".delete-btn").on('click', function() {
            var delete_id = $(this).data('delete-id');
            var delete_url = $(this).data('delete-url');
            var current_parent = $(this).parent().parent();
            if (bootbox.confirm) {
                if(delete_url == 'tfa'){
                    bootbox.confirm("确认锁定当前账户?", function(e) {
                        if (e) {
                            $.ajax({
                                url: '/' + delete_url + '/' + delete_id,
                                type: 'DELETE',
                                cache: false,
                                dataType: 'json',
                                success: function(data) {
                                    if (data.code == 200) {
                                        location.href = '/tfa';
                                    }
                                },
                            });
                        } else {
                            return;
                        }
                    });
                } else {
                    bootbox.confirm("确认删除该条目?", function(e) {
                        if (e) {
                            $.ajax({
                                url: '/' + delete_url + '/' + delete_id,
                                data: {
                                    _token: csrf_token
                                },
                                type: 'DELETE',
                                cache: false,
                                dataType: 'json',
                                success: function(data) {
                                    if (data.code == 200) {
                                        current_parent.remove();
                                        alert('删除成功');
                                    }
                                },
                            });
                        } else {
                            return;
                        }
                    });
                }
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
    };

    var runNestable = function() {
        $.getScript("/vendor/plugins/nestable/jquery.nestable.js", function(data, textStatus, jqxhr) {
            $('#nestable-alt').nestable({
                group: 2,
                maxDepth: 3
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
        });
    };

    var runFancyTree = function(e) {
        $.getScript("/vendor/plugins/fancytree/jquery.fancytree-all.min.js", function(){
            $.getScript("/vendor/plugins/fancytree/extensions/jquery.fancytree.childcounter.js");
            $.getScript("/vendor/plugins/fancytree/extensions/jquery.fancytree.columnview.js");
            $.getScript("/vendor/plugins/fancytree/extensions/jquery.fancytree.dnd.js");
            $.getScript("/vendor/plugins/fancytree/extensions/jquery.fancytree.edit.js");
            $.getScript("/vendor/plugins/fancytree/extensions/jquery.fancytree.filter.js");
            $("#treeList").fancytree({
                source: treeData,
                selectMode: 3,
                checkbox: true, // Show checkboxes.
                clickFolderMode: 2, // 1:activate, 2:expand, 3:activate and expand, 4:activate (dblclick expands)
                select: function(event, data) {
                    // Display list of selected nodes
                    var selNodes = data.tree.getSelectedNodes();
                    // convert to title/key array
                    var selKeys = $.map(selNodes, function(node) {
                        return node.key;
                    });
                    $("#zones").val(selKeys.join(","));
                },
            });
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
            if (route == 'zone') {
                runNestable();
            } else if (/^user\/\d+\/edit$/.test(route)) {
                runFancyTree();
            }
        }

    }
}();