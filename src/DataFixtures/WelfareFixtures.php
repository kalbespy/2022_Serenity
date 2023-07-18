<?php

namespace App\DataFixtures;

use App\Entity\Welfare;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class WelfareFixtures extends Fixture implements DependentFixtureInterface
{
    public const WELFARES = [
        [
            '2023-01-12',
            '2023-01-15',
            '2023-01-17',
            '2023-01-20',
            '2023-01-22',
            '2023-01-24',
            '2023-01-28',
            '2023-02-03',
            '2023-02-04',
            '2023-02-01',
        ],
        [
            '2023-01-12',
            '2023-01-16',
            '2023-01-19',
            '2023-01-22',
            '2023-01-24',
            '2023-01-26',
            '2023-02-01',
            '2023-02-03',
            '2023-02-05',
            '2023-02-02',
        ],
        [
            '2023-01-13',
            '2023-01-17',
            '2023-01-19',
            '2023-01-22',
            '2023-01-25',
            '2023-01-29',
            '2023-02-01',
            '2023-02-04',
            '2023-02-03',
            '2023-02-02',
        ],
        [
            '2023-01-17',
            '2023-01-20',
            '2023-01-24',
            '2023-01-26',
            '2023-02-01',
            '2023-02-03',
            '2023-02-07',
            '2023-02-09',
            '2023-01-07',
            '2023-01-19',
        ],
        [
            '2023-01-10',
            '2023-01-13',
            '2023-01-16',
            '2023-01-19',
            '2023-01-22',
            '2023-01-25',
            '2023-01-06',
            '2023-02-07',
            '2023-02-08',
            '2023-02-09',
        ],
        [
            '2023-01-30',
            '2023-02-01',
            '2023-02-02',
            '2023-02-03',
            '2023-02-04',
            '2023-02-05',
            '2023-02-06',
            '2023-02-07',
            '2023-02-08',
            '2023-02-09',
        ],
        [
            '2023-01-17',
            '2023-01-19',
            '2023-01-22',
            '2023-01-27',
            '2023-01-29',
            '2023-02-01',
            '2023-02-06',
            '2023-02-07',
            '2023-02-08',
            '2023-02-09',
        ],
        [
            '2023-01-12',
            '2023-01-15',
            '2023-01-17',
            '2023-01-20',
            '2023-01-22',
            '2023-01-24',
            '2023-01-28',
            '2023-02-03',
            '2023-02-04',
            '2023-02-07',
        ],
    ];

    public function load(ObjectManager $manager): void
    {


        $faker = Factory::create();
        for ($i = 0; $i < 8; $i++) {
            for ($j = 0; $j < 10; $j++) {
                $welfare = new Welfare();
                $welfare->setResponseAt(\DateTimeImmutable::createFromFormat('Y-m-d', self::WELFARES[$i][$j]));
                $randomScore = $faker->numberBetween(1, 4);
                $welfare->setScore($randomScore);
                $userNb = $i + 1;
                $welfare->setUser($this->getReference('user_' . $userNb));
                if ($randomScore == 1) {
                    $welfare->setIsCallBack(false);
                } else {
                    $welfare->setIsCallBack(true);
                }


                $manager->persist($welfare);
            }
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
