<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Universe;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class UniverseFixtures extends Fixture implements DependentFixtureInterface
{
    public $universes = [
        [
            "name" => "Universe 1",
            "slug" => "universe-1",
            "seed" => "123456789",
            "description" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed euismod, nisl vitae ultricies lacinia, nisl nisl aliquet nisl, eget ali",
        ],
        [
            "name" => "Universe 2",
            "slug" => "universe-2",
            "seed" => "987654321",
            "description" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed euismod, nisl vitae ultricies lacinia, nisl nisl aliquet nisl, eget ali",
        ]
    ];

    public function load(ObjectManager $manager): void
    {
        // echo start message
        echo 'Start universeFixtures' . PHP_EOL;
        $users = $manager->getRepository(User::class)->findAll();
        $datetime = new \DateTime('now');
        // foreach universe
        foreach ($this->universes as $u) {
            // create universe
            $new_universe = new Universe();
            $new_universe->setName($u['name']);
            $new_universe->setSlug($u['slug']);
            $new_universe->setSeed($u['seed']);
            $new_universe->setDescription($u['description']);
            // choose a random user
            $user = $users[rand(0, count($users) - 1)];
            $new_universe->setUser($user);
            $new_universe->setCreatedAt($datetime);
            $new_universe->setUpdatedAt($datetime);
            // persist
            $manager->persist($new_universe);
            // add a ref to universe
            $this->addReference($new_universe->getSlug(), $new_universe);
            // echo
            echo $new_universe->getName() . ' has been created succesfully !' . PHP_EOL;
        }
        $manager->flush();
        // echo end message
        echo 'End universeFixtures' . PHP_EOL;
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
        ];
    }
}
