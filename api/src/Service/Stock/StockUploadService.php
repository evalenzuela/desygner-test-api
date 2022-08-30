<?php

namespace App\Service\Stock;

use App\Entity\Stock;
use App\Repository\StockRepository;
use App\Service\Request\RequestService;
use Symfony\Component\HttpFoundation\Request;

class StockUploadService
{

    private StockRepository $stockRepository;

    public function __construct(StockRepository $stockRepository)
    {
        $this->stockRepository = $stockRepository;
    }

    public function upload(Request $request, Stock $stock): Stock
    {
        $url = RequestService::getField($request, 'url', true);

        $stock = new Stock();
        $stock->setUrl($url);

        $this->stockRepository->add($stock);

        return $stock;
    }
}
