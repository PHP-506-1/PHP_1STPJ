<?php
define( "DOC_ROOT", $_SERVER["DOCUMENT_ROOT"]."/" ); 
define( "URL_DB", DOC_ROOT."project/DB/db_conn.php"); 
include_once( URL_DB );

$http_method = $_SERVER["REQUEST_METHOD"];

//레코드 전체 수를 가져오는 함수 - 작성된 글을 넣기 위해 db의 레코드 순번을 가져오기 위한 코드
function task_recode_cnt()
{
    $sql = " SELECT " 
    ." count(*) " 
    ." FROM " 
    ." task "
    ;

    $arr_prepare = array();

    $conn = null;
    $db_conn($conn);
    $stmt = $obj_conn->prepare($sql); // Prepare Statement를 생성
    $stmt->execute($arr_prepare); //쿼리 실행
    $result = $stmt->fetchAll();
}

return $result;

//DB에 입력될 데이터 레코드를 입력하는 sql문
function write_info(&$param_arr)
{
    $sql = " INSERT INTO task( "
        ." task_date "
        ." ,start_time "
        ." ,end_time "
        ." ,task_title "
        ." ,is_com "
        ." ,task_memo "
        ." ,category_no "
        ." ) "

        ." VALUES ( " 
        ." DATE(NOW()) "
        ." ,:start_time "
        ." ,:end_time "
        ." ,:task_title "
        ." ,:is_com "
        ." ,:task_memo "
        // ." ,:category_no "
        ." ) "
        ;
// prepare로 데이터들의 배열을 입력
        $arr_prepare = 
        array(
            ":start_time" => $param_arr["start_time"]
            ,":end_time" => $parma_arr["end_time"]
            ,":task_title" => $parma_arr["task_title"]
            ,":is_com" => $parma_arr["is_com"]
            ,":task_memo" => $parma_arr["task_memo"]
            // ,":category_no" => $parma_arr["category_no"]
        );


        $conn = null;

$db_conn($conn);
$stmt = $obj_conn->prepare($sql); // Prepare Statement를 생성
$stmt->execute($arr_prepare); //쿼리 실행
$result = $stmt->fetchAll();

}


if ( $http_method === "POST" )
{
    $arr_post = $_POST;
    
    $result_cnt = write_info( $arr_post );
    
    exit();
}

?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>작성페이지</title>
</head>
<body>
    <form method = "post" action = "">
    <div class = date_title><label id = "date_title">
        <input type="date" id = "date_title" name = 'task_date'></label>
    </div>
    <br>
    <label for ="start_time">시작시간<input type="time" id = "start_time" name = "start_time"></label>
    <br>
    <label for ="end_time">종료시간<input type="time" id= "end_time" name="end_time"></label>
    <br>
    <label for ="category">카테고리
        <select>
            <option value="">카테고리를 선택해 주세요</option>
            <option value="book" id = "category">독서</option>
            <option value="exer" id = "category">운동</option>
            <option value="study" id = "category">공부</option>
            <option value="wake" id = "category">기상</option>
            <option value="hobby" id = "category">취미</option>
            <option value="meeting" id = "category">회의</option>
            <option value="shopping" id = "category">쇼핑</option>
            <option value="cook" id = "category">요리</option>
            <option value="clean" id = "category">청소</option>
            <option value="friend" id = "category">친구</option>
            <option value="family" id = "category">가족</option>
            <option value="tuor" id = "category">여행</option>
            <option value="movie" id = "category">영화</option>
            <option value="rest" id = "category">휴식</option>
            <option value="opt" id = "category">기타</option>
            <option value="hospital" id = "category">병원</option>
            <option value="eat" id = "category">식사</option>
        </select>
    </label>
    <br>
    <label for ="title">제목 <input type="text" id ="title"></label>
    <br>
    <label for ="com">수행여부 <input type="checkbox" id = "com"></label>
    <br>
    <label for ="memo">메모 <input type="text" id = "memo"></label>
    <br>
    <label for="write_button"><button type ="submit"><a id="write_button">작성</a></button></label>
    </form>




</body>
</html>