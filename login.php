<?php
  require_once 'function/config.php';
  require_once 'function/myFunction.php';
  
  if(isset($_GET['logOut']) && $_GET['logOut'] = 'yes')
  {
      unset($_SESSION['data']['user']);
  }
  
  if(isset($_SESSION['data']['user']))
  {
      if(md5(sha1('ehda')) != $_SESSION['data']['user'])
      {
          if(md5(sha1('admin')) == $_SESSION['data']['user'])
          {
              header("location: index.php");
              exit;
          }
      }
      else
      {
          header("location: index.php");
          exit;
      }
  }
  
  $user = array('ehda', '1234567890');
  $admin = array('admin', 'ehda1346798520');
  $msg = '';
  if(isset($_POST['txtUserName']) && strlen($_POST['txtUserName']) >= 4)
  {
      $userM = htmlCoding($_POST['txtUserName']);
      $pass = htmlCoding($_POST['txtPassWord']);
      
      if($userM == $user[0])
      {
          if($pass == $user[1])
          {
              $_SESSION['data']['user'] = md5(sha1($user[0]));
              header('location: index.php');
              exit;
          }
          else
          {
              $msg = 1;
          }
      }
      elseif($userM == $admin[0])
      {
          if($pass == $admin[1])
          {
              $_SESSION['data']['user'] = md5(sha1($admin[0]));
              header('location: index.php');
              exit;
          }
          else
          {
              $msg = 1;
          }
      }
      else
      {
          $msg = 1;
      }
  }
    
?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="Lang" content="fa">
<title>لیست اطلاعات خانواده های اهدا کننده و گیرنده عضو واحد پیوند</title>
<link rel="stylesheet" type="text/css" href="bootstrap/css/normalize.css">
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-theme.min.css">
<link rel="stylesheet" type="text/css" href="bootstrap/css/myStyle.css">
<script type="text/javascript" src="bootstrap/js/jquery.js"></script>
<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
</head>
<body style="margin: 0 auto; text-align: center;">
    <img src="images/loading.gif" style="display: none;">
    <div style="margin: 0 auto; direction: rtl; font-family: 'BYekan'; margin-top: 20px; font-size: 20px;">لیست اطلاعات خانواده های اهدا کننده و گیرنده عضو واحد پیوند</div>
    <div style="clear: both;"></div>
    
    <div style="width: 900px; border: 2px #DDDDDD solid; border-radius: 5px; margin: 0 auto; height: 180px; margin-top: 20px; -moz-border-radius: 5px; -webkit-border-radius: 5px;">
        <div style="float: right; margin-top: 15px; margin-right: 15px; font-family: 'BNazanin'; direction: rtl; font-size: 16px;">ورود</div>
        <div style="clear: both;"></div>
        <form class="form-inline" role="form" style="direction: rtl; text-align: center; margin-right: 10px; margin-top: 10px;" method="post" action="login.php">
          <div class="form-group">
            <label class="sr-only" for="txtUserName" style="font-family: 'BYekan';">نام کاربری:</label>
            <input type="text" class="form-control" id="txtUserName" name="txtUserName" placeholder="Username" style="width: 250px; direction: ltr; text-align: left;">
          </div>
          <div class="form-group">
              <label class="sr-only" for="txtPassWord" style="font-family: 'BYekan';">رمز عبور:</label>
              <input type="password" class="form-control" id="txtPassWord" name="txtPassWord" placeholder="Password" style="width: 250px; direction: ltr; text-align: left;">
          </div>
          <button type="submit" class="btn btn-info" style="font-family: 'BNazanin'; width: 80px;">ورود</button>
        </form>
        <div style="clear: both;"></div>
        <?php if($msg == 1){ ?>
        <div class="alert alert-danger" role="alert" style="direction: rtl; font-family: 'BNazanin'; width: 55%; text-align: right; margin: 0 auto; margin-top: 30px; margin-bottom: 30px; font-size: 16px; line-height: 20px; padding-top: 10px; padding-bottom: 10px;">نام کاربری یا رمز عبور صحیح نمی باشد ...</div>
        <?php } ?>
        
    </div>
    
</body>
</html>