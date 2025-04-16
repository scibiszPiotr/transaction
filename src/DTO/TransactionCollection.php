<?php

namespace App\DTO;

use ArrayIterator;
use Countable;
use IteratorAggregate;
use Traversable;

class TransactionCollection implements IteratorAggregate, Countable
{
    /** @var TransactionDTO[] */
    private array $transactions = [];

    public function add(TransactionDTO $transaction): void
    {
        $this->transactions[] = $transaction;
    }

    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->transactions);
    }

    public function count(): int
    {
        return count($this->transactions);
    }

    public function first(): ?TransactionDTO
    {
        foreach ($this as $item) {
            return $item;
        }

        return null;
    }
}