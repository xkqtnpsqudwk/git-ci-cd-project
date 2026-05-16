<?php
	include "db.php";

	$id = $_POST['loginId'];
	$pw = $_POST['loginPw'];

	$sql = "
	SELECT * FROM `member`
	WHERE `user_id` = '{$id}'
	AND `user_pw` = '{$pw}';
	";
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	$row = $stmt->fetch(PDO::FETCH_ASSOC);

	if($row) {
?>
<script>
	alert("로그인 되었습니다");
	location.replace('./admin_users.php');
</script>
<?php
	} else {
?>
<script>
	alert("아이디 또는 비밀번호가 일치하지 않습니다");
	history.back();
</script>
<?php
	}
?>
