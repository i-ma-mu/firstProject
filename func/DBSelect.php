<?php
function getDBresultSet($TABLE_NAME, $SEARCH_TARGET_NAME, $SEARCH_TARGET_ALL, $ORDER_BASENAME){
  $pdo = getPdo();
  if(!$pdo == null){
    if(isset($_POST['search'])){
      if($_POST['compare'] == "equal"){
        $sql_compare = "=";
      }else{
        $sql_compare = "LIKE";
      }
      if($_POST['target'] == 'name'){
        $sql = "SELECT * FROM " . $TABLE_NAME . " WHERE";
        $first_searchName = true;
        foreach($SEARCH_TARGET_NAME as $target){
          if($first_searchName){
            $sql .= " " . $target . " " . $sql_compare . " :search";
            $first_searchName = false;
          }else{
            $sql .= " OR " . $target . " " . $sql_compare . " :search";
          }
        }
      }else{
        $sql = "SELECT * FROM " . $TABLE_NAME . " WHERE";
        $first_searchAll = true;
        foreach($SEARCH_TARGET_ALL as $target){
          if($first_searchAll){
            $sql .= " " . $target . " " . $sql_compare . " :search";
            $first_searchAll = false;
          }else{
            $sql .= " OR " . $target . " " . $sql_compare . " :search";
          }
        }
      }
    }else{
      $sql = "SELECT * FROM " . $TABLE_NAME;
    }
    if(isset($_POST['order'])){
      if($_POST['order'] == "yomi"){
        $sql .= " ORDER BY " . $ORDER_BASENAME;
      }else if($_POST['order'] == "appear"){
        $sql .= " ORDER BY id";
      }else if($_POST['order'] == "type"){
        $sql .= " ORDER BY type, " . $ORDER_BASENAME;
      }
    }else{
      $sql .= " ORDER BY name";
    }
    $stmt = $pdo->prepare($sql);
    if(isset($_POST['search'])){
      if($_POST['compare'] == "equal"){
        $bindstr = $_POST['search'];
      }else{
        $bindstr = "%" . $_POST['search'] . "%";
      }
      $stmt->bindValue(':search', $bindstr);
    }
    $stmt->execute();
    return $stmt;
  }
} ?>