<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class CategoryFixtures extends Fixture
{
    private const CATEGORIES = [

        [
            'title' => "Comprendre mon opération",
            'progressColor' => "category1-progress",
            'progressbarColor' => "category1-progressbar",

        ],
        [
            'title' => "Finir les démarches administratives",
            'progressColor' => "category2-progress",
            'progressbarColor' => "category2-progressbar",

        ],
        [
            'title' => "Préparer mon arrivée en toute sérénité",
            'progressColor' => "category3-progress",
            'progressbarColor' => "category3-progressbar",

        ],
        [
            'title' => "Anticiper ma sortie",
            'progressColor' => "category4-progress",
            'progressbarColor' => "category4-progressbar",

        ],
        [
            'title' => 'Ma check-list avant le départ à la clinique',
            'progressColor' => 'category5-progress',
            'progressbarColor' => 'category5-progressbar',

        ],
    ];


    public function load(ObjectManager $manager): void
    {
        foreach (self::CATEGORIES as $values) {
            $category = new Category();
            $category->setTitle($values['title']);
            $category->setProgressColor($values['progressColor']);
            $category->setProgressbarColor($values['progressbarColor']);
            $manager->persist($category);
            $this->addReference('category_' . $values['title'], $category);
        }
        $manager->flush();
    }
}
