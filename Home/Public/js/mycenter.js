$(document).ready(function(){
	// 分页
  	initPagination();
	comPage();

	var URL = getURL(),
		$edit = $('#edit'), // 修改图标
		$mask = $('.edit-mask'), // 遮罩
		$cont = $('.edit-cont'), // 弹框内容
		$edit_info = $('#edit-info'),
		$edit_pwd = $('#edit-pwd'),
		$form_info = $('#form-info'),
		$sm_info = $('#sm-info'),
		$form_pwd = $('#form-pwd'),
		$sm_pwd = $('#sm-pwd'),
		$cancel = $('.cancel'); // 取消按钮

	$edit.click(function(){
		$mask.show();
		$cont.fadeIn(200);
	});

	$edit_info.click(function(){
		$edit_info.addClass('active');
		$edit_pwd.removeClass('active');
		$form_pwd.hide();
		$form_info.fadeIn(200);
	});
	$edit_pwd.click(function(){
		$edit_pwd.addClass('active');
		$edit_info.removeClass('active');
		$form_info.hide();
		$form_pwd.fadeIn(200);
	});

	$cancel.click(function(){
		$mask.hide();
		$cont.fadeOut(100);
		return false;
	});

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

	// 删除我的评论
	var $delCom = $('#coms a.del-com');
	$delCom.click(function(){
		var id = $(this).attr('name');
		console.log(id);
		$.ajax({
	        url:URL+"/delCom",
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
		if(num_entries < 1){
			$('#real-coms > div').remove();
			return;
		}
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

	$sm_info.click(function(){
		var $name = $('#edit-name'),
			$email = $('#edit-email'),
			$file = $('#edit-pic'),
			id = $('#user-id').val();
		if(!$name.val() && !$email.val() && !$file.val()){
			alert('请输入至少一项内容！');
			$name.focus();
		}else{
			if($file.val()){
				//console.log($file.val());
				var filename = $file.val().split('.'),
					n = filename.length-1,
					types = ['gif','GIF','jpg','JPG','png','PNG','jpeg','JPEG'];
				if($.inArray(filename[n], types) < 0){
					alert("图片必须为gif、jpg、png或jpeg格式");
				}
			}
			var formData = new FormData($("#form-info")[0]);
			$.ajax({
				url: URL+'/editInfo',
				type: 'POST',
				data: formData,
				async: false,
				cache: false,
				contentType: false,
				processData: false,
				success: function (returndata) {
				    alert(returndata);
				    if(returndata === '修改成功！'){
				    	location.reload();
				    }
				},
				error: function (returndata) {
				    console.log(returndata);
				}
			});
			
		}
		return false;
	});

	$sm_pwd.click(function(){
		var $old = $('#old-pwd'),
			$new = $('#new-pwd'),
			$check = $('#check-pwd');
		if(!$old.val()){
			alert('请输入旧密码！');
			$old.focus();
		}else if(!$new.val()){
			alert('请输入新密码！');
			$new.focus();
		}else if(!$check.val()){
			alert('请输入确认密码！');
			$check.focus();
		}else if($new.val() !== $check.val()){
			alert('新密码与确认密码不一致！');
			$check.focus();
		}else{
			$.ajax({
				url:URL+"/editPwd",
				type:"POST",
				data:{oldpwd:$old.val(), newpwd:$new.val()},
				dataType:"json",
				success:function (info){
							alert(info);
							if(info === "修改成功！"){
								location.reload();
							}
						}
			});
		}
		return false;
	});

});