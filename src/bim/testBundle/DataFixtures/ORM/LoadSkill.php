<?php
namespace bim\testBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use bim\testBundle\Entity\Skill;

class LoadSkill implements FixtureInterface
{
    // Dans l'argument de la méthode load, l'objet $manager est l'EntityManager
    public function load(ObjectManager $manager)
    {
        $names = array('PHP', 'Symfony', 'C++', 'Java', 'Photoshop', 'Blender', 'Bloc-note');
        foreach ($names as $name)
        {
            $skill = new skill();
            $skill->setname($name);

            $manager->persist($skill);
        }

        $manager->flush();
    }
}

