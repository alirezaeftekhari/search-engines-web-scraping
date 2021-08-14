<?php
class Comparison {
    public function __construct(array &$googleList, array &$yahooList, array &$bingList)
    {
        $this->googleAndYahooComparison($googleList,$yahooList);
        $this->googleAndBingComparison($googleList,$bingList);
        $this->yahooAndBingComparison($yahooList,$bingList);
    }

    public function googleAndYahooComparison(array &$googleList, array &$yahooList) {
        for ($i = 0; $i < count($googleList); $i++) {
            for($j = 0; $j < count($yahooList); $j++) {
                if(strpos($googleList[$i]['href'], $yahooList[$j]['href']) !== false) {
                    $googleList[$i]['yahoo'] = $j + 1;
                    $yahooList[$j]['google'] = $i + 1;
                    break;
                }
            }
        }
    }

    public function googleAndBingComparison(array &$googleList, array &$bingList) {
        for ($i = 0; $i < count($googleList); $i++) {
            for($j = 0; $j < count($bingList); $j++) {
                if(strpos($googleList[$i]['href'], $bingList[$j]['href']) !== false) {
                    $googleList[$i]['bing'] = $j + 1;
                    $bingList[$j]['google'] = $i + 1;
                    break;
                }
            }
        }
    }

    public function yahooAndBingComparison(array &$yahooList, array &$bingList) {
        for ($i = 0; $i < count($yahooList); $i++) {
            for($j = 0; $j < count($bingList); $j++) {
                if(strpos($yahooList[$i]['href'], $bingList[$j]['href']) !== false) {
                    $yahooList[$i]['bing'] = $j + 1;
                    $bingList[$j]['yahoo'] = $i + 1;
                    break;
                }
            }
        }
    }

}