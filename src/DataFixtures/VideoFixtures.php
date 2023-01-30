<?php

namespace App\DataFixtures;

use App\Entity\Video;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class VideoFixtures extends Fixture implements DependentFixtureInterface
{
    public const VIDEOS = [
        [
            'title' => "L'ACCOUCHEMENT",
            'picture' => 'https://www.youtube.com/embed/NM2KJA8uSuc',
            'duration' => 6,
            'category' => 'Comprendre mon opération',
            'secretariat' => ['secretariat_maternité']

        ],
        [
            'title' => "ACCOUCHER SANS PÉRIDURALE",
            'picture' => 'https://www.youtube.com/embed/fe7S_-QoI6o',
            'duration' => 18,
            'category' => 'Comprendre mon opération',
            'secretariat' => ['secretariat_maternité']

        ],
        [
            'title' => "LES SUITES DE COUCHES",
            'picture' => 'https://www.youtube.com/embed/rroZ9Tn4Oa8',
            'duration' => 26,
            'category' => 'Comprendre mon opération',
            'secretariat' => ['secretariat_maternité']

        ],
        [
            'title' => 'PROTHÈSE DU PIED',
            'picture' => 'https://www.youtube.com/embed/Su2-oVbP8qU',
            'duration' => 4,
            'category' => 'Comprendre mon opération',
            'secretariat' => ['secretariat_orthopédie']
        ],
        [
            'title' => 'CHIRURGIE ORTHOPÉDIQUE ÉPAULE',
            'picture' => 'https://www.youtube.com/embed/g0ANw4IRrlU',
            'duration' => 3,
            'category' => 'Comprendre mon opération',
            'secretariat' => ['secretariat_orthopédie']
        ],
        [
            'title' => 'RÉPARATION D\'UNE RUPTURE DE LA COIFFE',
            'picture' => 'https://www.youtube.com/embed/RuPP_ilhndY',
            'duration' => 3,
            'category' => 'Comprendre mon opération',
            'secretariat' => ['secretariat_orthopédie']
        ],
        [
            'title' => 'LA NEUROCHIRURGIE',
            'picture' => 'https://www.youtube.com/embed/hXFBWXuZIdo',
            'duration' => 3,
            'category' => 'Comprendre mon opération',
            'secretariat' => ['secretariat_neurologie']
        ],
        [
            'title' => 'SCLÉROSE EN PLAQUES',
            'picture' => 'https://www.youtube.com/embed/muIoiyebzBA',
            'duration' => 7,
            'category' => 'Comprendre mon opération',
            'secretariat' => ['secretariat_neurologie']
        ],
        [
            'title' => 'DÉPRESSION ET PERTES DE NEURONES',
            'picture' => 'https://www.youtube.com/embed/vCavRhuxlTg',
            'duration' => 6,
            'category' => 'Comprendre mon opération',
            'secretariat' => ['secretariat_neurologie']
        ]
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::VIDEOS as $key => $values) {
            $video = new Video();
            $video->settitle($values['title']);
            $video->setPicture($values['picture']);
            $video->setDuration($values['duration']);
            $video->setCategory($this->getReference('category_' . $values['category']));
            foreach ($values['secretariat'] as $secretariat) {
                $video->addSecretariat($this->getReference($secretariat));
            }
            $manager->persist($video);
            $key++;
            $this->addReference('video_' . $key, $video);
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
