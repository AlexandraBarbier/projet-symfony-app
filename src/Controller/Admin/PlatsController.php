<?php

namespace App\Controller\Admin;

use App\DTO\SearchDishCriteria;
use App\Entity\Plat;
use App\Form\PlatType;
use App\Form\SearchDishType;
use App\Repository\PlatRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/plats')]
class PlatsController extends AbstractController
{
    #[Route('/', name: 'admin_plats_index', methods: ['GET'])]
    public function index(PlatRepository $platRepository, Request $request): Response
    {
        $DTO = new SearchDishCriteria;
        $form = $this->createForm(SearchDishType::class, $DTO);

        $form->handleRequest($request);

        return $this->render('admin/plats/index.html.twig', [
            'plats' => $platRepository->findAllByCriteria($DTO),
            'form' => $form->createView()
        ]);
    }

    #[Route('/new', name: 'admin_plats_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $plat = new Plat();
        $form = $this->createForm(PlatType::class, $plat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($plat);
            $entityManager->flush();

            return $this->redirectToRoute('admin_plats_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/plats/new.html.twig', [
            'plat' => $plat,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'admin_plats_show', methods: ['GET'])]
    public function show(Plat $plat): Response
    {
        return $this->render('admin/plats/show.html.twig', [
            'plat' => $plat,
        ]);
    }

    #[Route('/{id}/edit', name: 'admin_plats_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Plat $plat, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PlatType::class, $plat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('admin_plats_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/plats/edit.html.twig', [
            'plat' => $plat,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'admin_plats_delete', methods: ['POST'])]
    public function delete(Request $request, Plat $plat, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$plat->getId(), $request->request->get('_token'))) {
            $entityManager->remove($plat);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_plats_index', [], Response::HTTP_SEE_OTHER);
    }
}
