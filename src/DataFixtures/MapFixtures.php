<?php

namespace App\DataFixtures;

use App\Entity\Map;
use App\Entity\Area;
use App\Entity\Interaction;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class MapFixtures extends Fixture implements DependentFixtureInterface
{
    public $maps = [
        [
            "name" => "[0,0]",
            "slug" => "0_0",
            "x" => 0,
            "y" => 0,
        ],
        [
            "name" => "[0,-1]",
            "slug" => "0_-1",
            "x" => 0,
            "y" => -1,
        ]
    ];

    public function load(ObjectManager $manager): void
    {
        // echo start message
        echo 'Start mapFixtures' . PHP_EOL;

        // interactions
        $interactions = $manager->getRepository(Interaction::class)->findAll();
        // areas 
        $areas = $manager->getRepository(Area::class)->findAll();
        // count interactions
        $countInteractions = count($interactions);
        
        foreach ($this->maps as $m) {
            $datetime = new \DateTime('now');
            $map = new Map();
            $map->setName($m['name']);
            $map->setSlug($m['slug']);
            $map->setX($m['x']);
            $map->setY($m['y']);
            // choose a random interaction
            $interaction = $interactions[rand(0, $countInteractions - 1)];
            $map->addInteraction($interaction);
            // choose a random area
            $area = $areas[rand(0, count($areas) - 1)];
            $map->setArea($area);
            $map->setCreatedAt($datetime);
            $map->setUpdatedAt($datetime);
            $manager->persist($map);
            // add a ref to biome
            $this->addReference($map->getSlug(), $map);
            // echo
            echo $map->getName() . ' has been created succesfully !' . PHP_EOL;
        }

        $manager->flush();
        // echo end message
        echo 'End mapFixtures' . PHP_EOL;
    }

    public function getDependencies()
    {
        return [
            InteractionFixtures::class,
            AreaFixtures::class,
        ];
    }
}
