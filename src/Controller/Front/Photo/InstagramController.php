<?php

namespace App\Controller\Front\Photo;

use App\Service\Instagram as InstagramService;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Instagram;
use Symfony\Component\Cache\Adapter\AdapterInterface;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\Cache\ItemInterface;

class InstagramController extends AbstractController
{
    protected $base_url;
    protected $access_token;
    protected $cache;
    protected $entityManager;
    protected $container;
    protected $instagram;

    public function __construct(ContainerInterface $container,
                                EntityManagerInterface $entityManager,
                                InstagramService $instagram)
    {
        $this->base_url = $container->getParameter('base_url');
        $this->access_token = $container->getParameter('access_token');
        $this->cache = new FilesystemAdapter();
        $this->entityManager = $entityManager;
        $this->container = $container;
        $this->instagram = $instagram;
    }

    /**
     * @Route("/photos", name="front_photos_instagram", methods={"GET"}, schemes={"https"})
     */
    public function list()
    {
//        $this->cache->delete('updated_instagram_photos');
//        die();
        $photos = $this->cache->get('updated_instagram_photos', function (ItemInterface $item){
            $item->expiresAfter(3600);
//            dd( $this->instagram->updateInstagramPhotos());
            return $this->instagram->updateInstagramPhotos();
//            return $this->updateInstagramPhotos();
        });

//        // instanciate the HttpClient Object
//        $client = HttpClient::create();
//
//        // get datas from instagram
//        $response = $client->request('GET', $this->base_url.'users/self/media/recent'.'?access_token='.$this->access_token);
//
//        $statusCode = $response->getStatusCode();
//        $contentType = $response->getHeaders()['content-type'][0];
//        $content = $response->getContent();
//        $content = $response->toArray();
//
//        // get photos and datas from database
//        $photos = $entityManager
//            ->getRepository('App:Instagram')
//            ->myFindAll();
//
////dd($content['data'][1]['images']['thumbnail']);
//        foreach ($content['data'] as $pic):
////            dump($pic);
//            if(array_search($pic['id'], array_column($photos, 'insta_id')) == FALSE) {
//                $instagram = new \App\Entity\Instagram();
//                $instagram->setInstaId($pic['id']);
//                $instagram->setLink($pic['link']);
//                if (!is_null($pic['caption']))   $instagram->setCaption($pic['caption']['text']);
//                $instagram->setThumbnail($pic['images']['thumbnail']['url']);
//                $instagram->setLowResolution($pic['images']['low_resolution']['url']);
//                $instagram->setStandardResolution($pic['images']['standard_resolution']['url']);
//                $entityManager->persist($instagram);
//            }
//
//        endforeach;
//            $entityManager->flush();
//        $photos = $entityManager
//            ->getRepository('App:Instagram')
//            ->myFindAll();

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