<html>
<head>
  <?php require("head.html"); ?>
</head>
<body>
  <h3 class="fw-bold text-center">ECサイト【売れ筋ランキング】</h3>
  <form  action="check.php?url1=r_categories&url2=a_categories&url3=y_categories&url4=y_categories_detail&count=count&r_categories_detail=r_categories_detail" method="GET">
    <hr><p class="fw-bolder">表示件数設定(最大20件(半角数字のみ))</p><input class="form-control" type='number' max='20' min='1' name='count' id='count' value="10"><br>
    <p class="fw-bolder">商品カテゴリ選択</p>
    <?php require_once("wrap/amazon_wrap.php"); ?><br>
    <?php require_once("wrap/rakuten_wrap.php"); ?><br>
    <?php require_once("wrap/rakuten_wrap_detail.php"); ?><br>
    <?php require_once("wrap/yahoo_wrap.php");  ?><br>
    <?php require_once("wrap/yahoo_wrap_detail.php"); ?><br>
    <button  class="form-control btn btn-outline-secondary" type="submit">検索</button>
  </form>
  <a class="fixed-bottom btn btn-secondary btn-lg" href="mailto:maeda_sho@sshd911.net?subject=ECサイト【カテゴリ別売れ筋ランキング】お問い合せ">お問い合わせ</a>
</body>
</html>