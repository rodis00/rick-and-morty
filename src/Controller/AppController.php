<?php

namespace App\Controller;

use App\Service\CharacterService;
use App\Service\HttpService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AppController extends AbstractController
{
    public function __construct(
        private HttpService $httpService,
        private CharacterService $characterService
    ) {}

    #[Route("")]
    public function index(): Response
    {
        return $this->redirect('characters/1');
    }

    #[Route('characters/{id}')]
    public function characters(int $id): Response
    {
        $data = $this->httpService->getCharacterPage($id);

        $next = $data['info']['next'];
        $prev = $data['info']['prev'];

        if ($next != null) {
            $next = $next[strlen($next) - 1];
        }

        if ($prev != null) {
            $prev = $prev[strlen($prev) - 1];
        }

        $characters = $this->characterService->getCharactersInfo($data['results']);

        return $this->render('characters/characters.html.twig', [
            'next' => $next,
            'prev' => $prev,
            'characters' => $characters
        ]);
    }
}
