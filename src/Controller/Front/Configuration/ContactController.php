<?php

namespace App\Controller\Front\Configuration;

use App\Entity\Site;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class ContactController extends Controller
{
    /**
     * @Route("/contact", name="front_contact", schemes={"https"})
     **/
    public function index()
    {
        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());
        $serializer = new Serializer($normalizers, $encoders);

        $dir = '../src/File';
        $fileSystem = new Filesystem();
//        if ($fileSystem->exists($dir.'/site.json')):
            $content = file_get_contents($dir.'/site.json');
            $site = $serializer->deserialize($content, site::class, 'json');
            return $this->render('Front/Configuration/contact.html.twig', [
                'site' => $site
            ]);
    }
}