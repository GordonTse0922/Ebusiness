<?Php
session_start();
?>
<!doctype html public "-//w3c//dtd html 3.2//en">



<?php
$isvip=0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$file = fopen("ac.csv","r");
$x = array($_POST["account"], $_POST["password"]);
$accountError="";
$passwordError="";    

function validate($str) {
    return trim(htmlspecialchars($str));
}

$account = validate($_POST['account']);
    if (!preg_match('/^[a-zA-Z0-9\s]+$/', $account)) {
      $accountError = 'account can only contain letters, numbers and white spaces';
        echo $accountError;
        echo '<br> <button type="button" onclick="Goback()"> Try Again </button>';
        echo "
        <script>function Goback(){window.location.href='./login.html';}</script>";
        return;
    }

    $password = validate($_POST['password']);
    if (strlen($password) > 6) {
      $passwordError = 'Password should be no more than 6 characters';
        echo $passwordError;
        echo '<br> <button type="button" onclick="Goback()"> Try Again </button>';
        echo "
        <script>function Goback(){window.location.href='./login.html';}</script>";
        return;
    }

if (empty($nameError) && empty($passwordError) ) {	

 while(! feof($file)){
      if (fgetcsv($file)==$x)
      {
		echo "Text as entered by user  : $_POST[t1] <br>";
		echo "Captcha shown : $_SESSION[my_captcha] <br>";
		if($_POST['t1'] == $_SESSION['my_captcha']){
		echo "Captcha validation passed ";
		echo "<br>";
		echo "Login sucessfully";//********************************************
		echo "<br>";
		$fp = fopen("vip.csv","r");
		$y = array($_POST["account"]);
		
		while(! feof($fp)){
			if (fgetcsv($fp)==$y){
				echo "status: vip membership";
				echo "<br>";
				$isvip=1;
				echo '<br> <button type="button" onclick="Goback()"> Go to vip page </button>';//************************
				echo "<script>function Goback(){window.location.href='./edit/vip.html';}</script>";
			}
		}
		if ($isvip==0){
			echo "status: normal membership";
			echo '<br> <button type="button" onclick="Goback()"> Go to normal page </button>';//**************************
			echo "<script>function Goback(){window.location.href='./edit/normal.html';}</script>";
		}
		fclose($fp);
        return;
      }
    }

}
}else{
	echo "Incorrect Username or password";
        echo '<br> <button type="button" onclick="Goback()"> Try Again </button>';
        echo "
        <script>function Goback(){window.location.href='./login.html';}</script>";
}
fclose($file);
echo "login fail";
echo '<br> <button type="button" onclick="Goback()"> Try Again </button>';
echo "<script>function Goback(){window.location.href='./login.html';}</script>";
}
?>