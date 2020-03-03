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
     * @var float $pesimistic Pesimistic calculation
     */
    public $pesimistic = 1;

    /**
     * @var float $mostLikely Most likley calculation
     */
    public $mostLikely = 1;

    /**
      * Constructor.
      *
      * @param float|int $optimistic
      * @param float|int $pesimistic
      * @param float|int $mostLikely
      *
      * @return void
      */
    public function __construct($optimistic = 1, $pesimistic = 1, $mostLikely = 1)
    {
        $this->setValuesForCalculation($optimistic, $pesimistic, $mostLikely);
    }

    /**
      * Set all values required for calculation.
      *
      * @param float|int $optimistic
      * @param float|int $pesimistic
      * @param float|int $mostLikely
      *
      * @return void
      */
    public function setValuesForCalculation($optimistic, $pesimistic, $mostLikely): void
    {
        $this->optimistic = floatval($optimistic);
        $this->pesimistic = floatval($pesimistic);
        $this->mostLikely = floatval($mostLikely);
    }

    /**
      * Get basic approximation.
      *
      * @return float
      */
    public function getApproximation(): float
    {
        $approximation = ($this->optimistic + 4 * $this->mostLikely + $this->pesimistic) / 6;
        return round($approximation, 2, PHP_ROUND_HALF_UP);
    }

    /**
      * Get standard deviation value.
      *
      * @return float
      */
    public function getStandardDeviation(): float
    {
        $sDeviation = ($this->optimistic + $this->pesimistic) / 6;
        return round($sDeviation, 2, PHP_ROUND_HALF_UP);
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
