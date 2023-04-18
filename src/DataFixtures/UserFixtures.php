<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }
    
    public function load(ObjectManager $manager): void
    {
        // echo start fixture message
        echo 'Loading UserFixtures...'.PHP_EOL;

        $admin = new User();
        $admin->setEmail('titou@admin.local');
        $admin->setUsername('Titou');
        $password = $this->hasher->hashPassword($admin, '0000');
        $admin->setPassword($password);
        $role = ['ROLE_ADMIN'];
        $admin->setRoles($role);
        $date = new \DateTimeImmutable();
        $admin->setCreatedAt($date);
        $admin->setUpdatedAt($date);
        $admin->setAvatarUrl('https://picsum.photos/150/150');

        // persist the user
        $manager->persist($admin);
        // add ref
        $this->addReference('admin', $admin);
        // echo success message
        echo 'Admin user created successfully!'.PHP_EOL;

        // same but for user
        for ($i = 1; $i <= 50; $i++) {
            $user = new User();
            $user->setEmail('user'.$i.'@gmail.com');
            $user->setUsername('User'.$i);
            $password = $this->hasher->hashPassword($user, '0000');
            $user->setPassword($password);
            $role = ['ROLE_USER'];
            $user->setRoles($role);
            $date = new \DateTimeImmutable();
            $user->setCreatedAt($date);
            $user->setUpdatedAt($date);
            // set avatar url
            $user->setAvatarUrl('https://randomuser.me/api/portraits/lego/'.$i.'.jpg');
            $manager->persist($user);
            $this->addReference('user'.$i, $user);
            echo 'User '.$i.' created successfully!'.PHP_EOL;
        }

        $manager->flush();
        // echo end fixture message
        echo "UserFixtures ended successfuly!".PHP_EOL;
    }
}
