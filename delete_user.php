<?php
	include "db.php";

	$userId = $_POST['userId'];
	echo "삭제할 아이디 : {$userId}";
	$sql = "
	DELETE FROM `member` 
	WHERE `member`.`user_id` = '{$userId}';
	";
	$pdo->exec($sql);
?>
<script>
	alert("아이디가 삭제되었습니다");
	location.replace('./login.php'); 
</script>
