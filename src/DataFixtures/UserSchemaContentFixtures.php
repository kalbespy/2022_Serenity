<?php

namespace App\DataFixtures;

use App\Entity\UserSchemaContent;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class UserSchemaContentFixtures extends Fixture implements DependentFixtureInterface
{
    public const USERSCHEMACONTENT = [
        [
            'user_id' => '1',
            'schema_content_id' => '11',
        ],
        [
            'user_id' => '1',
            'schema_content_id' => '12',
        ],
        [
            'user_id' => '1',
            'schema_content_id' => '13',
        ],
        [
            'user_id' => '1',
            'schema_content_id' => '14',
        ],
        [
            'user_id' => '1',
            'schema_content_id' => '15',
        ],
        [
            'user_id' => '2',
            'schema_content_id' => '6',
        ],
        [
            'user_id' => '2',
            'schema_content_id' => '7',
        ],
        [
            'user_id' => '2',
            'schema_content_id' => '8',
        ],
        [
            'user_id' => '2',
            'schema_content_id' => '9',
        ],
        [
            'user_id' => '2',
            'schema_content_id' => '10',
        ],
        [
            'user_id' => '3',
            'schema_content_id' => '1',
        ],
        [
            'user_id' => '3',
            'schema_content_id' => '2',
        ],
        [
            'user_id' => '3',
            'schema_content_id' => '3',
        ],
        [
            'user_id' => '3',
            'schema_content_id' => '4',
        ],
        [
            'user_id' => '3',
            'schema_content_id' => '5',
        ],
        [
            'user_id' => '5',
            'schema_content_id' => '1',
        ],
        [
            'user_id' => '5',
            'schema_content_id' => '2',
        ],
        [
            'user_id' => '5',
            'schema_content_id' => '3',
        ],
        [
            'user_id' => '5',
            'schema_content_id' => '4',
        ],
        [
            'user_id' => '5',
            'schema_content_id' => '5',
        ],
        [
            'user_id' => '6',
            'schema_content_id' => '11',
        ],
        [
            'user_id' => '6',
            'schema_content_id' => '12',
        ],
        [
            'user_id' => '6',
            'schema_content_id' => '13',
        ],
        [
            'user_id' => '6',
            'schema_content_id' => '14',
        ],
        [
            'user_id' => '6',
            'schema_content_id' => '15',
        ],
        [
            'user_id' => '7',
            'schema_content_id' => '6',
        ],
        [
            'user_id' => '7',
            'schema_content_id' => '7',
        ],
        [
            'user_id' => '7',
            'schema_content_id' => '8',
        ],
        [
            'user_id' => '7',
            'schema_content_id' => '9',
        ],
        [
            'user_id' => '7',
            'schema_content_id' => '10',
        ],
        [
            'user_id' => '8',
            'schema_content_id' => '11',
        ],
        [
            'user_id' => '8',
            'schema_content_id' => '12',
        ],
        [
            'user_id' => '8',
            'schema_content_id' => '13',
        ],
        [
            'user_id' => '8',
            'schema_content_id' => '14',
        ],
        [
            'user_id' => '8',
            'schema_content_id' => '15',
        ],
    ];

    public function load(ObjectManager $manager): void
    {

        $faker = Factory::create();

        foreach (self::USERSCHEMACONTENT as $values) {
            $userSchemaContent = new UserSchemaContent();
            $userSchemaContent->setUser($this->getReference('user_' . $values['user_id']));
            $userSchemaContent->setSchemaContent($this->getReference('schema_content_' . $values['schema_content_id']));
            $userSchemaContent->setIsChecked($faker->boolean());
            if ($userSchemaContent->isIsChecked()) {
                $userSchemaContent->setcheckedAt($faker->dateTimeBetween('2022-01-01', '2022-12-31'));
            }
            $manager->persist($userSchemaContent);
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
