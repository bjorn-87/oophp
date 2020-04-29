<?php

namespace Bjos\Dice100;

/**
 * Generating histogram data.
 */
class Histogram
{
    /**
     * @var array $serie  The numbers stored in sequence.
     * @var int   $min    The lowest possible number.
     * @var int   $max    The highest possible number.
     */
    private $serie = [];
    private $min;
    private $max;


    /**
     * Get the serie.
     *
     * @return array with the serie.
     */
    public function getSerie()
    {
        return $this->serie;
    }

    /**
     * Return a string with a textual representation of the histogram.
     *
     * @return string representing the histogram.
     */
    public function getAsText()
    {
        $hist = "";
        $star = "*";
        $roundHist = array_count_values($this->serie);

        for ($i = $this->min; $i <= $this->max; $i++) {
            if (!isset($roundHist[$i])) {
                $roundHist[$i] = 0;
            }
        }

        ksort($roundHist);

        foreach ($roundHist as $key => $value) {
            $stars = str_repeat($star, $value);
            $hist .= "<p>{$key} : {$stars}</p>";
        }
        return $hist;
    }


    /**
     * Inject the object to use as base for the histogram data.
     *
     * @param HistogramInterface $object The object holding the serie.
     *
     * @return void.
     */
    public function injectData(HistogramInterface $object)
    {
        foreach ($object->getHistogramSerie() as $value) {
            array_push($this->serie, $value);
        }
        // $this->serie = $object->getHistogramSerie();
        $this->min = $object->getHistogramMin();
        $this->max = $object->getHistogramMax();
    }
}
