<h1>DB를 활용한 게시판 기능 구현</h1>
<hr>
<h2>게시판 기획</h2>
- Figma를 활용하여 아이디어를 정리함

![image](https://github.com/OrangeSQZ/DB_notice_board/assets/35069197/53c5c4eb-90bb-4902-af1d-834fa380774e)

![image](https://github.com/OrangeSQZ/DB_notice_board/assets/35069197/40a2b4c5-18ff-4adc-935d-ce999c5bd136)

<hr>
<h1>구현 결과</h1>
<h2>메인페이지</h2>

![image](https://github.com/OrangeSQZ/DB_notice_board/assets/35069197/ff88bd4b-ed6f-4789-943a-c473972a0062)
- 조회 ( 페이지로 리스트화 )
- 검색
- 글 작성

<hr>
<h2>작성 열람</h2>

![image](https://github.com/OrangeSQZ/DB_notice_board/assets/35069197/ca314792-36fb-4c0f-8a1f-88aea44d4c91)
- 작성 글 열람

<hr>
<h2>글 작성</h2>

![image](https://github.com/OrangeSQZ/DB_notice_board/assets/35069197/83ae2baa-45fd-4a25-b678-0c9810edc5de)
- 글 작성

<hr>
<h1>취약점 분석</h1>
<h2>페이지 별 발견한 취약점 및 공격 결과</h2>
<h3>index.php</h3>
```php
  $searchQuery = $conn->real_escape_string($searchQuery);
  $searchCondition = "WHERE $searchOption LIKE '%$searchQuery%'";
```
<h3>read.php</h3>

<h3>write.php</h3>
