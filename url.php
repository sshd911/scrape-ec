<?php
$count = (string) filter_input(INPUT_GET, 'count');
$r_categories = (string) filter_input(INPUT_GET, 'r_categories');
$r_categories_detail = (string) filter_input(INPUT_GET, 'r_categories_detail');
$a_categories = (string) filter_input(INPUT_GET, 'a_categories');
$y_categories = (string) filter_input(INPUT_GET, 'y_categories');
$y_categories_detail = (string) filter_input(INPUT_GET, 'y_categories_detail');
// 入力された文字列をURLにマッピングし、スクレイピングのページへ飛ばします。
// スクレイピング処理
header("Location: scrape/scrape.php?url1=$r_categories&url2=$a_categories&url3=$y_categories&url4=$y_categories_detail&count=$count&r_categories_detail=$r_categories_detail");

