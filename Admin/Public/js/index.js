$(document).ready(function() {
  var ue = getUE();

  var URL = getURL(),
      $search = $('#search'),
      $show = $('#show'),
	    $add = $('#add'),
	    $showNews = $('#showNews'),
      $news = $('#news'),
      $realNews = $('#realNews'),
	    $addNews = $('#addNews'),
      $editor = $('#editor');

  // 搜索
  $search.submit(function(){
    var $keyword = $search.children('input[name=search]');
    if(!$keyword.val()){
      alert("请输入关键字！");
      $keyword.focus();
    }else{
      $.ajax({
        url:URL+"/searchNews",
        type:"POST",
        data:{keyword:$keyword.val()},
        dataType:"json",
        success:function (msg){
                  $news.empty();
                  if(msg.length < 1){
                    $realNews.empty();
                    $('#holder').empty();
                    $p = $('<p class="text-center">未找到相关新闻:(</p>');
                    $realNews.append($p);
                    return;
                  }
                  for(var i = 0, n = msg.length; i < n; i++){
                    var $div = $('<div class="post-preview"></div>'),
                        $a = $('<a href="'+URL+'/new?id='+msg[i].news_id+'" target="_blank"></a>'),
                        $a_h2 = $('<h2 class="post-title">'+msg[i].news_title+'</h2>'),
                        $a_div = $('<div class="post-content">'+msg[i].news_content+'...</div>'),
                        $p = $('<p class="post-meta">'+msg[i].news_time+'</p>'),
                        $p_a = $('<a class="del" href="##" name="'+msg[i].news_id+'"> 删除</a>'),
                        $hr = $('<hr/>');
                    $a.append($a_h2).append($a_div);
                    $p.append($p_a);
                    $div.append($a).append($p).append($hr);
                    $news.append($div);
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
		$showNews.fadeIn(200);
		$addNews.hide();
	});

  // 显示发布新内容
	$add.click(function(){
		$add.addClass('active');
		$show.removeClass('active');
		$addNews.fadeIn(200);
		$showNews.hide();
	});

  // 删除内容
  var $dels = $('#news a.del');
  $dels.click(function(){
    var id = $(this).attr('name');
    console.log(id);
    $.ajax({
        url:URL+"/delNew",
        type:"POST",
        data:{id:id},
        dataType:"json",
        success:function (msg){
              alert(msg);
              if(msg === "删除成功！"){
                var $ori = $("#news").find("a[name="+id+"]"),
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
    var num_entries = $("#news div.post-preview").length;
    // 创建分页
    if(num_entries < 1){
      return;
    }
    if(num_entries < 5){
      pageselectCallback(0);
      return;
    }
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
    var $content = $("#news div.post-preview:eq("+min+")").clone(true);
    var $content2 = $("#news div.post-preview:lt("+page_index+"):gt("+min+")").clone(true);
    $("#realNews").empty().append($content);
    $("#realNews").append($content2);
    $('#realNews > div').show();
    return false;
  }

  // 提交新内容
  $addNews.submit(function(){
    var $news_title = $('#news-title'),
        html = ue.getContent(); //获取html内容，返回: <p>hello</p>
    //var txt = ue.getContentTxt(); 获取纯文本内容，返回: hello
    if(!$news_title.val()){
      alert('请输入标题！');
			$news_title.focus();
    }else if(!html){
      alert('请输入内容！');
			ue.focus(true);
    }else {
      //console.log(html);
      $.ajax({
				url:URL+"/addNew",
				type:"POST",
				data:{title:$news_title.val(), content:html},
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
