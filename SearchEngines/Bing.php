<?php
require_once __DIR__.'/SearchEngine.php';
class Bing extends SearchEngine {
    protected string $staticUrl = "https://www.bing.com/search?q={{keyword}}&qs=HS&sk=PRES1&sc=5-0&cvid=E323594EE0D7486BAFF8C772BA938569&FORM=QBLH&sp=1";

    public function parse() {
        foreach($this->html->find('li') as $li) {
            if ($li->class === 'b_algo') {
                $a = $li->first_child()->first_child();
                $span = $a->first_child();
                if(!empty($span->innertext) and !empty($a->getAttribute('href'))) {
                    array_push($this->probeLinks, [
                        'text' => $span->innertext,
                        'href' => urldecode($a->getAttribute('href'))
                    ]);
                }
            }
        }
    }
}
