<?php
namespace App\Data;

class SearchData {

    /** Number of the page */
    public int $page = 1;

    public $boat;

    public ?int $places;

    public ?int $max;

    public ?int $min;

}