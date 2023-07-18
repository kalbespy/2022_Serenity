<?php

namespace App\DataFixtures;

use App\Entity\Document;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class DocumentFixtures extends Fixture implements DependentFixtureInterface
{
    public const DOCUMENTS = [
        [
            'title' => 'Fiche administrative',
            'picture' => 'Document1.jpeg',
            'read_time' => 15,
            'description' => '',
            'category' => 'Finir les démarches administratives',
            'secretariat' => ['secretariat_maternité', 'secretariat_neurologie', 'secretariat_orthopédie']
        ],
        [
            'title' => 'Consentement éclairé',
            'picture' => 'Document2.jpeg',
            'read_time' => 15,
            'description' => '',
            'category' => 'Finir les démarches administratives',
            'secretariat' => ['secretariat_maternité', 'secretariat_neurologie', 'secretariat_orthopédie']
        ],
        [
            'title' => 'Votre retour mutuelle',
            'picture' => 'Document3.jpeg',
            'read_time' => 15,
            'description' => '',
            'category' => 'Finir les démarches administratives',
            'secretariat' => ['secretariat_maternité', 'secretariat_neurologie', 'secretariat_orthopédie']
        ],
        [
            'title' => 'Avez-vous vu votre anesthésiste ?',
            'picture' => 'Document4.jpeg',
            'read_time' =>  0,
            'description' => 'Prendre rendez-vous',
            'category' => 'Finir les démarches administratives',
            'secretariat' => ['secretariat_maternité', 'secretariat_neurologie', 'secretariat_orthopédie']
        ],
        [
            'title' => 'Avez-vous préparé votre valise de maternité ?',
            'picture' => 'Document-mater1.jpg',
            'read_time' =>  0,
            'description' => '',
            'category' => 'Finir les démarches administratives',
            'secretariat' => ['secretariat_maternité']
        ],
        [
            'title' => 'Avez-vous réalisé votre IRM ?',
            'picture' => 'Document-neuro1.jpeg',
            'read_time' =>  0,
            'description' => 'Prendre rendez-vous',
            'category' => 'Finir les démarches administratives',
            'secretariat' => ['secretariat_neurologie']
        ],
        [
            'title' => 'Avez-vous réalisé votre radio ?',
            'picture' => 'Document-ortho1.jpeg',
            'read_time' =>  0,
            'description' => 'Prendre rendez-vous',
            'category' => 'Finir les démarches administratives',
            'secretariat' => ['secretariat_orthopédie']
        ],
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::DOCUMENTS as $key => $values) {
            $document = new Document();
            $document->setTitle($values['title']);
            $document->setPicture($values['picture']);
            $document->setReadTime($values['read_time']);
            $document->setDescription($values['description']);
            $document->setCategory($this->getReference('category_' . $values['category']));
            foreach ($values['secretariat'] as $secretariat) {
                $document->addSecretariat($this->getReference($secretariat));
            }
            $manager->persist($document);
            $key++;
            $this->addReference('document_' . $key, $document);
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
