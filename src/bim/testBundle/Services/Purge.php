<?php
namespace bim\testBundle\Services;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\Date;

class Purge
{
    /**
     * @var EntityManager
     */
    private $em;
    public function __construct(EntityManager $doctrine)
    {
        $this->em=$doctrine;
    }
    public function purge($days)
    {


        $Adverts = $this->em->getRepository('testBundle:Advert')->AdvertPurge(new \DateTime('-'.(string)$days.'days'));

        foreach ($Adverts as $advert)
        {
                $advertSkills = $this->em->getRepository('testBundle:AdvertSkill')->findByAdvert($advert->getId());
                foreach ($advertSkills as $advertSkill) {
                    $this->em->remove($advertSkill);
                };
                $this->em->remove($advert);
        }
        $this->em->flush();

    }

}