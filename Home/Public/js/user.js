$(document).ready(function(){
	var URL = getURL(),
		$follow = $('#follow'),
		$f_span = $follow.children('span'),
		$if_follow = $('#if-follow').text();
	if($if_follow === 'follow'){
		$f_span.removeClass('glyphicon-star-empty').addClass('glyphicon-star');
	}
	$follow.click(function(){
		var $class = $f_span.attr('class').split(' '),
			n = $class.length-1,
			tag = '',
			follow = $('#user-id').text(), // 被关注者id
			follower = getUser(); // 关注者id
		if($class[n] === 'glyphicon-star-empty'){
			//console.log('关注ta');
			tag = 'follow';
		}else if($class[n] === 'glyphicon-star'){
			//console.log('取消关注');
			tag = 'nofollow';
		}
		console.log(follow+'.'+follower);
		$.ajax({
			url:URL+"/follow",
			type:"POST",
			data:{follow:follow, follower:follower, tag:tag},
			dataType:"json",
			success:function (info){
						alert(info);
						var $num = $('.followers div.num');
						if(info === "关注成功！"){
							$f_span.removeClass('glyphicon-star-empty').addClass('glyphicon-star');
							$num.text(parseInt($num.text()) + 1);
						}else if(info === "取消关注成功！"){
							$f_span.removeClass('glyphicon-star').addClass('glyphicon-star-empty');
							$num.text(parseInt($num.text()) - 1);
						}
					}
		});
	});
});