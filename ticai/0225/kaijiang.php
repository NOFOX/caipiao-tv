<?php
    require('../conn.php');
?>
<html>
<head>
	<title>知了彩票</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="style0225.css">
    <script type="text/javascript" src="../jquery-2.2.2.min.js"></script>
    <script type="text/javascript" src="../table.js"></script>
    <script type="text/javascript" src="../table_1.js"></script>
    <script type="text/javascript" src="../table_4.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1" />
</head>
<body>

	<div id="header">
		<div class="nav_1">
			<h2>期<br>数</h2>
		</div>

		<div class="nav_3">

			<div class="zoushi"><span><b><p>前&nbsp;三&nbsp;值</p></b></span></div>
        		<ul>
                <li style="float:left;">
                	<div class="haoma">
                		<p>一</p>
                	</div>
				</li>
            	<li style="float:left;">
			    	<div class="haoma">
						<p>二</p>
			    	</div>
            	</li>
            	<li style="float:left;">
			    	<div class="haoma">
						<p>三</p>
			    	</div>
            	</li>
            </ul>
		</div>
        <div class="nav_new"><span><b><p>任&nbsp;&nbsp;&nbsp;&nbsp;选&nbsp;&nbsp;&nbsp;&nbsp;值&nbsp;&nbsp;&nbsp;&nbsp;走&nbsp;&nbsp;&nbsp;&nbsp;势</p></b></span></div>
			<div class="nav_no">
			<ul>
                <li style="float:left; background:#fff;">
                		<p>一</p>
				</li>
            	<li style="float:left; background:#DDDCDC;">
						<p>二</p>
            	</li>
            	<li style="float:left; background:#fff;">
						<p>三</p>
            	</li>
            	<li style="float:left; background:#DDDCDC;">
                		<p>四</p>
				</li>
            	<li style="float:left; background:#fff;">
						<p>五</p>
            	</li>
            	<li style="float:left; background:#DDDCDC;">
						<p>六</p>
            	</li>
            	<li style="float:left; background:#fff;">
                		<p>七</p>
				</li>
            	<li style="float:left; background:#DDDCDC;">
						<p>八</p>
            	</li>
            	<li style="float:left; background:#fff;">
						<p>九</p>
            	</li>
            	<li style="float:left; background:#DDDCDC;">
                		<p>十</p>
				</li>
            	<li style="float:left; background:#fff;">
						<p>十一</p>
            	</li>
            	<li style="float:left; background:red;">
						<p style="color:#fff;">重号</p>
            	</li>
            	<li style="float:left; background:blue;">
						<p style="color:#fff;">奇数</p>
            	</li>
            	<li style="float:left; background:green;">
						<p style="color:#fff;">大数</p>
            	</li>
            	<li style="float:left; background:#FF6804;">
						<p style="color:#fff;">和值</p>
            	</li>
            </ul>

			</div>
	</div>


    <div class="pic">

    	<div class="tle">
    		<ul>
				<li style="width:21%; float:left; ">

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

$sql = "select * from ticai_1215 order by date desc limit 42";
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
	echo "<tr><td><p style='color:#000;'>$row[1]</p></td></tr>";;
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


				<li style="width:58%;float:left;">
<!-- 走势图 -->
<?php
$sql ="select date,num_1,num_2,num_3,num_4,num_5 from ticai order by date desc  limit 42";

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

    for($j=1;$j<=11;$j++) {
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
            echo "<td><p></p></td>";
        }else{
            echo "<td><p".(" style=$style").">$row[$j]</p></td>";
        }
    }

    echo '</tr>';

}


/* 定义量变(数组)row,并利用while循环,把数据一一写出来.
函数mysql_fetch_row()的意思是:将查询结果$rs单列拆到阵列变数中.
$row[0] 和 $row[1] 的位置可以换*/
echo "</table>";


//页面自动取得数据开始



//页面自动取得数据结束



// $fromurl="http://www.baidu.com/"; //跳转往这个地址。
//if( $_SERVER['HTTP_REFERER'] == "" )
//{
//header("Location:".$fromurl); exit;
//}
?>
				</li>
                <li style="width:21%;float:left;">
<?php
define("DEBUG", 0);
if(DEBUG){
    error_reporting(E_ALL);
}else{
    error_reporting(0);
}
include_once("../tool.php");
$sql ="select date,num_1,num_2,num_3,num_4,num_5 from ticai_1215 order by date desc  limit 42";

$rs = mysql_query($sql, $dbh);
/* 定义变量 rs ,函数mysql_query()的意思是:送出 query 字串供 MySQL 做相关的处理或者执行.由于php是从右往左执行的,所以,rs的值是服务器运行mysql_query()函数后返回的值 */
if(!$rs){die("Valid result!");}
echo "<table id='myTable3'>";
$data = array();
$k = 0;
$odd = array();
$large = array();
while($row = mysql_fetch_array($rs)){
    $data_tmp[] = $row;
}
 // echo "<pre>";
 // print_r($data_tmp[0]);
 // exit();
foreach( $data_tmp as $k => $v ){
    $data_tmp[$k]['odd'] = 0;
    $data_tmp[$k]['large'] = 0;
    if( $data_tmp[$k]['num_1']%2!=0 ){
        $data_tmp[$k]['odd'] += 1;
    }
    if( $data_tmp[$k]['num_2']%2!=0 ){
        $data_tmp[$k]['odd'] += 1;
    }
    if( $data_tmp[$k]['num_3']%2!=0 ){
        $data_tmp[$k]['odd'] += 1;
    }
    if( $data_tmp[$k]['num_4']%2!=0 ){
        $data_tmp[$k]['odd'] += 1;
    }
    if( $data_tmp[$k]['num_5']%2!=0 ){
        $data_tmp[$k]['odd'] += 1;
    }
    // 以上计算基数；
    // 一下计算大数；
    if( $data_tmp[$k]['num_1'] > 5 ){
        $data_tmp[$k]['large'] += 1;
    }
    if( $data_tmp[$k]['num_2'] > 5 ){
        $data_tmp[$k]['large'] += 1;
    }
    if( $data_tmp[$k]['num_3'] > 5 ){
        $data_tmp[$k]['large'] += 1;
    }
    if( $data_tmp[$k]['num_4'] > 5 ){
        $data_tmp[$k]['large'] += 1;
    }
    if( $data_tmp[$k]['num_5'] > 5 ){
        $data_tmp[$k]['large'] += 1;
    }
    $data_tmp[$k]['sum'] = $data_tmp[$k]['num_1']+$data_tmp[$k]['num_2']+$data_tmp[$k]['num_3']+$data_tmp[$k]['num_4']+$data_tmp[$k]['num_5'];
    $data = $data_tmp;
}


$allArr = array();
$data = Tool::multi_array_sort($data,'date');
$dataNum = count($data);
//echo "<pre>";
//  print_r($data);
// exit();
for($index=0;$index<$dataNum;$index++){
    $row = Tool::convert20($data[$index]);
 // echo "<pre>";
 // print_r($row);
 // exit();
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

    $row = $data[$index];
    //print_r($row);exit;
     echo "<td><p style='font-size:15px;'>编写中</P></td><td><p style='color:blue;'>".$row['odd']."</P></td><td><p style='color:green;'>".$row['large']."</P></td><td><p style='color:#FF6804;'>".$row['sum']."</P></td>";


    echo '</tr>';
}

/* 定义量变(数组)row,并利用while循环,把数据一一写出来.
函数mysql_fetch_row()的意思是:将查询结果$rs单列拆到阵列变数中.
$row[0] 和 $row[1] 的位置可以换*/
echo "</table>";
@mysql_close($dbh);
/* 关闭到mysql数据库的连接 */




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
