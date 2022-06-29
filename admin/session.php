<?php

session_start();
if(!function_exists('canDo')){
	function canDo($roleCode){
		$currentUserId = $_SESSION["userId"] ?? 0;
		$userRoles = get_all_data("SELECT * FROM user_role INNER JOIN roles ON user_role.role_id=roles.id WHERE user_id='$currentUserId'");
		if(!empty($userRoles)){
			foreach($userRoles as $role){
                	if($role['code'] == 'admin') return true;
				if($role['code'] == $roleCode){
					return true;
				}
			}
		}
		return false;
	}
}

if(!isset($_SESSION['username'])) {
    header("Location: $baseUrl/login.php");
}
?>