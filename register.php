<?php
include "db.php";

if(isset($_POST['userId'])) {
    $userId = $_POST['userId'];
    $user_pw = $_POST['userPw'];
    $user_pw_check = $_POST['userPwCheck'];
    $user_name = $_POST['userName'];
    $user_email = $_POST['userEmail'];

    if($user_pw !== $user_pw_check){
?>
<script>
    alert("비밀번호가 일치하지 않습니다.");
    history.back();
</script>
<?php
        exit;
    }
    $sql = "
    SELECT * FROM `member`
    WHERE `user_id` = '{$userId}';
    ";
    $stmt=$pdo->prepare($sql);
    $stmt->execute();
    $row=$stmt->fetch(PDO::FETCH_ASSOC);

    if($row) {
?>
<script>
    alert("이미 사용중인 아이디입니다.");
    history.back();
</script>
<?php
        exit;
    }

    $sql = "
    INSERT INTO `member`
	(`user_id`, `user_pw`, `user_name`, `user_email`, `user_reg_datetime`) VALUES
	('{$userId}', '{$user_pw}', '{$user_name}', '{$user_email}', NOW());
	";
	$pdo->exec($sql);
?>
<script>
    alert("회원가입이 완료되었습니다.");
    location.replace('./login.php');
</script>
<?php
    exit;
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>회원가입</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <main class="page">
    <section class="card">
      <h1>회원가입</h1>
      <p class="desc">사이트 이용을 위해 회원 정보를 입력하세요.</p>

      <form id="registerForm" action="register.php" method="post">
        <div class="form-group">
          <label for="userId">아이디</label>
          <input type="text" id="userId" name="userId" placeholder="아이디 입력">
        </div>

        <div class="form-group">
          <label for="userName">이름</label>
          <input type="text" id="userName" name="userName" placeholder="이름 입력">
        </div>

        <div class="form-group">
          <label for="userEmail">이메일</label>
          <input type="email" id="userEmail" name="userEmail" placeholder="email@example.com">
        </div>

        <div class="form-group">
          <label for="userPw">비밀번호</label>
          <input type="password" id="userPw" name="userPw" placeholder="비밀번호 입력">
        </div>

        <div class="form-group">
          <label for="userPwCheck">비밀번호 확인</label>
          <input type="password" id="userPwCheck" name="userPwCheck" placeholder="비밀번호 다시 입력">
        </div>

        <button class="btn" type="submit">가입하기</button>
      </form>

      <p class="link-text">
        이미 회원이라면 <a href="login.php">로그인</a>
      </p>
    </section>
  </main>

  <script src="js/register.js"></script>
</body>
</html>
