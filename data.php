<?php
  require_once 'function/config.php';
  require_once 'function/myFunction.php';
  
  if(isset($_SESSION['data']['user']))
  {
      if(md5(sha1('ehda')) != $_SESSION['data']['user'])
      {
          if(md5(sha1('admin')) == $_SESSION['data']['user'])
          {
              // continue
          }
          else
          {
              unset($_SESSION['data']['user']);
              header("location: login.php");
              exit;
          }
      }
  }
  else
  {
      header("location: login.php");
      exit;
  }
  
  $query = "SELECT * FROM `users` WHERE `verify` = 1";
  
  $user = DatabaseHandler::GetAll($query);
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
<body style="margin: 0 auto; text-align: center; background: none;">
<table class="table text-center table-bordered" style="direction: rtl; font-family: 'BNazanin', Tahoma; text-align: right; font-size: 18px;">
    <thead>
        <th>ردیف</th>
        <th>نام</th>
        <th>آدرس</th>
        <th>استان</th>
        <th>شهر</th>
        <th>نام مراجعه کننده</th>
        <th>نسبت</th>
        <th>تعداد نفرات حاضر</th>
        <th>تایتل</th>
    </thead>
    <tbody>
        <?php for ($i = 0, $a = 1; $i < count($user); $i++)
                {
                    echo '<tr><th>' . $a++ . '</th>';
                    echo '<td>' . $user[$i]['name'] . '</td>';
                    echo '<td>' . $user[$i]['address'] . '</td>';
                    echo '<td>' . $user[$i]['state'] . '</td>';
                    echo '<td>' . $user[$i]['city'] . '</td>';
                    echo '<td>' . $user[$i]['res1'] . '</td>';
                    echo '<td>' . $user[$i]['res2'] . '</td>';
                    echo '<td>' . $user[$i]['res3'] . '</td>';
                    if ($user[$i]['status'] == 1)
                    {
                        echo '<td>اهدا کننده</td>';
                    }
                    else
                    {
                        echo '<td>گیرنده عضو</td>';
                    }
                }
        ?>
    </tbody>
</table>
</body>
</html>