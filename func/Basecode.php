<?php
function printHeader($PAGE_NAME,$VALUE_NETAGARD){ ?>
  <header>
    <h1>
      <img src="/img/common/logo.png" alt="異世界はスマートフォンとともに。応援サイト">
    </h1>
    <nav id="gnav">
      <ul
        ><a href="/"<?php $PAGE_NAME == "/" ? print ' class="active"' : print '' ?>><li>トップページ</li></a
        ><a href="/relation/"<?php $PAGE_NAME == "/relation/" ? print ' class="active"' : print '' ?>><li>キャラ相関図</li></a
        ><a href="/magic/"<?php $PAGE_NAME == "/magic/" ? print ' class="active"' : print '' ?>><li>魔法一覧</li></a
        ><a href="/word/"<?php $PAGE_NAME == "/word/" ? print ' class="active"' : print '' ?>><li>用語一覧</li></a
      ></ul>
    </nav>
    <?php printShowNetaModal($VALUE_NETAGARD); ?>
  </header>
<?php printNetaModal($VALUE_NETAGARD);
} ?>