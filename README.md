<h1>DB를 활용한 게시판 기능 구현 + 취약점 분석</h1>
<hr>
<h2>게시판 기획</h2>
- Figma를 활용하여 아이디어를 정리함
<br>
<img src="https://github.com/OrangeSQZ/DB_notice_board/assets/35069197/53c5c4eb-90bb-4902-af1d-834fa380774e" width="500" height="300"/>
<img src="https://github.com/OrangeSQZ/DB_notice_board/assets/35069197/40a2b4c5-18ff-4adc-935d-ce999c5bd136" width="500" height="300"/>

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

![image](https://github.com/OrangeSQZ/DB_notice_board/assets/35069197/69b28df4-25a1-4ec7-a93a-dfd4b27bc444)

- 검색어를 입력하는 쿼리문에서 SQL Injection 취약점이 발견됨.
- 숨겨진 게시글을 열람하거나, 게시글을 모두 지울 수 있음

![image](https://github.com/OrangeSQZ/DB_notice_board/assets/35069197/4c1fd3ba-7035-4d4e-a4dd-dcc41a7f17c3)

- 허나, <b>real_escape_string</b>로 인해 특수 문자 사용이 제한되어 실제 SQL Injection은 먹히지 않음.
<h3>read.php</h3>

![image](https://github.com/OrangeSQZ/DB_notice_board/assets/35069197/16eaffbf-91c1-49b9-ab06-9d2039cccff4)

- ID 를 입력하는 쿼리에서 사용자의 입력값을 그대로 SQL 쿼리로 전달함
- 조작된 값을 전달하는 SQL Injection 공격이 가능해 보임

  ![image](https://github.com/OrangeSQZ/DB_notice_board/assets/35069197/08dd8719-5383-484d-9c6a-4ed6e318c104)

- 단일 쿼리에선 하나의 쿼리문만 전달될 수 있음
- ID/PW를 조회하거나 숨겨진 글이 따로 없기에 실습 환경에서 활용할 방법이 없다고 보임
  
<h3>write.php</h3>

![image](https://github.com/OrangeSQZ/DB_notice_board/assets/35069197/050ed471-493b-47c4-a6b3-e0021916dae1)

- 작성자, 제목, 내용 전달부분이 그대로 쿼리에 전달됨
- SQL Injection 취약점으로 보임

 ![image](https://github.com/OrangeSQZ/DB_notice_board/assets/35069197/fff7c163-36f5-4ba4-81a2-3e02768d4f40)
 
- 위와 마찬가지로, 단일 쿼리에선 하나의 쿼리문만 전달될 수 있음
