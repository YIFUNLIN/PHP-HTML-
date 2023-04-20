<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>login.php</title>
</head>
<body>
<?php
session_start();  // 啟用交談期
$username = "";  $password = "";
// 取得表單欄位值
if ( isset($_POST["Username"]) )  
         #isset():用來檢查變數是否已經設置並且具有值的函數
         #$_POST 包含了從 HTTP POST 方法提交的所有表單數據的，這個變數是一個關聯數組，每個元素都對應著一個表單欄位的名稱和值。
         ##這段程式碼主要用於檢查使用者是否已經填寫了 "Username" 欄位，以便在後續的處理中使用這個值。
         #如果這個條件為真，就表示使用者已經填寫了這個欄位，可以繼續進行後續的表單處理。
         #如果條件為假，就表示使用者沒有填寫這個欄位，需要提示用戶填寫此欄位以便進行後續的處理。
   $username = $_POST["Username"];  
if ( isset($_POST["Password"]) )
   $password = $_POST["Password"];
// 檢查是否輸入使用者名稱和密碼
if ($username != "" && $password != "") {      #如果此變數成功被賦予資料而非空
   // 建立MySQL的資料庫連接 
   $link = mysqli_connect('localhost:3306','root','','myschool')
        or die("無法開啟MySQL資料庫連接!<br/>");
   //送出UTF8編碼的MySQL指令
   mysqli_query($link, 'SET NAMES utf8'); 
   // 建立SQL指令字串
   $sql = "SELECT * FROM student WHERE password=' ".$password."' AND username='".$username."'";

   // 執行SQL查詢
   $result = mysqli_query($link, $sql);
   $total_records = mysqli_num_rows($result);    #mysqli_num_rows()取得該資料表所有的列資料數目
   // 是否有查詢到使用者記錄
   if ( $total_records > 0 ) {            #有找到一筆
      // 成功登入, 指定Session變數
      $_SESSION["login_session"] = true;   #將一個名為login_session的session變量設為true
      header("Location: index.php");       #轉址到另一個程式  通常成功登錄後都會跳到另一個頁面，也提高程序的安全性
   } else {  // 登入失敗
      echo "<center><font color='red'>";
      echo "使用者名稱或密碼錯誤!<br/>";
      echo "</font>";
      $_SESSION["login_session"] = false;
   }
   mysqli_close($link);  // 關閉資料庫連接  
}
?>
<form action="login.php" method="post">
<table align="center" bgcolor="#FFCC99">
 <tr><td><font size="2">使用者名稱:</font></td>  <!--利用表單 讓使用者輸入帳號並儲存在Username-->
   <td><input type="text" name="Username"    
             size="15" maxlength="10"/> 
   </td></tr>
 <tr><td><font size="2">使用者密碼:</font></td>   <!--利用表單 讓使用者輸入密碼並儲存在Password-->
   <td><input type="password" name="Password"  
              size="15" maxlength="10"/>
   </td></tr>
 <tr><td colspan="2" align="center">
   <input type="submit" value="登入網站"/>
   </td></tr> 
</table>
</form>
</body>
</html>
