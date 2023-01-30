<?php

namespace App\DataFixtures;

use App\Entity\UserMedDiscipline;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class UserMedicalDisciplineFixtures extends Fixture implements DependentFixtureInterface
{
    public const USERMEDICALDISCIPLINE = [
        [
            'user_id' => '1',
            'medical_discipline_id' => '2',
        ],
        [
            'user_id' => '1',
            'medical_discipline_id' => '3',
        ],
        [
            'user_id' => '1',
            'medical_discipline_id' => '4',
        ],
        [
            'user_id' => '2',
            'medical_discipline_id' => '1',
        ],
        [
            'user_id' => '2',
            'medical_discipline_id' => '2',
        ],
        [
            'user_id' => '2',
            'medical_discipline_id' => '3',
        ],
        [
            'user_id' => '2',
            'medical_discipline_id' => '6',
        ],
        [
            'user_id' => '3',
            'medical_discipline_id' => '2',
        ],
        [
            'user_id' => '3',
            'medical_discipline_id' => '3',
        ],
        [
            'user_id' => '3',
            'medical_discipline_id' => '5',
        ],
        [
            'user_id' => '5',
            'medical_discipline_id' => '2',
        ],
        [
            'user_id' => '5',
            'medical_discipline_id' => '3',
        ],
        [
            'user_id' => '5',
            'medical_discipline_id' => '5',
        ],
        [
            'user_id' => '6',
            'medical_discipline_id' => '2',
        ],
        [
            'user_id' => '6',
            'medical_discipline_id' => '3',
        ],
        [
            'user_id' => '6',
            'medical_discipline_id' => '4',
        ],
        [
            'user_id' => '7',
            'medical_discipline_id' => '2',
        ],
        [
            'user_id' => '7',
            'medical_discipline_id' => '3',
        ],
        [
            'user_id' => '7',
            'medical_discipline_id' => '6',
        ],
        [
            'user_id' => '8',
            'medical_discipline_id' => '2',
        ],
        [
            'user_id' => '8',
            'medical_discipline_id' => '3',
        ],
        [
            'user_id' => '8',
            'medical_discipline_id' => '4',
        ],
    ];

    public function load(ObjectManager $manager): void
    {

        $faker = Factory::create();

        foreach (self::USERMEDICALDISCIPLINE as $values) {
            $userMedDiscipline = new UserMedDiscipline();
            $userMedDiscipline->setUser($this->getReference('user_' . $values['user_id']));
            $userMedDiscipline->setMedicalDiscipline(
                $this->getReference('medical_discipline_' . $values['medical_discipline_id'])
            );
            $userMedDiscipline->setIsChecked($faker->boolean());
            if ($userMedDiscipline->isIsChecked()) {
                $userMedDiscipline->setcheckedAt($faker->dateTimeBetween('2022-01-01', '2022-12-31'));
            }
            $manager->persist($userMedDiscipline);
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
