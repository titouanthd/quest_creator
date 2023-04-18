<?php

namespace App\Twig\Components;

use App\Entity\Universe;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('universe_card')]
final class UniverseCardComponent
{
  public Universe $universe;
}
