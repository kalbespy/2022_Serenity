<?php

namespace App\DataFixtures;

use App\Entity\UserVideo;
use App\Entity\Video;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class UserVideoFixtures extends Fixture implements DependentFixtureInterface
{
    public const USERVIDEO = [
        [
            'user_id' => '1',
            'video_id' => '7',
        ],
        [
            'user_id' => '1',
            'video_id' => '8',
        ],
        [
            'user_id' => '1',
            'video_id' => '9',
        ],
        [
            'user_id' => '2',
            'video_id' => '4',
        ],
        [
            'user_id' => '2',
            'video_id' => '5',
        ],
        [
            'user_id' => '2',
            'video_id' => '6',
        ],
        [
            'user_id' => '3',
            'video_id' => '1',
        ],
        [
            'user_id' => '3',
            'video_id' => '2',
        ],
        [
            'user_id' => '3',
            'video_id' => '3',
        ],
        [
            'user_id' => '5',
            'video_id' => '1',
        ],
        [
            'user_id' => '5',
            'video_id' => '2',
        ],
        [
            'user_id' => '5',
            'video_id' => '3',
        ],
        [
            'user_id' => '6',
            'video_id' => '7',
        ],
        [
            'user_id' => '6',
            'video_id' => '8',
        ],
        [
            'user_id' => '6',
            'video_id' => '9',
        ],
        [
            'user_id' => '7',
            'video_id' => '4',
        ],
        [
            'user_id' => '7',
            'video_id' => '5',
        ],
        [
            'user_id' => '7',
            'video_id' => '6',
        ],
        [
            'user_id' => '8',
            'video_id' => '7',
        ],
        [
            'user_id' => '8',
            'video_id' => '8',
        ],
        [
            'user_id' => '8',
            'video_id' => '9',
        ],

    ];

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        foreach (self::USERVIDEO as $values) {
            $userVideo = new UserVideo();
            $userVideo->setUser($this->getReference('user_' . $values['user_id']));
            $userVideo->setVideo($this->getReference('video_' . $values['video_id']));
            $userVideo->setIsChecked($faker->boolean());
            if ($userVideo->isIsChecked()) {
                $userVideo->setcheckedAt($faker->dateTimeBetween('2022-01-01', '2022-12-31'));
            }
            $manager->persist($userVideo);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
            VideoFixtures::class,
        ];
    }
}
