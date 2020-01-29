<?php

namespace App\Controller;

use App\Entity\Perform;
use App\Form\PerformType;
use App\Repository\PerformRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/perform")
 */
class PerformController extends AbstractController
{
    /**
     * @Route("/", name="perform_index", methods={"GET"})
     */
    public function index(PerformRepository $performRepository): Response
    {
        return $this->render('admin/perform/index.html.twig', [
            'performs' => $performRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="perform_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $perform = new Perform();
        $form = $this->createForm(PerformType::class, $perform);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($perform);
            $entityManager->flush();

            return $this->redirectToRoute('perform_index');
        }

        return $this->render('admin/perform/new.html.twig', [
            'perform' => $perform,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="perform_show", methods={"GET"})
     */
    public function show(Perform $perform): Response
    {
        return $this->render('admin/perform/show.html.twig', [
            'perform' => $perform,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="perform_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Perform $perform): Response
    {
        $form = $this->createForm(PerformType::class, $perform);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('perform_index');
        }

        return $this->render('admin/perform/edit.html.twig', [
            'perform' => $perform,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="perform_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Perform $perform): Response
    {
        if ($this->isCsrfTokenValid('delete'.$perform->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($perform);
            $entityManager->flush();
        }

        return $this->redirectToRoute('perform_index');
    }
}
