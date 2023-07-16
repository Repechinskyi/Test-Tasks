<?php

class connectDB{

    protected $pdo;

    /**
     * Database connection
     */
    function __construct(){
        $host = 'localhost';
        $db = 'treecategories';
        $user = 'root';
        $pass = '';
        $charset = 'utf8';

        $dsn = "mysql:host={$host};dbname={$db};charset={$charset}";
        $opt = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false
        ];
        $this->pdo = new PDO($dsn, $user, $pass, $opt);
    }

}

class treeCategories extends connectDB{

    /**
     * Getting categories from the database
     * @return array
     */
    public function getCategories(){
        $categories = $this->pdo->query("SELECT * FROM categories");
        $result = [];
        while( $row = $categories->fetch() ){
            $result[$row['id']] = $row;
        }
        return $result;
    }

    /**
     * Getting files from the database
     * @return array
     */
    public function getFiles(){
        $files = $this->pdo->query("SELECT * FROM documents");
        $result = [];
        while( $row = $files->fetch() ){
            $result[] = $row;
        }
        return $result;
    }

    /**
     * Combining categories with files
     * @return array
     */
    public function mergeCategoriesFiles(){
        $categories = $this->getCategories();
        $files = $this->getFiles();
        foreach( $categories as $key => $val ){
            foreach( $files as $id => $item ){
                if($val['id'] == $item['category']){
                   $categories[$key]['files'][$id] = $item; 
                }
            }
        }
        return $categories;
    }

    /**
     * Building a tree structure
     * @param $data
     * @return array
     */
    public function tree( $data ){
        $result = [];
        foreach( $data as $key => &$val ){
            if( !$val['parent_id'] ){
                $result[$key] = &$val;
            }else{
                $data[$val['parent_id']]['childs'][$key] = &$val;
            }
        }
        return $result;
    }

    /**
     * HTML output generator
     * @param $data
     * @return string
     */
    public function categoriesToString( $data ){
        foreach( $data as $val ){
            $result .= $this->categoriesToTemplate( $val );
        }
        return $result;
    }

    /**
     * Template call
     * @param $item
     * @return false|string
     */
    public function categoriesToTemplate( $item ){
        ob_start();
        include 'category_template.php';
        return ob_get_clean();
    }

    /**
     * Getting file/category information AJAX
     * @param $data_table
     * @param $data_id
     * @return array
     */
    public function selectInfo($data_table, $data_id){
        $categories = $this->pdo->query("SELECT * FROM `$data_table` WHERE `id`=$data_id");
        $result = [];
        while( $row = $categories->fetch() ){
            $result[] = $row;
        }
        return $result;
    }

}