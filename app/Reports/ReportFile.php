<?php
declare(strict_types = 1);
namespace App\Reports;

use \Illuminate\Http\UploadedFile;

// TODO check out which methods has to me private and which of them might still protected
class ReportFile
{
    private $file;
    private $path;

    public function __construct(UploadedFile $file, string $report_name)
    {
        $this->file = $file;
        $this->path = $this->save($this->getPreparedString($report_name, true)
        );
    }

    protected function save(string $prepared_name): string
    {
        $file_name = $this->file->getClientOriginalName();
        $file_name = $this->getPreparedString($file_name);
        return $this->file->storeAs($this->getPath($prepared_name), $file_name);
    }

    protected function getPath(string $report_name): string
    {

        return "reports/${report_name}";
    }

    public function getFullPath()
    {
        return $this->path;
    }

    /**
     * Replace spaces with underscores and cut it to 20 symbols
     * @param string $str
     * @param bool $cut reduce string
     * @return bool|string
     */
    private function getPreparedString(string $str, bool $cut = false): string
    {
        $str = trim($str);
        $str = strtolower($str);
        $str = str_replace(' ', '_', $str);
        $str = transliterator_transliterate('Russian-Latin/BGN', $str);
        return $cut ? substr($str, 0, 20) : $str;
    }


    public function getFileContent(): string
    {
        $file_content = new DocxConversion($this->path);
        return $file_content->convertToText();
    }


}