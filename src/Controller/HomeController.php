<?php

namespace App\Controller;

use App\Entity\Member;
use App\Repository\MemberRepository;
use App\Repository\PerformRepository;
use App\Repository\PriceRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home_index")
     */
    public function index(PerformRepository $performRepository, MemberRepository $memberRepository, PriceRepository $priceRepository) : Response
    {
        return $this->render('visitor/home/home.html.twig', [
            'performs' => ($performRepository->findAll()),
            'members' => $memberRepository->findAll(),
            'prices' => $priceRepository->findAll(),
        ]);
    }
}