<?php

namespace App\DataFixtures;

use App\Entity\SchemaContent;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class SchemaFixtures extends Fixture implements DependentFixtureInterface
{
    public const SCHEMACONTENT = [
        [
            'picture' => 'Schema-mater1.jpeg',
            'category' => 'Comprendre mon opération',
            'title' => 'Césarienne',
            'secretariat' => ['secretariat_maternité']
        ],
        [
            'picture' => 'Schema-mater2.jpeg',
            'category' => 'Comprendre mon opération',
            'title' => 'Croissance in utero',
            'secretariat' => ['secretariat_maternité']
        ],
        [
            'picture' => 'Schema-mater3.jpeg',
            'category' => 'Comprendre mon opération',
            'title' => 'Anatomie',
            'secretariat' => ['secretariat_maternité']
        ],
        [
            'picture' => 'Schema-mater4.jpeg',
            'category' => 'Comprendre mon opération',
            'title' => 'Yoga prénatal',
            'secretariat' => ['secretariat_maternité']
        ],
        [
            'picture' => 'Schema-mater5.jpeg',
            'category' => 'Comprendre mon opération',
            'title' => 'Anesthésie Péridurale',
            'secretariat' => ['secretariat_maternité']
        ],
        [
            'picture' => 'Schema-ortho1.jpeg',
            'category' => 'Comprendre mon opération',
            'title' => 'Examen orthopédique',
            'secretariat' => ['secretariat_orthopédie']
        ],
        [
            'picture' => 'Schema-ortho2.jpeg',
            'category' => 'Comprendre mon opération',
            'title' => 'Utiliser une béquille orthopédique',
            'secretariat' => ['secretariat_orthopédie']
        ],
        [
            'picture' => 'Schema-ortho3.jpeg',
            'category' => 'Comprendre mon opération',
            'title' => 'Rééducation post-op',
            'secretariat' => ['secretariat_orthopédie']
        ],
        [
            'picture' => 'Schema-ortho4.jpg',
            'category' => 'Comprendre mon opération',
            'title' => 'Kinésithérapie des membres inférieurs',
            'secretariat' => ['secretariat_orthopédie']
        ],
        [
            'picture' => 'Schema-ortho5.jpeg',
            'category' => 'Comprendre mon opération',
            'title' => 'Rester mobile',
            'secretariat' => ['secretariat_orthopédie']
        ],
        [
            'picture' => 'Schema-neuro1.jpeg',
            'category' => 'Comprendre mon opération',
            'title' => 'Comprendre votre cerveau',
            'secretariat' => ['secretariat_neurologie']
        ],
        [
            'picture' => 'Schema-neuro2.jpeg',
            'category' => 'Comprendre mon opération',
            'title' => 'Les nouvelles procédures',
            'secretariat' => ['secretariat_neurologie']
        ],
        [
            'picture' => 'Schema-neuro3.jpeg',
            'category' => 'Comprendre mon opération',
            'title' => 'Examens Neurologiques',
            'secretariat' => ['secretariat_neurologie']
        ],
        [
            'picture' => 'Schema-neuro4.jpeg',
            'category' => 'Comprendre mon opération',
            'title' => 'IRM Cérébrale',
            'secretariat' => ['secretariat_neurologie']
        ],
        [
            'picture' => 'Schema-neuro5.jpeg',
            'category' => 'Comprendre mon opération',
            'title' => 'Pathologies Cérébrales',
            'secretariat' => ['secretariat_neurologie']
        ],
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::SCHEMACONTENT as $key => $values) {
            $schemaContent = new SchemaContent();
            $schemaContent->setPicture($values['picture']);
            $schemaContent->setTitle($values['title']);
            $schemaContent->setCategory($this->getReference('category_' . $values['category']));
            foreach ($values['secretariat'] as $secretariat) {
                $schemaContent->addSecretariat($this->getReference($secretariat));
            }
            $manager->persist($schemaContent);
            $key++;
            $this->addReference('schema_content_' . $key, $schemaContent);
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
