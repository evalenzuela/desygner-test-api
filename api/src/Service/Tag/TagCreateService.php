<?php

namespace App\Service\Tag;

use App\Entity\Tag;
use App\Exception\Tag\TagAlreadyExistsException;
use App\Repository\TagRepository;
use App\Service\Request\RequestService;
use Doctrine\ORM\Exception\ORMException;
use Symfony\Component\HttpFoundation\Request;

class TagCreateService
{

    private TagRepository $tagRepository;

    public function __construct(TagRepository $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }

    public function create(Request $request): Tag
    {
        $name = RequestService::getField($request, 'name', true);

        $tag = new Tag();
        $tag->setName($name);

        try {
            $this->tagRepository->add($tag);
        } catch (ORMException $e) {
            throw TagAlreadyExistsException::fromName($name);
        }

        return $tag;
    }
}
