<?php

namespace App\DataFixtures;

use App\Entity\UserChecklist;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class UserChecklistFixtures extends Fixture implements DependentFixtureInterface
{
    public const USERCHECKLIST = [
        [
            'user_id' => '1',
            'checklist_id' => '1',
        ],
        [
            'user_id' => '1',
            'checklist_id' => '2',
        ],
        [
            'user_id' => '1',
            'checklist_id' => '3',
        ],
        [
            'user_id' => '1',
            'checklist_id' => '4',
        ],
        [
            'user_id' => '1',
            'checklist_id' => '5',
        ],
        [
            'user_id' => '1',
            'checklist_id' => '9',
        ],
        [
            'user_id' => '1',
            'checklist_id' => '10',
        ],
        [
            'user_id' => '2',
            'checklist_id' => '1',
        ],
        [
            'user_id' => '2',
            'checklist_id' => '2',
        ],
        [
            'user_id' => '2',
            'checklist_id' => '3',
        ],
        [
            'user_id' => '2',
            'checklist_id' => '4',
        ],
        [
            'user_id' => '2',
            'checklist_id' => '5',
        ],
        [
            'user_id' => '2',
            'checklist_id' => '10',
        ],
        [
            'user_id' => '2',
            'checklist_id' => '11',
        ],
        [
            'user_id' => '3',
            'checklist_id' => '1',
        ],
        [
            'user_id' => '3',
            'checklist_id' => '2',
        ],
        [
            'user_id' => '3',
            'checklist_id' => '3',
        ],
        [
            'user_id' => '3',
            'checklist_id' => '4',
        ],
        [
            'user_id' => '3',
            'checklist_id' => '5',
        ],
        [
            'user_id' => '3',
            'checklist_id' => '6',
        ],
        [
            'user_id' => '3',
            'checklist_id' => '7',
        ],
        [
            'user_id' => '3',
            'checklist_id' => '8',
        ],
        [
            'user_id' => '6',
            'checklist_id' => '1',
        ],
        [
            'user_id' => '6',
            'checklist_id' => '2',
        ],
        [
            'user_id' => '6',
            'checklist_id' => '3',
        ],
        [
            'user_id' => '6',
            'checklist_id' => '4',
        ],
        [
            'user_id' => '6',
            'checklist_id' => '5',
        ],
        [
            'user_id' => '6',
            'checklist_id' => '9',
        ],
        [
            'user_id' => '6',
            'checklist_id' => '10',
        ],
        [
            'user_id' => '5',
            'checklist_id' => '1',
        ],
        [
            'user_id' => '5',
            'checklist_id' => '2',
        ],
        [
            'user_id' => '5',
            'checklist_id' => '3',
        ],
        [
            'user_id' => '5',
            'checklist_id' => '4',
        ],
        [
            'user_id' => '5',
            'checklist_id' => '5',
        ],
        [
            'user_id' => '5',
            'checklist_id' => '6',
        ],
        [
            'user_id' => '5',
            'checklist_id' => '7',
        ],
        [
            'user_id' => '5',
            'checklist_id' => '8',
        ],
        [
            'user_id' => '7',
            'checklist_id' => '1',
        ],
        [
            'user_id' => '7',
            'checklist_id' => '2',
        ],
        [
            'user_id' => '7',
            'checklist_id' => '4',
        ],
        [
            'user_id' => '7',
            'checklist_id' => '6',
        ],
        [
            'user_id' => '7',
            'checklist_id' => '7',
        ],
        [
            'user_id' => '8',
            'checklist_id' => '8',
        ],
        [
            'user_id' => '8',
            'checklist_id' => '1',
        ],
        [
            'user_id' => '8',
            'checklist_id' => '2',
        ],
        [
            'user_id' => '8',
            'checklist_id' => '3',
        ],
        [
            'user_id' => '8',
            'checklist_id' => '4',
        ],
        [
            'user_id' => '8',
            'checklist_id' => '5',
        ],
        [
            'user_id' => '8',
            'checklist_id' => '6',
        ],
        [
            'user_id' => '8',
            'checklist_id' => '7',
        ],
        [
            'user_id' => '8',
            'checklist_id' => '8',
        ],

    ];

    public function load(ObjectManager $manager): void
    {

        $faker = Factory::create();

        foreach (self::USERCHECKLIST as $values) {
            $userChecklist = new UserChecklist();
            $userChecklist->setUser($this->getReference('user_' . $values['user_id']));
            $userChecklist->setChecklist($this->getReference('checklist_' . $values['checklist_id']));
            $userChecklist->setIsChecked($faker->boolean());
            if ($userChecklist->isIsChecked()) {
                $userChecklist->setcheckedAt($faker->dateTimeBetween('2022-01-01', '2022-12-31'));
            }
            $manager->persist($userChecklist);
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
