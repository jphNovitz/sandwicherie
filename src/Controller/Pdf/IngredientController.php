<?php

Namespace App\Controller\Pdf;

use App\Entity\Ingredient;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;



/**
 * Class IngredientController
 * @package App\Controller\Pdf\Ingredient
 * @Route("/admin/pdf/ingredient/", methods={"GET","HEAD"})
 */

class IngredientController extends Controller
{

    /**
     * @Route("{id}", name="ingredient_pdf")
     */
    public function index(Ingredient $ingredient)
    {
        $this->get('knp_snappy.pdf')->setTimeout('1000');
        try {
            $this->get('knp_snappy.pdf')->generateFromHtml(
                $this->renderView(
                    'Pdf/ingredient-pdf.html.twig',
                    array(
                        'ingredient' => $ingredient
                    )
                ),
                'pdf/documents/ingredients/' . $ingredient->getSlug() . 'pdf'
            );
            return $this->render('Pdf/pdf-confirmation.html.twig', [
                "file" => 'pdf/documents/ingredients/' . $ingredient->getSlug() . 'pdf'
            ]);
        } catch (\Exception $e){
            echo 'erreur: '.$e->getMessage();
        }
    }
}