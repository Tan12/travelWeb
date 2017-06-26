$(document).ready(function(){
	var URL = getURL(),
		$post = $('#post-com'),
		$comment = $('#comment');

	// 分页
  	initPagination();

	// 提交评论
	$post.submit(function(){
		var userID = getName();
		if(!userID){
			alert('请先登录！');
			return false;
		}
		var postID = $('#posts-id').text();
		if(!$comment.val()){
			alert('请输入内容！');
			$comment.focus();
		}else{
			console.log($comment.val());
			$.ajax({
				url:URL+"/addCom",
				type:"POST",
				data:{content:$comment.val(), author:userID, post:postID},
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