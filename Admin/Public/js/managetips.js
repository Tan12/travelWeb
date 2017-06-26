$(document).ready(function() {
  var ue = getUE();

  var URL = getURL(),
      $search = $('#search'),
      $show = $('#show'),
	    $add = $('#add'),
	    $showTips = $('#showTips'),
      $tips = $('#tips'),
      $realTips = $('#realTips'),
	    $addTips = $('#addTips'),
      $editor = $('#editor');

  var $dels = $('#tips a.del');

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
                  $tips.empty();
                  if(msg.length < 1){
                    $realTips.empty();
                    $('#holder').empty();
                    $p = $('<p class="text-center">未找到相关攻略:(</p>');
                    $realTips.append($p);
                    return;
                  }
                  for(var i = 0, n = msg.length; i < n; i++){
                    var $div = $('<div class="post-preview"></div>'),
                        $a = $('<a href="'+URL+'/message?id='+msg[i].tips_id+'" target="_blank"></a>'),
                        $a_h2 = $('<h2 class="post-title">'+msg[i].tips_title+'</h2>'),
                        $a_div = $('<div class="post-content">'+msg[i].tips_content+'...</div>'),
                        $p = $('<p class="post-meta">'+msg[i].tips_author+'发布于'+msg[i].tips_time+'</p>'),
                        $p_a = $('<a class="del" href="##" name="'+msg[i].tips_id+'"> 删除</a>');
                        $hr = $('<hr/>');
                    $a.append($a_h2).append($a_div);
                    $p.append($p_a);
                    $div.append($a).append($p).append($hr);
                    $tips.append($div);
                  }
                  initPagination();
                }
      });
    }
    return false;
  });


  // 显示已发布内容
	$show.click(function(){
		$show.addClass('active');
		$add.removeClass('active');
		$showTips.fadeIn(200);
		$addTips.hide();
	});

  // 显示发布新内容
	$add.click(function(){
		$add.addClass('active');
		$show.removeClass('active');
		$addTips.fadeIn(200);
		$showTips.hide();
	});

  // 删除内容
  $dels.click(function(){
    var id = $(this).attr('name');
    console.log(id);
    $.ajax({
        url:URL+"/delTip",
        type:"POST",
        data:{id:id},
        dataType:"json",
        success:function (msg){
              alert(msg);
              if(msg === "删除成功！"){
                var $ori = $("#tips").find("a[name="+id+"]"),
                    $parent_div = $ori.parent('p').parent('div');
                $parent_div.remove();
                initPagination();
              }
            }
      });
  });

  // 分页
  initPagination();
  function initPagination(){
    var num_entries = $("#tips div.post-preview").length;
    // 创建分页
    $("#holder").pagination(num_entries, {
      num_edge_entries: 1, //边缘页数
      num_display_entries: 4, //主体页数
      items_per_page:4, //每页显示几项
      callback: pageselectCallback
    });
  }
  function pageselectCallback(page_index, jq){
    var min = page_index*4;//page_index从0开始算
    page_index = min+4;
    var $content = $("#tips div.post-preview:eq("+min+")").clone(true);
    var $content2 = $("#tips div.post-preview:lt("+page_index+"):gt("+min+")").clone(true);
    $("#realTips").empty().append($content);
    $("#realTips").append($content2);
    $('#realTips > div').show();
    return false;
  }

  // 提交新内容
  $addTips.submit(function(){
    var $tips_title = $('#tips-title'),
        $tags = $('#tags'),
        html = ue.getContent(); //获取html内容，返回: <p>hello</p>
    //var txt = ue.getContentTxt(); 获取纯文本内容，返回: hello
    if(!$tips_title.val()){
      alert('请输入标题！');
			$tips_title.focus();
    }else if(!$tags.val()){
      alert('请输入标签！');
			$tags.focus();
    }else if(!html){
      alert('请输入内容！');
			ue.focus(true);
    }else {
      var title = $tips_title.val(),
          tags = $tags.val();
      //console.log(html);
      $.ajax({
				url:URL+"/addTip",
				type:"POST",
				data:{title:title, tags:tags, content:html},
				dataType:"json",
				success:function (msg){
							alert(msg);
              if(msg === "添加成功！"){
                location.reload();
              }
						}
			});
    }
    return false;
  });
});
