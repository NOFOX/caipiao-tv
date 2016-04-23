<?php
  session_start();
  if(isset($_SESSION)){
     $username = $_SESSION['username'];
     $passcode = $_SESSION['passcode'];
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="initial-scale=1">
  <title>体彩登陆</title>
  <script src="jquery-2.2.2.min.js"></script>
  <link rel="stylesheet" href="caipiao-tv.css">
</head>

<body>
  <form name="fangbei" method="post" action="check_session_login.php" class="form" autocomplete="off">
    <div class="banner shiyixuanwu"></div>
    <div class="input-section">
      <label for="input-username" class="label">用户名：</label>
      <input type="text" name="username" value="<?=empty($username)?'':$username;?>" id="input-username" placeholder="用户名" tabindex="1"/>
      <div class="keyboard" id="keyboard-username">
        <ul>
          <li class="key">1</li>
          <li class="key">2</li>
          <li class="key">3</li>
          <li class="key">4</li>
          <li class="key">5</li>
          <li class="key">6</li>
          <li class="key">7</li>
          <li class="key">8</li>
          <li class="key">9</li>
          <li class="key">0</li>
        </ul>
        <button type="button" name="button" class="btn-reset" id="btn-reset-username" tabindex="-1">清空</button>
      </div>

    </div>

    <div class="input-section">
      <label for="input-password" class="label">密码：</label>
      <input type="password" name="passcode" value="<?=empty($passcode)?'':$passcode;?>" id="input-password" placeholder="密码" tabindex="2"/>
      <div class="keyboard" id="keyboard-password">
        <ul>
          <li class="key">1</li>
          <li class="key">2</li>
          <li class="key">3</li>
          <li class="key">4</li>
          <li class="key">5</li>
          <li class="key">6</li>
          <li class="key">7</li>
          <li class="key">8</li>
          <li class="key">9</li>
          <li class="key">0</li>
        </ul>
        <button type="button" name="button" class="btn-reset" id="btn-reset-password" tabindex="-1">清空</button>
      </div>

    </div>

    <!-- <a href="index.php" class="test">刷新</a> -->
    <input type="submit" name="Submit" value="登陆" class="btn-login" id="btn-login" tabindex="3"/>
    <div class="section-info ripple">
      <p class="alert">已记住密码，按遥控器确认键登陆</p>
      <p class="tip">登陆后选择版本</p>
    </div>
    <script type="text/javascript">
    // 输入框
    $('#input-username').on('focus',function(){
      $('.keyboard').css('visibility','hidden');
      $('#keyboard-username').css('visibility','visible');
      $('.section-info').removeClass('ripple');
      $('.input-section').removeClass('focus');
      $(this).parent().addClass('focus');
    });
    $('#input-password').on('focus',function(){
      $('.keyboard').css('visibility','hidden');
      $('#keyboard-password').css('visibility','visible');
      $('.section-info').removeClass('ripple');
      $('.input-section').removeClass('focus');
      $(this).parent().addClass('focus');
    });

// 已经登陆
    if($('#input-username').val()){
      // $('.keyboard').css('display','none');
      $('#btn-login').focus();
      $('.alert').css('opacity','1');
    }
    else {
      $('#input-username').focus();
      $('.section-info').removeClass('ripple');
    }
    // 键盘输入
    var inputUsername = $('#input-username');
    var inputPassword = $('#input-password');

    $('#keyboard-username .key').click(function(){
      inputUsername.val(inputUsername.val()+$(this).html());
    })
    $('#keyboard-password .key').click(function(){
      inputPassword.val(inputPassword.val()+$(this).html());
    })
    // 清空按钮
    $('#btn-reset-username').on('click',function(){
      inputUsername.val('');
    });
    $('#btn-reset-password').on('click',function(){
      inputPassword.val('');
    });

    </script>
  </form>
</body>
</html>
