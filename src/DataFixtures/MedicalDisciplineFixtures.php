<?php

namespace App\DataFixtures;

use App\Entity\MedicalDiscipline;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class MedicalDisciplineFixtures extends Fixture implements DependentFixtureInterface
{
    public const MEDICALDISCIPLINES = [
        [
            'name' => 'Kinésithérapeute',
            'category' => 'Anticiper ma sortie',
            'secretariat' => ['secretariat_orthopédie']
        ],
        [
            'name' => 'Infirmier',
            'category' => 'Anticiper ma sortie',
            'secretariat' => ['secretariat_orthopédie', 'secretariat_maternité', 'secretariat_neurologie']
        ],
        [
            'name' => 'Psychologue',
            'category' => 'Anticiper ma sortie',
            'secretariat' => ['secretariat_orthopédie', 'secretariat_maternité', 'secretariat_neurologie']
        ],
        [
            'name' => 'Neurologue',
            'category' => 'Anticiper ma sortie',
            'secretariat' => ['secretariat_neurologie']
        ],
        [
            'name' => 'Sage femme',
            'category' => 'Anticiper ma sortie',
            'secretariat' => ['secretariat_maternité']
        ],
        [
            'name' => 'Orthoprothésiste',
            'category' => 'Anticiper ma sortie',
            'secretariat' => ['secretariat_orthopédie']
        ],
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::MEDICALDISCIPLINES as $key => $values) {
            $medicalDiscipline = new MedicalDiscipline();
            $medicalDiscipline->setName($values['name']);
            $medicalDiscipline->setCategory($this->getReference('category_' . $values['category']));
            foreach ($values['secretariat'] as $secretariat) {
                $medicalDiscipline->addSecretariat($this->getReference($secretariat));
            }
            $manager->persist($medicalDiscipline);
            $key++;
            $this->addReference('medical_discipline_' . $key, $medicalDiscipline);
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
