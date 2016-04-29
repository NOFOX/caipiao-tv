<?php
    require('../conn.php');
?>
<html>
<head>
	<title>知了彩票</title>
  <meta name="viewport" content="initial-scale=1" />
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="style429.css">
    <script type="text/javascript" src="../jquery-2.2.2.min.js"></script>
<!-- <script type="text/javascript" src="../chartDrawLink.js"></script> -->
    <script type="text/javascript" src="../table.js"></script>
    <script type="text/javascript" src="../table_1.js"></script>
    <script type="text/javascript" src="../table_2.js"></script>
    <script type="text/javascript" src="../table_3.js"></script>
    <script type="text/javascript" src="../table_4.js"></script>
  <style>
  .ball{text-align:center}
  .ball>p{
    background-color:#000 !important;
    /*border-radius:50%;*/
    display:block;
    position: relative;
    z-index: 100;
    color:#fff !important;
    height:18px;
    margin:auto;
  }
  .ball.ball-green>p{
    background-color:mediumseagreen !important;
  }
  .ball.ball-blue>p{
    background-color:cornflowerblue !important;
  }

  body {
    /*屏幕旋转*/
    width: 100vmin;
    height: 100vmax;
    overflow: hidden;
    position: fixed;
    left: 0;
    top: 100vh;
    -webkit-transform-origin: 0 0;
    transform-origin: 0 0;
    -webkit-transform: rotate(-90deg);
    transform: rotate(-90deg);
  }
  .ball {
    position: absolute;
    width: 18px;
    height: 18px;
    border-radius: 50%;
    background: #555;
    color: #fff;
    font-size: 14px;
    display: flex;
    justify-content: center;
    align-items: center;
  }

  </style>
</head>
<body>
  <script type="text/javascript">
  function TableDrawLink(tableId,color,type) {
      var stage = $('<div id="stage-trend-'+tableId+'" class="stage-trend"></div>');
      var svg = $('<svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" style="position:fixed;left:-7px;top:7px"></svg>');
      var points = [];
      // 折线
      var polyline = $('<polyline points="" style="fill: none; stroke:#333; stroke-width:1"></polyline>');
      // 小球
      var balls = $('<div class="balls" style="position: fixed; left: -16px; top: -2px; z-index:102"></div>')
      var tBall = '<div class="ball"></div>';

      // 遍历dom生成点
      $('#'+tableId+' tr p').each(function(){
        if($(this).html()){
          var point = {
            x: $('html').height()-$(this).position().top,
            y: $(this).position().left,
            value: $(this).html()
          }
          points.push(point);
        }
      })

      var positions = [];
      for(i in points){
        // 记录折线的各个点
        positions.push(points[i].x);
        positions.push(points[i].y);
        // 生成小球
        var ball = $(tBall);
        ball.css('left',points[i].x).css('top',points[i].y)
        ball.html(points[i].value);
        balls.append(ball);
      }

      sPositions = positions.join(' ');
      polyline.attr('points',sPositions);
      // 折线
      svg.append(polyline);
      // 舞台写入折线和小球
      stage.append(svg).append(balls);
      // 写入html
      if($('#stage-trend-'+tableId).length){
        $('#stage-trend-'+tableId).html(stage.html());
      }else {
        $('body').prepend(stage);
      }
      // 刷新svg
      // $('.balls').html($('.balls').html());
  }

  </script>
	<div id="header">
		<div class="nav_1">
			<h2>期<br>数</h2>
		</div>

		<div class="nav_3">

			        <div class="zoushi"><span><b><p>开 &nbsp;奖&nbsp;号&nbsp;码&nbsp;及&nbsp;走&nbsp;势</p></b></span></div>
                    <ul>
                <li style="float:left;">
                <div class="haoma">
                <p>&nbsp;&nbsp;&nbsp;&nbsp;开奖&nbsp;&nbsp;&nbsp;&nbsp;号码</p>
                </div>
			</li>
            <li style="float:left;">
			    <div class="haoma">
				<p>&nbsp;&nbsp;&nbsp;&nbsp;走&nbsp;&nbsp;&nbsp;&nbsp;势</p>
			    </div>
            </li>
            </ul>
		</div>
        <div class="nav_new"><span><b><p>前&nbsp;&nbsp;&nbsp;&nbsp;三&nbsp;&nbsp;&nbsp;&nbsp;值&nbsp;&nbsp;&nbsp;&nbsp;走&nbsp;&nbsp;&nbsp;&nbsp;势</p></b></span></div>
        <div class="nav_4" style="background:#E5EDF2;"><p>第&nbsp;&nbsp;&nbsp;&nbsp;一&nbsp;&nbsp;&nbsp;&nbsp;位</p></div>
        <div class="nav_4" style="background:#d5c0ab;"><p>第&nbsp;&nbsp;&nbsp;&nbsp;二&nbsp;&nbsp;&nbsp;&nbsp;位</p></div>
        <div class="nav_4" style="background:#E5EDF2;"><p>第&nbsp;&nbsp;&nbsp;&nbsp;三&nbsp;&nbsp;&nbsp;&nbsp;位</p></div>
	</div>

    <div class="pic">

    	<div class="tle">
    		<ul>
				<li style="width:15%; float:left; ">

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
$sql = "select * from ticai order by date desc limit 60";
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


				<li style="width:22%;float:left;">
<!-- 走势图 -->
<?php
$sql ="select date,num_1,num_2,num_3,num_4,num_5 from ticai order by date desc  limit 60";

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
<!-- 走势图    第一位 -->
<?php
$sql ="select date,num_1 from ticai order by date desc  limit 60";

/* 定义变量q, "SELECT * FROM abc"是一个SQL语句,意思是读取表abc中的数据 */

$rs = mysql_query($sql, $dbh);
/* 定义变量 rs ,函数mysql_query()的意思是:送出 query 字串供 MySQL 做相关的处理或者执行.由于php是从右往左执行的,所以,rs的值是服务器运行mysql_query()函数后返回的值 */
if(!$rs){die("Valid result!");}
echo "<table id='myTable3'>";

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

?>
                </li>
                                <li style="width:21%;float:left;">
<!-- 走势图    第二位 -->
<?php
$sql ="select date,num_2 from ticai order by date desc  limit 60";

/* 定义变量q, "SELECT * FROM abc"是一个SQL语句,意思是读取表abc中的数据 */

$rs = mysql_query($sql, $dbh);
/* 定义变量 rs ,函数mysql_query()的意思是:送出 query 字串供 MySQL 做相关的处理或者执行.由于php是从右往左执行的,所以,rs的值是服务器运行mysql_query()函数后返回的值 */
if(!$rs){die("Valid result!");}
echo "<table id='myTable4'>";

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

?>

            </li>
                            <li style="width:21%;float:left;">
<!-- 走势图    第三位 -->
<?php
$sql ="select date,num_3 from ticai order by date desc  limit 60";

/* 定义变量q, "SELECT * FROM abc"是一个SQL语句,意思是读取表abc中的数据 */

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
