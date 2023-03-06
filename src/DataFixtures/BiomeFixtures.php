<?php

namespace App\DataFixtures;

use App\Entity\Biome;
use App\Entity\BiomeType;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class BiomeFixtures extends Fixture implements DependentFixtureInterface
{
    public $biomes = [
        [
            "name" => "Ocean arctic",
            "slug" => "ocean-arctic",
        ],
        [
            "name" => "Ocean tropical",
            "slug" => "ocean-tropical",
        ],
        [
            "name" => "Ocean temperate",
            "slug" => "ocean-temperate",
        ],
        [
            "name" => "Ocean subtropical",
            "slug" => "ocean-subtropical",
        ],
        [
            "name" => "Ocean polar",
            "slug" => "ocean-polar",
        ],
    ];

    public function load(ObjectManager $manager): void
    {
        // echo start message
        echo 'Start biomeFixtures' . PHP_EOL;
        $biomeTypes = $manager->getRepository(BiomeType::class)->findAll();
        // count biomeTypes
        $countBiomeTypes = count($biomeTypes);
        echo 'count biomeTypes: ' . $countBiomeTypes . PHP_EOL;
        // foreach biome
        foreach($this->biomes as $b) {
            $datetime = new \DateTime('now');
            // create biome
            $new_biome = new Biome();
            $new_biome->setName($b['name']);
            $new_biome->setSlug($b['slug']);
            // choose a random biomeType
            $biomeType = $biomeTypes[rand(0, $countBiomeTypes - 1)];
            $new_biome->setBiomeType($biomeType);
            $new_biome->setCreatedAt($datetime);
            $new_biome->setUpdatedAt($datetime);
            // persist
            $manager->persist($new_biome);
            // add a ref to biome
            $this->addReference($new_biome->getSlug(), $new_biome);
            // echo
            echo $new_biome->getName() . ' has been created succesfully !' . PHP_EOL;
        }

        $manager->flush();
    }


    public function getDependencies()
    {
        return [
            BiomeTypeFixtures::class,
        ];
    }
}
