<?php

namespace johnykvsky\Utils;

class EstimateCalculator
{
    /**
     * @var integer|float Optimistic calculation
     */
    public $optimistic = 1;

    /**
     * @var integer|float Pesimistic calculation
     */
    public $pesimistic = 1;

    /**
     * @var integer|float Most likley calculation
     */
    public $mostLikely = 1;

    /**
      * Constructor.
      *
      * @param float $optimistic
      * @param float $pesimistioc
      * @param float $mostLikley
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
      * @param float $optimistic
      * @param float $pesimistioc
      * @param float $mostLikley
      *
      * @return void
      */
    public function setValuesForCalculation($optimistic, $pesimistic, $mostLikely)
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
    public function getApproximation()
    {
        $approximation = ($this->optimistic + 4 * $this->mostLikely + $this->pesimistic) / 6;
        return round($approximation, 2, PHP_ROUND_HALF_UP);
    }

    /**
      * Get standard deviation value.
      *
      * @return float
      */
    public function getStandardDeviation()
    {
        $sDeviation = ($this->optimistic + $this->pesimistic) / 6;
        return round($sDeviation, 2, PHP_ROUND_HALF_UP);
    }

    /**
      * Get 68% accuracy.
      *
      * @return float
      */
    public function get68accuracy()
    {
        $accuracy = $this->getApproximation() + $this->getStandardDeviation();
        return round($accuracy, 2, PHP_ROUND_HALF_UP);
    }

    /**
      * Get 90% accuracy.
      *
      * @return float
      */
    public function get90accuracy()
    {
        $accuracy = $this->getApproximation() + 1.6 * $this->getStandardDeviation();
        return round($accuracy, 2, PHP_ROUND_HALF_UP);
    }
}
