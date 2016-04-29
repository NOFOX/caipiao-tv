<!DOCTYPE html>
<html lang="zh">
<head>
  <meta charset="UTF-8">
  <title>ad</title>
  <style>
  .ad-wrapper {
    width: 100vmin;
    height: 80px;
    overflow: hidden;
    position: fixed;
    bottom: 0;
    left: 0;
  }
  .ad-items {
  }

  .ad-item {
    width: 100%;
    position: absolute;
    left: 0;
    bottom: 0;
    visibility: hidden;
  }
  .ad-item:first-child {
    visibility: visible;
  }
  .ad-item img {
    width: 100%;
  }
  </style>
</head>
<body>
  <!-- ad start -->
  <div class="ad-wrapper">
    <div class="ad-items" id="ad-items">

      <div class="ad-item item active">
        <img src="../images/01.png?h= <?php echo md5(microtime(true)); ?>" alt="ad-1" />
      </div>

      <div class="ad-item item">
        <img src="../images/02.png?h= <?php echo md5(microtime(true)); ?>" alt="ad-2" />
      </div>

      <div class="ad-item item">
        <img src="../images/03.png?h= <?php echo md5(microtime(true)); ?>" alt="ad-3" />
      </div>
      <!-- 添加广告时复制上面结构. -->
    </div>
  </div>

  <script>
  var index = 0;
  var items = document.getElementById('ad-items').getElementsByTagName('div');
  var num = items.length;
  function run(){
    index++;
    if (index>num-1) index=0;
    // console.log(index);
    for(var i=0; i<num; i++){
      items[i].style.visibility='hidden';
    }
    items[index].style.visibility='visible';
  };
  setInterval('run()',300000);
  </script>
  <!-- ad end -->
</body>
</html>
