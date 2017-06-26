$(document).ready(function(){
	var id = getID(),
		search = window.location.search,
		type = search.split('&&')[0].split('=')[1], // 获取地址栏type的值
		userid = search.split('&&')[1].split('=')[1], // 获取地址栏userid的值
		h1= '';
	/*if(type === 'follows' && userid === "<{$_SESSION['user_id']}>"){
		h1 = '我的关注';
	}else if(type === 'followers' && userid === "<{$_SESSION['user_id']}>"){
		h1 = '我的粉丝';
	}else if(type === 'follows' && userid !== "<{$_SESSION['user_id']}>"){
		h1 = 'Ta的关注';
	}else{
		h1 = 'Ta的粉丝';
	}*/
	if(type === 'follows'){
		h1 = (userid === id) ? '我的关注' : 'Ta的关注';
	}else if(type === 'followers'){
		h1 = (userid === id) ? '我的粉丝' : 'Ta的粉丝';
	}
	$('h1').text(h1);

	var $showUser = $('#showUser'),
		$div = $showUser.children('div');
	console.log(userid+'&'+id);
	if($div.length < 2 && !$div.children('a').children('h4').text()){
		$showUser.next('p').show();
	}else{
		$showUser.show();
	}
});