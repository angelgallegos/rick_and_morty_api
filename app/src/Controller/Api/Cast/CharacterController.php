<?php
declare(strict_types=1);
namespace App\Controller\Api\Cast;

use App\Service\Cast\CharacterService;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Controller\Annotations\View as ViewAnnotation;
use Symfony\Component\HttpFoundation\Response;

class CharacterController extends AbstractFOSRestController
{
    /**
     * @var CharacterService
     */
    private CharacterService $characterService;

    public function __construct(CharacterService $characterService)
    {
        $this->characterService = $characterService;
    }

    /**
     * @Rest\Get("/character/{id}")
     * @param int $id
     * @return View
     */
    public function getCharacter(int $id): View
    {
        $character = $this->characterService->get($id);

        if (!$character)
            return View::create([], Response::HTTP_NOT_FOUND);

        return View::create($character, Response::HTTP_OK);
    }

    /**
     * @Rest\Get("/character/{name}/name")
     * @ViewAnnotation(serializerGroups={"request"})
     * @param string $name
     * @return View
     */
    public function getByName(string $name): View
    {
        $character = $this->characterService->findByName($name);

        if (!$character)
            return View::create([], Response::HTTP_NOT_FOUND);

        return View::create($character, Response::HTTP_OK);
    }
}