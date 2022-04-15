<html>
<head>
  <?php require_once("../head.html"); ?>
</head>
<body>  
<h3 class="fw-bold text-center">ECサイト【売れ筋ランキング】</h3><hr>
<?php
echo "<a class='form-control btn btn-outline-secondary' href='../index.php'>カテゴリ選択画面に戻る</a><hr>";
$_GET['url2'] !== 'Amazonカテゴリ' ? require_once("amazon_scrape.php") : '';
$_GET['url1'] !== 'Rakutenカテゴリ' ? require_once("rakuten_scrape.php"): '';
$_GET['r_categories_detail'] !== 'Rakuten詳細カテゴリ' ? require_once("rakuten_scrape_detail.php") : '';
$_GET['url3'] !== 'Yahooカテゴリ' ? require_once("yahoo_scrape.php") : '';
$_GET['url4'] !== 'Yahoo詳細カテゴリ' ? require_once("yahoo_scrape_detail.php") : '';
?>
</body>
</html>