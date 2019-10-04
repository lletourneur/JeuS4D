<?php

namespace App\Controller;

use App\Entity\Partie;
use App\Repository\CarteRepository;
use App\Repository\JoueurRepository;
use App\Repository\PartieRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class PartieController
 * @package App\Controller
 * @Route("/partie")
 */
class PartieController extends AbstractController
{
    /**
     * @Route("/", name="partie")
     */
    public function index(JoueurRepository $joueurRepository, PartieRepository $partieRepository)
    {
        $joueurs = $joueurRepository->findAll();
        $parties = $this->getUser()->getToutesMesParties();

        return $this->render('partie/index.html.twig', [
            'joueurs' => $joueurs,
            'parties' => $parties
        ]);
    }

    /**
     * @Route("/nouvelle-partie", name="nouvelle_partie")
     */
    public function nouvellePartie(
        Request $request,
        JoueurRepository $joueurRepository,
        CarteRepository $carteRepository
    ){
        $joueur1 = $this->getUser();
        $joueur2 = $joueurRepository->find($request->request->get('adversaire'));

        $cartes = $carteRepository->findAll();

        $partie = new Partie();
        $partie->setJoueur1($joueur1);
        $partie->setJoueur2($joueur2);

        $tabCartes = [];
        foreach ($cartes as $carte){
            $tabCartes[] = $carte->getId();
        }
        shuffle($tabCartes);

        $mainJ1 = [];
        $mainJ2 = [];
        for ($i = 0; $i < 7; $i++){
            $mainJ1[] = array_pop($tabCartes);
            $mainJ2[] = array_pop($tabCartes);
        }
        dump($mainJ1);
        dump($mainJ2);

        $pioche = $tabCartes;

        $partie->setMainJ1($mainJ1);
        $partie->setMainJ2($mainJ2);
        $partie->setPioche($pioche);
        $partie->setTypeVictoire('');

        $partie->setDateDebutPartie(new \DateTime('now'));
        $partie->setGagnant(null);
        $partie->setTour(1);

        $em = $this->getDoctrine()->getManager();
        $em->persist($partie);
        $em->flush();

        return $this->redirectToRoute('afficher_partie', ['idPartie' => $partie->getId()]);

//        return $this->render('partie/nouvelle-index.html.twig',[
//            ]);
    }

    /**
     * @param Request $request
     * @Route("/depose_carte/{idPartie}", name="depose_carte")
     */
    public function deposeCarte(Request $request, Partie $idPartie) {
        dump($request->request->get('carte'));
        dump($request->request->get('colonne'));
        dump($request->request->get('ligne'));
    }

    /**
     * @Route("/{idPartie}", name="afficher_partie")
     */
    public function afficherPartie(CarteRepository $carteRepository, Partie $idPartie)
    {
        $cartes = $carteRepository->findAll();
        $tcartes = [];
        foreach($cartes as $carte){
            $tcartes[$carte->getId()] = $carte;
        }

        return $this->render('partie/afficher-partie.html.twig', [
            'partie' => $idPartie,
            'cartes' => $tcartes
        ]);
    }
}
