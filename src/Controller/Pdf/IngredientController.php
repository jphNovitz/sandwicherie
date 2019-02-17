<?php

Namespace App\Controller\Pdf;

use App\Entity\Ingredient;
use App\Service\CustomObjectLoader;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Snappy\Pdf;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;


/**
 * Class IngredientController
 * @package App\Controller\Pdf\Ingredient
 * @Route("/admin/pdf/ingredient/", methods={"GET","HEAD"})
 */

class IngredientController extends Controller
{

    protected $generator ;
    protected $twig ;
    protected $loader ;

    public function __construct(Pdf $generator, Environment $twig, CustomObjectLoader $loader)
    {
        $this->generator = $generator;
        $this->twig = $twig;
        $this->loader = $loader;
    }

    /**
     * @Route("{slug}", name="ingredient_pdf")
     */
    public function index(String $slug)
    {
        $ingredient = $this->loader->LoadOne('App:Ingredient', $slug);
        $this->generator->setTimeout('1000');
        try {
            $this->generator->generateFromHtml(
                $this->twig->render(
                    'Pdf/ingredient-pdf.html.twig',
                    array(
                        'ingredient' => $ingredient
                    )
                ),
                'pdf/documents/ingredients/' . $ingredient->getSlug() . '.pdf'
            );
            return true;
//            return $this->render('Pdf/pdf-confirmation.html.twig', [
//                "file" => 'pdf/documents/ingredients/' . $ingredient->getSlug() . '.pdf'
//            ]);
        } catch (\Exception $e){
            return false;
//            return 'erreur: '.$e->getMessage();
        }
    }
}