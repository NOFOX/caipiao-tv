<?php
include_once("../conn.php");
include_once("../tool.php");
$sql ="select date,num_3 from ticai order by date desc  limit 71";

$rs = mysql_query($sql, $dbh); 
/* 定义变量 rs ,函数mysql_query()的意思是:送出 query 字串供 MySQL 做相关的处理或者执行.由于php是从右往左执行的,所以,rs的值是服务器运行mysql_query()函数后返回的值 */ 
if(!$rs){die("Valid result!");} 
echo "<table id='myTable5'>";
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
            $style.='color:red;font-size:16px;';
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
for($i=1;$i<=70;$i++){
   echo "<tr><td><p></p></td><td><p></p></td><td><p></p></td><td><p></p></td><td><p></p></td><td><p></p></td><td><p></p></td><td><p></p></td><td><p></p></td><td><p></p></td><td><p></p></td></tr>";
}
/* 定义量变(数组)row,并利用while循环,把数据一一写出来.
函数mysql_fetch_row()的意思是:将查询结果$rs单列拆到阵列变数中.  
$row[0] 和 $row[1] 的位置可以换*/ 
echo "</table>"; 



?> 