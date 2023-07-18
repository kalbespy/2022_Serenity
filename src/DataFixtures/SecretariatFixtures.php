<?php

namespace App\DataFixtures;

use App\Entity\Secretariat;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class SecretariatFixtures extends Fixture implements DependentFixtureInterface
{
    public const SECRETARIAT = [
        'maternité',
        'neurologie',
        'orthopédie',
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::SECRETARIAT as $secretariatName) {
            $secretariat = new Secretariat();
            $secretariat->setName($secretariatName);
            $manager->persist($secretariat);
            $this->addReference('secretariat_' . $secretariatName, $secretariat);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            CategoryFixtures::class,
        ];
    }
}
