<?php

namespace App\DataFixtures;

use App\Entity\Biome;
use App\DataFixtures\WorldFixtures;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class BiomeFixtures extends Fixture implements DependentFixtureInterface
{
    public $biomes = [
        'Arctic',
        'Desert',
        'Forest',
        'Grassland',
        'Jungle',
        'Mountain',
        'Ocean',
        'Plains',
        'Rainforest',
        'Swamp',
        'Tundra',
        'Wasteland',
    ];

    public function load(ObjectManager $manager): void
    {
        echo "Loading BiomeFixtures...".PHP_EOL;
        for ($i = 1; $i <= 1000; $i++) {
            $world_ref = $this->getReference('world'.$i);
            $loop = 0;
            foreach ($this->biomes as $b) {
                $loop++;
                $date = new \DateTime('now');
                $biome = new Biome();
                $biome->setName($b);
                $slug = strtolower($b);
                $biome->setColor('#000000');
                $biome->setWorld($world_ref);
                $biome->setCreatedAt($date);
                $biome->setUpdatedAt($date);
                $manager->persist($biome);
                $this->addReference('world'.$i.'_biome'.$loop, $biome);
                echo "Biome ".$biome->getName()." for world ".$world_ref->getName()." created successfully!".PHP_EOL;
            }
        }
        $manager->flush();
        echo "BiomeFixtures ended successfuly!".PHP_EOL;
    }

    public function getDependencies(): array
    {
        return [
            WorldFixtures::class,
        ];
    }
}
