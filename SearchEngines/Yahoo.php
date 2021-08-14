<?php
require_once __DIR__.'/SearchEngine.php';
class Yahoo extends SearchEngine {
    protected string $staticUrl = "https://search.yahoo.com/search?p={{keyword}}";

    public function parse() {
        foreach($this->html->find('a') as $a) {
            if ($a->class === 'ac-algo fz-l ac-21th lh-24' and !empty($a->innertext)
                and !empty($a->getAttribute('href'))) {
                array_push($this->probeLinks, [
                    'text' => $a->innertext,
                    'href' => urldecode($a->getAttribute('href'))
                ]);
            }
        }
    }
}
