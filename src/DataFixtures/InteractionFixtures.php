<?php

namespace App\DataFixtures;

use App\Entity\Interaction;
use App\Entity\InteractionType;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class InteractionFixtures extends Fixture implements DependentFixtureInterface
{
    public $interactions = [
        [
            "name" => "npc 1",
            "slug" => "npc-1",
        ],
        [
            "name" => "npc 2",
            "slug" => "npc-2",
        ]
    ];

    public function load(ObjectManager $manager): void
    {
        // echo start message
        echo 'Start interactionFixtures' . PHP_EOL;

        // get interactionTypes from db
        $interactionTypes = $manager->getRepository(InteractionType::class)->findAll();
        // count interactionTypes
        $countInteractionTypes = count($interactionTypes);
        echo 'count interactionTypes: ' . $countInteractionTypes . PHP_EOL;

        // foreach interaction
        foreach($this->interactions as $i) {
            $datetime = new \DateTime('now');
            // create interaction
            $new_interaction = new Interaction();
            $new_interaction->setName($i['name']);
            $new_interaction->setSlug($i['slug']);
            // choose a random interactionType
            $interactionType = $interactionTypes[rand(0, $countInteractionTypes - 1)];
            $new_interaction->setInteractionType($interactionType);
            $new_interaction->setCreatedAt($datetime);
            $new_interaction->setUpdatedAt($datetime);
            // persist
            $manager->persist($new_interaction);
            // add a ref to interaction
            $this->addReference($new_interaction->getSlug(), $new_interaction);
            // echo
            echo $new_interaction->getName() . ' has been created succesfully !' . PHP_EOL;
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            InteractionTypeFixtures::class,
        ];
    }
}
