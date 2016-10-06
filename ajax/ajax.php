<?php
  require_once '../function/config.php';
  require_once '../function/myFunction.php';

  if(isset($_POST['verifyOneUser']) && is_numeric($_POST['verifyOneUser']))
  {
      $id = $_POST['verifyOneUser'] + 0;
      $user = DatabaseHandler::GetRow("SELECT * FROM `users` WHERE `id` = $id AND `verify` = 0 LIMIT 0, 30");
      if($user)
      {
          $txtGName = htmlCoding($_POST['txtGName']);
          $txtGFam = htmlCoding($_POST['txtGFam']);
          $seFoodN = htmlCoding($_POST['seFoodN']);
          $res = 0;
          
          # res1 => estefadeh shod baraye name moraje'e konandeh
          # res2 => estefadeh shod baraye nesbat
          # res3 => estefadeh shod baraye tedade ghaza
          
          $na = updateOneFieldFromTable('users', 'res1', $txtGName, $id);
          if($na){$res++;}
          
          $fa = updateOneFieldFromTable('users', 'res2', $txtGFam, $id);
          if($fa){$res++;}
          
          $food = updateOneFieldFromTable('users', 'res3', $seFoodN, $id);
          if($food){$res++;}
          
          if($res == 3)
          {
              $up = updateOneFieldFromTable('users', 'verify', 1, $id);
              if($up)
              {
                  echo 'OK';
              }
              else
              {
                  echo 'NOK';
              }
          }
          else
          {
              echo 'NOK';
          }
      }
      else
      {
          echo 'NOK';
      }
  }
  if(isset($_POST['unVerifyOneUser']) && is_numeric($_POST['unVerifyOneUser']))
  {
      $id = $_POST['unVerifyOneUser'] + 0;
      $user = DatabaseHandler::GetRow("SELECT * FROM `users` WHERE `id` = $id AND `verify` = 1 LIMIT 0, 30");
      if($user)
      {
          updateOneFieldFromTable('users', 'res1', '0', $id);
          updateOneFieldFromTable('users', 'res2', '0', $id);
          updateOneFieldFromTable('users', 'res3', '0', $id);
          $up = updateOneFieldFromTable('users', 'verify', 0, $id);
          if($up)
          {
              echo 'OK';
          }
          else
          {
              echo 'NOK';
          }
      }
      else
      {
          echo 'NOK';
      }
  }
?>