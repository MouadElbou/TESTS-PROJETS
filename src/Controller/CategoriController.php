<?php

namespace App\Controller;

use App\Entity\Categori;
use App\Form\CategoriType;
use App\Repository\CategoriRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/categori')]
class CategoriController extends AbstractController
{
    #[Route('/', name: 'app_categori_index', methods: ['GET'])]
    public function index(CategoriRepository $categoriRepository): Response
    {
        return $this->render('categori/index.html.twig', [
            'categoris' => $categoriRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_categori_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CategoriRepository $categoriRepository): Response
    {
        $categori = new Categori();
        $form = $this->createForm(CategoriType::class, $categori);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $categoriRepository->save($categori, true);

            return $this->redirectToRoute('app_categori_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('categori/new.html.twig', [
            'categori' => $categori,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_categori_show', methods: ['GET'])]
    public function show(Categori $categori): Response
    {
        return $this->render('categori/show.html.twig', [
            'categori' => $categori,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_categori_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Categori $categori, CategoriRepository $categoriRepository): Response
    {
        $form = $this->createForm(CategoriType::class, $categori);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $categoriRepository->save($categori, true);

            return $this->redirectToRoute('app_categori_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('categori/edit.html.twig', [
            'categori' => $categori,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_categori_delete', methods: ['POST'])]
    public function delete(Request $request, Categori $categori, CategoriRepository $categoriRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$categori->getId(), $request->request->get('_token'))) {
            $categoriRepository->remove($categori, true);
        }

        return $this->redirectToRoute('app_categori_index', [], Response::HTTP_SEE_OTHER);
    }
}
