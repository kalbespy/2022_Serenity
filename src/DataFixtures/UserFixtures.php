<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture implements DependentFixtureInterface
{
    public const USERS = [
        [
            'firstname' => 'Jean-Michel',
            'lastname' => 'Ladmin',
            'phonenumber' => '0652654300',
            'email' => 'jeanmichel@gmail.com',
            'role' => ['ROLE_USER'],
            'password' => 'jeanmichel1234+',
            'picture' => 'adminpicture.jpg',
            'secretariat' => 'secretariat_neurologie',
        ],
        [
            'firstname' => 'Ibrahim',
            'lastname' => 'Mohammed',
            'phonenumber' => '0636656565',
            'email' => 'ibrabra@gmail.com',
            'role' => ['ROLE_USER'],
            'password' => 'ibrabra1234+',
            'picture' => 'ibrabrapicture.jpeg',
            'secretariat' => 'secretariat_orthopédie',
        ],
        [
            'firstname' => 'Nina',
            'lastname' => 'Iacoponelli',
            'phonenumber' => '0612131415',
            'email' => 'nina@gmail.com',
            'role' => ['ROLE_USER'],
            'password' => 'nina1234+',
            'picture' => 'ninapicture.jpeg',
            'secretariat' => 'secretariat_maternité',
        ],
        [
            'firstname' => 'Admin',
            'lastname' => 'Admin',
            'phonenumber' => '0637489135',
            'email' => 'admin@chu-bordeaux.com',
            'role' => ['ROLE_ADMIN'],
            'password' => 'adminCHU1234+',
            'picture' => '',
            'secretariat' => 'secretariat_neurologie',
        ],
        [
            'firstname' => 'Chloé',
            'lastname' => 'Charrier',
            'phonenumber' => '0612569876',
            'email' => 'chloe@gmail.com',
            'role' => ['ROLE_USER'],
            'password' => 'cloclo1234+',
            'picture' => 'chloe.jpg',
            'secretariat' => 'secretariat_maternité',
        ],
        [
            'firstname' => 'Jacquie',
            'lastname' => 'Hérisson',
            'phonenumber' => '0798541243',
            'email' => 'jaky@gmail.com',
            'role' => ['ROLE_USER'],
            'password' => 'jaky1234+',
            'picture' => 'jaky.jpg',
            'secretariat' => 'secretariat_neurologie',
        ],
        [
            'firstname' => 'Martine',
            'lastname' => 'Boulet',
            'phonenumber' => '0723751200',
            'email' => 'martass@gmail.com',
            'role' => ['ROLE_USER'],
            'password' => 'martass1234+',
            'picture' => 'martine.jpg',
            'secretariat' => 'secretariat_orthopédie',
        ],
        [
            'firstname' => 'Fanny',
            'lastname' => 'Epi',
            'phonenumber' => '0612999456',
            'email' => 'fanny@gmail.com',
            'role' => ['ROLE_USER'],
            'password' => 'epiphanie1234+',
            'picture' => 'fanny.jpg',
            'secretariat' => 'secretariat_neurologie',
        ],
    ];

    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        foreach (self::USERS as $key => $values) {
            $user = new User();
            $user->setEmail($values['email']);
            $user->setRoles($values['role']);
            $user->setFirstname($values['firstname']);
            $user->setLastname($values['lastname']);
            $user->setPhonenumber($values['phonenumber']);
            $user->setPicture($values['picture']);
            $user->setSecretariat($this->getReference($values['secretariat']));
            $hash = $this->passwordHasher->hashPassword($user, $values['password']);
            $user->setPassword($hash);
            $manager->persist($user);
            $key++;
            $this->addReference('user_' . $key, $user);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            SecretariatFixtures::class,
        ];
    }
}
