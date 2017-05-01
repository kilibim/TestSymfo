<?php
/**
 * Created by PhpStorm.
 * User: ZIANI
 * Date: 16/03/2017
 * Time: 23:59
 */

namespace bim\coreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class HomeController  extends Controller
{
    public function indexAction()
    {
        return $this->render('coreBundle:Home:Layout.html.twig');
    }
}