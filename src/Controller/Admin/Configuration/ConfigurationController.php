<?php

namespace App\Controller\Admin\Configuration;

use App\Entity\Site;
use App\Form\SiteType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;


/**
 * Class ConfigurationController
 * @package App\Controller\Admin\Configuration
 * @Route("/admin/configuration/")
 */
class ConfigurationController extends Controller {
    /**
     * @Route("site", name="configuration")
     * @Method({"GET", "POST"})
     */
    public function index(Request $request)
    {
        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());
        $serializer = new Serializer($normalizers, $encoders);

        $dir = '../src/File';
        $fileSystem = new Filesystem();
        if ($fileSystem->exists($dir.'/site.json')):
            $content = file_get_contents($dir.'/site.json');
            $site = $serializer->deserialize($content, site::class, 'json');
        else:
            $site = new Site();
        endif;

        $form = $this->createForm(SiteType::class, $site);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()):
            $content = $serializer->serialize($site, 'json');
            $fileSystem->dumpFile($dir.'/site.json', $content);
            $this->addFlash('success', 'Configuration modifiée');
        endif;

        return $this->render('Configuration/site.html.twig', ['form'=>$form->createView()]);


    }


}