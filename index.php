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
  
  if(isset($_POST['txtName']))
  {
      $name = htmlCoding($_POST['txtName']);
      $state = htmlCoding($_POST['txtState']);
      $city = htmlCoding($_POST['txtCity']);
      $address = htmlCoding($_POST['txtAddress']);
      $query = "SELECT * 
                        FROM  `users` 
                        WHERE  `name` LIKE  '%$name%'
                        AND  `state` LIKE  '%$state%'
                        AND  `city` LIKE  '%$city%'
                        AND  `address` LIKE  '%$address%' ORDER BY `name` ASC LIMIT 0 , 60";
  }
  elseif(isset($_GET['list']) && is_numeric($_GET['list']) && $_GET['list'] > 0 && $_GET['list'] < 3)
  {
      $query = "SELECT * FROM  `users` WHERE  `status` = " . htmlCoding($_GET['list']) . " ORDER BY `name` ASC";
  }
  elseif(isset($_POST['myQuery']) && strlen($_POST['myQuery']) > 10)
  {
      $query = base64_decode(htmlCoding($_POST['myQuery']));
  }
  else
  {
      $query = "SELECT * FROM `users` ORDER BY `name` ASC";
  }
  
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
<script type="text/javascript">
function verifyUser(id)
{
    var td = $('#tableTd' + id);
    var txtGoName = $('#txtGoName' + id).val();
    var txtGoFam = $('#txtGoFam' + id).val();
    var seFoodNum = $('#seFoodNum' + id).val();
    if(txtGoFam.length > 2 && txtGoName.length > 2 && seFoodNum > 0)
    {
        $('#form-group' + id).removeClass('has-error');
        $('#form-groupSe' + id).removeClass('has-error');
        $('#form-group' + id).addClass('has-success');
        $('#form-groupSe' + id).addClass('has-success');
        td.html('<img src="images/loading.gif">');
        $.ajax({
                type: "POST",
                url: "ajax/ajax.php",
                cache: false,
                data: {verifyOneUser: id, txtGName: txtGoName, txtGFam: txtGoFam, seFoodN: seFoodNum}
            }).done(function(Data){
                if(Data == 'OK')
                {
                    $('#tableTr' + id).addClass('success');
                    <?php if(md5(sha1('admin')) == $_SESSION['data']['user']){ ?>
                    td.html('<button type="button" class="btn btn-danger glyphicon glyphicon-remove" style="cursor: pointer; color: white;" onclick="unVerifyUser(' + id + ');"></button>');
                    <?php }else{ ?>
                    td.html('-');
                    <?php } ?>
                    document.queryForm.submit();
                }
                else if(Data == 'NOK')
                {
                    td.html('<button type="button" class="btn btn-success glyphicon glyphicon-ok" style="cursor: pointer; color: white;" onclick="verifyUser(' + id + ');"></button>');
                }
            });
    }
    else
    {
        $('#form-group' + id).addClass('has-error');
        $('#form-groupSe' + id).addClass('has-error');
    }
}
function unVerifyUser(id)
{
    var td = $('#tableTd' + id);
    td.html('<img src="images/loading.gif">');
    $.ajax({
            type: "POST",
            url: "ajax/ajax.php",
            cache: false,
            data: {unVerifyOneUser: id}
        }).done(function(Data){
            if(Data == 'OK')
            {
                $('#tableTr' + id).removeClass('success');
                td.html('<button type="button" class="btn btn-success glyphicon glyphicon-ok" style="cursor: pointer; color: white;" onclick="verifyUser(' + id + ');"></button>');
                document.queryForm.submit();
            }
            else if(Data == 'NOK')
            {
                <?php if(md5(sha1('admin')) == $_SESSION['data']['user']){ ?>
                td.html('<button type="button" class="btn btn-danger glyphicon glyphicon-remove" style="cursor: pointer; color: white;" onclick="unVerifyUser(' + id + ');"></button>');
                <?php }else{ ?>
                td.html('-');
                <?php } ?>
            }
        });
}
</script>
</head>
<body style="margin: 0 auto; text-align: center;">
    <img src="images/loading.gif" style="display: none;">
    <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>" name="queryForm">
        <input type="hidden" id="myQuery" name="myQuery" value="<?php echo base64_encode($query); ?>" />
    </form>
    <div style="margin: 0 auto; direction: rtl; font-family: 'BYekan'; margin-top: 20px; font-size: 20px;">لیست اطلاعات خانواده های اهدا کننده و گیرنده عضو واحد پیوند</div>
    <div style="clear: both;"></div>
    <div style="width: 1000px; margin: 0 auto; height: 20px;">
        <button type="submit" class="btn btn-danger" style="font-family: 'BNazanin'; float: left;" onclick="window.location = 'login.php?logOut=yes';">خروج</button>
    </div>
    <?php if(md5(sha1('admin')) == $_SESSION['data']['user']){ ?>
    <div style="width: 1000px; border: 2px #DDDDDD solid; border-radius: 5px; margin: 0 auto; height: 245px; margin-top: 20px; -moz-border-radius: 5px; -webkit-border-radius: 5px; direction: rtl;">
        <div style="float: right; margin-top: 15px; margin-right: 15px; font-family: 'BNazanin'; direction: rtl; font-size: 16px;">آمار و اطلاعات:</div>
        <div style="clear: both;"></div>
        
        <?php
            $total = DatabaseHandler::GetRow("SELECT COUNT(`id`) FROM `users`");
            $data = DatabaseHandler::GetAll("SELECT `id` , `res3` FROM `users` WHERE `verify` = 1 ");
            $foo = 0;
            if($data)
            {
                for($i = 0; $i < count($data); $i++)
                {
                    if($data[$i]['res3'] > 0)
                    {
                        $foo = $foo + $data[$i]['res3'];
                    }
                }
            }
        ?>
        
        <div class="alert alert-info myAlert" role="alert">تعداد کل  افراد موجود در لیست: <?php echo number_format($total['COUNT(`id`)']); ?></div>
        <div class="alert alert-success myAlert" role="alert">تعداد کل افراد تایید شده: <?php echo number_format(count($data)); ?></div>
        <div class="alert alert-success myAlert" role="alert">تعداد کل فیش غذا تحویل داده شده: <?php echo number_format($foo); ?></div>
        <div class="alert alert-warning myAlert" role="alert">تعداد کل افراد تایید نشده: <?php echo number_format($total['COUNT(`id`)'] - count($data)); ?></div>
        
        <div style="clear: both;"></div>
        
    </div>
    <?php } ?>
    
    <div style="width: 1000px; border: 2px #DDDDDD solid; border-radius: 5px; margin: 0 auto; height: 180px; margin-top: 20px; -moz-border-radius: 5px; -webkit-border-radius: 5px;">
        <div style="float: right; margin-top: 15px; margin-right: 15px; font-family: 'BNazanin'; direction: rtl; font-size: 16px;">جستجو (توجه: در هنگام استفاده از قسمت جستجو سیستم در لیست نام خانواده های اهدا کننده و در لیست گیرنده عضو جستجو می نماید.):</div>
        <div style="clear: both;"></div>
        <form class="form-inline" role="form" style="direction: rtl; text-align: right; margin-right: 10px; margin-top: 10px;" method="post" action="index.php">
          <div class="form-group">
            <label class="sr-only" for="txtName" style="font-family: 'BYekan';">نام و نام خانوادگی:</label>
            <input type="text" class="form-control" id="txtName" name="txtName" placeholder="نام یا نام خانوادگی" style="font-family: 'BYekan'; width: 275px;" value="<?php if(isset($_POST['txtName']) && strlen($_POST['txtName']) > 0){echo htmlCoding($_POST['txtName']);} ?>">
          </div>
          <div class="form-group">
              <label class="sr-only" for="txtState" style="font-family: 'BYekan';">استان:</label>
              <input type="text" class="form-control" id="txtState" name="txtState" placeholder="استان" style="font-family: 'BYekan'; width: 160px;" value="<?php if(isset($_POST['txtState']) && strlen($_POST['txtState']) > 0){echo htmlCoding($_POST['txtState']);} ?>">
          </div>
          <div class="form-group">
              <label class="sr-only" for="txtCity" style="font-family: 'BYekan';">شهر:</label>
              <input type="text" class="form-control" id="txtCity" name="txtCity" placeholder="شهر" style="font-family: 'BYekan'; width: 160px;" value="<?php if(isset($_POST['txtCity']) && strlen($_POST['txtCity']) > 0){echo htmlCoding($_POST['txtCity']);} ?>">
          </div>
          <div class="form-group">
              <label class="sr-only" for="txtAddress" style="font-family: 'BYekan';">آدرس:</label>
              <input type="text" class="form-control" id="txtAddress" name="txtAddress" placeholder="آدرس" style="font-family: 'BYekan'; width: 300px;" value="<?php if(isset($_POST['txtAddress']) && strlen($_POST['txtAddress']) > 0){echo htmlCoding($_POST['txtAddress']);} ?>">
          </div>
          <button type="submit" class="btn btn-info" style="font-family: 'BNazanin';">جستجو</button>
        </form>
        <div style="width: 100%; height: 2px; background: #DDDDDD; margin: 0 auto;"></div>
        <div style="clear: both;"></div>
        <div style="margin-top: 20px; direction: rtl;">
            <button type="button" class="btn btn-primary" style="font-family: 'BNazanin'; font-size: 18px; width: 290px;" onclick="window.location = 'index.php';">نمایش کامل لیست</button>
            <button type="button" class="btn btn-success" style="font-family: 'BNazanin'; font-size: 18px; width: 290px; direction: rtl;" onclick="window.location = 'index.php?list=1';">لیست خانواده های اهدا کننده</button>
            <button type="button" class="btn btn-info" style="font-family: 'BNazanin'; font-size: 18px; width: 290px;" onclick="window.location = 'index.php?list=2';">لیست گیرنده های عضو</button>
        </div>
    </div>
    
    <div class="panel panel-info" style="width: 1000px; margin: 0 auto; margin-top: 30px; direction: rtl; margin-bottom: 30px;">
        <div class="panel-heading" style="text-align: right;">
            <h3 class="panel-title" style="font-family: 'BYekan';">
            <?php if(isset($_POST['txtName']))
            {
                echo 'جستجو...';
            }
            elseif(isset($_GET['list']) && is_numeric($_GET['list']) && $_GET['list'] > 0 && $_GET['list'] < 3)
            {
                if($_GET['list'] == 1)
                {
                    echo 'لیست خانواده های اهدا کننده عضو';
                }
                elseif($_GET['list'] == 2)
                {
                    echo 'لیست گیرنده های عضو';
                }
            }
            else
            {
                echo 'لیست اطلاعات خانواده های اهدا کننده و گیرنده عضو واحد پیوند';
            }
            ?>
            </h3>
        </div>
        <?php if($user){ ?>
        <table class="table table-striped table-hover" class="indexTable">
          <thead style="font-family: 'BLotus';">
            <tr>
              <th>ردیف</th>
              <th>نام و نام خانوادگی</th>
              <th>استان</th>
              <th>شهر</th>
              <th>آدرس</th>
              <th>نوع لیست</th>
              <th>اطلاعات مراجعه کننده</th>
              <th>تعداد فیش غذا</th>
              <th>عملیات</th>
            </tr>
          </thead>
          <tbody style="font-family: 'BNazanin';">
            <?php for($i = 0, $r = 1; $i < count($user); $i++){ ?>
            <tr <?php if($user[$i]['verify'] == 1){ echo 'class="success"'; } ?> id="tableTr<?php echo $user[$i]['id']; ?>">
              <td style="width: 50px;"><?php echo $r; $r++; ?></td>
              <td style="width: 130px;"><?php echo htmlCoding($user[$i]['name'], 2); ?></td>
              <td style="width: 70px;"><?php echo htmlCoding($user[$i]['state'], 2); ?></td>
              <td style="width: 70px;"><?php echo htmlCoding($user[$i]['city'], 2); ?></td>
              <td style="width: 320px;"><?php echo htmlCoding($user[$i]['address'], 2); ?></td>
              <td style="width: 70px;">
                <?php if($user[$i]['status'] == 1)
                {
                    echo 'اهدا کننده';
                }
                elseif($user[$i]['status'] == 2)
                {
                    echo 'گیرنده عضو';
                }
                ?>
              </td>
              <?php if($user[$i]['verify'] == 0){ ?>
              <td style="width: 150px;">
                <div class="form-group" id="form-group<?php echo $user[$i]['id']; ?>">
                    <input type="text" class="form-control" id="txtGoName<?php echo $user[$i]['id']; ?>" name="txtGoName" placeholder="نام مراجعه کننده" style="font-family: 'BYekan'; width: 150px;">
                    <input type="text" class="form-control" id="txtGoFam<?php echo $user[$i]['id']; ?>" name="txtGoFam" placeholder="نسبت مراجعه کننده" style="font-family: 'BYekan'; width: 150px; margin-top: 5px;">
                </div>
              </td>
              <td style="width: 80px;">
                <div class="form-group" id="form-groupSe<?php echo $user[$i]['id']; ?>">
                    <select class="form-control" id="seFoodNum<?php echo $user[$i]['id']; ?>" style="font-family: 'BYekan'; width: 75px;">
                        <option value="0">تعداد</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                    </select>
                </div>
              </td>
              <?php }elseif($user[$i]['verify'] == 1){ ?>
              <td style="width: 150px;">
                <div style="width: 145px; direction: rtl; text-align: right;">نام: <?php echo $user[$i]['res1']; ?></div>
                <div style="width: 145px; direction: rtl; text-align: right;">نسبت: <?php echo $user[$i]['res2']; ?></div>
              </td>
              <td style="width: 80px;"><?php echo $user[$i]['res3']; ?></td>
              <?php } ?>
              <td style="width: 40px;" id="tableTd<?php echo $user[$i]['id']; ?>">
                <?php if($user[$i]['verify'] == 0){ ?>
                <button type="button" class="btn btn-success glyphicon glyphicon-ok" style="cursor: pointer; color: white;" onclick="verifyUser(<?php echo $user[$i]['id']; ?>);"></button>
                <?php }else{ ?>
                <?php if(md5(sha1('admin')) == $_SESSION['data']['user']){ ?>
                <button type="button" class="btn btn-danger glyphicon glyphicon-remove" style="cursor: pointer; color: white;" onclick="unVerifyUser(<?php echo $user[$i]['id']; ?>);"></button>
                <?php }else{ echo '-'; } ?>
                <?php } ?>
              </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
        <?php }else{ ?>
        <div class="alert alert-danger" role="alert" style="direction: rtl; font-family: 'BNazanin'; width: 55%; text-align: right; margin: 0 auto; margin-top: 30px; margin-bottom: 30px; font-size: 16px; line-height: 20px; padding-top: 10px; padding-bottom: 10px;">موردی یافت نشد...</div>
        <?php } ?>
    </div>
</body>
</html>