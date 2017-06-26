$(document).ready(function() {
	initPagination();
	var URL = getURL(),
		$dels = $('#real-cont a.del');
	$dels.on('click', function(){
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
		                var $ori = $("#cont").find("a[name="+id+"]"),
		                    $parent_div = $ori.parent('p').parent('div');
		                $parent_div.remove();
		                initPagination();
		              }
		            }
	      });
	  });
});