<?php
defined('BASEPATH') or exit('No direct script access allowed');

function waktu_ago($datetime)
{
	date_default_timezone_set('Asia/Jakarta');
	$time = strtotime($datetime);
	$diff = time() - $time;

	if ($diff < 60) {
		return 'Baru saja';
	}

	$units = [
		31536000 => 'tahun',
		2592000 => 'bulan',
		604800 => 'minggu',
		86400 => 'hari',
		3600 => 'jam',
		60 => 'menit',
	];

	foreach ($units as $unit => $text) {
		if ($diff >= $unit) {
			$value = floor($diff / $unit);
			return $value . ' ' . $text . ' yang lalu';
		}
	}

	return date('d M Y, H:i', $time);
}
