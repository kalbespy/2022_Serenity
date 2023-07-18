<?php

namespace App\DataFixtures;

use App\Entity\Checklist;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ChecklistFixtures extends Fixture implements DependentFixtureInterface
{
    public const CHECKLISTS = [
        [
            'name' => 'Pièce d\'identité',
            'description' => "Obligatoire",
            'category' => 'Ma check-list avant le départ à la clinique',
            'secretariat' => ['secretariat_maternité', 'secretariat_neurologie', 'secretariat_orthopédie']
        ],
        [
            'name' => 'Consultation anesthésique',
            'description' => "Obligatoire",
            'category' => 'Ma check-list avant le départ à la clinique',
            'secretariat' => ['secretariat_maternité', 'secretariat_neurologie', 'secretariat_orthopédie']
        ],
        [
            'name' => 'Test COVID',
            'description' => "Datant de moins de 3 jours",
            'category' => 'Ma check-list avant le départ à la clinique',
            'secretariat' => ['secretariat_maternité', 'secretariat_neurologie', 'secretariat_orthopédie']
        ],
        [
            'name' => 'Carte bleue',
            'description' => "Facultatif",
            'category' => 'Ma check-list avant le départ à la clinique',
            'secretariat' => ['secretariat_maternité', 'secretariat_neurologie', 'secretariat_orthopédie']
        ],
        [
            'name' => 'Carte de mutuelle',
            'description' => "Facultatif",
            'category' => 'Ma check-list avant le départ à la clinique',
            'secretariat' => ['secretariat_maternité', 'secretariat_neurologie', 'secretariat_orthopédie']
        ],
        [
            'name' => 'Valise de maternité',
            'description' => "Obligatoire",
            'category' => 'Ma check-list avant le départ à la clinique',
            'secretariat' => ['secretariat_maternité']
        ],
        [
            'name' => 'Résultats analyses RAI',
            'description' => "Obligatoire",
            'category' => 'Ma check-list avant le départ à la clinique',
            'secretariat' => ['secretariat_maternité']
        ],
        [
            'name' => 'Résultats analyse sérologie',
            'description' => "Obligatoire",
            'category' => 'Ma check-list avant le départ à la clinique',
            'secretariat' => ['secretariat_maternité']
        ],
        [
            'name' => 'Résultats IRM',
            'description' => "Obligatoire",
            'category' => 'Ma check-list avant le départ à la clinique',
            'secretariat' => ['secretariat_neurologie']
        ],
        [
            'name' => 'Bilan pré-opératoire',
            'description' => "Obligatoire",
            'category' => 'Ma check-list avant le départ à la clinique',
            'secretariat' => ['secretariat_neurologie', 'secretariat_orthopédie']
        ],
        [
            'name' => 'Résultats scinthigraphie osseuse',
            'description' => "Obligatoire",
            'category' => 'Ma check-list avant le départ à la clinique',
            'secretariat' => ['secretariat_orthopédie']
        ],
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::CHECKLISTS as $key => $values) {
            $checklist = new Checklist();
            $checklist->setName($values['name']);
            $checklist->setDescription($values['description']);
            $checklist->setCategory($this->getReference('category_' . $values['category']));
            foreach ($values['secretariat'] as $secretariat) {
                $checklist->addSecretariat($this->getReference($secretariat));
            }
            $manager->persist($checklist);
            $key++;
            $this->addReference('checklist_' . $key, $checklist);
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
