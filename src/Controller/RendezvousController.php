<?php

namespace App\Controller;

use App\Entity\Rendezvous;
use App\Form\RendezvousType;
use App\Repository\RendezvousRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/rendezvous")
 */
class RendezvousController extends AbstractController
{
    /**
     * @Route("/", name="app_rendezvous_index", methods={"GET"})
     */
    public function index(RendezvousRepository $rendezvousRepository): Response
    {
        return $this->render('rendezvous/index.html.twig', [
            'rendezvouses' => $rendezvousRepository->findAll(),
        ]);
    }


     /**
     * @Route("/admin", name="app_admin_index")
     */
    public function indexAdmin(): Response
    {
        return $this->render('admin/index.html.twig');
    }



    /**
     * @Route("/new", name="app_rendezvous_new", methods={"GET", "POST"})
     */
    public function new(Request $request, RendezvousRepository $rendezvousRepository): Response
    {
        $rendezvou = new Rendezvous();
        $form = $this->createForm(RendezvousType::class, $rendezvou);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $rendezvousRepository->add($rendezvou);
            return $this->redirectToRoute('app_rendezvous_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('rendezvous/new.html.twig', [
            'rendezvou' => $rendezvou,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_rendezvous_show", methods={"GET"})
     */
    public function show(Rendezvous $rendezvou): Response
    {
        return $this->render('rendezvous/show.html.twig', [
            'rendezvou' => $rendezvou,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_rendezvous_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Rendezvous $rendezvou, RendezvousRepository $rendezvousRepository): Response
    {
        $form = $this->createForm(RendezvousType::class, $rendezvou);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $rendezvousRepository->add($rendezvou);
            return $this->redirectToRoute('app_rendezvous_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('rendezvous/edit.html.twig', [
            'rendezvou' => $rendezvou,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_rendezvous_delete", methods={"POST"})
     */
    public function delete(Request $request, Rendezvous $rendezvou, RendezvousRepository $rendezvousRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$rendezvou->getId(), $request->request->get('_token'))) {
            $rendezvousRepository->remove($rendezvou);
        }

        return $this->redirectToRoute('app_rendezvous_index', [], Response::HTTP_SEE_OTHER);
    }
}
