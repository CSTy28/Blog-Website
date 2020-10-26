<?php 

function validateTopic($topic) {
    
    $errors = array();
    
    if (empty($topic['topic'])) {
        array_push($errors, 'Title is required');
    }
        
    $existingTopic = selectOne('topics', ['topic' => $topic['topic']]);
    if ($existingTopic) {
        if($existingTopic){
        if(isset($post['update-topic']) && $existingTopic['id'] != $post['id']){
            array_push($errors, 'Possible Duplicate Topic');
        }
        
        if (isset($post['add-topic'])) {
            array_push($errors, 'Possible Duplicate Topic');
        }
        
    }
    }
        
    return $errors;
}




?>