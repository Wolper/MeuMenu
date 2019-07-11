<?php // define('DBSA', 'meumenu');
//define('HOST', 'localhost');
//define('USER', 'root');
//define('PASS', '');
//
//try {
//    $pdo = new PDO("mysql:dbname=" . DBSA . ";host=" . HOST, USER, PASS, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));
//} catch (PDOException $ex) {
//
//    echo 'FALHA: ' . $ex->getMessage();
//    exit;
//}
//
//$sql = "SELECT * FROM estados";
//$sql = $pdo->query($sql);
//$sql->execute();
//
//if ($sql->rowCount() > 0) {
//    $data = array();
//    foreach ($sql->fetchAll() as $key => $estado) {
//
//        $data[$key]['estado_id'] = $estado['estado_id'];
//        $data[$key]['estado_nome'] = $estado['estado_nome'];
//        $data[$key]['estado_uf'] = $estado['estado_uf'];
//    }
//    
////    die(var_dump($data));
//    echo json_encode($data);
//}
//
//
