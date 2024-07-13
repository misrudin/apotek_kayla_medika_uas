<?php

if (!function_exists('formatRupiah')) {
    function formatRupiah($number)
    {
        return 'Rp ' . number_format($number, 0, ',', '.');
    }
}

if (!function_exists('formatNumber')) {
  function formatNumber($number)
  {
      return number_format($number, 0, ',', '.');
  }
}
