<?php
namespace App;

use App\Report;


class Search {
    private $name = 0;
    private $short = 0;
    private $full = 0;
    public $origin;

    public function __construct(Report $origin, string $search) {
        $this->origin = $origin;
        $this->setRanks($search);
    }

    public function getNameRankAmount()
    {
        return $this->name;
    }

    public function getShortTextRankAmount()
    {
        return $this->short;
    }

    public function getFullTextRankAmount()
    {
        return $this->full;
    }

    private function setRanks(string $search)
    {
        $this->name = $this->getRankFor($this->origin->name, $search);
        $this->short = $this->getRankFor($this->origin->short_report_text, $search);
        $this->full = $this->getRankFor($this->origin->full_report_text, $search);
    }

    private function getRankFor(string $text, string $search)
    {
        return substr_count($text, $search);
    }

    private function higlight()
    {

    }





}