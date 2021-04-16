<?php

declare(strict_types=1);

namespace App\Domain\Utils;

use ArrayIterator;
use Countable;
use IteratorAggregate;

use function App\Utils\array_find;
use function App\Utils\array_find_key;
use function Safe\usort;
use function array_values;
use function array_reduce;
use function array_map;
use function array_filter;
use function array_shift;
use function count;
use function array_walk;

/**
 * @template T
 */
final class Liste implements Countable, IteratorAggregate
{
    /**
     * @var array<int, T>
     */
    private array $array;

    /**
     * @param T[] $array
     */
    public function __construct(array $array)
    {
        $this->array = array_values($array);
    }

    /**
     * @template U
     * @param callable(U, T): U $reducer
     * @phpstan-param U $initial
     * @phpstan-return U
     */
    public function reduce(callable $reducer, mixed $initial): mixed
    {
        return array_reduce($this->array, $reducer, $initial);
    }

    /**
     * @template U
     * @param callable(T): U $map
     * @return self<U>
     */
    public function map(callable $map): self
    {
        return new self(array_map($map, $this->array));
    }

    /**
     * @param callable(T): bool $shouldStay
     * @return self<T>
     */
    public function filter(callable $shouldStay): self
    {
        return new self(array_filter($this->array, $shouldStay));
    }

    public function vide(): bool
    {
        return $this->array === [];
    }

    /**
     * @param callable(T): bool $matches
     * @phpstan-return  T|null
     */
    public function find(callable $matches): mixed
    {
        return array_find($this->array, $matches);
    }

    public function findKey(callable $matches): ?int
    {
        return array_find_key($this->array, $matches);
    }

    /**
     * @param callable(T):bool $matches
     */
    public function hasOneThat(callable $matches): bool
    {
        return $this->find($matches) !== null;
    }

    /**
     * @return array{T|null, self<T>}
     */
    public function shift(): array
    {
        $array = $this->array;
        $element = array_shift($array);
        return [$element, new self($array)];
    }

    /**
     * @phpstan-return T|null
     */
    public function premierElement(): mixed
    {
        return $this->array[0] ?? null;
    }

    /**
     * @phpstan-param T $newElement
     * @return self<T>
     */
    public function addElement(mixed $newElement): self
    {
        return new self([...$this->array, $newElement]);
    }

    /**
     * @template U
     * @phpstan-param self<U> $that
     * @return self<T | U>
     */
    public function mergeWith(self $that): self
    {
        return new self([...$this->array, ...$that->array]);
    }

    /**
     * @return callable(self<mixed>, self<mixed>): self<mixed>
     */
    public static function fnEt(): callable
    {
        return function (Liste $a, Liste $b) {
            /**
             * @var Liste<mixed> $a
             * @var Liste<mixed> $b
             */
            return $a->mergeWith($b);
        };
    }

    /**
     * @param callable(T, T): int $compare
     * @return self<T>
     */
    public function sort(callable $compare): self
    {
        $array = $this->array;
        usort($array, $compare);
        return new self($array);
    }

    /**
     * @param callable(T): bool $vraisPourElement
     */
    public function vraisPourChaque(callable $vraisPourElement): bool
    {
        return $this->reduce(
            fn (bool $vraisPourChaque, $element) => $vraisPourChaque && $vraisPourElement($element),
            true
        );
    }

    public function count(): int
    {
        return count($this->array);
    }

    /**
     * @return array<int, mixed>
     */
    public function toArray(): array
    {
        return $this->array;
    }

    /**
     * @phpstan-return T
     */
    public function get(int $index): mixed
    {
        return $this->array[$index];
    }

    /**
     * @phpstan-param T $with
     */
    public function set(int $key, mixed $with): self
    {
        return new self([$key => $with] + $this->array);
    }

    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->array);
    }

    /**
     * @param callable(T): mixed $do
     */
    public function forEach(callable $do): void
    {
        array_walk($this->array, $do);
    }
}
