<?php
// この処理はYahooショッピングのランキング取得する際に使うサイドバーのカテゴリー一覧を取得します。
$url = "https://ranking.rakuten.co.jp/?l-id=top_normal_grayheader02";
$dom = new DOMDocument('1.0', 'UTF-8');
$dom->preserveWhiteSpace = false;
$url = file_get_contents($url);
@$dom->loadHTML($url);
$xpath = new DOMXpath($dom);
$wrap_title = [];
$wrap_href  = [];
$wraps_title = [];
$wraps_href  = [];
$count = 1370;
$i = 0;

$url_plus = 'https://ranking.rakuten.co.jp';
$wrap_href[] = $xpath->query("//a[@class='genrename']");
$wrap_title[] = $xpath->query("//a[@class='genrename']");
for ($i = 0; $i < $count; $i++) {
  // aタグのリンクを取得
  // サイドバーのurlが相対パスの為ドメインを連結する
  $wraps_href[$i]  = $url_plus.$wrap_href[0]->item($i)->getAttribute('href');
}
for ($i = 0; $i < $count; $i++) {
  $wraps_title[$i]  = $wrap_title[0]->item($i)->nodeValue;
}

$rakuten_sidebar_detail = array_combine($wraps_href, $wraps_title);

echo "<select class='form-select form-select-sm' name='r_categories_detail'>";
echo "<option name='r_categories_detail'>Rakuten詳細カテゴリ</option>";
foreach ($rakuten_sidebar_detail as $k => $v) {
  echo "<option name='r_categories_detail' id='y_categories_detail' value='$k'>$v</option>";
}
echo "</select>";
unset($url, $dom, $xpath, $wrap_title, $wraps_title, $wrap_href, $wraps_href, $url_plus, $rakuten_sidebar_detail, $k, $v, $i, $count);