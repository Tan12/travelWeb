$(document).ready(function(){
	var URL = getURL(),
		$dels = $('.del');

	$dels.click(function(){
	    var $this = $(this);
	    var id = $this.attr('name');
	    console.log(id);
	    $.ajax({
	        url:URL+"/delUser",
	        type:"POST",
	        data:{id:id},
	        dataType:"json",
	        success:function (msg){
	              alert(msg);
	              if(msg === "删除成功！"){
	                $this.parent('div').remove();
	              }
	            }
	      });
	 });
});