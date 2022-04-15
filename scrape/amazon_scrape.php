<?php
// この処理はamaozonのランキングを取得
$count = (string) filter_input(INPUT_GET, 'count');
$url2 = (string) filter_input(INPUT_GET, 'url2');
$dom = new DOMDocument('1.0', 'UTF-8');
$dom->preserveWhiteSpace = false;
$url = file_get_contents($url2);
@$dom->loadHTML($url);
$xpath = new DOMXpath($dom);

$tmp = "";
$i = 0;
$title = [];
$href  = [];
$title_arr = [];
$href_arr  = [];

$title[] = $xpath->query("//*[@id='gridItemRoot']/div/div[2]/div/a[2]/span/div");
$href[]  = $xpath->query("//*/a[@class='a-link-normal']");

for ($i = 0; count($title_arr) < $count; $i++) {
  $title_arr[] = $title[0]->item($i)->nodeValue;
}

for ($i = 0; count($href_arr) < $count; $i++){
  $tmp = $href[0]->item($i)->getAttribute('href');
  if (! in_array($tmp, $href_arr) && strpos($tmp, 'product-reviews') === false) {
    $href_arr[] = $tmp; // ここでurlに変更を加えてしまうと in_array の意味が無くなる
  }
}
$price = [];
$price_arr = [];
$price[] = $xpath->query("//div[@class='a-row']/a/span/span[1]");
for($i = 0; $i < $count; $i++) {
  $price_arr[] = $price[0]->item($i)->nodeValue;
}
$i = 1; 
$amazon_arr = array_combine($title_arr, $href_arr);
echo "<p class='fw-bolder'>Amazon簡単検索の結果【売れ筋ランキング】</p>";
echo "<table class='table table-striped'>";
echo "<thead><tr><th scope='col'>順位</th><th scope='col'>商品名</th><th scope='col'>値段</th></tr></thead>";
foreach ($amazon_arr as $v => $k) {
  // 取得したurlは全て相対パスの為絶対パスに変換
  echo "<tr><td>{$i}位</td><td><a href='https://www.amazon.co.jp$k'>$v</a></td><td>{$price_arr[--$i]}</td></tr>";
  $i+=2;
}
echo "</table>";
unset($price, $price_arr, $url2, $dom, $url, $xpath, $i, $count, $title, $title_arr, $href, $href_arr, $tmp, $amazon_arr, $v, $k,);
