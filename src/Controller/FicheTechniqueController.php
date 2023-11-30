<?php

namespace App\Controller;

use App\Entity\FicheTechnique;
use App\Form\FicheTechniqueType;
use App\Repository\FicheTechniqueRepository;
use Doctrine\ORM\EntityManagerInterface;
use Dompdf\Dompdf;
use Dompdf\Options;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/fiche/technique')]
class FicheTechniqueController extends AbstractController
{
    #[Route('/', name: 'app_fiche_technique_index', methods: ['GET'])]
    public function index(FicheTechniqueRepository $ficheTechniqueRepository): Response
    {
        return $this->render('fiche_technique/index.html.twig', [
            'fiche_techniques' => $ficheTechniqueRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_fiche_technique_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $ficheTechnique = new FicheTechnique();
        $form = $this->createForm(FicheTechniqueType::class, $ficheTechnique);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($ficheTechnique);
            $entityManager->flush();

            return $this->redirectToRoute('app_fiche_technique_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('fiche_technique/new.html.twig', [
            'fiche_technique' => $ficheTechnique,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_fiche_technique_show', methods: ['GET'])]
    public function show(FicheTechnique $ficheTechnique): Response
    {
        return $this->render('fiche_technique/show.html.twig', [
            'fiche_technique' => $ficheTechnique,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_fiche_technique_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, FicheTechnique $ficheTechnique, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(FicheTechniqueType::class, $ficheTechnique);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_fiche_technique_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('fiche_technique/edit.html.twig', [
            'fiche_technique' => $ficheTechnique,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_fiche_technique_delete', methods: ['POST'])]
    public function delete(Request $request, FicheTechnique $ficheTechnique, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ficheTechnique->getId(), $request->request->get('_token'))) {
            $entityManager->remove($ficheTechnique);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_fiche_technique_index', [], Response::HTTP_SEE_OTHER);
    }


    #[Route('/fichse/technique/{id}/pdf', name: 'PDF_t')]
    public function generatePdf($id,FicheTechniqueRepository $ficheRepository,FicheTechnique $fiche, Request $request)
    {
        // Récupération des données de la facture par ID
        $fiche = $ficheRepository->find($id);

        
        // Génération du document PDF
        $dompdf = new Dompdf();
        $dompdf->loadHtml($this->renderView('fiche_technique/pdffiche.html.twig',
         ['fiche' => $fiche]));
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Envoi du PDF en tant que réponse HTTP
        //$response = new Response();
        //$response->setContent($dompdf->output());
        //$response->headers->set('Content-Type', 'application/pdf');
        //$response->headers->set('Content-Disposition', 'inline; filename="facture.pdf"');

        // Output the generated PDF to Browser (inline view)
        // Send the PDF to the browser
        $response = new Response($dompdf->output(), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="VotreFiche.pdf"',
        ]);

        return $response;
    }
}
