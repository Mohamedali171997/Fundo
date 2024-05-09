<?php

namespace App\Controller;

use App\Entity\Investisseur;
use App\Form\InvestisseurType;
use App\Repository\InvestisseurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;




use Symfony\Component\HttpFoundation\Session\Session;

use App\Entity\User;

use App\Entity\InvestisseurFavorities;


#[Route('/investisseur')]
class InvestisseurController extends AbstractController
{

    

    #[Route('/', name: 'app_investisseur_index', methods: ['GET'])]
    public function index(InvestisseurRepository $investisseurRepository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        
        return $this->render('investisseur/index.html.twig', [
            'investisseurs' => $investisseurRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_investisseur_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $investisseur = new Investisseur();
        $form = $this->createForm(InvestisseurType::class, $investisseur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($investisseur);
            $entityManager->flush();

            return $this->redirectToRoute('app_investisseur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('investisseur/new.html.twig', [
            'investisseur' => $investisseur,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_investisseur_show', methods: ['GET'])]
    public function show(Investisseur $investisseur): Response
    {
        return $this->render('investisseur/show.html.twig', [
            'investisseur' => $investisseur,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_investisseur_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Investisseur $investisseur, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(InvestisseurType::class, $investisseur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_investisseur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('investisseur/edit.html.twig', [
            'investisseur' => $investisseur,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_investisseur_delete', methods: ['POST'])]
    public function delete(Request $request, Investisseur $investisseur, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$investisseur->getId(), $request->request->get('_token'))) {
            $entityManager->remove($investisseur);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_investisseur_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/favo/{id}', name: 'app_investisseur_favorities', methods: ['GET'])]
public function favorities($id, Request $request, EntityManagerInterface $entityManager): Response
{
    // Récupérer l'investisseur associé à l'ID fourni
    $investisseur = $entityManager->getRepository(Investisseur::class)->find($id);

    if (!$investisseur) {
        throw $this->createNotFoundException('Investisseur non trouvé');
    }

    // Récupérer la liste des favoris de cet investisseur
    $favoris = $investisseur->getFavoris();

    // Passer les favoris à la vue
    return $this->render('investisseur/favoris.html.twig', [
        'investisseur' => $investisseur,
        'favoris' => $favoris,
    ]);
}
    
}
