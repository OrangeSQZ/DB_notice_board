<?php
// DB 연결 설정
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "php";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 폼이 제출되었을 때
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $author = $_POST['author'];
    $title = $_POST['title'];
    $content = $_POST['content'];

    // 게시글 삽입
    $sql = "INSERT INTO posts (author, title, content, created_at) VALUES ('$author', '$title', '$content', NOW())";
    if ($conn->query($sql) === TRUE) {
        echo "게시글이 성공적으로 작성되었습니다.";
    } else {
        echo "게시글 작성에 실패했습니다: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>게시판 - 게시글 작성</title>
</head>
<body>

<h1>게시판 - 게시글 작성</h1>

<form method="post" action="write.php">
    작성자: <input type="text" name="author"><br>
    제목: <input type="text" name="title"><br>
    내용: <textarea name="content"></textarea><br>
    <input type="submit" value="게시글 작성">
</form>

<!-- 뒤로가기 링크 -->
<a href="index.php">뒤로가기</a>

