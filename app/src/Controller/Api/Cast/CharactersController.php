<?php
declare(strict_types=1);
namespace App\Controller\Api\Cast;

use App\Client\RickAndMorty\Request\Exceptions\RequestException;
use App\Filter\Cast\CharactersFilter;
use App\Service\Cast\CharactersService;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use __\__;

class CharactersController extends AbstractFOSRestController
{
    /**
     * @var CharactersService
     */
    public CharactersService $charactersService;

    public ValidatorInterface $validator;

    public function __construct(
        CharactersService $charactersService,
        ValidatorInterface $validator
    ) {
        $this->charactersService = $charactersService;
        $this->validator = $validator;
    }

    /**
     * @Rest\Post("/characters")
     * @ParamConverter("filter", converter="fos_rest.request_body")
     * @param CharactersFilter $filter
     * @return View
     */
    public function filter(CharactersFilter $filter): View
    {
        $errors = $this->validator->validate($filter);

        if (!__::isEmpty($errors)) {
            return View::create($errors, Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $characters = null;

        try {
            $characters = $this->charactersService->lists($filter);
        } catch (RequestException $e) {
            return View::create([
                "message" => "Something went wrong with the request"
            ], Response::HTTP_BAD_REQUEST);
        }

        if (!$characters)
            return View::create([
                "message" => "Resource not found"
            ], Response::HTTP_NOT_FOUND);

        return View::create($characters->all(), Response::HTTP_OK);
    }
}