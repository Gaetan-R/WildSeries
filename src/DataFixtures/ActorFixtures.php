<?php

namespace App\DataFixtures;

use App\Entity\Actor;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker;

class ActorFixtures extends Fixture implements DependentFixtureInterface
{

    const ACTOR = [
        'Andrew Lincoln',
        'Norman Reedus',
        'Lauren Cohan',
        'Danai-Gurira',
    ];

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('en_US');
        for($i=1; $i<=50; $i++) {
            $actor = new Actor();
            $actor->setName($faker->name);
            for ($j = 0; $j < rand(1, 5); $j++) {
                $actor->addProgram($this->getReference('program_' . rand(0, 5)));
            }

            $manager->persist($actor);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [ProgramFixtures::class];
    }

}
