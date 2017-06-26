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
        url:URL+"/searchTips",
        type:"POST",
        data:{keyword:$keyword.val()},
        dataType:"json",
        success:function (msg){
                  var html;
                  $tips.empty();
                  if(msg.length < 1){
                    $realTips.empty();
                    $('#holder').empty();
                    $p = $('<p class="text-center margin-top-20">未找到相关攻略:(</p>');
                    $realTips.append($p);
                    return;
                  }
                  for(var i = 0, n = msg.length; i < n; i++){
                    var $div = $('<div class="post-preview"></div>'),
                        $a = $('<a href="'+URL+'/message?id='+msg[i].tips_id+'" target="_blank"></a>'),
                        $a_h2 = $('<h2 class="post-title">'+msg[i].tips_title+'</h2>'),
                        $a_div = $('<div class="post-content">'+msg[i].tips_content+'...</div>'),
                        $p = $('<p class="post-meta"></p>'),
                        $p_s1 = $('<span class="glyphicon glyphicon-user">'+msg[i].tips_author+'</span>'),
                        $p_s2 = $('<span class="glyphicon glyphicon-time">'+msg[i].tips_time+'</span>'),
                        $hr = $('<hr>');
                    $a.append($a_h2).append($a_div);
                    $p.append($p_s1).append($p_s2);
                    $div.append($a).append($p).append($hr);
                    $tips.append($div);
                  }
                  initPagination();
                }
      });
    }
    return false;
  });

  // 分页
  initPagination();

});
