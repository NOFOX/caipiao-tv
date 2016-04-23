<?php 
include_once("../conn.php");
/**
	 * 二维数组排序
	 * @param Array $multi_array 待排序数组
	 * @param Array $sort_key  排序字段
	 * @return string $sort 排序类型：SORT_ASC / SORT_DESC
	 */
	function multi_array_sort($multi_array, $sql, $sort = SORT_ASC){
		if(is_array($multi_array) and !empty($multi_array)){
			foreach ($multi_array as $row_array){
				if(is_array($row_array)){
					$key_array[] = $row_array[$sql];
				}else{
					return -1;
				}
			}
			array_multisort($key_array,$sort,$multi_array);
		}

		return $multi_array;
	}

 // 因为第一次浏览网页 已经有了mytable1 的id  了 
 
 // 所以 这次ajax 就 要tr 里面的数据  js 赋值就可以了
$sql ="select * from fucai_1215 order by date desc  limit 50";
//$size = "select count(*) from fucai";
//$start =($size-72)<0?0:$size-72; 
//$sql = "select id,date,num_1,num_2,num_3,num_4,num_5,num_6,num_7,num_8 from fucai limit $start,$size";
/* 定义变量q, "SELECT * FROM abc"是一个SQL语句,意思是读取表abc中的数据 */ 
 
$rs = mysql_query($sql, $dbh); 
/* 定义变量 rs ,函数mysql_query()的意思是:送出 query 字串供 MySQL 做相关的处理或者执行.由于php是从右往左执行的,所以,rs的值是服务器运行mysql_query()函数后返回的值 */ 
if(!$rs){die("Valid result!");} 
echo "<table  id='myTable1'>";  

$data = array();
while($row = mysql_fetch_array($rs)){
	//$row['date'] = substr($row['date'],0,-2);
	$data[] = $row;
}
/*
echo "<pre>";
print_r($data);*/

//这个indexajax是个定时刷新的~~
$data = multi_array_sort($data,'date');

echo '<tr>';
foreach($data as $row){
	 $row[1]=substr($row[1],-2);
	echo "<tr><td><p style='color:#000;background:#FFF;'>$row[1]</p></td><td><b><p style='color:red;'>$row[2]</p></b></td><td><b><p style='color:red;'>$row[3]</p></b></td><td><b><p style='color:red;'>$row[4]</p></b></td><td><p style='color:#000;'>$row[5]</p></td><td><p style='color:#000;'>$row[6]</p></td><td><p style='color:#000;'>$row[7]</p></td><td><p style='color:#000;'>$row[8]</p></td><td><p style='color:#000;'>$row[9]</p></td></tr>";
}
echo '</tr>';
for($i=1;$i<=2;$i++){
   echo "<tr><td><p></p></td><td><p></p></td></tr>";
}
for($i=1;$i<=2;$i++){
   echo "<tr><td><p></p></td><td><p></p></td><td><p></p></td><td><p></p></td><td><p></p></td><td><p></p></td><td><p></p></td><td><p></p></td><td><p></p></td><tr>";
}
echo "</table>";
exit;
//while($row = mysql_fetch_row($rs)) echo "<tr><td><p style='color:#000;'>$row[1]</p></td><td><b><p style='color:red;'>$row[2]</p></b></td><td><b><p style='color:red;'>$row[3]</p></b></td><td><b><p style='color:red;'>$row[4]</p></b></td><td><p style='color:#000;'>$row[5]</p></td><td><p style='color:#000;'>$row[6]</p></td><td><p style='color:#000;'>$row[7]</p></td><td><p style='color:#000;'>$row[8]</p></td><td><p style='color:#000;'>$row[9]</p></td></tr>"; 
/* 定义量变(数组)row,并利用while循环,把数据一一写出来.  
函数mysql_