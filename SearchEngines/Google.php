<?php
require_once __DIR__.'/SearchEngine.php';
class Google extends SearchEngine {
    protected string $staticUrl = "https://www.google.com/search?q={{keyword}}";

    private function urlParser($url): string {
        $url = explode('&amp;', $url)[0];
        return urldecode(str_replace('/url?q=', '', $url));
    }
    public function parse() {
        foreach($this->html->find('div') as $div) {
            if ($div->class === 'ZINbbc xpd O9g5cc uUPGi') {
                foreach($div->find('h3') as $h3) {
                    if($h3->class === 'zBAuLc' and !empty($h3->parent()->getAttribute('href'))
                        and !empty($h3->first_child ()->innertext)) {
                        array_push($this->probeLinks, [
                            'text' => $h3->first_child ()->innertext,
                            'href' => $this->urlParser($h3->parent()->getAttribute('href'))
                        ]);
                    }
                }
            }
        }
    }
}
