<?php
class Suggestions {
    private float $googleScore = 92.54;
    private float $bingScore = 2.44;
    private float $yahooScore = 1.64;

    private int $scoreNumber = 11;

    private array $suggestions = [];

    private function duplicateHref($href): bool {
        foreach ($this->suggestions as $suggest) {
            if(strpos($suggest['href'], $href) !== false) {
                return false;
            }
        }
        return true;
    }

    private function scoreComputing() {
        foreach ($this->suggestions as &$suggestion) {
            $score = 0;
            if(isset($suggestion['google'])) {
                $score += ($this->scoreNumber - $suggestion['google']) * $this->googleScore;
            }
            if(isset($suggestion['bing'])) {
                $score += ($this->scoreNumber - $suggestion['bing']) * $this->bingScore;
            }
            if(isset($suggestion['yahoo'])) {
                $score += ($this->scoreNumber - $suggestion['yahoo']) * $this->yahooScore;
            }
            $suggestion['score'] = $score;
        }
    }

    private function sortByScore() {
        usort($this->suggestions, function ($sug1, $sug2) {
            return $sug1['score'] < $sug2['score'];
        });
    }

    public function __construct(array &$googleList, array &$yahooList, array &$bingList)
    {
        //in all serach engines
        foreach ($googleList as $index => $google) {
            if(isset($google['yahoo']) and isset($google['bing'])) {
                array_push($this->suggestions, [
                    'text' => $google['text'],
                    'href' => $google['href'],
                    'google' => $index + 1,
                    'yahoo' => $google['yahoo'],
                    'bing' => $google['bing']
                ]);
            }
        }
        //in google and bing
        foreach ($googleList as $index => $google) {
            if(isset($google['bing']) and $this->duplicateHref($google['href'])) {
                array_push($this->suggestions, [
                    'text' => $google['text'],
                    'href' => $google['href'],
                    'google' => $index + 1,
                    'bing' => $google['bing']
                ]);
            }
        }
        //in google and yahoo
        foreach ($googleList as $index => $google) {
            if(isset($google['yahoo']) and $this->duplicateHref($google['href'])) {
                array_push($this->suggestions, [
                    'text' => $google['text'],
                    'href' => $google['href'],
                    'google' => $index + 1,
                    'yahoo' => $google['yahoo']
                ]);
            }
        }
        //in bing and yahoo
        foreach ($bingList as $index => $bing) {
            if(isset($bing['yahoo']) and $this->duplicateHref($bing['href'])) {
                array_push($this->suggestions, [
                    'text' => $bing['text'],
                    'href' => $bing['href'],
                    'bing' => $index + 1,
                    'yahoo' => $bing['yahoo']
                ]);
            }
        }
        //score computing
        $this->scoreComputing();
        //sort by score
        $this->sortByScore();
    }
    public function getSuggestions(): array {
        return $this->suggestions;
    }
}