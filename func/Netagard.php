<?php
function getValueNetagard(){
  if(isset($_POST['netagard'])){
    $VALUE_NETAGARD = $_POST['netagard'];
    setcookie('netagard', $_POST['netagard'], time()+60*60*24, "/");
  }else{
    if(isset($_COOKIE['netagard'])){
      $VALUE_NETAGARD = $_COOKIE['netagard'];
    }else{
      $VALUE_NETAGARD = 999;
    }
  }
  return $VALUE_NETAGARD;
}
function printShowNetaModal($VALUE_NETAGARD){ ?>
    <button type="button" class="btn btn-<?php $VALUE_NETAGARD == 999 ? print "warning" : print "primary" ?> showNetaModal fs-08" data-bs-toggle="modal" data-bs-target="#netaModal">ネタバレ防止機能<br><?php $VALUE_NETAGARD == 999 ? print "停止中" : print "原作" . $VALUE_NETAGARD . "話" ?></button>
<?php }
function printNetaModal($VALUE_NETAGARD){ ?>
  <div class="modal" id="netaModal" tabindex="-1" aria-labelledby="netaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 id="netaModalLabel" class="modal-title fs-4 fw-bold">ネタバレ防止機能</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="alert alert-light fs-09 fs-md-10" role="alert"
            ><span class="d-block pb-2 fw-bold">ネタバレ防止機能とは…</span
            ><span class="d-block ps-3">当サイトに掲載されている情報を制限することにより、まだ読み進めていない内容のネタバレを表示してしまうことを防ぎます。本機能は当サイト内のコンテンツに適用されます。</span
          ></div>
          <form method="post">
            <div class="mt-4">
              <span class="py-1 px-2 me-3 rounded-2 text-white bg-secondary fs-09">現在の設定</span
              ><span><?php $VALUE_NETAGARD == 999 ? print "すべて表示中" : print "原作" . $VALUE_NETAGARD . "話相当まで表示中"; ?></span
              ><input name="netagard" type="hidden" value="0"
            ></div>
            <div class="mt-4"
              ><span class="me-3 py-1 px-2 rounded-2 text-white bg-secondary fs-09">設定の変更</span
            ></div>
            <table id="netaModal_setTable">
              <tr>
                <th>原作Web小説</th>
                <td>
                  <span class="d-inline-block">
                    <span class="input-group">
                      <input type="number" class="neta-web form-control" value="0">
                      <span class="input-group-text">話</span>
                    </span>
                  </span>
                  </td>
                </td>
              </tr>
              <tr>
                <th>ライトノベル</th>
                <td>
                  <span class="d-inline-block">
                    <span class="input-group">
                      <input type="number" class="neta-lightnovel form-control" value="0">
                      <span class="input-group-text">巻</span>
                    </span>
                  </span>
                </td>
                <td id="neta-l-trans"></td>
              </tr>
              <tr>
                <th>コミック</th>
                <td>
                  <span class="d-inline-block">
                    <span class="input-group">
                      <input type="number" class="neta-comic form-control" value="0">
                      <span class="input-group-text">巻</span>
                    </span>
                  </span>
                </td>
                <td id="neta-c-trans"></td>
              </tr>
              <tr>
                <th>アニメ</th>
                <td>
                  <span class="d-inline-block">
                    <span class="input-group">
                      <input type="number" class="neta-animeS form-control" value="1">
                      <span class="input-group-text">期</span>
                      <input type="number" class="neta-animeE form-control" value="0">
                      <span class="input-group-text">話</span>
                    </span>
                  </span>
                </td>
                <td id="neta-a-trans"></td>
              </tr>
            </table>
            <div class="mt-4 text-end">
              <button id="submitNetModal" type="submit" class="btn btn-primary ms-1 ms-md-3 py-1 px-2 fs-09" disabled><span id="netaValue"></span>変更する</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <script>
    let trans_w = 0;
    let trans_ltw = 0;
    let trans_ctw = 0;
    let trans_atw = 0;
    function refrectToWeb(){
      if(trans_w || trans_ltw > 0 || trans_ctw > 0 || trans_atw){
        const neta = Math.max(trans_w, trans_ltw, trans_ctw, trans_atw);
        document.querySelector('#netaValue').textContent = "原作" + neta + "話相当へ";
        document.querySelector('[name="netagard"]').value = neta;
        document.querySelector('#submitNetModal').disabled = false;
      }
    }
    //原作
    const netaWElement = document.querySelector('.neta-web');
    netaWElement.addEventListener('change', (event) => {
      trans_w = parseFloat(`${event.target.value}`);
      if(trans_w > 0){
        refrectToWeb();
      }
    });
    //ラノベ変換
    const netaLElement = document.querySelector('.neta-lightnovel');
    netaLElement.addEventListener('change', (event) => {
      const result = document.querySelector('#neta-l-trans');
      let target = `${event.target.value}`;
      switch(parseFloat(target)){
        case 1:
          trans_ltw = 10;
          break;
        default:
          trans_ltw = 1;
      }
      if(trans_ltw > 0){
        result.textContent = "（原作" + trans_ltw + "話相当）";
        refrectToWeb();
      }
    });
    //コミック変換
    const netaCElement = document.querySelector('.neta-comic');
    netaCElement.addEventListener('change', (event) => {
      const result = document.querySelector('#neta-c-trans');
      let target = `${event.target.value}`;
      switch(parseFloat(target)){
        default:
          trans_ctw = 20;
      }
      if(trans_ctw > 0){
        result.textContent = "（原作" + trans_ctw + "話相当）";
        refrectToWeb();
      }
    });
    //アニメ変換
    const netaASElement = document.querySelector('.neta-animeS');
    const netaAEElement = document.querySelector('.neta-animeE');
    let neta_as_target = 1;
    let neta_ae_target = 1;
    function changeNetaAElement(neta_as_target, neta_ae_target){
      const result = document.querySelector('#neta-a-trans');
      if(neta_as_target == 1){
        switch(neta_ae_target){
          case 2:
            trans_atw = 15;
            break;
          default:
            trans_atw = 60;
        }
      }else if(neta_as_target == 2){
        switch(neta_ae_target){
          default:
            trans_atw = 2;
        }
      }
      if(trans_atw > 0){
        result.textContent = "（原作" + trans_atw + "話相当）";
        refrectToWeb();
      }
    };
    netaASElement.addEventListener('change', (event) => {
      let target = `${event.target.value}`;
      neta_as_target = parseFloat(target);
      changeNetaAElement(neta_as_target, neta_ae_target);
    });
    netaAEElement.addEventListener('change', (event) => {
      let target = `${event.target.value}`;
      neta_ae_target = parseFloat(target);
      changeNetaAElement(neta_as_target, neta_ae_target);
    });
  </script>
<?php } ?>