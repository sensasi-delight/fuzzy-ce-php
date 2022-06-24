<?php

/**
 * EXAMPLE 1
 * 
 * This file is an example for usage of the FuzzyCE library
 * for risk evaluation between two project based on paper [1] case study.
 * 
 * [1] ML, Zhang, and Yang Wp. "Fuzzy comprehensive evaluation method applied in the real estate investment risks research." Physics Procedia 24 (2012): 1815-1821.
 * [1] @link https://www.sciencedirect.com/science/article/pii/S1875389212003100
 * 
 */

require_once __DIR__ . '\..\vendor\autoload.php';


use SensasiDelight\FuzzyCE;



# see Table 1 on page 1819
# our library does'nt support dynamic name of evaluation index yet.
# we've convert 𝘈 to 𝘶, 𝘉ᵢ to 𝘶ᵢ, and 𝘊ᵢ to 𝘶ᵢⱼ

$evaluation_index = [
	'u1' => ['u11', 'u12', 'u13', 'u14', 'u15'],
	'u2' => ['u21', 'u22'],
	'u3' => ['u31', 'u34', 'u33', 'u34', 'u35', 'u36'],
	'u4' => ['u41', 'u42']
];


# see 4th and 5th paragraph on section 5 (page 1819)

$weights = [
	'u1' => 0.58,
	'u2' => 0.16,
	'u3' => 0.10,
	'u4' => 0.16,
	'u11' => 0.162,
	'u12' => 0.162,
	'u13' => 0.103,
	'u14' => 0.058,
	'u15' => 0.162,
	'u21' => 0.144,
	'u22' => 0.016,
	'u31' => 0.005,
	'u32' => 0.005,
	'u33' => 0.028,
	'u34' => 0.028,
	'u35' => 0.028,
	'u36' => 0.005,
	'u41' => 0.128,
	'u42' => 0.032
];


# see 6th paragraph on section 5 (page 1820)

$assesment_scale = [
	'Big' => 5,
	'Large' => 4,
	'Medium' => 3,
	'Small' => 2,
	'Very Small' => 1
];


# since we do not have the dataset,
# for this example we've to intepret dataset based on R1 and R2 martix on page 1820
# dataset1.csv for R1 and dataset2.csv for R2

$csvFile = file(__DIR__ . "\dataset1.csv");
foreach ($csvFile as $i => $line) {
	if ($i != 0) {
		$rows = str_getcsv($line, ';');
		$u_text = array_shift($rows);
		$jinshan_assesment_data[$u_text] = $rows;
	}
}

$csvFile = file(__DIR__ . "\dataset2.csv");
foreach ($csvFile as $i => $line) {
	if ($i != 0) {
		$rows = str_getcsv($line, ';');
		$u_text = array_shift($rows);
		$zhabei_assesment_data[$u_text] = $rows;
	}
}


// do the evalutaion using FuzzyCE library
$jinshan_eval = new FuzzyCE(
	$evaluation_index,
	$weights,
	$assesment_scale,
	$jinshan_assesment_data
);

$zhabei_eval = new FuzzyCE(
	$evaluation_index,
	$weights,
	$assesment_scale,
	$zhabei_assesment_data
);

echo "Jinshan District\n";
echo "----------------\n";
echo 'Score: ', $jinshan_eval->get_grade_score(), "\n";
echo 'grade: ', $jinshan_eval->get_grade(), "\n\n";

echo "Zhabei District\n";
echo "----------------\n";
echo 'Score: ', $zhabei_eval->get_grade_score(), "\n";
echo 'grade: ', $zhabei_eval->get_grade(), "\n\n";


# it's resulting different score than [1], i still can't figured it out
