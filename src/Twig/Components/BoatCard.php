<?php

namespace App\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('boatCard')]
final class BoatCard {
    
    public string $title;
    public int $price;
    public string $image;
    public string $boatType;
}
