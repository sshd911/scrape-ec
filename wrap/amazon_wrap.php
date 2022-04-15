<?php
// この処理はYahooショッピングのランキング取得する際に使うサイドバーのカテゴリー一覧を取得します。
$url = "https://www.amazon.co.jp/gp/bestsellers";
$dom = new DOMDocument('1.0', 'UTF-8');
$dom->preserveWhiteSpace = false;
$url = file_get_contents($url);
@$dom->loadHTML($url);
$xpath = new DOMXpath($dom);
$title = [];
$href  = [];
$wrap_href  = [];
$tmp   = [];

$tmp[] = $xpath->query("//*[@class='_p13n-zg-nav-tree-all_style_zg-browse-item__1rdKf _p13n-zg-nav-tree-all_style_zg-browse-height-small__nleKL']/a");
$url_plus = 'https://www.amazon.co.jp';
// サイドバーのurlが相対パスの為ドメインを連結する
for ($i = 0; $i < 35; $i++) {
  $wrap_href[$i]  = $url_plus.$tmp[0]->item($i)->getAttribute('href');
}
// aタグのリンクを取得
$wrap_title[] = $xpath->query("//*[@class='_p13n-zg-nav-tree-all_style_zg-browse-item__1rdKf _p13n-zg-nav-tree-all_style_zg-browse-height-small__nleKL']/a");
for ($i = 0; $i < 35; $i++) {
  $title_arr[$i]  = $wrap_title[0]->item($i)->nodeValue;
}
$amazon_side_bar = array_combine($wrap_href, $title_arr);
// class="shadow-sm p-3 mb-5 bg-body rounded"
echo "<select class='form-select form-select-sm' name='a_categories'>";
echo "<option name='a_categories'>Amazonカテゴリ</option>";
foreach ($amazon_side_bar as $k => $v) {
  echo "<option value='$k'>$v</option>";
}
echo "</select>";
unset($url, $dom, $xpath, $title, $href, $tmp, $title, $needle, $url_plus, $rakuten_side_bar, $k, $v, $i, $url_plus, $amazon_side_bar, $wrap_href, $wrap_title, $title_arr);
