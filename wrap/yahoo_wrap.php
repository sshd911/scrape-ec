<?php
// この処理はYahooショッピングのランキング取得する際に使うサイドバーのカテゴリー一覧を取得します。
$url = "https://shopping.yahoo.co.jp/ranking/";
$dom = new DOMDocument('1.0', 'UTF-8');
$dom->preserveWhiteSpace = false;
$url = file_get_contents($url);
@$dom->loadHTML($url);
$xpath = new DOMXpath($dom);
$title = [];
$href  = [];
$i = 0;
$title[] = $xpath->query("//a[@class='elSCliLink']");
for ($i = 0; $i < 38; $i++) {
  $tmp[]  = $title[0]->item($i)->getAttribute('href');
}
// aタグのリンクを取得
$href[] = $xpath->query("//a[@class='elSCliLink']");
for ($i = 0; $i < 38; $i++) {
  $title_arr[] = $title[0]->item($i)->nodeValue;
}
$needle = "https:";
$url_plus = 'https://shopping.yahoo.co.jp'; 
for ($i = 0; $i < 38; $i++) {
  //取得したurlの中にドメイン等から始まらないurlがあった場合、これを付け加える
  if (strpos($tmp[$i] , $needle) === false) {
    $tmp[$i] = "$url_plus$tmp[$i]";
  }
}
$yahoo_side_bar = array_combine($tmp, $title_arr);
echo "<select class='form-select form-select-sm' name='y_categories'>";
echo "<option name='y_categories'>Yahooカテゴリ</option>";
foreach ($yahoo_side_bar as $k => $v) {
  echo "<option name='y_categories' id='y_categories' value='$k'>$v</option>";
}
echo "</select>";
unset($url, $dom, $xpath, $title, $href, $tmp, $title, $needle, $url_plus, $yahoo_side_bar, $k, $v, $i);

