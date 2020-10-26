<?php

//Database Connection
$servername = "localhost";
$dBUsername = "uptothet_CSTyy28";
$dBPassword = "Basketball28!";
$dBName = "uptothet_blog";

$conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);

if (!$conn){
    die("Connection failed: ".mysqli_connect_error());
}

function dd($value){ //to be deleted
    echo "<pre>" , print_r($value, true), "</pre";
    die();
}



    
function executeQuery($sql, $data){
    global $conn;
    $stmt = $conn->prepare($sql);
    $values = array_values($data);
    $types = str_repeat('s', count($values));
    $stmt->bind_param($types, ...$values);
    $stmt->execute();
    return $stmt;
}

function selectAll($table){
    $sql = "SELECT * FROM $table ORDER BY id DESC";
    global $conn;
    if (empty($conditions)){
        $result = mysqli_query($conn, $sql);
        $data_array = array();
        if (empty($conditions)){
            while($row = mysqli_fetch_assoc($result)) {
                $data_array[] = $row;
            }

        }
        return $data_array;
    }
    
    
}

function getFavorites($table){
    $sql = "SELECT * FROM $table WHERE favorite = 1";
    global $conn;
    if (empty($conditions)){
        $result = mysqli_query($conn, $sql);
        $data_array = array();
        if (empty($conditions)){
            while($row = mysqli_fetch_assoc($result)) {
                $data_array[] = $row;
            }

        }
        return $data_array;
    }
    
}

function getPublished($table){
    $sql = "SELECT * FROM $table WHERE published = 1 ORDER BY id DESC";
    global $conn;
    if (empty($conditions)){
        $result = mysqli_query($conn, $sql);
        $data_array = array();
        if (empty($conditions)){
            while($row = mysqli_fetch_assoc($result)) {
                $data_array[] = $row;
            }

        }
        return $data_array;
    }
    
}

function getUsers($table){
    $sql = "SELECT * FROM users WHERE uidUsers = 'Tot'";
    global $conn;
    $result = mysqli_query($conn, $sql);
    $data_array = array();
    if (empty($conditions)){
        while($row = mysqli_fetch_assoc($result)) {
            $data_array[] = $row;
        }
    }
    return $data_array[0];
}

//select one from posts
function selectOne($table){
    
    if (isset($_GET['id'])){
        $id = $_GET['id'];
        $sql = "SELECT * FROM posts WHERE id = $id";
        global $conn;
        $result = mysqli_query($conn, $sql);
        $data_array = array();
        if (empty($conditions)){
            while($row = mysqli_fetch_assoc($result)) {
                $data_array[] = $row;
            }

        }
        return $data_array[0];
    }
    

    
}

//select one from topics
function selectOneTop($table){
    
    if (isset($_GET['t_id'])){
        $id = $_GET['t_id'];
        $sql = "SELECT * FROM topics WHERE id = $id";
        global $conn;
        $result = mysqli_query($conn, $sql);
        $data_array = array();
        if (empty($conditions)){
            while($row = mysqli_fetch_assoc($result)) {
                $data_array[] = $row;
            }

        }
        return $data_array[0];
    }
    

    
}

function selectTopicPosts($table){
    if (isset($_GET['t_id'])){
        $id = $_GET['t_id'];
        $sql = "SELECT * FROM posts WHERE topic_id = $id";
        global $conn;
        $result = mysqli_query($conn, $sql);
        $data_array = array();
        while($row = mysqli_fetch_assoc($result)) {
            $data_array[] = $row;
        }
        return $data_array;
    }
}

/*function selectOne($table){
    $sql = "SELECT * FROM $table WHERE id = $id";
    global $conn;
    if (empty($conditions)){
        $result = mysqli_query($conn, $sql);
        $data_array = array();
        if (empty($conditions)){
            while($row = mysqli_fetch_assoc($result)) {
                $data_array[] = $row;
            }

        }
        return $data_array;
    }
    
}*/


//SELECT ALL THINGS IN TABLE

/*function selectAll($table, $conditions = []){
    
    global $conn;
    $sql = "SELECT * FROM $table";
    //dd($sql);
    if (empty($conditions)){
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $records;
    }
    else {
        //return records that match conditions ...
        
        $i = 0;
        foreach ($conditions as $key => $value) {
            if ($i === 0) {
                $sql = $sql . " WHERE $key=?";
            } else {
                $sql = $sql . " AND $key=?";
            }
            $i++;
            
        }
        
        $stmt = executeQuery($sql, $conditions);
        $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $records;
    }
    
}*/

//SELECT ONE SPECIFIC THING IN TABLE
/*function selectOne($table, $conditions){
    
    global $conn;
    $sql = "SELECT * FROM $table";
    $i = 0;
    foreach ($conditions as $key => $value) {
        if ($i === 0) {
            $sql = $sql . " WHERE $key=?";
        } else {
            $sql = $sql . " AND $key=?";
        }
        $i++;

    }
       
    
    $sql = $sql . " LIMIT 1";
    $stmt = executeQuery($sql, $conditions);
    $records = $stmt->get_result()->fetch_assoc();
    return $records;
    }*/

//CREATE VALUE FOR CURRENT TABLE
function create($table, $data){
    global $conn;
    // $sql = 'INSERT INTO users SET username=?, admin=?, email=?, password=?
    $sql = "INSERT INTO $table SET ";
    
    $i = 0;
    foreach($data as $key => $value){
        if ($i === 0){
            $sql = $sql . " $key=?";
        } else {
            $sql = $sql . ", $key=?";
        }
        $i++;
    }
    
    $stmt = executeQuery($sql, $data);
    $id = $stmt->insert_id;
    return $id;
}

//UPDATE VALUE IN TABLE
function update($table, $id, $data){
    global $conn;
    // $sql = 'UPDATE users SET username=?, admin=?, email=?, password=? WHERE id=?"
    $sql = "UPDATE $table SET ";
    
    $i = 0;
    foreach($data as $key => $value){
        if ($i === 0){
            $sql = $sql . " $key=?";
        } else {
            $sql = $sql . ", $key=?";
        }
        $i++;
    }
    
    $sql = $sql . " WHERE id=?";
    $data['id'] = $id;
    $stmt = executeQuery($sql, $data);
    $id = $stmt->insert_id;
    return $stmt->affected_rows;
}

//DELETE VALUE IN TABLE
function delete($table, $id){
    global $conn;
    // $sql = 'DELETE FROM users WHERE id=?"
    $sql = "DELETE FROM $table WHERE id=?";
    
    $stmt = executeQuery($sql, ['id' => $id]);
    return $stmt->affected_rows;
}

/*function getPublishedPosts(){//////////
    global $conn;
    $sql = "SELECT p.*, u.uidUsers FROM posts AS p JOIN users AS u ON p.user_id = u.id WHERE p.published=?";
    
    $stmt = executeQuery($sql, ['published' => 1]);
    $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    return $records;
}

function getFavoritePosts(){///////////
    global $conn;
    $sql = "SELECT p.*, u.uidUsers FROM posts AS p JOIN users AS u ON p.user_id = u.id WHERE p.published=? AND p.favorite=?";
    
    $stmt = executeQuery($sql, ['published' => 1, 'favorite' => 1]);
    $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    return $records;
}

function getPostsByTopicId($topic_id){/////////////
    global $conn;
    $sql = "SELECT p.*, u.uidUsers FROM posts AS p JOIN users AS u ON p.user_id = u.id WHERE p.published=? AND topic_id=?";
    
    $stmt = executeQuery($sql, ['published' => 1, 'topic_id' => $topic_id]);
    $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    return $records;
}

function searchPosts($term){//////////////////
    
    $match = '%' . $term . '%';
    
    global $conn;
    $sql = "SELECT p.*, u.uidUsers
    FROM posts AS p 
    JOIN users AS u 
    ON p.user_id = u.id 
    WHERE p.published=? 
    AND p.title LIKE ? OR p.body LIKE ?";
    
    $stmt = executeQuery($sql, ['published' => 1, 'title' => $match, 'body' => $match]);
    $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    return $records;
}

*/
//VALIDATE TOPIC CREATION



    

?>