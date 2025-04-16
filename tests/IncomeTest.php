<?php

declare(strict_types=1);

namespace Bimer\Test;

use Bimer\Income;
use Bimer\Test\DataServices\BatchData;
use Bimer\Test\DataServices\IncomeData;

class IncomeTest extends ResourceTest
{
    public function setUp(): void
    {
        $this->resource = Income::class;
    }

    public function testCreateIncome()
    {
        $incomeData = IncomeData::get();

        $incomeId = Income::create($incomeData);

        $this->assertNotEmpty($incomeId);
    }

    public function testGetIncomeById()
    {
        $incomeData = IncomeData::get();

        $incomeId = Income::create($incomeData);

        $income = $this->resource::find($incomeId);

        $this->assertObjectHasProperty('Identificador', $income);
    }

    public function testMakeIncomeBatch()
    {
        $incomeData = IncomeData::get();

        $incomeId = Income::create($incomeData);

        $batchData = BatchData::get();

        $batchData["LoteAReceberItemBaixa"][0]->IdentificadorTituloAReceber = $incomeId;
        $batch = Income::makeBatch($batchData);

        $this->assertObjectHasProperty('IdentificadorLoteAReceber', $batch);
    }
}
