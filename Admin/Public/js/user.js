$(document).ready(function(){
	var URL = getURL();

	initPagination();
	comPage();

	var $a_post = $('#a-post'),
		$a_comment = $('#a-comment'),
		$my_posts = $('#my-posts'),
		$my_coms = $('#my-coms');

	$a_post.click(function(){
		$my_posts.fadeIn(200);
		$my_coms.hide();
		initPagination();
	});
	$a_comment.click(function(){
		$my_coms.fadeIn(200);
		$my_posts.hide();
		comPage();
	});

	// 删除我的帖子
	var $delPost = $('#cont a.del-post');
	$delPost.click(function(){
		var id = $(this).attr('name'),
			num = $(this).next('span').text();
		console.log(id);
		$.ajax({
	        url:URL+"/delUserPost",
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

	// 删除我的评论
	var $delCom = $('#coms a.del-com');
	$delCom.click(function(){
		var id = $(this).attr('name');
		console.log(id);
		$.ajax({
	        url:URL+"/delUserCom",
	        type:"POST",
	        data:{id:id},
	        dataType:"json",
	        success:function (msg){
		              alert(msg);
		              if(msg === "删除成功！"){
		                var $ori = $("#coms").find("a[name="+id+"]"),
		                    $parent_div = $ori.parent('p').parent('div');
		                $parent_div.remove();
		                comPage();
		              }
		            }
	      });
	});


	// 评论的分页
	function comPage(){
		var num_entries = $("#coms div.post-preview").length;
		// 创建分页
		if(num_entries < 5){
			comCallback(0);
			return;
		}
		$("#com-holder").pagination(num_entries, {
			num_edge_entries: 1, //边缘页数
			num_display_entries: 4, //主体页数
			items_per_page:5, //每页显示几项
			callback: comCallback
		});
	}
	function comCallback(page_index, jq){
		var min = page_index*5;//page_index从0开始算
		page_index = min+5;
		var $content = $("#coms div.post-preview:eq("+min+")").clone(true);
		var $content2 = $("#coms div.post-preview:lt("+page_index+"):gt("+min+")").clone(true);
		$("#real-coms").empty().append($content);
		$("#real-coms").append($content2);
		$('#real-coms > div').show();
		return false;
	}
});