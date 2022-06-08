<?php
function getDBresultSet($TABLE_NAME){
  $pdo = getPdo();
  if(!$pdo == null){
    $sql = "SELECT * FROM " . $TABLE_NAME;
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt;
  }
}
function arraySort($array,$target_index){

}
function quickSort(&$list, $target, $first, $last) {  
  $firstPointer = $first;
  $lastPointer  = $last;
  //枢軸値（配列の中央値）
  $centerValue  = $list[intVal(($firstPointer + $lastPointer) / 2)][$target];
  do {
    //軸より左側かつ値が小さい場合ポインター進める
    while ($list[$firstPointer][$target] < $centerValue) {
      $firstPointer++;
    }
    //軸より右側かつ値が大きい場合ポインター減らす
    while ($list[$lastPointer][$target] > $centerValue) {
      $lastPointer--;
    }
    //左側と右側の値を交換場所特定
    if ($firstPointer <= $lastPointer) {
      //ポインターが非逆転時は交換可能
      $tmp                 = $list[$lastPointer];
      $list[$lastPointer]  = $list[$firstPointer];
      $list[$firstPointer] = $tmp;
      //ポインタを進めて分割する位置指定
      $firstPointer++;
      $lastPointer--;
    }
  } while ($firstPointer <= $lastPointer);
  if ($first < $lastPointer) {
    //左側比較可能時
    quickSort($list, $target, $first, $lastPointer);
  }
  if ($firstPointer < $last) {
    //右側比較可能時
    quickSort($list, $target, $firstPointer, $last);
  }
}
?>