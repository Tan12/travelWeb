$(document).ready(function() {

  initPagination();

  var URL = getURL(),
      $search = $('#search'),
      $show = $('#show'),
	    $add = $('#add'),
	    $showTips = $('#showTips'),
      $cont = $('#cont'),
      $realCont = $('#real-cont');

  // 搜索
  $search.submit(function(){
    var $keyword = $search.children('input[name=search]');
    if(!$keyword.val()){
      alert("请输入关键字！");
      $keyword.focus();
    }else{
      $.ajax({
        url:URL+"/searchPost",
        type:"POST",
        data:{keyword:$keyword.val()},
        dataType:"json",
        success:function (msg){
                  console.log(msg);
                  $cont.empty();
                  if(msg.length < 1){
                    $realCont.empty();
                    $('#holder').empty();
                    $p = $('<p class="text-center margin-top-20">未找到相关帖子:(</p>');
                    $realCont.append($p);
                    return;
                  }
                  for(var i = 0, n = msg.length; i < n; i++){
                    var $div = $('<div class="post-preview"></div>'),
                        $h2_a = $('<a href="'+URL+'/post?id='+msg[i].posts_id+'" target="_blank">'+msg[i].posts_title+'</a>'),
                        $h2 = $('<h2 class="post-title"></h2>'),
                        $div_div = $('<div class="post-content">'+msg[i].posts_content+'...</div>'),
                        $p = $('<p class="post-meta"></p>'),
                        $p_s1 = $('<span class="glyphicon glyphicon-user">'+msg[i].posts_author+'</span>'),
                        $p_s2 = $('<span class="glyphicon glyphicon-time">'+msg[i].posts_time+'</span>'),
                        $p_s3 = $('<span class="glyphicon glyphicon-comment">'+msg[i].coms_num+'</span>'),
                        $p_a = $('<a href="##" class="del" name="'+msg[i].posts_id+'"><span class="glyphicon glyphicon-trash"></span>删除</a>'),
                        $hr = $('<hr>');
                    $h2.append($h2_a);
                    $p.append($p_s1).append($p_s2).append($p_s3).append($p_a);
                    $div.append($h2).append($div_div).append($p).append($hr);
                    $cont.append($div);
                  }
                  initPagination();
                }
      });
    }
    return false;
  });

  // 删除内容
  var $dels = $('#real-cont a.del');
  //console.log($dels);
  $dels.click(function(){
    var id = $(this).attr('name'),
        num = $(this).next('span').text();
    console.log(num);
    $.ajax({
        url:URL+"/delPost",
        type:"POST",
        data:{id:id, num:num},
        dataType:"json",
        success:function (msg){
              alert(msg);
              if(msg === "删除成功！"){
                var $ori = $("#cont").find("a[name="+id+"]"),
                    $parent_div = $ori.parent('p').parent('div');
                $parent_div.remove();
                initPagination();
              }
            }
      });
  });

});
