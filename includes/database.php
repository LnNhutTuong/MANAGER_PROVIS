<?php

if (!defined('_ximen')) {
    die('---TRUY CAP KHONG HOP LE---');
}

//SELECT * FORM table WHERE id
function selectAll($sql)
{
    global $conn;
    $stm = $conn->prepare($sql);
    $stm->execute();
    $result = $stm->fetchAll(PDO::FETCH_ASSOC);
    return $result; 
}

//dem dong trong cot
function getRows($sql)
{
    global $conn;
    $stm = $conn->prepare($sql);
    $stm->execute();
    return $stm->rowCount(); 
}

//SELECT column FORM table WHERE id
function selectOne($sql)
{
    global $conn;
    $stm = $conn->prepare($sql);
    $stm->execute();
    $result = $stm->fetch(PDO::FETCH_ASSOC);
    return $result;
}

//INSERT INTO table FORM table WHERE id (KHO')
function insert($table, $data)
{
    global $conn;

    //lay key 
    $columns = implode(',', array_keys($data));

    //lay
    $placeholders = implode(',', array_fill(0, count($data), "?"));

    $sql = "INSERT INTO $table ($columns) VALUES ($placeholders)";
    $stm = $conn->prepare($sql);
    
    // Sử dụng PDO: truyền mảng giá trị vào execute()
    $is_success = $stm->execute(array_values($data));

    // Sử dụng PDO: lastInsertId() thay cho insert_id
    return $is_success ? $conn->lastInsertId() : false;
}

//Update
function update($table, $data, $cond)
{
    global $conn;

    if (!$data || !$cond) return false;

    //col1 = ?, col2 = ? (cot)
    $set = implode(", ", array_map(fn($c) => "$c = ?", array_keys($data)));

    // Chuỗi WHERE: id = ? AND ...
    $where = implode(" AND ", array_map(fn($c) => "$c = ?", array_keys($cond)));

    // Prepare câu SQL
    $stmt = $conn->prepare("UPDATE $table SET $set WHERE $where");

    // Bind dữ liệu
    $params = array_merge(array_values($data), array_values($cond));

    // Thực thi
    return $stmt->execute($params);
}

//Delete (chatGPT vi qua kho)
function delete($table, $cond)
{
    global $conn;
    if (!$cond) return false;

    $where = implode(" AND ", array_map(fn($c) => "$c=?", array_keys($cond)));
    $stmt = $conn->prepare("DELETE FROM $table WHERE $where");
    // Sử dụng PDO: truyền mảng giá trị điều kiện vào execute()
    return $stmt->execute(array_values($cond));
}

//lay du lieu moi nhat
function lastID()
{
    global $conn;
    return $conn->lastInsertId();
}