<?php

namespace App\Api\Action\Stock;

use App\Entity\Stock;
use App\Service\Stock\StockUploadService;
use Symfony\Component\HttpFoundation\Request;

class Upload
{

    private StockUploadService $stockCreateService;

    public function __construct(StockUploadService $stockUploadService)
    {
        $this->stockUploadService = $stockUploadService;
    }

    public function __invoke(Request $request): Stock
    {
        return $this->stockUploadService->create($request);
    }
}
