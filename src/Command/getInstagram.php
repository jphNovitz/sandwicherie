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

        $this->instagram->test();
//        $output->writeln($this->instagram->test());

    }



}