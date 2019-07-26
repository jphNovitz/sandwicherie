<?php

namespace App\Service;



use Doctrine\ORM\EntityManagerInterface;
use Psr\Container\ContainerInterface;

class Instagram
{

    protected $base_url ;
    protected $access_token ;
    protected $em ;

    public function __construct(ContainerInterface $container, EntityManagerInterface $entityManager)
    {
        $this->base_url = $container->getParameter('base_url');
        $this->access_token = $container->getParameter('access_token');
        $this->em = $entityManager;
    }

    public function test()
    {

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->base_url.'users/self/media/recent'.'?access_token='.$this->access_token);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json')); // Assuming you're requesting JSON
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $raw_response = curl_exec($ch);

        $response = json_decode($raw_response)->data;
//        dump($response); die();
        $temp=[];
//        dump($response[1]->caption->id); die();
        foreach ($response as $pic):

            $instagram = new \App\Entity\Instagram();
        $instagram->setInstaId($pic->id);
        $instagram->setLink($pic->link);
            if (!is_null($pic->caption))   $instagram->setCaption($pic->caption->text);
        $instagram->setThumbnail($pic->images->thumbnail->url);
        $instagram->setLowResolution($pic->images->low_resolution->url);
        $instagram->setStandardResolution($pic->images->standard_resolution->url);
        $this->em->persist($instagram);


        endforeach;
        $this->em->flush();
        die();
    }
}