$(document).ready(function(){
	var URL = getURL(),
			$login = $('#login'),
	    $register = $('#register'),

			$login_form = $('#login-form'),
			$login_name = $('#name'),
			$login_pwd = $('#pwd'),
			$verify = $('#verify'),

			$register_form = $('#register-form'),
			$register_name = $('#name2'),
			$register_email = $('#email'),
			$register_pwd = $('#pwd2'),
			$register_pwd2 = $('#pwd22');

	//console.log(URL);
	
	$login.click(function(){
		$login.addClass('active');
		$register.removeClass('active');
		$login_form.fadeIn(200);
		$register_form.hide();

	});
	$register.click(function(){
		$register.addClass('active');
		$login.removeClass('active');
		$register_form.fadeIn(200);
		$login_form.hide();
	});

	// 登录
	$login_form.submit(function(){
		if(!$login_name.val()){
		  alert('请输入用户名！');
			$login_name.focus();
		}else if(!$login_pwd.val()){
			alert('请输入密码！');
			$login_pwd.focus();
		}else if(!$verify.val()){
			alert('请输入验证码！');
			$verify.focus();
		}else{
			var name = $login_name.val(),
			    pwd = $login_pwd.val(),
					verify = $verify.val();
			$.ajax({
				url:URL+"/checkLogin",
				type:"POST",
				data:{name:name, pwd:pwd, verify:verify},
				dataType:"json",
				success:function (warning){
							if(warning === "登录成功！"){
								location.href = URL+'/index';
							}else{
								alert(warning);
							}
						}
			});
		}
		return false;
	});

	// 注册
	$register_form.submit(function(){
		if(!$register_name.val()){
		    alert('请输入用户名！');
			$register_name.focus();
		}else if(!$register_email.val()){
			alert('请输入邮箱！');
			$register_email.focus();
		}else if(!$register_pwd.val()){
			alert('请输入密码！');
			$register_pwd.focus();
		}else if(!$register_pwd2.val()){
			alert('请输入确认密码！');
			$register_pwd2.focus();
		}else if($register_pwd.val() !== $register_pwd2.val()){
			alert('两次密码不一致！');
			$register_pwd2.focus();
		}else{
			var name = $register_name.val(),
			    email = $register_email.val(),
			    pwd = $register_pwd2.val();
			console.log(URL);
			$.ajax({
				url:URL+"/register",
				type:"POST",
				data:{name:name, email:email, pwd:pwd},
				dataType:"json",
				success:function(warning){
							if(warning === "注册成功！"){
								location.href = URL+'/index';
							}else{
								alert(warning);
							}
						}
			});
		}
		return false;
	});
});
