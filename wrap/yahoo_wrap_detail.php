<?php
// この処理はYahooショッピングのランキング取得する際に使うサイドバーのカテゴリー一覧[詳細]を取得します。
$url = "https://shopping.yahoo.co.jp/ranking/";
$dom = new DOMDocument('1.0', 'UTF-8');
$dom->preserveWhiteSpace = false;
$url = file_get_contents($url);
@$dom->loadHTML($url);
$xpath = new DOMXpath($dom);
$wrap_href   = [];
$wraps_href  = [];
$wrap_title  = [];
$wraps_title = [];
$count = 331;
$i = 0;

$wrap_href[]  = $xpath->query("//*[@class='comCateLinksWrap']/ul/li/a");
for ($i = 0; $i < $count; $i++) {
  $wraps_href[$i] = $wrap_href[0]->item($i)->getAttribute('href');
}
$wrap_title[]  = $xpath->query("//*[@class='comCateLinksWrap']/ul/li/a");
for ($i = 0; $i < $count; $i++) {
  $wraps_title[$i] = $wrap_title[0]->item($i)->nodeValue;
}
$yahoo_side_bar_detail = array_combine($wraps_href, $wraps_title);
echo "<select class='form-select form-select-sm' name='y_categories_detail'>";
echo "<option name='y_categories_detail'>Yahoo詳細カテゴリ</option>";
foreach ($yahoo_side_bar_detail as $k => $v) {
  echo "<option name='y_categories_detail' value='$k'>$v</option>";
}
echo "</select>";
unset($url, $dom, $xpath, $tmp, $title, $k, $v, $i, $wrap_href, $wraps_href, $wrap_title, $wraps_title, $yahoo_side_bar_detail);