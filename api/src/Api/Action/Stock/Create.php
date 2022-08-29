<?php

namespace App\Api\Action\Stock;

use App\Entity\Stock;
use App\Service\Stock\StockCreateService;
use Symfony\Component\HttpFoundation\Request;

class Create
{

    private StockCreateService $stockCreateService;

    public function __construct(StockCreateService $stockCreateService)
    {
        $this->stockCreateService = $stockCreateService;
    }

    public function __invoke(Request $request): Stock
    {
        return $this->stockCreateService->create($request);
    }
}
