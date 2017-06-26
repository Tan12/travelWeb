$(document).ready(function(){
  var URL  = getURL(),
      $search = $('#search'),
      $showTips = $('#showTips'),
      $tips = $('#cont'),
      $realTips = $('#real-cont');

	// 搜索
  $search.submit(function(){
    var $keyword = $search.children('input[name=search]');
    if(!$keyword.val()){
      alert("请输入关键字！");
      $keyword.focus();
    }else{
      $.ajax({
        url:URL+"/searchViews",
        type:"POST",
        data:{keyword:$keyword.val()},
        dataType:"json",
        success:function (msg){
                  var html;
                  $tips.empty();
                  if(msg.length < 1){
                    $realTips.empty();
                    $('#holder').empty();
                    $p = $('<p class="text-center margin-top-20">未找到相关景点:(</p>');
                    $realTips.append($p);
                    return;
                  }
                  for(var i = 0, n = msg.length; i < n; i++){
                    var $div = $('<div class="post-preview"></div>'),
                        $h2_a = $('<a href="'+URL+'/view?id='+msg[i].sights_id+'" target="_blank">'+msg[i].sights_name+'</a>'),
                        $h2 = $('<h2 class="post-title"></h2>'),
                        $div_div = $('<div class="post-content">'+msg[i].intro+'...</div>'),
                        $hr = $('<hr>');
                    $h2.append($h2_a);
                    $div.append($h2).append($div_div).append($hr);
                    $tips.append($div);
                    initPagination();
                  }
                }
      });
    }
    return false;
  });

  // 分页
  initPagination();

});
