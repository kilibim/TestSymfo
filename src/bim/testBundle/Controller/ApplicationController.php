<?php
/**
 * Created by PhpStorm.
 * User: ZIANI
 * Date: 02/04/2017
 * Time: 13:02
 */

namespace bim\testBundle\Controller;

// N'oubliez pas ce use :
use bim\testBundle\Entity\image;
use bim\testBundle\Entity\Advert;
use bim\testBundle\Entity\Application;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


class ApplicationController extends controller
{
    public function AddAppAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $repository=$em->getRepository('testBundle:Advert');
        $Advert=$repository->find($id);

        $Application = new Application();
        $Application->setAuthor('Brahim');
        $Application->setContent("Super Offer.");

        $Advert->addApplication($Application);

        $em->persist($Application);
        $em->persist($Advert);

        $em->flush();
        return $this->redirectToRoute('bim_platform_view',array('slug'=>$Advert->getSlug()));
    }
}