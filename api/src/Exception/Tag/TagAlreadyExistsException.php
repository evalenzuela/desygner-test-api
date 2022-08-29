<?php

namespace App\Exception\Tag;

use Symfony\Component\HttpKernel\Exception\ConflictHttpException;

class TagAlreadyExistsException extends ConflictHttpException
{

    private const MESSAGE = 'Tag with name %s already exists';

    public static function fromName(string $name): self
    {
        throw new self(\sprintf(self::MESSAGE, $name));
    }
}
