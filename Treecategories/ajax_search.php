<?php
include 'functions.php';

if( isset($_POST['data_table']) && isset($_POST['data_id']) ) {
    $search_info = (new treeCategories)->selectInfo($_POST['data_table'], $_POST['data_id']);
    $html = '';
    if( $_POST['data_table'] == 'categories' ){
        $html = "Id category: " . $search_info[0]['id'] . '<br>';
        $html .= "Name category: " . $search_info[0]['name_category'] . '<br>';
    }else{
        $html = "Id file: " . $search_info[0]['id'] . '<br>';
        $html .= "Name file: " . $search_info[0]['name_file'] . '<br>';
        $html .= "Size file: " . $search_info[0]['file_size'] . '<br>';
        $html .= "Category ID: " . $search_info[0]['category'] . '<br>';
        $html .= "Date install: " . $search_info[0]['date_instal'] . '<br>';
    } 
    echo json_encode($html);      
}

