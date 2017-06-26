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
                        $p = $('<p class="post-meta"></p>'),
                        $p_a1 = $('<a class="del" href="##" name="'+msg[i].sights_id+'"> 删除</a>'),
                        $p_a2 = $('<a class="edit" href="##" name="'+msg[i].sights_id+'"> 编辑</a>'),
                        $hr = $('<hr>');
                    $h2.append($h2_a);
                    $p.append($p_a1).append($p_a2);
                    $div.append($h2).append($div_div).append($p).append($hr);
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

  // 编辑
  var $edits = $('#tips a.edit');
  $edits.click(function(){
    var id = $(this).attr('name');
    //console.log(id);
    $.ajax({
        url:URL+"/returnView",
        type:"POST",
        data:{id:id},
        dataType:"json",
        success:function (msg){
              console.log(msg);
              var $view_name = $('#view-name'),
                  $city = $('#city'),
                  $addr = $('#addr'),
                  $ticket = $('#ticket'),
                  $sm = $('#submit'),
                  $id = $('#view-id');
              $view_name.val(msg.sights_name);
              $city.val(msg.city);
              $addr.val(msg.address);
              $ticket.val(msg.ticket);
              ue.setContent(msg.intro);
              $sm.val('修改');
              $id.val(msg.sights_id);
              $addTips.fadeIn(200);
              $showTips.hide();
            }
      });
  });

  // 删除内容
  var $dels = $('#tips a.del');
  $dels.click(function(){
    console.log($(this).attr('name'));
    var id = $(this).attr('name');
    console.log(id);
    $.ajax({
        url:URL+"/delView",
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
    var $view_name = $('#view-name'),
        $city = $('#city'),
        $addr = $('#addr'),
        $ticket = $('#ticket'),
        sm = $('#submit').val(),
        id = $('#view-id').val(),
        html = ue.getContent(); //获取html内容，返回: <p>hello</p>
    //var txt = ue.getContentTxt(); 获取纯文本内容，返回: hello
    if(!$view_name.val()){
      alert('请输入景点名称！');
			$view_name.focus();
    }else if(!$city.val()){
      alert('请输入景点所属城市！');
			$city.focus();
    }else if(!$addr.val()){
      alert('请输入景点地址！');
      $addr.focus();
    }else if(!$ticket.val()){
      alert('请输入景点门票价格！');
      $ticket.focus();
    }else if(!html){
      alert('请输入内容！');
			ue.focus(true);
    }else {
      var name = $view_name.val(),
          city = $city.val(),
          addr = $addr.val(),
          ticket = $ticket.val();
      console.log(html);
      $.ajax({
				url:URL+"/addView",
				type:"POST",
				data:{name:name, city:city, addr:addr, ticket:ticket, content:html, sm:sm, id:id},
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
