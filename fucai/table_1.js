
//循环执行，每隔3秒钟执行一次showalert（） 请求行的数据  时间可以改哟
window.setInterval(showalert, 16000);
function showalert()
{
  //ajax 请求最新数据    
	$.ajax({    
        type:'post',        
        url:'indexajax_1.php',    
        data:'act=a',      
        cache:false,    
        dataType:'html',    
        success:function(data){
			$("#myTable2").html(data); //赋值给新的table1
        }
    });
 
}
