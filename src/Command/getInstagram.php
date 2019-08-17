<?php
namespace App\Command;

use App\Service\Instagram;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class getInstagram extends Command
{

    protected static $defaultName = 'App:get-instagram';
    private $instagram ;

    public function __construct(Instagram $instagram)
    {
        $this->instagram = $instagram;
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription('Get Instagram photos')
            ->setHelp('This command allows you to get Instagram photos')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {


        $output->writeln([
            'INSTAGRAM PHOTOS',
            '================',
            '',
        ]);
        $output->writeln('Etape 1 - Vider les photos existantes');

        if ($this->instagram->truncate() == 1)
        {
            $output->writeln('<info>Succes</info>');
            $output->writeln('<info>Anciennes photos effacees !</info>');
            $output->writeln('<bg=green>=========== OK ===========</>');
            $output->writeln(' ');
            $output->writeln('Etape 2 - Récupération et enregistrement des images ');
            $output->writeln('');

            if ($this->instagram->add()){
                $output->writeln('<info>Nouvelles photos enregistrees !</info>');
                $output->writeln('<bg=green>=========== OK ===========</>');
            } else {
                $output->writeln('<error>AUCUNE photos enregistrees !</error>');
                $output->writeln('<bg=red>=========== ECHEC ===========</>');
            }


            $output->writeln(' ');
            $output->writeln('');
        }

    }



}