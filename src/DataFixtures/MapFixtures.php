<?php

namespace App\DataFixtures;

use App\Entity\Map;
use App\DataFixtures\WorldFixtures;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class MapFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        // echo start message
        echo "Loading MapFixtures...".PHP_EOL;
        $date = new \DateTimeImmutable();
        $random_world_ref = $this->getReference('world'.rand(1, 1000));
        $map = new Map();
        $map->setName('Map 1');
        $map->setSlug('map-1');
        $map->setWidth(rand(100, 1000));
        $map->setHeight(rand(100, 1000));
        $map->setSize('small');
        $map->setCreatedAt($date);
        $map->setUpdatedAt($date);
        $map->setWorld($this->getReference('world1'));
        $manager->persist($map);
        $this->addReference('map1', $map);
        echo "Map 1 created successfully!".PHP_EOL;
        for ( $i = 2 ; $i <= 1000 ; $i++ ) {
            $map = new Map();
            $map->setName('Map '.$i);
            $map->setSlug('map-'.$i);
            $map->setWidth(rand(100, 1000));
            $map->setHeight(rand(100, 1000));
            $map->setCreatedAt($date);
            $map->setUpdatedAt($date);
            $map->setSize('small');
            $map->setWorld($random_world_ref);
            $manager->persist($map);
            $this->addReference('map'.$i, $map);
            echo "Map ".$i." created successfully!".PHP_EOL;
        }
        $manager->flush();
        // echo end message
        echo "MapFixtures ended successfuly!".PHP_EOL;
    }

    // get dependencies
    public function getDependencies(): array
    {
        return [
            WorldFixtures::class,
        ];
    }
}
