<?php
// 楽天のカテゴリ一覧を取得
$url = 'https://ranking.rakuten.co.jp/';
$dom = new DOMDocument('1.0', 'UTF-8');
$dom->preserveWhiteSpace = false;
$url = file_get_contents($url);
@$dom->loadHTML($url);
$xpath = new DOMXPath($dom);

$wrap_title  = [];
$wraps_title = [];
$wrap_href   = [];
$wraps_href  = [];
$count = 38; 
$i = 0;

$wrap_href[] = $xpath->query("//span[@class='zindexGenreName']/a");

for ($i = 0; $i < $count; $i++) {
  $wraps_href[$i] = $wrap_href[0]->item($i)->getAttribute('href');
}

for ($i = 0; $i < $count; $i++){
// 取得したurlに相対パスが混ざっている為フィルタリングし、絶対パスに変換
  if (strpos($wraps_href[$i], 'https://') === false) {
    $wraps_href[$i] = 'https://ranking.rakuten.co.jp'.$wraps_href[$i];
  }
}

$wrap_title[] = $xpath->query("//span[@class='zindexGenreName']/a");

for ($i = 0; $i < $count; $i++){
  $wraps_title[$i] = $wrap_title[0]->item($i)->nodeValue;
} 

$rakuten_side_bar = array_combine($wraps_href, $wraps_title);
echo "<select class='form-select form-select-sm' name='r_categories'>";
echo "<option name='r_categories'>Rakutenカテゴリ</option>";
foreach ($rakuten_side_bar as $k => $v) {
  echo "<option name='r_categories' id='r_categories' value='$k'>$v</option>";
}
echo "</select>";
unset($count, $wrap_href, $wrap_title, $wraps_href, $wraps_title, $k, $v, $i, $dom, $xpath, $rakuten_side_bar, $url);
