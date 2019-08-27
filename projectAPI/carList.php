<?php 
/**
 * 这是一个用于练习vue-resource的接口
 */

//  设置此站点可以接收跨域请求
header('Access-Control-Allow-Origin: *');
//允许的请求类型
header('Access-Control-Allow-Methods: *');
//允许的请求头字段
header('Access-Control-Allow-Headers:x-requested-with,content-type');

//  确定返回类型为json
header('Content-Type: application/json');

//  查询逻辑
if($_SERVER['REQUEST_METHOD'] === 'GET'){

    // echo 'get';
    // 链接数据库
    $conn = mysqli_connect('localhost','root','111111','vue');
    // 获取数据
    $query = mysqli_query($conn,"SELECT * FROM cars;");

    // 取出数据
    while($array = mysqli_fetch_all($query)){
        // var_dump($row);
        echo json_encode($array);
    }

    // 返回数据
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    // echo 'post';
    // var_dump($_POST['name']);
    // 新增逻辑
    if(!empty($_POST['name'])){
        // 链接数据库
        $conn = mysqli_connect('localhost','root','111111','vue');
        // 获取数据
        $query = mysqli_query($conn,"INSERT INTO cars (`name`) VALUES ('{$_POST['name']}');");
        // 获取受影响条数
        $affected_rows = mysqli_affected_rows($conn);
        echo json_encode(array(
            'success' => $affected_rows > 0
        ));
    }

    // 删除逻辑
    if(!empty($_POST['id'])){
        // 链接数据库
        $conn = mysqli_connect('localhost','root','111111','vue');
        // 获取数据
        $query = mysqli_query($conn,"DELETE FROM cars WHERE id = '{$_POST['id']}'LIMIT 1;");
        // 获取受影响条数
        $affected_rows = mysqli_affected_rows($conn);
        
        echo json_encode(array(
            'success' => $affected_rows > 0
        ));
    }
}
