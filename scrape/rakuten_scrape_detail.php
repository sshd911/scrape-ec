<?php
$count = (string) filter_input(INPUT_GET, 'count');
$r_categories_detail = (string) filter_input(INPUT_GET, 'r_categories_detail');
$dom = new DOMDocument('1.0', 'UTF-8');
$dom->preserveWhiteSpace = false;
$url = file_get_contents($r_categories_detail);
@$dom->loadHTML($url);
$xpath = new DOMXpath($dom);

$i = 0;
$k = 0; 
$title = [];
$href  = [];
$price = [];
$title_arr = [];
$href_arr  = [];
$price_arr = [];
$title[] = $xpath->query("//div[@class='rnkRanking_itemName']/a");
$href[]  = $xpath->query("//div[@class='rnkRanking_itemName']/a");
$price[] = $xpath->query("//div[@class='rnkRanking_price']");
for ($i = 1; $i <= $count; $i++) {
  $title_arr[$i]  = $title[0]->item($i-1)->nodeValue;
  for (; $k <= count($title_arr);) {
    $href_arr[$k] = $href[0]->item($k++)->getAttribute('href');
    break;
  }
}
for ($i = 0; $i < $count; $i++) {
  $price_arr[] = $price[0]->item($i)->nodeValue;
}
$i = 1;
$rakuten_arr = array_combine($href_arr, $title_arr);
echo "<p class='fw-bolder'>Rakuten詳細検索の結果【売れ筋ランキング】</p>";
echo "<table class='table table-striped'>";
echo "<thead><tr><th scope='col'>順位</th><th scope='col'>商品名</th><th scope='col'>値段</th></tr></thead>";
foreach ($rakuten_arr as $k => $v) {
  echo "<tr><td>{$i}位</td><td><a href='$k'>$v</a></td><td>{$price_arr[--$i]}</td></tr>";
  $i+=2;
}
echo "</table>";
unset($price, $price_arr, $dom, $url, $r_categories_detail, $xpath, $k, $i, $count, $title, $href, $rakuten_arr, $title_arr, $href_arr, $v);
