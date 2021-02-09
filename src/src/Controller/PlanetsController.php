<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use App\Entity\Planets;
use App\Form\PlanetsType;
use App\Form\AddPlanetsType;
use DateTime;

class PlanetsController extends AbstractController
{
    /**
     * @Route("/", name="planets")
     */
    public function index(Request $request): Response
    {
        $planet = new Planets;
        $planet->setName('test');

        $form = $this->createForm(PlanetsType::class, $planet, [
            'choices' => $this->getDoctrine()->getRepository(Planets::class)->findAll()
        ]);

        $addPlanetsForm = $this->createForm(AddPlanetsType::class, $planet);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $result = $this->calculate($addPlanetsForm->getData());

            return $this->render('planets/index.html.twig', [
                'form' => $form->createView(),
                'add' => $addPlanetsForm->createView(),
                'info' => $result,
            ]);
        }

        $addPlanetsForm->handleRequest($request);
        if ($addPlanetsForm->isSubmitted() && $addPlanetsForm->isValid()) {
            $planet = $addPlanetsForm->getData();
            \dump($this->getDoctrine()->getRepository(Planets::class)->findAll());
            $em = $this->getDoctrine()->getManager();
            $em->persist($planet);
            $em->flush();

            // Refresh calculate form with the new item after flush
            $form = $this->createForm(PlanetsType::class, $planet, [
                'choices' => $this->getDoctrine()->getRepository(Planets::class)->findAll()
            ]);

            return $this->render('planets/index.html.twig', [
                'form' => $form->createView(),
                'add' => $addPlanetsForm->createView(),
                'itemAdded' => $planet->getName(),
            ]);
        }

        return $this->render('planets/index.html.twig', [
            'form' => $form->createView(),
            'add' => $addPlanetsForm->createView(),
        ]);
    }

    private function calculate(Planets $addPlanetsFormData)
    {
        $selectedPlanet = $this->getDoctrine()->getRepository(Planets::class)->findOneBy(['id' => $addPlanetsFormData->getName()]);
        $selectedDate = $addPlanetsFormData->getDate();
        $initialDate = new DateTime('0001-01-01');

        $diff = $selectedDate->diff($initialDate)->format("%a");

        // Here I calculate the year, however I was not able to calculate the month of the year
        $year = $diff / ($selectedPlanet->getDay() * $selectedPlanet->getMonth());

        return ['name' => $selectedPlanet->getName(), 'year' => ceil($year)];
    }
}
