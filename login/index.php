<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>index.php</title>
</head>
<body>
<?php
session_start();  // 啟用交談期
#要使用session變量来追蹤用户在Web應用程序中的活動狀態，必须先使用session_start()函數啟動對話。

#在本例中，當用戶成功登錄後，會將名為"login_session"的session變量設為true。
#但若在調用session_start()函数之前未啟用對話，則無法訪問或使用該變量。因此，必须在登錄成功後調用session_start()
#若要在PHP的多個頁面使用session變量，則必須在每個頁面的上面調用session_start()函數
#以便整個對話期間使用相同的session變量

// 檢查Session變數是否存在, 表示是否已成功登入
if ( $_SESSION["login_session"] != true ) 
   header("Location: login.php");   #轉址功能 header()使用Location型態來指定轉址到php程式
                                    #目的就是 因為輸入錯誤，讓它停留在原網頁，以便可以重新輸入
echo "歡迎使用者進入網站!<br/>";
?>
</body>
</html>
