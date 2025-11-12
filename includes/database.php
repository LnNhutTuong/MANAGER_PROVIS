<?php

if (!defined('_ximen')) {
    die('---TRUY CAP KHONG HOP LE---');
}

//SELECT * FORM table WHERE id
function selectAll($sql, $params = [])
{
    global $conn;
    $stm = $conn->prepare($sql);
    if (!empty($params)) {
        $types = str_repeat("s", count($params));
        $stm->bind_param($types, ...$params);
    }
    $stm->execute();
    $result = $stm->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}

//dem dong trong cot
function getRows($sql)
{
    global $conn;
    $stm = $conn->prepare($sql);
    $stm->execute();
    $result = $stm->get_result();
    return $result->num_rows;
}

//SELECT column FORM table WHERE id
function selectOne($sql, $params = [])
{
    global $conn;
    $stm = $conn->prepare($sql);
    if (!empty($params)) {
        $types = str_repeat("s", count($params));
        $stm->bind_param($types, ...$params);
    }
    $stm->execute();
    $result = $stm->get_result();
    return $result->fetch_assoc();
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

    $stm->bind_param(str_repeat("s", count($data)), ...array_values($data));

    return $stm->execute() ? $conn->insert_id : false;
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
    $stmt->bind_param(str_repeat("s", count($params)), ...$params);

    // Thực thi
    return $stmt->execute();
}

//Delete (chatGPT vi qua kho)
function delete($table, $cond)
{
    global $conn;
    if (!$cond) return false;

    $where = implode(" AND ", array_map(fn($c) => "$c=?", array_keys($cond)));
    $stmt = $conn->prepare("DELETE FROM $table WHERE $where");
    $stmt->bind_param(str_repeat("s", count($cond)), ...array_values($cond));
    return $stmt->execute();
}

//lay du lieu moi nhat
function lastID()
{
    global $conn;
    return $conn->insert_id;
}
