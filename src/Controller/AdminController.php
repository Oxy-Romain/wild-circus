<?php

namespace App\Controller;

use App\Repository\MemberRepository;
use App\Repository\PerformRepository;
use App\Repository\PriceRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin_index")
     */
    public function index(PerformRepository $performRepository, MemberRepository $memberRepository, PriceRepository $priceRepository) : Response
    {
        return $this->render('admin/home/home.html.twig', [
            'performs' => $performRepository->findAll(),
            'members' => $memberRepository->findAll(),
            'prices' => $priceRepository->findAll(),
        ]);
    }
}