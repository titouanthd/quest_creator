<?php

namespace App\DataFixtures;

use App\Entity\World;
use App\DataFixtures\UniverseFixtures;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class WorldFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        // echo start message
        echo "Loading WorldFixtures...".PHP_EOL;
        $date = new \DateTimeImmutable();
        $universe1 = $this->getReference('universe1');
        $world = new World();
        $world->setName('World 1');
        $world->setSlug('world-1');
        $world->setUniverse($universe1);
        $world->setCreatedAt($date);
        $world->setUpdatedAt($date);
        $manager->persist($world);
        $this->addReference('world1', $world);

        for ( $i = 2 ; $i <= 1000 ; $i++ ) {
            $random_universe_ref = $this->getReference('universe'.rand(1, 100));
            $world = new World();
            $world->setName('World '.$i);
            $world->setSlug('world-'.$i);
            $world->setUniverse($random_universe_ref);
            $world->setCreatedAt($date);
            $world->setUpdatedAt($date);
            $manager->persist($world);
            $this->addReference('world'.$i, $world);
            echo "World ".$i." created successfully!".PHP_EOL;
        }

        $manager->flush();
        // echo end message
        echo "WorldFixtures ended successfuly!".PHP_EOL;
    }

    // get dependencies
    public function getDependencies(): array
    {
        return [
            UniverseFixtures::class,
        ];
    }
}
