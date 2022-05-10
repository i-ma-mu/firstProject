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
<title>キャラクター相関図</title>
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
        <?php for($i = 0; $i < 5; $i++){ ?>
        <div class="card" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
          <span class="card-title"><i class="bi-caret-right-fill pe-1"></i>イグニスファイア</span
          ><span class="badge rounded-pill ms-1 bg-m-fire">火属性</span>
        </div><?php } ?>
      </div>

      <div class="modal fade" id="staticBackdrop" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="staticBackdropLabel">イグニスファイア</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pb-4">
              <div class="magic_media pb-2"><!--
                <span class="badge rounded-pill bg-web">Web小説</span>
                <span class="badge rounded-pill bg-lanobe">ラノベ</span>
                <span class="badge rounded-pill bg-comic">コミック</span>
                <span class="badge rounded-pill bg-anime1">アニメ1期</span>
                <span class="badge rounded-pill bg-anime2">アニメ2期</span>
                 --><span class="badge rounded-pill me-1 bg-media">Web小説</span
                ><span class="badge rounded-pill me-1 bg-media">ラノベ</span
                ><span class="badge rounded-pill me-1 bg-nonactive">コミック</span
                ><span class="badge rounded-pill me-1 bg-media">アニメ1期</span
                ><span class="badge rounded-pill me-1 bg-nonactive">アニメ2期</span>
              </div>
              <div class="magic_type"><!--
                <span class="badge rounded-pill p-2 bg-m-fire">火</span>
                <span class="badge rounded-pill p-2 bg-m-water">水</span>
                <span class="badge rounded-pill p-2 bg-m-soil">土</span>
                <span class="badge rounded-pill p-2 bg-m-wind">風</span>
                <span class="badge rounded-pill p-2 bg-m-light">光</span>
                <span class="badge rounded-pill p-2 bg-m-dark">闇</span>
                <span class="badge rounded-pill p-2 bg-m-person">無</span>
                --><span class="badge rounded-pill p-2 me-1 bg-m-fire">火</span
                ><span class="badge rounded-pill p-2 me-1 bg-nonactive">水</span
                ><span class="badge rounded-pill p-2 me-1 bg-nonactive">土</span
                ><span class="badge rounded-pill p-2 me-1 bg-nonactive">風</span
                ><span class="badge rounded-pill p-2 me-1 bg-nonactive">光</span
                ><span class="badge rounded-pill p-2 me-1 bg-nonactive">闇</span
                ><span class="badge rounded-pill p-2 me-1 bg-nonactive">無</span>
              </div>
              <div class="row border-bottom mt-3 mb-4"></div>
              <div>冬夜が異世界で始めて見た魔法。リフレットの東の森でリンゼが使用した。</div>
            </div>
            <div class="modal-footer fs-6 text-muted">
              <span class="pe-3"><i class="bi-chevron-left pe-2"></i>前の魔法へ</span>
              <span>次の魔法へ<i class="bi-chevron-right ps-2"></i></span>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
  <footer>
    <span>異世界はスマートフォンとともに。応援サイト</span>
  </footer>
</body>
</html>