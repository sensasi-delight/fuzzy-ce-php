<?php

namespace SensasiDelight;

use MathPHP\LinearAlgebra\MatrixFactory;

class FuzzyCE
{
	private $evaluation_index;
	private $weights;
	private $assesment_scale;
	private $assesment_data;


	private $evaluation_matrix;
	public $evaluation_index_mapped;

	public function __construct($evaluation_index = null, $weights = null, $assesment_scale = null, $assesment_data = null)
	{
		if ($evaluation_index) {
			$this->set_evaluation_index($evaluation_index);
		}

		if ($weights) {
			$this->set_weights($weights);
		}

		if ($assesment_scale) {
			$this->set_assesment_scale($assesment_scale);
		}

		if ($assesment_data) {
			$this->set_assesment_data($assesment_data);
		}
	}

	//SETTER
	public function set_index_map(array $index_map = null)
	{
		if ($index_map) {
			$this->evaluation_index_mapped = $index_map;
		} else {
			$this->evaluation_index_mapped = Self::index_map($this->evaluation_index);
		}

		if ($this->isPropertyFilled()) {
			$this->calculate();
		}
	}
	public function set_evaluation_index(array $value)
	{
		$this->evaluation_index = $value;
		$this->set_index_map();

		if ($this->isPropertyFilled()) {
			$this->calculate();
		}
	}

	public function set_weights(array $value)
	{
		$this->weights = $value;

		if ($this->isPropertyFilled()) {
			$this->calculate();
		}
	}

	public function set_assesment_scale(array $value)
	{
		$this->assesment_scale = $value;

		if ($this->isPropertyFilled()) {
			$this->calculate();
		}
	}

	public function set_assesment_data(array $value)
	{
		$this->assesment_data = $value;

		if ($this->isPropertyFilled()) {
			$this->calculate();
		}
	}


	//GETTER
	public function get_grade()
	{
		return array_search($this->get_grade_score(), $this->get_evaluation());
	}

	public function get_grade_score()
	{
		return max($this->get_evaluation());
	}

	public function get_evaluation($evaluation_index = null)
	{
		if ($evaluation_index) {
			return $this->evaluation_matrix[$evaluation_index];
		}

		return end($this->evaluation_matrix);
	}

	public function get_all_evaluation()
	{
		return $this->evaluation_matrix;
	}


	//PRIVATE
	private function evaluate(array $evaluation_ids)
	{
		$r = array_intersect_key($this->evaluation_matrix, array_flip($evaluation_ids));
		ksort($r);
		$r = array_values($r);
		$r = array_map(function ($vector) {
			return array_values($vector);
		}, $r);
		$r = MatrixFactory::create($r);


		$ws = array_intersect_key($this->weights, array_flip($evaluation_ids));
		ksort($ws);
		$ws = MatrixFactory::create([array_values($ws)]);


		$result = $ws->multiply($r)->getMatrix()[0];

		return array_combine(array_flip($this->assesment_scale), $result);
	}

	private function calculate()
	{
		foreach ($this->assesment_data as $i => $u) {
			foreach ($this->assesment_scale as $key => $value) {
				$evaluation_vector[$key] = 0;
			}

			foreach (array_count_values($u) as $j => $count) {
				$evaluation_vector[array_search($j, $this->assesment_scale)] = $count;
			}

			$this->evaluation_matrix[$i] = Self::toItsPercentage($evaluation_vector);
		}


		foreach ($this->evaluation_index_mapped as $key => $evaluation_ids) {
			$this->evaluation_matrix[$key] = $this->evaluate($evaluation_ids);
		}
	}

	private function isPropertyFilled()
	{
		return $this->evaluation_index & $this->weights & $this->assesment_scale & $this->assesment_data;
	}

	//helper
	private static function index_map(array $array)
	{
		$return = [];
		foreach ($array as $key => $value) {
			if (is_array($value)) {
				$return = array_merge($return, Self::index_map($value));
			} else {
				$return[substr($value, 0, -1)][] = $value;
			}

			if (is_string($key)) {
				$return[substr($key, 0, -1)][] = $key;
			}
		}

		krsort($return);
		return $return;
	}

	public static function toItsPercentage(array $numbers)
	{
		$sum = array_sum($numbers);
		foreach ($numbers as $i => $number) {
			$numbers[$i] = $number / $sum;
		}

		return $numbers;
	}
}
