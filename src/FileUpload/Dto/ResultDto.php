<?php

namespace app\src\FileUpload\Dto;

use app\models\File;

final class ResultDto
{
    private string $message;
    private ?File $model;
    private ?int $status;

    /**
     * @param string $message
     * @param File|null $model
     * @param int|null $status
     */
    public function __construct(
        string $message,
        ?File $model,
        ?int $status = null
    )
    {
        $this->message = $message;
        $this->model = $model;
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @return ?File
     */
    public function getModel(): ?File
    {
        return $this->model;
    }

    /**
     * @return int|null
     */
    public function getStatus(): ?int
    {
        return $this->status;
    }
}