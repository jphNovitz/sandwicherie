<?php
/**
 * Admin Controller Page
 *
 * get all the importants entities and give them to the twig template
 *
 * @category   CategoryName
 * @package     App\Controller\Admin
 * @author     Novitz Jean-Philippe <novitz@gmail.com>
 * @copyright  2018
 * @license    Opensource
 * @version    CVS: $Id:$
 * @link       http://pear.php.net/package/PackageName
 * @see        http://www.laclementine.be
 */

namespace App\Controller\Admin;
use App\Entity\Ingredient;
use App\Service\CustomObjectLoader;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AdminController
 * @package App\Controller\Admin
 * @Route("/admin/")
 */
class AdminController extends Controller {
    /**
     * @Route("", name="admin_default")
     */

    public function index(CustomObjectLoader $loader){
        $ingredients = $loader->LoadAll('App:Ingredient');
        $categories = $loader->LoadAll('App:Category');
        $allergies = $loader->LoadAll('App:Allergy');
        $products = $loader->LoadAll('App:Product');
        $types = $loader->LoadAll('App:Type');
        $providers = $loader->LoadAll('App:Provider');
        $users = $loader->LoadAll('App:User');
        $carts = $loader->LoadAll('App:Cart');

        return $this->render('Admin/index.html.twig', [
            'ingredients'=>$ingredients,
            'categories' => $categories,
            'allergies' => $allergies,
            'products' => $products,
            'types' => $types,
            'providers' => $providers,
            'users' => $users,
            'carts' => $carts
        ]);

    }

}
