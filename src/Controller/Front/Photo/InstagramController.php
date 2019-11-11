<?php

namespace App\Controller\Front\Photo;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Instagram;

class InstagramController extends Controller
{

    /**
     * @Route("/photos", name="front_photos_instagram", methods={"GET"}, schemes={"https"})
     */
    public function list()
    {
        $photos = $this->get('doctrine.orm.default_entity_manager')
            ->getRepository('App:Instagram')
            ->findAll();
//dump($photos); die();
        return $this->render('Front/Photo/instagram-list.html.twig', [
            'photos' => $photos
        ]);

    }

    /**
     * @Route("/photo/{id}", name="front_photo_instagram", methods={"GET"})
     */
    public function show(Instagram $photo)
    {
        if (!$photo){
            $this->addFlash('error', "Cette photo n'a pas été trouvée !");
            return $this->render('Front/Photo/instagram-list.html.twig');
        }

        return $this->render('Front/Photo/instagram-card.html.twig', [
            'photo' => $photo
        ]);
    }
}