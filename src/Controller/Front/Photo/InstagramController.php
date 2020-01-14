<?php

namespace App\Controller\Front\Photo;

use Doctrine\ORM\EntityManagerInterface;
use Psr\Container\ContainerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Instagram;
use Symfony\Component\HttpClient\HttpClient;

class InstagramController extends AbstractController
{
    protected $base_url;
    protected $access_token;

    public function __construct(\Symfony\Component\DependencyInjection\ContainerInterface $container)
    {
        $this->base_url = $container->getParameter('base_url');
        $this->access_token = $container->getParameter('access_token');
    }

    /**
     * @Route("/photos", name="front_photos_instagram", methods={"GET"}, schemes={"https"})
     */
    public function list(EntityManagerInterface $entityManager)
    {

        // instanciate the HttpClient Object
        $client = HttpClient::create();

        // get datas from instagram
        $response = $client->request('GET', $this->base_url.'users/self/media/recent'.'?access_token='.$this->access_token);

        $statusCode = $response->getStatusCode();
        $contentType = $response->getHeaders()['content-type'][0];
        $content = $response->getContent();
        $content = $response->toArray();

        // get photos and datas from database
        $photos = $entityManager
            ->getRepository('App:Instagram')
            ->myFindAll();
//        dd($photos);
//        $ids = [];
//        foreach ($photos as $p) {
//            $ids[$p['i_insta_id'] = $p->insta_id;
//        }
//        dd($ids);
//        dd(array_search('21566769206667423182_5919541710', array_column($photos, 'i_insta_id')));
//        dd(array_column($photos, 'i_insta_id'));
//        dd($photos);
//        dd(gettype($photos[0]));
//        dd(array_column($photos, 'id'));



        foreach ($content['data'] as $pic):
//            dump($pic);
            if(array_search($pic['id'], array_column($photos, 'insta_id')) == FALSE) {
                $instagram = new \App\Entity\Instagram();
                $instagram->setInstaId($pic['id']);
                $instagram->setLink($pic['link']);
                if (!is_null($pic['caption']))   $instagram->setCaption($pic['caption']['text']);
                $instagram->setThumbnail($pic['images']['thumbnail']['url']);
                $instagram->setLowResolution($pic['images']['low_resolution']['url']);
                $instagram->setStandardResolution($pic['images']['standard_resolution']['url']);
                $entityManager->persist($instagram);
            }

        endforeach;
            $entityManager->flush();
        $photos = $entityManager
            ->getRepository('App:Instagram')
            ->myFindAll();

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