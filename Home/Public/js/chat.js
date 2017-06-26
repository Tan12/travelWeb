$(document).ready(function(){
	var ue = getUE(),
		URL = getURL();

	var $post = $('#post'),
		$shows = $('.show-part'),
		$hides = $('.hide-part'),
		$cancel = $('#cancel'),
		$addPost = $('#add-post'),
		$search = $('#search'),
		$cont = $('#cont'),
		$realCont = $('#real-cont');
	$post.click(function(){
		var username = $('#user-name').text();
		if(!username){
			alert('请先登录！');
			return;
		}
		$shows.hide();
		$hides.fadeIn(200);
	});

	// 分页
	initPagination();

	$search.submit(function(){
		var $input = $('#search input');
		if(!$input.val()){
			alert('请输入关键字！');
			$input.focus();
		}else{
			console.log($input.val());
			$.ajax({
				url:URL+"/searchPost",
				type:"POST",
				data:{keyword:$input.val()},
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
		                        $p_s3 = $('<span class="glyphicon glyphicon-comment">('+msg[i].coms_num+')评论</span>'),
		                        $hr = $('<hr>');
		                    $h2.append($h2_a);
		                    $p.append($p_s1).append($p_s2).append($p_s3);
		                    $div.append($h2).append($div_div).append($p).append($hr);
		                    $cont.append($div);
		                  }
		                  initPagination();
						}
			});
		}
		return false;
	});

	$cancel.click(function(){
	var $title = $('#post-title'),
		content = ue.getContent();
		$title.val('');
		ue.setContent('<p>请输入内容...</p>');
		$hides.hide();
		$shows.fadeIn(200);
	});
	$addPost.submit(function(){
		var username = $('#user-name').text();
		if(!username){
			alert('请先登录！');
			return;
		}
		var $title = $('#post-title'),
			content = ue.getContent();
		if(!$title.val()){
			alert('请输入标题！');
			$title.focus();
		}else if(!content){
			alert('请输入内容！');
			ue.focus(true);
		}else{
			//console.log(content);
			$.ajax({
				url:URL+"/addPost",
				type:"POST",
				data:{title:$title.val(), content:content, author:username},
				dataType:"json",
				success:function (msg){
							alert(msg);
							if(msg === '发表成功！'){
								location.reload();
							}
						}
			});
		}
		return false;
	});
});