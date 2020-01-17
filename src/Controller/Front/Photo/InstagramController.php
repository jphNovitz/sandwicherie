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
            $item->expiresAfter(36000);

            return $this->instagram->updateInstagramPhotos();
        });

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