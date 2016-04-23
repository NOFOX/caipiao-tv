<?php
    require_once('../conn.php');
?>
<html>
<head>
	<title>知了彩票</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="style.css">
    <script type="text/javascript" src="../jquery-2.2.2.min.js"></script>
    <script type="text/javascript" src="../table.js"></script>
    <script type="text/javascript" src="../table_1.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1" />
</head>
<body>
	<div id="header">
		<div class="nav_1">
			<h2>期<br>数</h2>
		</div>
		<div class="nav_2">
			<div class="kaijianghaoma"><span><b><p>开 &nbsp;&nbsp;奖&nbsp;&nbsp;号&nbsp;&nbsp;码&nbsp;&nbsp;</p></b></span></div>
			<div class="shuzihaomaqu"><span><h4>数&nbsp;&nbsp;字&nbsp;&nbsp;号&nbsp;&nbsp;码&nbsp;&nbsp;区</h4></span></div>
			<div class="nub">
				<div class="cub"><b><p>一</p></b></div>
                <div class="cub"><b><p>二</p></b></div>
                <div class="cub"><b><p>三</p></b></div>
			</div>
		</div>
		<div class="nav_3">
			<div class="zoushi"><span><b><p>开 &nbsp;&nbsp;奖&nbsp;&nbsp;号&nbsp;&nbsp;码&nbsp;&nbsp;及&nbsp;&nbsp;走&nbsp;&nbsp;势</p></b></span></div>
			<div class="fenqu">
				<div class="fenqu_1" style="background:#999;">小&nbsp;&nbsp;号&nbsp;&nbsp;区</div>
				<div class="fenqu_1" style="background:#888;">中&nbsp;&nbsp;号&nbsp;&nbsp;区</div>
				<div class="fenqu_1" style="background:#777;">大&nbsp;&nbsp;号&nbsp;&nbsp;区</div>
				<div class="fenqu_2" style="background:#fff;">红&nbsp;&nbsp;号&nbsp;&nbsp;区</div>
			</div>
			<div class="haoma">
				<div class="haoma_1"><p>1</p></div>
				<div class="haoma_1"><p>2</p></div>
				<div class="haoma_1"><p>3</p></div>
				<div class="haoma_1"><p>4</p></div>
				<div class="haoma_1"><p>5</p></div>
				<div class="haoma_1"><p>6</p></div>
				<div class="haoma_1"><p>7</p></div>
				<div class="haoma_1"><p>8</p></div>
				<div class="haoma_1"><p>9</p></div>
				<div class="haoma_1"><p>10</p></div>
				<div class="haoma_1"><p>11</p></div>
				<div class="haoma_1"><p>12</p></div>
				<div class="haoma_1"><p>13</p></div>
				<div class="haoma_1"><p>14</p></div>
				<div class="haoma_1"><p>15</p></div>
				<div class="haoma_1"><p>16</p></div>
				<div class="haoma_1"><p>17</p></div>
				<div class="haoma_1"><p>18</p></div>
				<div class="haoma_1" style="background: red;"><p>19</p></div>
				<div class="haoma_1" style="background: red;"><p>20</p></div>
			</div>
		</div>
	</div>

    <div class="pic">

    	<div class="tle">
    		<ul>
				<li style="width:25%; float:left;">

<?php

    include_once("../tool.php");

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
$sql = "select * from fucai_1215 order by date desc limit 72";
/* 定义变量q, "SELECT * FROM abc"是一个SQL语句,意思是读取表abc中的数据 */

$rs = mysql_query($sql, $dbh);
/* 定义变量 rs ,函数mysql_query()的意思是:送出 query 字串供 MySQL 做相关的处理或者执行.由于php是从右往左执行的,所以,rs的值是服务器运行mysql_query()函数后返回的值 */
if(!$rs){die("Valid result!");}
echo "<table  id='myTable1'>";

$data = array();
while($row = mysql_fetch_array($rs)){
	$data[] = $row;
}
//这个indexajax是个定时刷新的~~
$data = multi_array_sort($data,'date');

echo '<tr>';
foreach($data as $row){
	 $row[1]=substr($row[1],-2);
	echo "<tr><td>$row[1]</td><td style='color:red'>$row[2]</td><td style='color:red'>$row[3]</td><td style='color:red'>$row[4]</td></tr>";
}
echo '</tr>';


//while($row = mysql_fetch_row($rs)) echo "<tr><td><p>$row[1]</p></td><td><p>$row[2]</p></td><td><p>$row[3]</p></td><td><p>$row[4]</p></td><td><p>$row[5]</p></td><td><p>$row[6]</p></td><td><p>$row[7]</p></td><td><p>$row[8]</p></td></tr>";
/* 定义量变(数组)row,并利用while循环,把数据一一写出来.
函数mysql_fetch_row()的意思是:将查询结果$rs单列拆到阵列变数中.
$row[0] 和 $row[1] 的位置可以换*/
echo "</table>";
//$fromurl="http://www.baidu.com/"; //跳转往这个地址。
//if( $_SERVER['HTTP_REFERER'] == "" )
//{
//header("Location:".$fromurl); exit;
//}

?>
				</li>


				<li style="width:75%;float:right;">
<!-- 走势图 -->
<?php
$sql ="select date,num_1,num_2,num_3,num_4,num_5,num_6,num_7,num_8 from fucai_1215 order by date desc  limit 72";
/* 定义变量q, "SELECT * FROM abc"是一个SQL语句,意思是读取表abc中的数据 */
$rs = mysql_query($sql, $dbh);
/* 定义变量 rs ,函数mysql_query()的意思是:送出 query 字串供 MySQL 做相关的处理或者执行.由于php是从右往左执行的,所以,rs的值是服务器运行mysql_query()函数后返回的值 */
if(!$rs){die("Valid result!");}
echo "<table id='myTable2'>";

$data = array();
while($row = mysql_fetch_array($rs)){
    $data[] = $row;
}

$allArr = array();
$data = Tool::multi_array_sort($data,'date');
$dataNum = count($data);

for($index=0;$index<$dataNum;$index++){
    $row = Tool::convert20($data[$index]);

    $oneArr = array();
    $twoArr = array();
    $threeArr = array();
    $fourArr = array();

    if(array_key_exists($index-2,$data)){
        $oneArr = Tool::convert20($data[$index-2]);
    }
    if(array_key_exists($index-1,$data)){
        $twoArr = Tool::convert20($data[$index-1]);
    }
    if(array_key_exists($index+1,$data)){
        $threeArr = Tool::convert20($data[$index+1]);
    }
    if(array_key_exists($index+2,$data)){
        $fourArr = Tool::convert20($data[$index+2]);
    }
    echo '<tr>';

    for($j=1;$j<=20;$j++) {
        $isHLian = false;//竖的连号
        if($row[$j]!=0){
            if(!empty($oneArr)&&!empty($twoArr)&&$oneArr[$j]==$twoArr[$j]&&$oneArr[$j]==$row[$j]){
                $isHLian = true;
            }else if(!empty($twoArr)&&!empty($threeArr)&&$twoArr[$j]==$threeArr[$j]&&$twoArr[$j]==$row[$j]){
                $isHLian = true;
            }else if(!empty($threeArr)&&!empty($fourArr)&&$threeArr[$j]==$fourArr[$j]&&$threeArr[$j]==$row[$j]){
                $isHLian = true;
            }
        }

        $isLLian = false;//横的连号
        if(array_key_exists($j-2,$row)&&array_key_exists($j-1,$row)&&$row[$j-1]!=0&&$row[$j-2]!=0&&$row[$j]!=0){
            $isLLian = true;
        }else if(array_key_exists($j-1,$row)&&array_key_exists($j+1,$row)&&$row[$j-1]!=0&&$row[$j+1]!=0&&$row[$j]!=0){
            $isLLian = true;
        }else if(array_key_exists($j+1,$row)&&array_key_exists($j+2,$row)&&$row[$j+1]!=0&&$row[$j+2]!=0&&$row[$j]!=0){
            $isLLian = true;
        }

        $style = '';
        if($isHLian){
            $style.='color:#000;font-size:16px;';
        }

        if($isLLian){
            $style.='font-size:16px;background:#999;';
        }
        if($row[$j]==0){
            echo "<td></td>";
        }else{
            echo "<td".(" style=$style").">$row[$j]</td>";
        }
    }

    echo '</tr>';

}


/* 定义量变(数组)row,并利用while循环,把数据一一写出来.
函数mysql_fetch_row()的意思是:将查询结果$rs单列拆到阵列变数中.
$row[0] 和 $row[1] 的位置可以换*/
echo "</table>";

@mysql_close($dbh);
/* 关闭到mysql数据库的连接 */

//页面自动取得数据开始



//页面自动取得数据结束



// $fromurl="http://www.baidu.com/"; //跳转往这个地址。
//if( $_SERVER['HTTP_REFERER'] == "" )
//{
//header("Location:".$fromurl); exit;
//}
?>
				</li>

			</ul>

    	</div>
    </div>

<?php
	require('../ad.php');
	?>
</body>
</html>
