<?php

namespace App\Controller\Front\Configuration ;

use App\Entity\Schedule;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ConfigurationController
 * @package App\Controller\Admin\Configuration
 * @Route("/", schemes={"https"})
 */
class ScheduleController extends AbstractController
{

    /**
     * @Route("heures-d-ouverture", name="front_schedules_list", methods={"GET", "POST"})
     */
    public function list(Request $request, ContainerInterface $container)
    {
        $schedule = $container->get('doctrine.orm.default_entity_manager')
            ->getRepository('App:Schedule')
            ->groupByDay();

        return $this->render('Front/Configuration/schedule-list.html.twig', [
            'schedule' => $schedule
        ]);
    }
}