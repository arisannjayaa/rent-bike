<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('format_rupiah')) {
	function format_rupiah($number)
	{
		return 'Rp ' . number_format($number, 0, ',', '.');
	}
}
