<?php
// この処理はYahooショッピングのランキング取得する際に使うサイドバーのカテゴリー一覧を取得します。
$count = (string) filter_input(INPUT_GET, 'count');
$url3 = (string) filter_input(INPUT_GET, 'url3');
$dom = new DOMDocument('1.0', 'UTF-8');
$dom->preserveWhiteSpace = false;
$url = file_get_contents($url3);
@$dom->loadHTML($url);
$xpath = new DOMXpath($dom);
$i = 0;
$title_arr = [];
$title = [];
$href  = [];
// タイトルを取得
$href[] = $xpath->query("//h4[@class='elTitle']/a");
for ($i = 0; $i < $count; $i++) {
  $href_arr[]  = $href[0]->item($i)->getAttribute('href');
}
// aタグのリンクを取得
$title[] = $xpath->query("//h4[@class='elTitle']/a");
for ($i = 0; $i < $count; $i++) {
  $title_arr[] = $title[0]->item($i)->nodeValue;
}
for ($i = 0; $i < $count; $i++) {
  // 取得したurlが相対パスであれば、絶対パスに変換する
  if (strpos($href_arr[$i], "https:") === false) {
    $href_arr[$i] = "https://shopping.yahoo.co.jp$href_arr[$i]";
  }
}
$price = [];
$price_arr = [];
$price[] = $xpath->query("//h4[@class='elPrice']");
for($i = 0; $i < $count; $i++) {
  $price_arr[] = $price[0]->item($i)->nodeValue;
}
$i = 1;
$yahoo_arr = array_combine($href_arr, $title_arr,);
echo "<p class='fw-bolder'>Yahoo簡単検索の結果【売れ筋ランキング】</p>";
echo "<table class='table table-striped'>";
echo "<thead><tr><th scope='col'>順位</th><th scope='col'>商品名</th><th scope='col'>値段</th></tr></thead>";
foreach ($yahoo_arr as $k => $v) {
  echo "<tr><td>{$i}位</td><td><a href='$k'>$v</a></td><td>{$price_arr[--$i]}</td></tr>";
  $i+=2;
}
echo "</table>";
unset($url, $url3, $dom, $xpath, $count, $title, $title_arr, $href, $href_arr, $yahoo_arr, $k, $v, $i);
