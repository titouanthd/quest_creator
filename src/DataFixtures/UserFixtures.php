<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private $hasher;

    public function  __construct( UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager): void
    {
        echo 'Start userFixtures' . PHP_EOL;
        $admins = [
            [
                "email" => "titouan.thd@gmail.com",
                "password" => 0000,
                "username" => "titouanthd",
            ]
        ];

        foreach( $admins as $admin ) {
            $adm = new User();
            $adm->setEmail($admin['email']);
            $adm->setUsername($admin['username']);
            $password = $this->hasher->hashPassword($adm, '0000');
            $adm->setPassword($password);
            $createdAt = new \DateTime('now');
            $adm->setCreatedAt($createdAt);
            $adm->setUpdatedAt($createdAt);
            $adm->setLastConnect($createdAt);
            $roles = ['ROLE_ADMIN'];
            $adm->setRoles($roles);
            $manager->persist($adm);
            // add a ref to user
            $this->addReference($adm->getUsername(), $adm);
            // echo 
            echo $adm->getUsername() . ' has been created succesfully !' . PHP_EOL;
        }

        $count_user_to_create = 3;
        for ($i = 1; $i <= $count_user_to_create; $i++) {
            $user = new User();
            // set user fields (email, username, password, created_at, updated_at, roles, last_connect)
            $user->setEmail('user.' . $i . '@gmail.com');
            $user->setUsername('user'.$i);
            $password = $this->hasher->hashPassword($user, '0000');
            $user->setPassword($password);
            $createdAt = new \DateTime('now');
            $user->setCreatedAt($createdAt);
            $user->setUpdatedAt($createdAt);
            $user->setLastConnect($createdAt);
            $roles = ['ROLE_USER'];
            $user->setRoles($roles);
            $manager->persist($user);
            // add a ref to user
            $this->addReference($user->getUsername(), $user);
            // echo 
            echo $user->getUsername() . ' has been created succesfully !' . PHP_EOL;
        }

        $manager->flush();
        echo 'End userFixtures';
    }
}
