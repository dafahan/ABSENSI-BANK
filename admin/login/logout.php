<?PHP session_start(); 
    require_once'../../library/sw-config.php';
    require_once'../login/login_session.php';
   $time_logout	= date('Y-m-d H:i:s');
   $update = mysqli_query($connection,"UPDATE user set last_login='$time_logout',session='-' where user_id='$user_id'") or die (mysqli_error($connection));
    unset($_SESSION['SESSION_USER']);
    unset($_SESSION['SESSION_ID']);
    session_destroy();
    header('Location:./login/');
exit();
?>