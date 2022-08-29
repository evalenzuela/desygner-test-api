<?php

namespace App\Service\Stock;

use App\Entity\Stock;
use App\Repository\StockRepository;
use App\Service\Request\RequestService;
use Doctrine\ORM\Exception\ORMException;
use Symfony\Component\HttpFoundation\Request;

class StockCreateService
{

    private StockRepository $stockRepository;

    public function __construct(StockRepository $stockRepository)
    {
        $this->stockRepository = $stockRepository;
    }

    public function create(Request $request): Stock
    {
        $url = RequestService::getField($request, 'url', true);

        $stock = new Stock();
        $stock->setUrl($url);

        $this->stockRepository->add($stock);

        return $stock;
    }
}
