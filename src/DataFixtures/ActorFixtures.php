<?php


namespace App\DataFixtures;


use App\Entity\Actor;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class ActorFixtures extends Fixture implements DependentFixtureInterface
{
    const ACTORS = [
        'Walid',
        'luca',
        'Com',
        'Gaetan',
        'Philippe',
        'Thierry',

    ];

    /**
     * Load data fixtures with the passed EntityManager
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');
        for ($i = 0; $i <= 15; $i++) {
            $person = new Actor();
            $person->setName($faker->firstName);
            $manager->persist($person);
            $person->addProgram($this->getReference('program_' . rand(0, 5)));
        }

        foreach (self::ACTORS as $key => $actorName) {
            $actor = new Actor();
            $actor->setName($actorName);
            $manager->persist($actor);
            $actor->addProgram($this->getReference('program_' . rand(0, 5)));
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [ProgramFixtures::class];
    }

}