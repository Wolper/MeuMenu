<?php
//
//define('DBSA', 'meumenu');
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
//$post = filter_input_array(INPUT_POST, FILTER_DEFAULT);
//
//$sql = "SELECT * FROM cidades WHERE estado_id =:estado_id";
//$sql = $pdo->prepare($sql);
//$sql->bindValue(':estado_id', $post['estado_id']);
//$sql->execute();
//$data = array();
//if ($sql->rowCount() > 0) {
//
//    foreach ($sql->fetchAll() as $key => $cidade) {
//        $data[$key]['cidade_id'] = $cidade['cidade_id'];
//        $data[$key]['estado_id'] = $cidade['estado_id'];
//        $data[$key]['cidade_nome'] = $cidade['cidade_nome'];
//    }
//}
//
////return var_dump($_POST);
//echo json_encode($data);
//
////echo json_encode(['cidade_nome' => 'Espirito Santo']);
////echo '{"cidade_nome":"Espirito Santo"}';
//
//
