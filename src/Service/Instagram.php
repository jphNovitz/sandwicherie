<?php

namespace App\Service;



use Doctrine\ORM\EntityManagerInterface;
use Psr\Container\ContainerInterface;
use Symfony\Component\Console\Output\OutputInterface;


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

    public function truncate()
    {
        $connection = $this->em->getConnection();
//        $db_platform = $connection->getDatabasePlatform();
//        return $connection->executeUpdate($db_platform->getTruncateTableSQL('instagram', true));
        try {
            $db_platform = $connection->getDatabasePlatform();
            $connection->executeUpdate($db_platform->getTruncateTableSQL('instagram', true));
            return true;
            //            $this->output->writeln('<info>Succes</info>');
//            $this->output->writeln('<info>Anciennes photos effacees !</info>');
        } catch (\Exception $e){
            return false;
//            $this->output->writeln('<error>Erreur</error>');
//            $this->output->writeln('<error>ACTION ARRETEE !</error>');
        }
    }

    public function add()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->base_url.'users/self/media/recent'.'?access_token='.$this->access_token);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json')); // Assuming you're requesting JSON
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $raw_response = curl_exec($ch);

        $response = json_decode($raw_response)->data;
        foreach ($response as $pic):

        $instagram = new \App\Entity\Instagram();
        $instagram->setInstaId($pic->id);
        $instagram->setLink($pic->link);
            if (!is_null($pic->caption))   $instagram->setCaption($pic->caption->text);
        $instagram->setThumbnail($pic->images->thumbnail->url);
        $instagram->setLowResolution($pic->images->low_resolution->url);
        $instagram->setStandardResolution($pic->images->standard_resolution->url);
        $this->em->persist($instagram);
            echo "* ajouté--> image ". $pic->id."\n";


        endforeach;

        try {
            $this->em->flush();
            return true;
        } catch (\Exception $e){
            return false;
        }
    }
}