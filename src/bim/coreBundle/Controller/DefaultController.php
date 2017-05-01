<?php

namespace bim\coreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('coreBundle:Home:index.html.twig');
    }
}
