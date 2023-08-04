<?php

namespace app\src\FileUpload\Dto;

use app\src\FileUpload\Form\FileUploadForm;
use yii\web\UploadedFile;

class FileUploadDto
{
    private string $hash;
    private string $name;
    private string $description;
    private ?UploadedFile $file;
    private string $created_at;

    /**
     * @param string $hash
     * @param string $name
     * @param string $description
     * @param UploadedFile|null $file
     * @param string $created_at
     */
    public function __construct(
        string $hash,
        string $name,
        string $description,
        ?UploadedFile $file,
        string $created_at
    )
    {
        $this->hash = $hash;
        $this->name = $name;
        $this->description = $description;
        $this->file = $file;
        $this->created_at = $created_at;
    }

    public static function fromRequest(FileUploadForm $request): FileUploadDto
    {
        return new FileUploadDto(
            hash('sha256', $request->file->name),
            $request->name,
            $request->description,
            $request->file,
            date('Y-m-d H:i:s')
        );
    }

    /**
     * @return string
     */
    public function getHash(): string
    {
        return $this->hash;
    }

    public function setHash(string $hash): void
    {
        $this->hash = $hash;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return UploadedFile|null
     */
    public function getFile(): ?UploadedFile
    {
        return $this->file;
    }

    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->created_at;
    }
}