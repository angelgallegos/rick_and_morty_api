<?php

namespace App\Controller\Api\Places;

use App\Filter\Places\CharactersFilter;
use App\Service\Places\LocationService;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations\View as ViewAnnotation;

class LocationController extends AbstractFOSRestController
{

    /**
     * @var LocationService
     */
    private LocationService $locationService;

    public function __construct(LocationService $locationService)
    {
        $this->locationService = $locationService;
    }

    /**
     * @Rest\Get("/locations")
     * @ViewAnnotation(serializerGroups={"response"})
     * @param Request $request
     * @return View
     */
    public function request(Request $request): View
    {
        $filter = new CharactersFilter();
        $filter->setDimension("Dimension C-137");

        $locations = $this->locationService->filter($filter);

        if (!$locations)
            return View::create([], Response::HTTP_NOT_FOUND);

        return View::create($locations->getAllResidents(), Response::HTTP_OK);
    }
}