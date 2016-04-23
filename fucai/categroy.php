<!DOCTYPE html>
<html lang="zh">
<head>
  <meta charset="UTF-8">
  <title>选择版本</title>
  <script src="jquery-2.2.2.min.js"></script>
  <link rel="stylesheet" href="caipiao-tv.css">
</head>
<body>
  <header></header>
  <content>
    <section class="section clear-float">
      <h2>方向键选择版本</h2>
      <div class="category-items">
        <!-- <a href="categroy.php" class="category-item test">刷新</a> -->
        <a href="0329/kaijiang.php" class="category-item">默认版</a>
        <a href="0225/kaijiang.php" class="category-item">高清版</a>
        <a href="0222/kaijiang.php" class="category-item">高清滚动版</a>
        <a href="1215/kaijiang.php" class="category-item">前三值滚动版</a>
      </div>
    </section>
  </content>
  <script>
    $('.category-item')[0].focus();
  </script>
</body>
</html>
