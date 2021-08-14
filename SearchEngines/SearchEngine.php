<?php
require_once __DIR__.'/Assets/simple_html_dom.php';

abstract class SearchEngine {
    protected string $staticUrl;
    protected string $keyword;
    protected array $probeLinks = [];
    protected simple_html_dom $html;

    public function __construct($keyword) {
        $this->keyword = urlencode(trim($keyword));
        $this->html = file_get_html(str_replace('{{keyword}}', $this->keyword, $this->staticUrl));
        $this->parse();
    }

    public function parse() {}

    public function getLinks(): array {
        return $this->probeLinks;
    }
}