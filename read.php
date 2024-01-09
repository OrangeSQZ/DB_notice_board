<?php
// DB 연결 설정
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "php";

$conn = new mysqli($servername, $username, $password, $dbname);
// 게시글 ID 가져오기
$postId = $_GET['id'];

// 게시글 조회
$sql = "SELECT * FROM posts WHERE id = $postId";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    echo "게시글을 찾을 수 없습니다.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>게시판 - 게시글 읽기</title>
</head>
<body>

<h1><?php echo $row['title']; ?></h1>
<p><?php echo $row['content']; ?></p>


<!-- 뒤로가기 링크 -->
<a href="index.php">뒤로가기</a>

</body>
</html>

<?php $conn->close(); ?>
