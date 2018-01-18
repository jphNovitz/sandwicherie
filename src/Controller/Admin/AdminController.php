<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AdminController
 * @package App\Controller\Admin
 *  @Route("/admin/")
 */
class AdminController extends Controller {
    /**
     * @Route("", name="admin_default")
     */
    public function index(){
        return $this->render('Admin/index.html.twig');

    }

}
