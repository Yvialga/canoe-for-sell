<?php

namespace App\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('boatCard')]
final class BoatCard {
    
    public string $image;
    public string $title;
    public string $brand;
    public string $type;
    public int $price;
    public int $id;
}
