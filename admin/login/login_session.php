<?PHP if(empty($_SESSION['SESSION_USER']) && empty($_SESSION['SESSION_ID'])){
    header('location:../admin/');
    unset($_SESSION['SESSION_USER']);
	unset($_SESSION['SESSION_ID']);
	session_destroy();

}else{
$SESSION_USER=''; $SESSION_ID='';
if(!empty($_SESSION['SESSION_USER'])){$SESSION_USER=$_SESSION['SESSION_USER'];}
if(!empty($_SESSION['SESSION_ID'])){$SESSION_ID=$_SESSION['SESSION_ID'];}

$query_login= "SELECT * FROM user where session='$SESSION_USER' and user_id='$SESSION_ID'";
 //login
	$result_login = $connection->query($query_login);
	$log_login = $result_login->num_rows;
	$row_user = $result_login->fetch_assoc();
	extract($row_user);
	$user_id 	= htmlentities($row_user['user_id']);
	$level_user = htmlentities($row_user['level']);

if($log_login == '0'){ 
		unset($_SESSION['SESSION_ID']);
		unset($_SESSION['SESSION_USER']);
		session_destroy();
} else {	

}}