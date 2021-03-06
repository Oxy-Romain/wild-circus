<?php

namespace App\Controller;

use App\Entity\Member;
use App\Form\MemberType;
use App\Repository\MemberRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/member")
 */
class MemberController extends AbstractController
{
    /**
     * @Route("/new", name="member_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $member = new Member();
        $form = $this->createForm(MemberType::class, $member);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($member);
            $entityManager->flush();

            return $this->redirectToRoute('admin_index');
        }

        return $this->render('admin/member/new.html.twig', [
            'member' => $member,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="member_show", methods={"GET"})
     */
    public function show(Member $member): Response
    {
        return $this->render('admin/member/show.html.twig', [
            'member' => $member,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="member_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Member $member): Response
    {
        $form = $this->createForm(MemberType::class, $member);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_index');
        }

        return $this->render('admin/member/edit.html.twig', [
            'member' => $member,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="member_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Member $member): Response
    {
        if ($this->isCsrfTokenValid('delete'.$member->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($member);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_index');
    }
}
