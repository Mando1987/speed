<?php 

namespace App\Services;

use Intervention\Image\Image;
use Illuminate\Http\UploadedFile;

class LocalUploadFileService

{
    private $file, $file_name;
    
    public function __construct($file)
    {
        $this->file = $file;

    }

    public function save($path)
    {
       $this->file->storeAs($path, $this->generateFileName());
       return $this;
    }

    protected function generateFileName()
    {
       return $this->file_name = $this->file->hashName();
    }

    public function getFileName()
    {
       return $this->file_name;
    }

    private function resizeFile()
    {
        return Image->make($this->file)->resize(100, 100);
    }
}