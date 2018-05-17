<?php
namespace App\Service;

use App\Entity\Site;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

class SiteConfiguration{
    protected $seralizer;
    protected $manager;

    public function __construct(SerializerInterface $serializer,
                                EntityManagerInterface $entityManager,

                                ObjectNormalizer $normalizer)
    {

        $this->manager = $entityManager;
        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());
        $this->serializer = new Serializer($normalizers, $encoders);
    }

    public function getGeneral(){

        $content = file_get_contents('../src/File/site.json');
        //$serialized = $this->serializer->deserialize($content, site::class, 'json');
        return json_decode($content);
    }
}