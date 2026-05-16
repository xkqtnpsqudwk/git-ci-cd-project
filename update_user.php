<?php
include "db.php";

$oldUserId = $_POST['userId'];
if(isset($_POST['oldUserId'])) {
	$oldUserId = $_POST['oldUserId'];
}

$userId = $_POST['userId'];
$user_name = $_POST['userName'];
$user_email = $_POST['userEmail'];

$sql = "
SELECT * FROM `member`
WHERE `user_id` = '{$userId}'
AND `user_id` != '{$oldUserId}';
";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if($row) {
?>
<script>
	alert("이미 사용중인 아이디입니다");
	history.back();
</script>
<?php
	exit;
}

if(isset($_POST['userPw'])) {
	$user_pw = $_POST['userPw'];

	$sql = "
	UPDATE `member`
	SET
	`user_id` = '{$userId}',
	`user_pw` = '{$user_pw}',
	`user_name` = '{$user_name}',
	`user_email` = '{$user_email}'
	WHERE `member`.`user_id` = '{$oldUserId}';
	";
} else {
	$sql = "
	UPDATE `member`
	SET
	`user_id` = '{$userId}',
	`user_name` = '{$user_name}',
	`user_email` = '{$user_email}'
	WHERE `member`.`user_id` = '{$oldUserId}';
	";
}
$pdo->exec($sql);
?>
<script>
	alert("회원정보가 수정되었습니다");
	location.replace('./admin_users.php');
</script>
