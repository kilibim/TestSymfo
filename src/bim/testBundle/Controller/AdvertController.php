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
use bim\testBundle\Entity\Advert;
use bim\testBundle\Form\AdvertEditType;
use bim\testBundle\Form\AdvertType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class AdvertController extends Controller
{

    public function indexAction($page)
    {
        $em = $this->getDoctrine()->getManager();
        $listeAdvert=$em->getRepository('testBundle:Advert')->getAdverts();
        return $this->render('testBundle:Advert:index.html.twig',array('listAdverts'=> $listeAdvert));
    }
    public function purgeAction($days)
    {
        $purge= $this->container->get('bim_test.purge');
        $purge->purge($days);
        return $this->redirectToRoute('bim_platform_home');
    }
    public function menuAction($limit)
    {
        $repository=$this->getDoctrine()->getManager()->getRepository('testBundle:Application');

        $LastCondidaWithAdvert=$repository->getApplicationsWithAdvert($limit);

        return $this->render('testBundle:Advert:menu.html.twig', array(
            'LastCondidaWithAdvert' => $LastCondidaWithAdvert
        ));
        
//        // On fixe en dur une liste ici, bien entendu par la suite
//        // on la récupérera depuis la BDD !
//        $listAdverts = array(
//            array('id' => 1, 'title' => 'Recherche développeur Symfony'),
//            array('id' => 5, 'title' => 'Mission de webmaster'),
//            array('id' => 9, 'title' => 'Offre de stage webdesigner')
//        );
//
//        return $this->render('testBundle:Advert:menu.html.twig', array(
//            // Tout l'intérêt est ici : le contrôleur passe
//            // les variables nécessaires au template !
//            'listAdverts' => $listAdverts
//        ));
    }
    public function viewAction($slug)
    {
        $em = $this->getDoctrine()->getManager();

        // On récupère l'annonce $id
        $AdvertAndApplication = $em->getRepository('testBundle:Advert')
            ->getAdvertWithApplicationBySlug($slug);

        if (null === $AdvertAndApplication) {
//            throw new NotFoundHttpException("L'annonce de slug ".$slug." n'existe pas.");
            $Advert = $em->getRepository('testBundle:Advert')->findOneBySlug($slug);
            return $this->render('testBundle:Advert:view.html.twig', array(
                'advert'           => $Advert
            ));
        }
        else{
            $listApplications = $AdvertAndApplication->getApplications();

            return $this->render('testBundle:Advert:view.html.twig', array(
                'advert'           => $AdvertAndApplication,
                'listApplications' => $listApplications
            ));
        }

        // On récupère la liste des candidatures de cette annonce


    }

    public function addAction(Request $request)
    {
        // On crée un objet Advert
        $advert = new Advert();

        // On crée le FormBuilder grâce au service form factory
        $form = $this->get('form.factory')->create(AdvertType::class, $advert);



        // Si la requête est en POST
        if ($request->isMethod('POST')) {
            // On fait le lien Requête <-> Formulaire
            // À partir de maintenant, la variable $advert contient les valeurs entrées dans le formulaire par le visiteur
            $form->handleRequest($request);

            // On vérifie que les valeurs entrées sont correctes
            // (Nous verrons la validation des objets en détail dans le prochain chapitre)
            if ($form->isSubmitted() && $form->isValid()) {
                $advert->getImage()->upload();
                // On enregistre notre objet $advert dans la base de données, par
                $em = $this->getDoctrine()->getManager();
                $em->persist($advert);
                $em->flush();

                $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');

                // On redirige vers la page de visualisation de l'annonce nouvellement créée
                return $this->redirectToRoute('bim_platform_view', array('slug' => $advert->getSlug()));
            }
        }

        // À ce stade, le formulaire n'est pas valide car :
        // - Soit la requête est de type GET, donc le visiteur vient d'arriver sur la page et veut voir le formulaire
        // - Soit la requête est de type POST, mais le formulaire contient des valeurs invalides, donc on l'affiche de nouveau
        return $this->render('testBundle:Advert:form.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function editAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        // Ici, on récupérera l'annonce correspondante à $id
        $adv=$em->getRepository('testBundle:Advert')->find($id);
        $form = $this->get('form.factory')->create(AdvertEditType::class,$adv);

        return $this->render('testBundle:Advert:form.html.twig',array(
            'form' => $form->createView(),
        ));

    }

    public function deleteAction($id)
    {
        // Ici, on récupérera l'annonce correspondant à $id

        // Ici, on gérera la suppression de l'annonce en question

        return $this->render('testBundle:Advert:delete.html.twig');
    }

    public function viewSlugAction($slug, $year, $format)
    {
        $content = $this->get('templating')->render('testBundle:Advert:viewSlug.html.twig',array('slug'=>$slug , 'year'=>$year , 'format'=>$format));
        return new Response($content);
    }



}

?>