<?php
/**
 * Created by PhpStorm.
 * User: ZIANI
 * Date: 04/03/2017
 * Time: 13:02
 */

// src/OC/PlatformBundle/Controller/AdvertController.php

namespace bim\testBundle\Controller;

// N'oubliez pas ce use :
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
//-----------------pour afficher UrlGeneratorInterface--------
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
//-------------------------------------------------------------

class testController extends Controller
{
    public function indexAction()
    {
        return $this->redirectToRoute('bim_platform_view_slug',array('slug'=>'plat','year'=>'2001','format'=>'html'));
//        $content = $this->get('templating')->render('testBundle:Advert:index.html.twig',array('nom' => 'IBRAHIM','ad_id'=>'989'));
//        return new Response($content);


//        // On veut avoir l'URL de l'annonce d'id 5.
//        $url = $this->get('router')->generate(
//            'bim_platform_view', // 1er argument : le nom de la route
//            array('id' => 5),UrlGeneratorInterface::ABSOLUTE_URL    // 2e argument : les valeurs des paramètres
//        );
//        // $url vaut « /platform/advert/5 »
//        return new Response("L'URL de l'annonce d'id 5 est : ".$url);
    }




    // La route fait appel à OCPlatformBundle:Advert:view,
    // on doit donc définir la méthode viewAction.
    // On donne à cette méthode l'argument $id, pour
    // correspondre au paramètre {id} de la route

    public function viewAction($id)
    {
        // $id vaut 5 si l'on a appelé l'URL /platform/advert/5

        // Ici, on récupèrera depuis la base de données
        // l'annonce correspondant à l'id $id.
        // Puis on passera l'annonce à la vue pour
        // qu'elle puisse l'afficher

        return new Response("Affichage de l'annonce d'id : ".$id);
    }
    // On récupère tous les paramètres en arguments de la méthode
    public function viewSlugAction($slug, $year, $format)
    {
        $content = $this->get('templating')->render('testBundle:Advert:viewSlug.html.twig',array('slug'=>$slug , 'year'=>$year , 'format'=>$format));
        return new Response($content);
    }

    public function AddAction()
    {
        // Création de l'entité Advert
        $Advert = new Advert();
        $Advert->setTitle("Recherche développeur web");
        $Advert->setAuthor("SAIDI Ahmed");
        $Advert->setContent("Nous recherchons un développeur web a Sale. Blabla…");

        //Création de l'entité image
        $image = new image();
        $image->setUrl("http://images.itnewsinfo.com/lmi/articles/grande/000000043505.jpg");
        $image->setAlt("Devloppeur web");

        // On lie l'image à l'annonce
        $Advert->setImage($image);

        // On récupère l'EntityManager
        $em = $this->getDoctrine()->getManager();

        // Étape 1 : On « persiste » l'entité
        $em->persist($Advert);
        // Étape 2 : On « flush » tout ce qui a été persisté avant
        $em->flush();


        // Si la requête est en POST, c'est que le visiteur a soumis le formulaire
//        if ($request->isMethod('POST')) {
        // Ici, on s'occupera de la création et de la gestion du formulaire

        $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');

        // Puis on redirige vers la page de visualisation de cettte annonce
        return $this->redirectToRoute('bim_platform_view', array('slug' => $Advert->getSlug()));
//        }

        // Si on n'est pas en POST, alors on affiche le formulaire
//        return $this->render('testBundle:Advert:add.html.twig');

    }

}

?>