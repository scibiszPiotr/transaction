<?php

namespace App;

use App\DTO\TransactionCollection;
use App\DTO\TransactionDTO;

class LoadInputFile
{
    public static function load(string $fileName): TransactionCollection
    {
        $fileContent = file_get_contents($fileName);

        $collection = new TransactionCollection();
        foreach (explode("\n", $fileContent) as $line) {
            if (empty($line)) {
                continue;
            }

            $raw = json_decode($line, true);
            $collection->add(new TransactionDTO($raw['bin'], $raw['amount'], $raw['currency']));
        }

        return $collection;
    }
}