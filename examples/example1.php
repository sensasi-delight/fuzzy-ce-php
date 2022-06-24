<?php

// TODO: GRAMARLY


/**
 * EXAMPLE 1
 * 
 * This file is an example for usage the FuzzyCE library
 * for evaluate Safety Guarantee System based on paper [1] case study.
 * 
 * [1] Zhou, Z., Zhang, X. and Dong, W., 2013. Fuzzy comprehensive evaluation for safety guarantee system of reclaimed water quality. Procedia Environmental Sciences, 18, pp.227-235.
 * [1] @link https://www.sciencedirect.com/science/article/pii/S1878029613001618
 * 
 */

require_once __DIR__ . '\..\vendor\autoload.php';

use SensasiDelight\FuzzyCE;


/**
 * see Table 1 on page 228
 */
$evaluation_index = [
	'u1' => ['u11', 'u12'],
	'u2' => ['u21', 'u22', 'u23'],
	'u3' => ['u31', 'u32'],
	'u4' => ['u41', 'u42'],
	'u5' => ['u51', 'u52']
];

/**
 * see table 4 on page 232
 */
$weights = [
	'u1' => 0.133,
	'u2' => 0.310,
	'u3' => 0.330,
	'u4' => 0.118,
	'u5' => 0.109,
	'u11' => 0.667,
	'u12' => 0.333,
	'u21' => 0.200,
	'u22' => 0.400,
	'u23' => 0.400,
	'u31' => 0.333,
	'u32' => 0.667,
	'u41' => 0.667,
	'u42' => 0.333,
	'u51' => 0.750,
	'u52' => 0.250
];

/**
 * see first senteces on section 5.3 (page 232)
 */
$assesment_scale = [
	'Excellent' => 5,
	'Good' => 4,
	'Medium' => 3,
	'Poor' => 2,
	'Worst' => 1
];

/**
 * all data below are interpreted from table 5 on page 232
 */
$assesment_data = [
	"u11" => [
		"expert1" => 5,
		"expert2" => 4,
		"expert3" => 4,
		"expert4" => 4,
		"expert5" => 3,
	], "u12" => [
		"expert1" => 5,
		"expert2" => 5,
		"expert3" => 4,
		"expert4" => 3,
		"expert5" => 3,
	], "u21" => [
		"expert1" => 5,
		"expert2" => 5,
		"expert3" => 5,
		"expert4" => 4,
		"expert5" => 3,
	], "u22" => [
		"expert1" => 5,
		"expert2" => 4,
		"expert3" => 4,
		"expert4" => 4,
		"expert5" => 3,
	], "u23" => [
		"expert1" => 5,
		"expert2" => 5,
		"expert3" => 4,
		"expert4" => 3,
		"expert5" => 3,
	], "u31" => [
		"expert1" => 5,
		"expert2" => 5,
		"expert3" => 4,
		"expert4" => 4,
		"expert5" => 4,
	], "u32" => [
		"expert1" => 4,
		"expert2" => 4,
		"expert3" => 3,
		"expert4" => 3,
		"expert5" => 3,
	], "u41" => [
		"expert1" => 5,
		"expert2" => 4,
		"expert3" => 4,
		"expert4" => 3,
		"expert5" => 3,
	], "u42" => [
		"expert1" => 5,
		"expert2" => 5,
		"expert3" => 5,
		"expert4" => 5,
		"expert5" => 4,
	], "u51" => [
		"expert1" => 5,
		"expert2" => 5,
		"expert3" => 4,
		"expert4" => 4,
		"expert5" => 3,
	], "u52" => [
		"expert1" => 4,
		"expert2" => 3,
		"expert3" => 3,
		"expert4" => 3,
		"expert5" => 3
	]
];

$fuzzy = new FuzzyCE(
	$evaluation_index,
	$weights,
	$assesment_scale,
	$assesment_data
);


print_r($fuzzy->get_grade() . "\n");
print_r($fuzzy->get_grade_score() . "\n");
print_r($fuzzy->get_evaluation());
