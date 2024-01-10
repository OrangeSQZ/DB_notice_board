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

// 검색어와 옵션을 가져오기
$searchOption = isset($_GET['searchOption']) ? $_GET['searchOption'] : 'title';
$searchQuery = isset($_GET['searchQuery']) ? $_GET['searchQuery'] : '';

// 게시글 조회
$sql = "SELECT * FROM posts ORDER BY created_at DESC";
$result = $conn->query($sql);

// 페이지당 표시할 게시글 수
$postsPerPage = 10;

// 현재 페이지
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $postsPerPage;

// 페이징을 위한 전체 게시글 수 조회
$totalPosts = $result->num_rows;

// 총 페이지 수 계산
$totalPages = ceil($totalPosts / $postsPerPage);

// 검색어가 입력되었을 때 검색 쿼리 생성
$searchCondition = '';
if (!empty($searchQuery)) {
    $searchQuery = $conn->real_escape_string($searchQuery);
    $searchCondition = "WHERE $searchOption LIKE '%$searchQuery%'";
}

// 글 목록 출력
$sql = "SELECT * FROM posts $searchCondition ORDER BY created_at DESC LIMIT $offset, $postsPerPage";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>게시판 - 메인페이지</title>
</head>
<body>

<h1>게시판 - 메인페이지</h1>

<table border="1">
    <tr>
        <th>글 번호</th>
        <th>제목</th>
        <th>작성자</th>
        <th>작성일자</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><a href="read.php?id=<?php echo $row['id']; ?>"><?php echo $row['title']; ?></a></td>
            <td><?php echo $row['author']; ?></td>
            <td><?php echo $row['created_at']; ?></td>
        </tr>
    <?php endwhile; ?>
</table>

<!-- 페이징 링크 생성 -->
<div>
    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
        <a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
    <?php endfor; ?>
</div>

<!-- 검색 창 및 글 작성 버튼 -->
<div>
    <form action="index.php" method="get">
        <select name="searchOption">
            <option value="title" <?php echo ($searchOption === 'title') ? 'selected' : ''; ?>>글 제목</option>
            <option value="author" <?php echo ($searchOption === 'author') ? 'selected' : ''; ?>>작성자</option>
        </select>
        <input type="text" name="searchQuery" placeholder="검색어 입력" value="<?php echo $searchQuery; ?>">
        <input type="submit" value="검색">
    </form>
    <a href="write.php">글 작성</a>
</div>

</body>
</html>

<?php $conn->close(); ?>
