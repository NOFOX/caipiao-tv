<?php
require('../conn.php');
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
for($i=1;$i<=2;$i++){
   echo "<tr><td><p></p></td><td><p></p></td><td><p></p></td><td><p></p></td><tr>";
}
/* 定义量变(数组)row,并利用while循环,把数据一一写出来.
函数mysql_fetch_row()的意思是:将查询结果$rs单列拆到阵列变数中.
$row[0] 和 $row[1] 的位置可以换*/
echo "</table>";
