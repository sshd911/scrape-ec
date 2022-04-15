<?php

if (isset($_GET)) {
  $count = (string) filter_input(INPUT_GET, 'count');
  $r_categories = (string) filter_input(INPUT_GET, 'r_categories');
  $r_categories_detail = (string) filter_input(INPUT_GET, 'r_categories_detail');
  $a_categories = (string) filter_input(INPUT_GET, 'a_categories');
  $y_categories = (string) filter_input(INPUT_GET, 'y_categories');
  $y_categories_detail = (string) filter_input(INPUT_GET, 'y_categories_detail');

  if (
    strpos($r_categories, 'https') === false &&
    strpos($r_categories_detail, 'https') === false &&
    strpos($y_categories, 'https') === false &&
    strpos($a_categories, 'https') === false &&
    strpos($y_categories_detail, 'https') === false
  ) {
    header("Location: error.php");
    exit();
  }

  if ($count < 1) {
    $count = 1;
  } elseif ($count > 20) {
    $count = 20; 
  }

  header("Location: url.php?r_categories=$r_categories&a_categories=$a_categories&y_categories=$y_categories&y_categories_detail=$y_categories_detail&count=$count&r_categories_detail=$r_categories_detail");
}
