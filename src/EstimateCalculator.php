<?php

declare(strict_types=1);

namespace johnykvsky\Utils;

class EstimateCalculator
{
    /**
     * @var float $optimistic Optimistic calculation
     */
    public $optimistic = 1;

    /**
     * @var float $pessimistic Pessimistic calculation
     */
    public $pessimistic = 1;

    /**
     * @var float $mostLikely Most likley calculation
     */
    public $mostLikely = 1;

    /**
     * Constructor.
     *
     * @param float|int $optimistic
     * @param float|int $pessimistic
     * @param float|int $mostLikely
     *
     * @return void
     */
    public function __construct($optimistic = 1, $pessimistic = 1, $mostLikely = 1)
    {
        $this->setValuesForCalculation($optimistic, $pessimistic, $mostLikely);
    }

    /**
     * Set all values required for calculation.
     *
     * @param float|int $optimistic
     * @param float|int $pessimistic
     * @param float|int $mostLikely
     *
     * @return void
     */
    public function setValuesForCalculation($optimistic, $pessimistic, $mostLikely): void
    {
        $this->optimistic = (float)$optimistic;
        $this->pessimistic = (float)$pessimistic;
        $this->mostLikely = (float)$mostLikely;
    }

    /**
     * Get 68% accuracy.
     *
     * @return float
     */
    public function get68accuracy(): float
    {
        $accuracy = $this->getApproximation() + $this->getStandardDeviation();
        return round($accuracy, 2, PHP_ROUND_HALF_UP);
    }

    /**
     * Get basic approximation.
     *
     * @return float
     */
    public function getApproximation(): float
    {
        $approximation = ($this->optimistic + 4 * $this->mostLikely + $this->pessimistic) / 6;
        return round($approximation, 2, PHP_ROUND_HALF_UP);
    }

    /**
     * Get standard deviation value.
     *
     * @return float
     */
    public function getStandardDeviation(): float
    {
        $sDeviation = ($this->optimistic + $this->pessimistic) / 6;
        return round($sDeviation, 2, PHP_ROUND_HALF_UP);
    }

    /**
     * Get 90% accuracy.
     *
     * @return float
     */
    public function get90accuracy(): float
    {
        $accuracy = $this->getApproximation() + 1.6 * $this->getStandardDeviation();
        return round($accuracy, 2, PHP_ROUND_HALF_UP);
    }
}
