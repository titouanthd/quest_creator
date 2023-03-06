<?php

namespace App\DataFixtures;

use App\Entity\Area;
use App\Entity\Biome;
use App\Entity\Universe;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class AreaFixtures extends Fixture implements DependentFixtureInterface
{
    public $areas = [
        [
            "name" => "Area 1",
            "slug" => "area-1",
        ],
    ];

    public function load(ObjectManager $manager): void
    {
        // echo start message
        echo 'Start areaFixtures' . PHP_EOL;
        // count biomeTypes
        $universes = $manager->getRepository(Universe::class)->findAll();
        $biomes = $manager->getRepository(Biome::class)->findAll();
        // foreach area
        foreach ($this->areas as $a) {
            $datetime = new \DateTime('now');
            // create area
            $new_area = new Area();
            $new_area->setName($a['name']);
            $new_area->setSlug($a['slug']);
            // choose a random biome
            $biome = $biomes[rand(0, count($biomes) - 1)];
            $new_area->setBiome($biome);
            // choose a random universe
            $universe = $universes[rand(0, count($universes) - 1)];
            $new_area->setUniverse($universe);
            $new_area->setCreatedAt($datetime);
            $new_area->setUpdatedAt($datetime);
            // persist
            $manager->persist($new_area);
            // add a ref to area
            $this->addReference($new_area->getSlug(), $new_area);
            // echo
            echo $new_area->getName() . ' has been created succesfully !' . PHP_EOL;
        }

        $manager->flush();
        // echo end message
        echo 'End areaFixtures' . PHP_EOL;
    }

    public function getDependencies()
    {
        return [
            BiomeFixtures::class,
            UniverseFixtures::class,
        ];
    }
}
