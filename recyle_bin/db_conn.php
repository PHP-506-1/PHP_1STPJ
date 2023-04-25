<?php
// DB 연결 객체를 가져오는 함수
// function get_db_conn() {
// 	$host = "localhost";
// 	$user = "root";
// 	$pass = "root506";
// 	$charset = "utf8mb4";
// 	$db_name = "morning_project";
// 	$dsn = "mysql:host=".$host.";dbname=".$db_name.";charset=".$charset;
// 	$pdo_option =
// 		array(
// 			PDO::ATTR_EMULATE_PREPARES		=> false,
// 			PDO::ATTR_ERRMODE				=> PDO::ERRMODE_EXCEPTION,
// 			PDO::ATTR_DEFAULT_FETCH_MODE	=> PDO::FETCH_ASSOC
// 		);
	
// 	try {
// 		$db_conn = new PDO( $dsn, $user, $pass, $pdo_option );
// 		return $db_conn;
// 	} catch( PDOException $e ) {
// 		// DB 연결 실패 시, null 반환
// 		return null;
// 	}
	
// }

// ---------------------------------
// 함수명	: db_conn
// 기능		: DB Connection
// 파라미터	: Obj	&$param_conn
// 리턴값	: 없음
// ---------------------------------
function db_conn(&$param_conn)
{
    $host = "localhost";
    $user = "root";
    $pass = "root506";
    $charset = "utf8mb4";
    $db_name = "morning_project";
    $dns = "mysql:host=" . $host . ";dbname=" . $db_name . ";charset=" . $charset;
    $pdo_option =
        array(
            PDO::ATTR_EMULATE_PREPARES        => false, PDO::ATTR_ERRMODE                => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE    => PDO::FETCH_ASSOC
        );

    try {
        $param_conn = new PDO($dns, $user, $pass, $pdo_option);
    } catch (Exception $e) {
        $param_conn = null;
        throw new Exception($e->getMessage());
    }
}
?>