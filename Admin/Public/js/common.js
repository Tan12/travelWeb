// 分页
  function initPagination(){
    var num_entries = $("#cont div.post-preview").length;
    // 创建分页
    if(num_entries < 1){
      return;
    }
    if(num_entries < 5){
      pageselectCallback(0);
      $('#holder').empty();
      return;
    }
    $("#holder").pagination(num_entries, {
      num_edge_entries: 1, //边缘页数
      num_display_entries: 4, //主体页数
      items_per_page:5, //每页显示几项
      callback: pageselectCallback
    });
  }
  function pageselectCallback(page_index, jq){
    var min = page_index*5;//page_index从0开始算
    page_index = min+5;
    var $content = $("#cont div.post-preview:eq("+min+")").clone(true);
    var $content2 = $("#cont div.post-preview:lt("+page_index+"):gt("+min+")").clone(true);
    $("#real-cont").empty().append($content);
    $("#real-cont").append($content2);
    $('#real-cont > div').show();
    return false;
  }