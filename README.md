
# FuzzyCE PHP

A PHP library that Implements the Fuzzy Comprehensive Evaluation method to assist you in the conclusion of qualitative assessment.

## Installation

Install using composer:

```bash
composer require sensasi-delight/fuzzy-ce-php
```

## Usage

The usage examples of this library are also available on [examples folder](https://github.com/sensasi-delight/fuzzy-ce-php/tree/main/examples) with detailed description.

1. Define the evaluation index with their sub-factor of evaluation.

    ```php
    $evaluation_index = [
        'u1' => ['u11', 'u12'],
        'u2' => ['u21', 'u22', 'u23'],
        'u3' => ['u31', 'u32'],
        'u4' => ['u41', 'u42'],
        'u5' => ['u51', 'u52']
    ];
    ```

2. Define the evaluation weight for each factor.

    ```php
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
    ```

3. Define the scale of assesment

    The scale of assesment can be ascending or descending with their grade name depends on your assesment design.

    ```php
    $assesment_scale = [
        'Excellent' => 5,
        'Good' => 4,
        'Medium' => 3,
        'Poor' => 2,
        'Worst' => 1
    ];
    ```

4. Define assesment data for each evaluation index with their respondent answer.

    ```php
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
        ], 
        
        ...
        
        "u52" => [
            "expert1" => 4,
            "expert2" => 3,
            "expert3" => 3,
            "expert4" => 3,
            "expert5" => 3,
        ], ...

    ];
    ```

5. Create the FuzzyCE object and set the required property that you have defined before.

    ```php
    $fuzzyCE = new FuzzyCE(
        $evaluation_index,
        $weights,
        $assesment_scale,
        $assesment_data
    );
    ```

    or

    ```php
    $fuzzyCE = new FuzzyCE();

    $fuzzyCE->set_evaluation_index($evaluation_index);
    $fuzzyCE->set_weights($weights);
    $fuzzyCE->set_assesment_scale($assesment_scale);
    $fuzzyCE->set_assesment_data($assesment_data);
    ```

6. Get the evaluation.

    - for the evaluation vector:

        ```php
        print_r($fuzzyCE->get_evaluation());
        ```

        it's should be returning an output:

        ```bash
        Array
        (
            [Excellent] => 0.2708902
            [Good] => 0.4051536
            [Medium] => 0.3239562
            [Poor] => 0
            [Worst] => 0
        )
        ```

    - for the overall evaluation grade:

        ```php
        echo $fuzzyCE->get_grade();
        ```

        It's should be returning an output:

        ```bash
        > Good
        ```

    - for the grade score:

        ```php
        echo $fuzzyCE->get_grade_score();
        ```

        It's should be returning an output:

        ```bash
        > 0.4051536
        ```

## Contributing

Contributions are what make the open source community such an amazing place to learn, inspire, and create. Any contributions you make are **greatly appreciated**.

If you have a suggestion that would make this better, please fork the repo and create a pull request. You can also simply open an issue with the tag "enhancement". Don't forget to give the project a star! Thanks again!

1. Fork the Project.
2. Create your Feature Branch (`git checkout -b feature/AmazingFeature`).
3. Commit your Changes (`git commit -m 'Add some AmazingFeature'`).
4. Push to the Branch (`git push origin feature/AmazingFeature`).
5. Open a Pull Request.

## License

The code is released under the MIT license.

## Contact

Email - [zainadam.id@gmail.com](mailto:zainadam.id@gmail.com?subject=[GitHub]%20EigenvectorCentralityPHP)

Twitter - [@sensasi_DELIGHT](https://twitter.com/sensasi_DELIGHT)
