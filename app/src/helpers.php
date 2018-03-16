<?php

if (!function_exists('hero_name')) {

    function hero_name() : string
    {
        $faker = Faker\Factory::create();

        return $faker->name;
    }
}


if (!function_exists('last_word')) {

    function last_word($string) : string
    {
        $pieces = explode(' ', $string);
        $last_word = array_pop($pieces);

        return $last_word;
    }
}