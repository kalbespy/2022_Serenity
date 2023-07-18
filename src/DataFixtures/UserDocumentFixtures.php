<?php

namespace App\DataFixtures;

use App\Entity\UserDocument;
use DateTime;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class UserDocumentFixtures extends Fixture implements DependentFixtureInterface
{
    public const USERDOCUMENT = [
        [
            'user_id' => '1',
            'document_id' => '1',
        ],
        [
            'user_id' => '1',
            'document_id' => '2',
        ],
        [
            'user_id' => '1',
            'document_id' => '3',
        ],
        [
            'user_id' => '1',
            'document_id' => '4',
        ],
        [
            'user_id' => '1',
            'document_id' => '6',
        ],
        [
            'user_id' => '2',
            'document_id' => '1',
        ],
        [
            'user_id' => '2',
            'document_id' => '2',
        ],
        [
            'user_id' => '2',
            'document_id' => '3',
        ],
        [
            'user_id' => '2',
            'document_id' => '4',
        ],
        [
            'user_id' => '2',
            'document_id' => '7',
        ],
        [
            'user_id' => '3',
            'document_id' => '1',
        ],
        [
            'user_id' => '3',
            'document_id' => '2',
        ],
        [
            'user_id' => '3',
            'document_id' => '3',
        ],
        [
            'user_id' => '3',
            'document_id' => '4',
        ],
        [
            'user_id' => '3',
            'document_id' => '5',
        ],
        [
            'user_id' => '5',
            'document_id' => '1',
        ],
        [
            'user_id' => '5',
            'document_id' => '2',
        ],
        [
            'user_id' => '5',
            'document_id' => '3',
        ],
        [
            'user_id' => '5',
            'document_id' => '4',
        ],
        [
            'user_id' => '6',
            'document_id' => '5',
        ],
        [
            'user_id' => '6',
            'document_id' => '1',
        ],
        [
            'user_id' => '6',
            'document_id' => '2',
        ],
        [
            'user_id' => '6',
            'document_id' => '3',
        ],
        [
            'user_id' => '7',
            'document_id' => '1',
        ],
        [
            'user_id' => '7',
            'document_id' => '2',
        ],
        [
            'user_id' => '7',
            'document_id' => '3',
        ],
        [
            'user_id' => '8',
            'document_id' => '4',
        ],
        [
            'user_id' => '8',
            'document_id' => '1',
        ],
        [
            'user_id' => '8',
            'document_id' => '2',
        ],
        [
            'user_id' => '8',
            'document_id' => '3',
        ],
    ];

    public function load(ObjectManager $manager): void
    {

        $faker = Factory::create();

        foreach (self::USERDOCUMENT as $values) {
            $userDocument = new UserDocument();
            $userDocument->setUser($this->getReference('user_' . $values['user_id']));
            $userDocument->setDocument($this->getReference('document_' . $values['document_id']));
            $userDocument->setIsChecked($faker->boolean());
            if ($userDocument->isIsChecked()) {
                $userDocument->setcheckedAt($faker->dateTimeBetween('2022-01-01', '2022-12-31'));
            }
            $manager->persist($userDocument);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
        ];
    }
}
