<?php
require_once('../func/Netagard.php');
require_once('../func/Basecode.php');
require_once('../env/pdo.php');
require_once('../func/DBSelect.php');
$PAGE_NAME = "/word/";
$VALUE_NETAGARD = getValueNetagard();
if(isset($_POST['subtype']) && $_POST['subtype'] == "reset"){
  $_POST['target'] = null;
  $_POST['search'] = null;
  $_POST['compare'] = null;
  $_POST['order'] = null;
}
$TABLE_NAME = "isesuma_word";
$SEARCH_TARGET_NAME = array("name","ruby");
$SEARCH_TARGET_ALL = array("name","ruby","detail");
$ORDER_BASENAME = "ruby";
$resultSet = getDBresultSet($TABLE_NAME, $SEARCH_TARGET_NAME, $SEARCH_TARGET_ALL, $ORDER_BASENAME);
$wordList = array();
foreach ($resultSet as $row){
  $ISNETABARE = false;
  $target_num = 0;
  $rs_netagard = 0;
  $rs_name = "";
  $rs_ruby = "";
  $rs_detail = "";
  // 配列の順
  // (0)識別ID, (1)表示制限, (2)登場媒体, (3)名前, (4)ルビ, (5)種別, (6)説明, (7)関連 
  $netaArray = explode("|", $row['netagard']);
  if(count($netaArray) == 1){
    if(intval($netaArray[0]) <= $VALUE_NETAGARD){
      $rs_netagard = $netaArray[0];
    }else{
      $ISNETABARE = true;
    }
  }else{
    for($i = 0; $i < count($netaArray); $i++){
      if(intval($netaArray[$i]) <= $VALUE_NETAGARD){
        $target_num = $i;
        $rs_netagard = intval($netaArray[$i]);
      }else{
        if($i == 0){
          $ISNETABARE = true;
        }
        break;
      }
    }
  }
  if($ISNETABARE){
    continue;
  }
  $nameArray = explode("|", $row['name']);
  if(count($nameArray) == 1){
    $rs_name = $nameArray[0];
  }else{
    $count = 0;
    do{
      $rs_name = $nameArray[$target_num - $count];
      $count++;
    }while($rs_name == "");
  }
  $rubyArray = explode("|", $row['ruby']);
  if(count($rubyArray) == 1){
    $rs_ruby = $rubyArray[0];
  }else{
    $count = 0;
    do{
      $rs_ruby = $rubyArray[$target_num - $count];
      $count++;
    }while($rs_ruby == "");
  }
  $detailArray = explode("|", $row['detail']);
  if(count($detailArray) == 1){
    $rs_detail = $detailArray[0];
  }else{
    $count = 0;
    do{
      $rs_detail = $detailArray[$target_num - $count];
      $count++;
    }while($rs_detail == "");
  }
  $wordList[] = array(
    $row['id']
    , $rs_netagard
    , $row['media']
    , $rs_name
    , $rs_ruby
    , $row['type']
    , $rs_detail
    , $row['relate']
  );
} ?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="format-detection" content="telephone=no,address=no,email=no">
<meta property="description" content="イセスマの世界をまるごと解説！人気急上昇作品の世界もこれで丸わかり！ネタバレ防止機能付き">
<meta property="og:site_name" content="異世界はスマートフォンとともに。応援サイト">
<meta property="og:url" content="http://isesuma-data.com/">
<meta property="og:title" content="用語一覧 - 異世界はスマートフォンとともに。応援サイト">
<meta property="og:description" content="イセスマの世界をまるごと解説！人気急上昇作品の世界もこれで丸わかり！">
<meta property="og:type" content="website">
<meta property="og:image" content="http://isesuma.vallaria.net/img/top/main_img.jpg">
<link rel="canonical" href="http://isesuma.vallaria.net/word">
<!-- bootstrap -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
<!-- googleFont -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Kiwi+Maru:wght@400;500&family=Noto+Sans+JP:wght@400;700&display=swap" rel="stylesheet">
<!-- costum CSS -->
<link rel="stylesheet" href="/css/common.css">
<link rel="stylesheet" href="/css/modallist.css">
<title>用語一覧</title>
</head>
<body>
<?php printHeader($PAGE_NAME,$VALUE_NETAGARD) ?>
  <div class="bg-theme w-100 h-9px"></div>
  <main>
    <section id="word">
      <h2 class="text-center">
        <span>用語一覧</span>
      </h2>
      <form method="post" id="modalList_search_box" class="d-flex flex-wrap border mx-1 mx-md-5 mt-4 mb-0 p-3">
        <div class="w-50 p-1 p-md-3 pb-0 pb-md-0">
          <div class="ps-1 pb-1 pb-md-2 fw-bold">絞り込み検索</div>
          <div class="input-group input-group mb-2 mb-md-3">
            <select name="target" class="w-auto input-group-text form-select fs-09 text-start" aria-label="検索対象" style="padding-right:calc(0.75rem + 18px);">
              <option value="all"<?php
                if(!isset($_POST['target']) || $_POST['target'] == "all"){print " selected";};
              ?>>すべてから検索</option>
              <option value="name"<?php
                if(isset($_POST['target']) && $_POST['target'] == "name"){print " selected";};
              ?>>名称のみ検索</option>
            </select>
            <input name="search" type="text" class="w-auto form-control" placeholder="調べたい名前を入力" aria-label="検索文字列" value="<?php
              if(isset($_POST['search'])){print $_POST['search'];};
            ?>">
            <select name="compare" class="w-auto input-group-text form-select border-start-0 fs-09 text-start" aria-label="比較方法" style="padding-right:calc(0.75rem + 18px)">
              <option value="like"<?php
                if(!isset($_POST['compare']) || $_POST['compare'] == "like"){print " selected";};
              ?>>を含む</option>
              <option value="equal"<?php
                if(isset($_POST['compare']) && $_POST['compare'] == "equal"){print " selected";};
              ?>>に一致</option>
            </select>
          </div>
        </div>
        <div class="w-50 p-1 p-md-3 ps-2 pb-0 pb-md-0">
          <div class="ps-1 pb-1 pb-md-2 fw-bold">並び順変更</div>
          <div class="form-check form-check-inline">
            <input name="order" class="form-check-input" type="radio" id="orderYomi" value="yomi"<?php
              if(!isset($_POST['order']) || $_POST['order'] == "yomi"){print " checked";};
            ?>>
            <label class="form-check-label" for="orderYomi">五十音順</label>
          </div>
          <div class="form-check form-check-inline">
            <input name="order" class="form-check-input" type="radio" id="orderAppear" value="appear"<?php
              if(isset($_POST['order']) && $_POST['order'] == "appear"){print " checked";};
            ?>>
            <label class="form-check-label" for="orderAppear">登場順</label>
          </div>
          <div class="form-check form-check-inline">
            <input name="order" class="form-check-input" type="radio" id="orderType" value="type"<?php
              if(isset($_POST['order']) && $_POST['order'] == "type"){print " checked";};
            ?>>
            <label class="form-check-label" for="orderType">属性順</label>
          </div>
        </div>
        <button type="submit" name="subtype" value="select" class="btn btn-primary ms-1 ms-md-3 my-2 fs-09 fs-md-10">変更する</button>
        <button type="submit" name="subtype" value="reset" class="btn btn-outline-primary ms-2 mx-ms-3 my-2 fs-09 fs-md-10">検索条件リセット</button>
      </form>
      <div class="border mx-1 mx-md-5 mb-4 px-4 py-2 py-md-3 border-top-0 bg-nonactive text-muted fs-08 fs-md-09"
        >※未掲載魔法は順次掲載予定です。
      </div>
      <div id="modalList" class="mt-5">
      <!-- (0)識別ID, (1)表示制限, (2)登場媒体, (3)名前, (4)ルビ, (5)種別, (6)説明, (7)関連  -->
        <?php $count = count($wordList);
        for($i = 0; $i < $count; $i++){ ?>
        <div id="magicItem_<?=$wordList[$i][0]?>" class="card" data-bs-toggle="modal" data-bs-target="#magicBackdrop_<?=$wordList[$i][0]?>"
          ><span class="card-title fw-bold"><i class="bi-caret-right-fill pe-1"></i><?=$wordList[$i][3]?></span
          <?php if($wordList[$i][5] != "一般"){ ?>><span class="badge rounded-pill ms-1 bg-media"><?=$wordList[$i][5]?></span<?php } ?>
        ></div>
        <div class="modal fade" id="magicBackdrop_<?=$wordList[$i][0]?>" data-bs-keyboard="true" tabindex="-1" aria-labelledby="magicBackdropLabel_<?=$wordList[$i][0]?>" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title ps-2 pt-1 fs-4 fw-bold" id="magicBackdropLabel_<?=$wordList[$i][0]?>"><?=$wordList[$i][3]?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body pb-4"><?php if($wordList[$i][4] != ""){ ?>
                <div class="modalList_ruby pb-2"><?=$wordList[$i][4]?></div><?php } ?>
                <div class="modalList_media"
                  <?php $mediaList = array(false, false, false, false, false);
                  foreach(explode(",", $wordList[$i][2]) as $exp_media){
                    switch($exp_media){
                      case "w":
                        $mediaList[0] = true;
                        break;
                      case "l":
                        $mediaList[1] = true;
                        break;
                      case "c":
                        $mediaList[2] = true;
                        break;
                      case "a1":
                        $mediaList[3] = true;
                        break;
                      case "a2":
                        $mediaList[4] = true;
                    }
                  } ?>
                  ><span class="badge rounded-pill me-1 bg-<?php $mediaList[0] == true ? print "media" : print "nonactive" ?>">Web小説</span
                  ><span class="badge rounded-pill me-1 bg-<?php $mediaList[1] == true ? print "media" : print "nonactive" ?>">ラノベ</span
                  ><span class="badge rounded-pill me-1 bg-<?php $mediaList[2] == true ? print "media" : print "nonactive" ?>">コミック</span
                  ><span class="badge rounded-pill me-1 bg-<?php $mediaList[3] == true ? print "media" : print "nonactive" ?>">アニメ1期</span
                  ><span class="badge rounded-pill me-1 bg-<?php $mediaList[4] == true ? print "media" : print "nonactive" ?>">アニメ2期</span
                ></div>
                <div class="row border-bottom mt-3 mb-4"></div>
                <div class="px-4"><?=$wordList[$i][6]?></div>
              </div>
              <div class="modal-footer text-muted">
                <?php if($i != 0){ ?><a style="font-size:0.95rem;" class="btn btn-outline-secondary ps-1 pe-3 py-1 me-2" data-bs-toggle="modal" data-bs-dismiss="modal" href="#magicBackdrop_<?=$wordList[$i-1][0]?>"><i class="bi-chevron-left pe-2"></i><?=$wordList[$i-1][3]?></a><?php } ?>
                <?php if($i != $count - 1){ ?><a style="font-size:0.95rem;" class="btn btn-outline-secondary ps-3 pe-1 py-1" data-bs-toggle="modal" data-bs-dismiss="modal" href="#magicBackdrop_<?=$wordList[$i+1][0]?>"><?=$wordList[$i+1][3]?><i class="bi-chevron-right ps-2"></i></a><?php } ?>
              </div>
            </div>
          </div>
        </div><?php }//foreach magic ?>
      </div>
    </section>
  </main>
  <footer>
    <span>異世界はスマートフォンとともに。応援サイト</span>
  </footer>
</body>
</html>