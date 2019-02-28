<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
           <link href="css/log.css" rel="stylesheet">
    </head>
    <body>
         <h1>登录</h1>
        <section id="sform">
              <p><b>用户名：</b><input type="text" id="lgname"><section id="sp1"></section>
         <p><b>密码：</b><input type="password" id="lgpwd"><section id="sp3"></section>   
          <p><button id="lgbtn">登录</button></p>      
        </section>
        <?php
        session_start();
   if(isset($_SESSION['name'])){
   echo "欢迎您，".$_SESSION['name'];
echo"<button id=\"outbtn\">"."退出"."</button>";}
        ?>
        <span id="s1"></span>
        <script src="js/login.js"></script>
        <script src="js/xmlHttp.js"></script>
    </body>
</html>
