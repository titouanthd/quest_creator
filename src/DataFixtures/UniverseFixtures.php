<?php

namespace App\DataFixtures;

use App\Entity\Universe;
use App\DataFixtures\UserFixtures;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class UniverseFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        // echo start fixture message
        echo 'Loading UniverseFixtures...'.PHP_EOL;
        $admin_ref = $this->getReference('admin');
        $date = new \DateTime();
        for ( $i = 1 ; $i <= 100 ; $i++ ) {
            // for the first 2 universes, set the author to the admin
            if ( $i < 3 ) {
                $universe = new Universe();
                $universe->setName('Universe '.$i);
                $universe->setAuthor($admin_ref);
                $universe->setCreatedAt($date);
                $universe->setUpdatedAt($date);
                $manager->persist($universe);
                $this->addReference('universe'.$i, $universe);
                echo 'Universe '.$i.' created successfully!'.PHP_EOL;
            } else {
                $random_user_ref = $this->getReference('user'.rand(1, 50));
                $universe = new Universe();
                $universe->setName('Universe '.$i);
                $universe->setCreatedAt($date);
                $universe->setUpdatedAt($date);
                $universe->setAuthor($random_user_ref);
                $manager->persist($universe);
                $this->addReference('universe'.$i, $universe);
                echo 'Universe '.$i.' created successfully!'.PHP_EOL;
            }
        }
        $manager->flush();
        // echo success message
        echo 'UniverseFixtures ended successfully!'.PHP_EOL;
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
        ];
    }
}
