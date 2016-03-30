<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="initial-scale=1">
  <title>Document</title>
  <script src="jquery-2.2.2.min.js"></script>
  <link rel="stylesheet" href="caipiao-tv.css">
</head>

<body>
  <form name="fangbei" method="post" action="check_session_login.php" class="form">
    <div class="input-section">
      <label for="input-username" class="label">用户名：</label>
      <input type="text" name="username" id="input-username" placeholder="用户名" autofocus autocomplete="off"/>
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
        <button type="button" name="button" class="btn-reset" id="btn-reset-username">清空</button>
      </div>

    </div>

    <div class="input-section">
      <label for="input-password" class="label">密码：</label>
      <input type="password" name="passcode" id="input-password" placeholder="密码"/>
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
        <button type="button" name="button" class="btn-reset" id="btn-reset-password">清空</button>
      </div>

    </div>

    <!-- <a href="index.php" class="test">刷新</a> -->
    <input type="submit" name="Submit" value="登陆" class="btn-login"/>

    <script type="text/javascript">

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
    // 键盘
    $('#keyboard-username').css('visibility','visible');
    $('#input-username').on('focus',function(){
      $('.keyboard').css('visibility','hidden');
      $('#keyboard-username').css('visibility','visible');
    });
    $('#input-password').on('focus',function(){
      $('.keyboard').css('visibility','hidden');
      $('#keyboard-password').css('visibility','visible');
    });
    </script>
  </form>
</body>
</html>
