<?php
require_once('../env/pdo.php');
function translateTypeJPtoEN($jp){
  $typeByEN = array("fire","water","soil","wind","light","dark","person");
  switch($jp){
    case "火":
      return $typeByEN[0];
    case "水":
      return $typeByEN[1];
    case "土":
      return $typeByEN[2];
    case "風":
      return $typeByEN[3];
    case "光":
      return $typeByEN[4];
    case "闇":
      return $typeByEN[5];
    case "無":
      return $typeByEN[6];
    default:
      return "未実装";
  };
}
$pdo = getPdo();
$name = "a";
if(!$pdo == null){
  $target_media = "%w%";
  $stmt = $pdo->prepare("SELECT * FROM isesuma_magic WHERE media LIKE :target_media ORDER BY name ");
  $stmt->bindValue(':target_media', $target_media);
  $stmt->execute();
  $magicList = array();
  
  foreach ($stmt as $row){
    // 配列の順
    // (0)識別ID, (1)表示制限, (2)登場媒体, (3)名前, (4)属性, (5)属性英語名, (6)詠唱, (7)説明 
    $magicList[] = array(
      $row['id']
      ,$row['netagard']
      ,$row['media']
      ,$row['name']
      ,$row['type']
      ,translateTypeJPtoEN($row['type'])
      ,$row['chant']
      ,$row['detail']
    );
  }
}?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="format-detection" content="telephone=no,address=no,email=no">
<meta property="description" content="異世界スマホの世界をまるごと解説！人気急上昇作品の世界もこれで丸わかり！ネタバレ防止機能付き">
<meta property="og:site_name" content="異世界はスマートフォンとともに。応援サイト">
<meta property="og:url" content="http://isesuma-data.com/">
<meta property="og:title" content="キャラクター相関図 - 異世界はスマートフォンとともに。応援サイト">
<meta property="og:description" content="イセスマホの世界をまるごと解説！人気急上昇作品の世界もこれで丸わかり！">
<meta property="og:type" content="website">
<meta property="og:image" content="http://isesuma.vallaria.net/img/top/main_img.jpg">
<link rel="canonical" href="http://isesuma.vallaria.net/relation">
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
<link rel="stylesheet" href="/css/magic.css">
<title>魔法一覧</title>
</head>
<body>
  <header>
    <h1>
      <img src="/img/common/logo.png" alt="異世界はスマートフォンとともに。応援サイト">
    </h1>
    <nav class="gnav">
      <ul>
        <a href="/"><li class="gnav_item">トップページ</li></a>
        <a href="/relation/" class="active"><li class="gnav_item">キャラ相関図</li></a>
      </ul>
    </nav>
  </header>
  <div class="bg-theme w-100 h-9px"></div>
  <main>
    <section id="magic">
      <h2 class="text-center">
        <span>魔法一覧</span>
      </h2>
      <div id="magic_list">
      <!-- (0)識別ID, (1)表示制限, (2)登場媒体, (3)名前, (4)属性, (5)属性英語名, (6)詠唱, (7)説明  -->
        <?php $count = count($magicList);
        for($i = 0; $i < $count; $i++){ ?>
        <div class="card magicItem_<?=$magicList[$i][0]?>" data-bs-toggle="modal" data-bs-target="#magicBackdrop_<?=$magicList[$i][0]?>"
          ><span class="card-title fw-bold"><i class="bi-caret-right-fill pe-1"></i><?=$magicList[$i][3]?></span
          ><span class="badge rounded-pill ms-1 bg-m-<?=$magicList[$i][5]?>"><?=$magicList[$i][4]?>属性</span
        ></div>
        <div class="modal fade" id="magicBackdrop_<?=$magicList[$i][0]?>" data-bs-keyboard="true" tabindex="-1" aria-labelledby="magicBackdropLabel_<?=$magicList[$i][0]?>" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title ps-2 pt-1 fs-4 fw-bold" id="magicBackdropLabel_<?=$magicList[$i][0]?>"><?=$magicList[$i][3]?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body pb-4">
                <div class="magic_media pb-2"
                  <?php $mediaList = array(false, false, false, false, false);
                  foreach(explode(",", $magicList[$i][2]) as $exp_media){
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
                <div class="magic_type pb-2"
                  <?php $typeList = array(false, false, false, false, false, false, false);
                  foreach(explode(",", $magicList[$i][4]) as $exp_media){
                    switch($exp_media){
                      case "火":
                        $typeList[0] = true;
                        break;
                      case "水":
                        $typeList[1] = true;
                        break;
                      case "土":
                        $typeList[2] = true;
                        break;
                      case "風":
                        $typeList[3] = true;
                        break;
                      case "光":
                        $typeList[4] = true;
                        break;
                      case "闇":
                        $typeList[5] = true;
                        break;
                      case "無":
                        $typeList[6] = true;
                    }
                  } ?>
                  ><span class="badge rounded-pill p-2 me-1 bg-<?php $typeList[0] == true ? print "m-fire" : print "nonactive" ?>">火</span
                  ><span class="badge rounded-pill p-2 me-1 bg-<?php $typeList[1] == true ? print "m-water" : print "nonactive" ?>">水</span
                  ><span class="badge rounded-pill p-2 me-1 bg-<?php $typeList[2] == true ? print "m-soil" : print "nonactive" ?>">土</span
                  ><span class="badge rounded-pill p-2 me-1 bg-<?php $typeList[3] == true ? print "m-wind" : print "nonactive" ?>">風</span
                  ><span class="badge rounded-pill p-2 me-1 bg-<?php $typeList[4] == true ? print "m-light" : print "nonactive" ?>">光</span
                  ><span class="badge rounded-pill p-2 me-1 bg-<?php $typeList[5] == true ? print "m-dark" : print "nonactive" ?>">闇</span
                  ><span class="badge rounded-pill p-2 me-1 bg-<?php $typeList[6] == true ? print "m-person" : print "nonactive" ?>">無</span
                ></div><?php if($magicList[$i][6] != ""){ ?>
                  <div class="magic_chant"><?=$magicList[$i][6]?></div><?php } ?>
                <div class="row border-bottom mt-3 mb-4"></div>
                <div class="px-4"><?=$magicList[$i][7]?></div>
              </div>
              <div class="modal-footer text-muted">
                <?php if($i != 0){ ?><a style="font-size:0.95rem;" class="btn btn-outline-secondary ps-1 pe-3 py-1 me-2" data-bs-toggle="modal" data-bs-dismiss="modal" href="#magicBackdrop_<?=$magicList[$i-1][0]?>"><i class="bi-chevron-left pe-2"></i><?=$magicList[$i-1][3]?></a><?php } ?>
                <?php if($i != $count - 1){ ?><a style="font-size:0.95rem;" class="btn btn-outline-secondary ps-3 pe-1 py-1" data-bs-toggle="modal" data-bs-dismiss="modal" href="#magicBackdrop_<?=$magicList[$i+1][0]?>"><?=$magicList[$i+1][3]?><i class="bi-chevron-right ps-2"></i></a><?php } ?>
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