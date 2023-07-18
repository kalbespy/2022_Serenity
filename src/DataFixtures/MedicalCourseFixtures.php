<?php

namespace App\DataFixtures;

use App\Entity\MedicalCourse;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class MedicalCourseFixtures extends Fixture implements DependentFixtureInterface
{
    public const MEDICALCOURSES = [
        [
            'step' => 1,
            'title' => 'Prise en charge administrative',
            'picture' => 'MedicalCourse1.png',
            'category' => 'Préparer mon arrivée en toute sérénité',
            'secretariat' => ['secretariat_maternité', 'secretariat_neurologie', 'secretariat_orthopédie']
        ],
        [
            'step' => 2,
            'title' => 'Installation en chambre',
            'picture' => 'MedicalCourse-mater1.jpg',
            'category' => 'Préparer mon arrivée en toute sérénité',
            'secretariat' => ['secretariat_maternité']
        ],
        [
            'step' => 3,
            'title' => 'Phase de travail',
            'picture' => 'MedicalCourse-mater3.jpg',
            'category' => 'Préparer mon arrivée en toute sérénité',
            'secretariat' => ['secretariat_maternité']
        ],
        [
            'step' => 4,
            'title' => 'Pose de la péridurale',
            'picture' => 'MedicalCourse-mater2.jpeg',
            'category' => 'Préparer mon arrivée en toute sérénité',
            'secretariat' => ['secretariat_maternité']
        ],
        [
            'step' => 5,
            'title' => 'Accouchement',
            'picture' => 'MedicalCourse-mater4.jpg',
            'category' => 'Préparer mon arrivée en toute sérénité',
            'secretariat' => ['secretariat_maternité']
        ],
        [
            'step' => 6,
            'title' => 'Retour en chambre',
            'picture' => 'MedicalCourse2.jpeg',
            'category' => 'Préparer mon arrivée en toute sérénité',
            'secretariat' => ['secretariat_maternité', 'secretariat_neurologie', 'secretariat_orthopédie']
        ],
        [
            'step' => 2,
            'title' => 'Consultation pré-opératoire',
            'picture' => 'MedicalCourse3.jpeg',
            'category' => 'Préparer mon arrivée en toute sérénité',
            'secretariat' => ['secretariat_neurologie', 'secretariat_orthopédie']
        ],
        [
            'step' => 3,
            'title' => 'Visite neuro-chirurgien',
            'picture' => 'MedicalCourse-neuro1.jpeg',
            'category' => 'Préparer mon arrivée en toute sérénité',
            'secretariat' => ['secretariat_neurologie']
        ],
        [
            'step' => 3,
            'title' => 'Visite chirurgien',
            'picture' => 'MedicalCourse-ortho1.jpeg',
            'category' => 'Préparer mon arrivée en toute sérénité',
            'secretariat' => ['secretariat_orthopédie']
        ],
        [
            'step' => 4,
            'title' => 'Transfert bloc opératoire',
            'picture' => 'MedicalCourse4.jpeg',
            'category' => 'Préparer mon arrivée en toute sérénité',
            'secretariat' => ['secretariat_neurologie', 'secretariat_orthopédie']
        ],
        [
            'step' => 5,
            'title' => 'Intervention',
            'picture' => 'MedicalCourse5.jpeg',
            'category' => 'Préparer mon arrivée en toute sérénité',
            'secretariat' => ['secretariat_neurologie', 'secretariat_orthopédie']
        ],
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::MEDICALCOURSES as $key => $values) {
            $medicalCourse = new MedicalCourse();
            $medicalCourse->setStep($values['step']);
            $medicalCourse->setTitle($values['title']);
            $medicalCourse->setPicture($values['picture']);
            $medicalCourse->setCategory($this->getReference('category_' . $values['category']));
            foreach ($values['secretariat'] as $secretariat) {
                $medicalCourse->addSecretariat($this->getReference($secretariat));
            }
            $manager->persist($medicalCourse);
            $key++;
            $this->addReference('medical_course_' . $key, $medicalCourse);
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
