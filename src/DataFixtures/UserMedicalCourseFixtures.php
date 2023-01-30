<?php

namespace App\DataFixtures;

use App\Entity\UserMedicalCourse;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class UserMedicalCourseFixtures extends Fixture implements DependentFixtureInterface
{
    public const USERMEDICALCOURSE = [
        [
            'user_id' => '1',
            'medical_course_id' => '1',
        ],
        [
            'user_id' => '1',
            'medical_course_id' => '6',
        ],
        [
            'user_id' => '1',
            'medical_course_id' => '7',
        ],
        [
            'user_id' => '1',
            'medical_course_id' => '8',
        ],
        [
            'user_id' => '1',
            'medical_course_id' => '10',
        ],
        [
            'user_id' => '1',
            'medical_course_id' => '11',
        ],
        [
            'user_id' => '2',
            'medical_course_id' => '1',
        ],
        [
            'user_id' => '2',
            'medical_course_id' => '6',
        ],
        [
            'user_id' => '2',
            'medical_course_id' => '7',
        ],
        [
            'user_id' => '2',
            'medical_course_id' => '9',
        ],
        [
            'user_id' => '2',
            'medical_course_id' => '10',
        ],
        [
            'user_id' => '2',
            'medical_course_id' => '11',
        ],
        [
            'user_id' => '3',
            'medical_course_id' => '1',
        ],
        [
            'user_id' => '3',
            'medical_course_id' => '2',
        ],
        [
            'user_id' => '3',
            'medical_course_id' => '3',
        ],
        [
            'user_id' => '3',
            'medical_course_id' => '4',
        ],
        [
            'user_id' => '3',
            'medical_course_id' => '5',
        ],
        [
            'user_id' => '3',
            'medical_course_id' => '6',
        ],
        [
            'user_id' => '5',
            'medical_course_id' => '1',
        ],
        [
            'user_id' => '5',
            'medical_course_id' => '2',
        ],
        [
            'user_id' => '5',
            'medical_course_id' => '3',
        ],
        [
            'user_id' => '5',
            'medical_course_id' => '4',
        ],
        [
            'user_id' => '5',
            'medical_course_id' => '5',
        ],
        [
            'user_id' => '5',
            'medical_course_id' => '6',
        ],
        [
            'user_id' => '6',
            'medical_course_id' => '1',
        ],
        [
            'user_id' => '6',
            'medical_course_id' => '6',
        ],
        [
            'user_id' => '6',
            'medical_course_id' => '7',
        ],
        [
            'user_id' => '6',
            'medical_course_id' => '8',
        ],
        [
            'user_id' => '6',
            'medical_course_id' => '10',
        ],
        [
            'user_id' => '6',
            'medical_course_id' => '11',
        ],
        [
            'user_id' => '8',
            'medical_course_id' => '1',
        ],
        [
            'user_id' => '8',
            'medical_course_id' => '6',
        ],
        [
            'user_id' => '8',
            'medical_course_id' => '7',
        ],
        [
            'user_id' => '8',
            'medical_course_id' => '8',
        ],
        [
            'user_id' => '8',
            'medical_course_id' => '10',
        ],
        [
            'user_id' => '8',
            'medical_course_id' => '11',
        ],
        [
            'user_id' => '7',
            'medical_course_id' => '1',
        ],
        [
            'user_id' => '7',
            'medical_course_id' => '2',
        ],
        [
            'user_id' => '7',
            'medical_course_id' => '7',
        ],
    ];

    public function load(ObjectManager $manager): void
    {

        $faker = Factory::create();

        foreach (self::USERMEDICALCOURSE as $values) {
            $userMedicalCourse = new UserMedicalCourse();
            $userMedicalCourse->setUser($this->getReference('user_' . $values['user_id']));
            $userMedicalCourse->setMedicalCourse($this->getReference('medical_course_' . $values['medical_course_id']));
            $userMedicalCourse->setIsChecked($faker->boolean());
            if ($userMedicalCourse->isIsChecked()) {
                $userMedicalCourse->setcheckedAt($faker->dateTimeBetween('2022-01-01', '2022-12-31'));
            }
            $manager->persist($userMedicalCourse);
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
