<?php

namespace App\Api\Action\Tag;

use App\Entity\Tag;
use App\Service\Tag\TagCreateService;
use Symfony\Component\HttpFoundation\Request;

class Create
{
    private TagCreateService $tagCreateService;

    public function __construct(TagCreateService $tagCreateService)
    {
        $this->tagCreateService = $tagCreateService;
    }

    public function __invoke(Request $request): Tag
    {
        return $this->tagCreateService->create($request);
    }
}
