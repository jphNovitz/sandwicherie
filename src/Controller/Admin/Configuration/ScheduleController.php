<?php

namespace App\Controller\Admin\Configuration ;

use App\Entity\Schedule;
use App\Form\ScheduleType;
use App\Service\CustomPersister;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


/**
 * Class ConfigurationController
 * @package App\Controller\Admin\Configuration
 * @Route("/admin/schedule/")
 */
class ScheduleController extends Controller
{

    /**
     * @Route("", name="schedules_list", methods={"GET", "POST"})
     */
    public function list(Request $request)
    {
        $schedules = $this->get('doctrine.orm.default_entity_manager')
            ->getRepository('App:Schedule')
            ->fetchAll();

        if (!$schedules) {
            $this->addFlash('error', 'Oups !');
            return $this->redirectToRoute('admin_default');
        }

        return $this->render('Configuration/Schedule/schedules-list.html.twig', [
            "list" =>$schedules
        ]);
    }

    /**
     * @Route("add", name="schedules_add", methods={"GET", "POST"})
     */
    public function add(Request $request, CustomPersister $persister)
    {
        $schedule = new Schedule();

        $form = $this->createForm(ScheduleType::class, $schedule);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            if (!$persister->insert($schedule))
            {
                $this->addFlash('error', 'Erreur');
            } else {
                $this->addFlash('success', 'plage horaire ajoutée');
                return $this->redirectToRoute('schedules_list');
            }
        }

        return $this->render('Configuration/Schedule/schedule-add.html.twig', [
           "form" => $form->createView()
        ]);
    }

    /**
     * @Route("{id}/update", name="schedules_update", methods={"GET", "POST"})
     */
    public function update(Schedule $schedule, Request $request, CustomPersister $persister)
    {
        if (!$schedule) return $this->redirectToRoute('schedules_list');

        $form = $this->createForm(ScheduleType::class, $schedule);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            if (!$persister->update($schedule))
            {
                $this->addFlash('error', 'Erreur');
            } else {
                $this->addFlash('success', 'plage horaire modifiée');
                return $this->redirectToRoute('schedules_list');
            }
        }

        return $this->render('Configuration/Schedule/schedule-update.html.twig', [
            "form" => $form->createView()
        ]);
    }

    /**
     * @Route("{id}/delete", name="schedules_delete", methods={"GET", "POST"})
     */
    public function delete(Schedule $day, Request $request, CustomPersister $persister)
    {
        if ( (!$day) || (!$persister->delete($day)))
            $this->addFlash('error', 'Erreur lors de la mise à jour ');
        else
            $this->addFlash('success', 'Horaire supprimé ');

        return $this->redirectToRoute("schedules_list");

    }

    /**
     * @Route("{id}/switch", name="schedules_switch", methods={"GET", "POST"})
     */
    public function switchActive(Schedule $day, Request $request, CustomPersister $persister)
    {
        if ( (!$day) || (!$persister->update($day->setActive(!$day->getActive()))))
            $this->addFlash('error', 'Erreur lors de la mise à jour ');
         else
             $this->addFlash('success', 'Mis à jour ');

        return $this->redirectToRoute("schedules_list");

    }


}