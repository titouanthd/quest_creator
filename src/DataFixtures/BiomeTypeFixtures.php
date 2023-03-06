<?php

namespace App\DataFixtures;

use App\Entity\BiomeType;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class BiomeTypeFixtures extends Fixture
{
    public $biome_types = [
        [
            'name' => 'Arctic',
            'slug' => 'arctic',
        ],
        [
            'name' => 'Desert',
            'slug' => 'desert',
        ],
        [
            'name' => 'Forest',
            'slug' => 'forest',
        ],
        [
            'name' => 'Grassland',
            'slug' => 'grassland',
        ],
        [
            'name' => 'Mountain',
            'slug' => 'mountain',
        ],
        [
            'name' => 'Ocean',
            'slug' => 'ocean',
        ],
        [
            'name' => 'Rainforest',
            'slug' => 'rainforest',
        ],
        [
            'name' => 'Tundra',
            'slug' => 'tundra',
        ],
    ];

    public function load(ObjectManager $manager): void
    {
        // echo start message
        echo 'Start biomeTypeFixtures' . PHP_EOL;
        foreach ($this->biome_types as $biome_type) {
            $biome = new BiomeType();
            $biome->setName($biome_type['name']);
            $biome->setSlug($biome_type['slug']);
            $manager->persist($biome);
            // add a ref to biome
            $this->addReference($biome->getSlug(), $biome);
            // echo
            echo $biome->getName() . ' has been created succesfully !' . PHP_EOL;
        }

        $manager->flush();
        // echo end message
        echo 'End biomeTypeFixtures' . PHP_EOL;
    }
}
