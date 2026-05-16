<?php
include "db.php";

$userId = $_POST['userId'];

$sql = "
SELECT * FROM `member`
WHERE `user_id` = '{$userId}';
";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<form action="update_user.php" method="post">
  <input type="hidden" name="userId" value="<?php echo $row['user_id']; ?>">

  아이디
  <input type="text" value="<?php echo $row['user_id']; ?>" readonly>

  이름
  <input type="text" name="userName" value="<?php echo $row['user_name']; ?>">

  이메일
  <input type="email" name="userEmail" value="<?php echo $row['user_email']; ?>">

  비밀번호
  <input type="password" name="userPw" value="<?php echo $row['user_pw']; ?>">

  <button type="submit">수정 완료</button>
</form>
