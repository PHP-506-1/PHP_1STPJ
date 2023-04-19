<?php

// DB 연결 객체를 가져오는 함수
function get_db_conn() {
	$host = "localhost";
	$user = "root";
	$pass = "root506";
	$charset = "utf8mb4";
	$db_name = "morning_project";
	$dsn = "mysql:host=".$host.";dbname=".$db_name.";charset=".$charset;
	$pdo_option =
		array(
			PDO::ATTR_EMULATE_PREPARES		=> false,
			PDO::ATTR_ERRMODE				=> PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE	=> PDO::FETCH_ASSOC
		);
	
	try {
		$db_conn = new PDO( $dsn, $user, $pass, $pdo_option );
		return $db_conn;
	} catch( PDOException $e ) {
		// DB 연결 실패 시, null 반환
		return null;
	}

	// ---------------------------------
// 함수명	: db_conn
// 기능		: DB Connection
// 파라미터	: Obj	&$param_conn
// 리턴값	: 없음
// ---------------------------------
function db_conn( &$param_conn )
{
	$host = "localhost";
	$user = "root";
	$pass = "root506";
	$charset = "utf8mb4";
	$db_name = "morning_project";
	$dns = "mysql:host=".$host.";dbname=".$db_name.";charset=".$charset;
	$pdo_option =
		array(
			PDO::ATTR_EMULATE_PREPARES		=> false
			,PDO::ATTR_ERRMODE				=> PDO::ERRMODE_EXCEPTION
			,PDO::ATTR_DEFAULT_FETCH_MODE	=> PDO::FETCH_ASSOC
		);
	
	try
	{
		$param_conn = new PDO( $dns, $user, $pass, $pdo_option );
	}
	catch( Exception $e )
	{
		$param_conn = null;
		throw new Exception( $e->getMessage() );
	}
	
}

// ---------------------------------
// 함수명	: select_task_info_no
// 기능		: 게시판 특정 게시글 정보 검색
// 파라미터	: Array		&$param_no
// 리턴값	: Array		$result
// ---------------------------------
function select_task_info_no( &$param_no )
{
	$sql =
		" SELECT "
		."	ts.task_no "
		."	,ts.task_date "
		."	,ts.start_time "
		."	,ts.end_time "
		."	,ct.category_name "
		."	,ts.task_title "
		."	,ts.is_com "
		."	,ts.task_memo "
		." FROM "
		."	task ts "
		." INNER JOIN category ct ON ts.category_no = ct.category_no "
		." WHERE "
		."	ts.task_no = :task_no "
		;

	$arr_prepare =
		array(
			":task_no"	=> $param_no
		);

	$conn = null;
	try
	{
		db_conn( $conn );
		$stmt = $conn->prepare( $sql );
		$stmt->execute( $arr_prepare );
		$result = $stmt->fetchAll();
	}
	catch( Exception $e )
	{
		return $e->getMessage();
	}
	finally
	{
		$conn = null;
	}

	return $result[0]; // 조건을 PK로 걸어줘서, 리턴값이 1개만 있기 때문에 [0]을 적어줌.
}


}
