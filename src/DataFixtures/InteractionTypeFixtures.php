<?php

namespace App\DataFixtures;

use App\Entity\InteractionType;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class InteractionTypeFixtures extends Fixture
{
    public $interaction_types = [
        [
            "name" => "npc",
            "slug" => "npc",
        ],
        [
            "name" => "player",
            "slug" => "player",
        ],
        [
            "name" => "monster",
            "slug" => "monster",
        ],
        [
            "name" => "object",
            "slug" => "object",
        ],
        [
            "name" => "building",
            "slug" => "building",
        ]
    ];

    public function load(ObjectManager $manager): void
    {
        // echo start message
        echo 'Start interactionTypeFixtures' . PHP_EOL;
        foreach ($this->interaction_types as $interaction_type) {
            $interaction = new InteractionType();
            $interaction->setName($interaction_type['name']);
            $interaction->setSlug($interaction_type['slug']);
            $manager->persist($interaction);
            // add a ref to biome
            $this->addReference($interaction->getSlug(), $interaction);
            // echo
            echo $interaction->getName() . ' has been created succesfully !' . PHP_EOL;
        }

        $manager->flush();
        // echo end message
        echo 'End interactionTypeFixtures' . PHP_EOL;
    }
}
