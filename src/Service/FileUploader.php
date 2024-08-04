<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;

class FileUploader {

    public function __construct(
        private string $targetDirectory,
        private SluggerInterface $slugger
    ) {
        // ...
    }

    public function upload(UploadedFile $file): string {

        // $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        // safe inclusion of the file name in the URL
        // $safeFilename = $this->slugger->slug($originalFilename);
        // generate a unique name and let symfony guess the right extension for don't trust the input provided by user
        $file->getError();
        $newFilename = md5(uniqid()).'.'.$file->guessExtension();

        try {
            // moving file chere pictures are stored
            $file->move($this->getTargetDirectory(), $newFilename);
        } catch (FileException $fileError) {
            echo 'Erreur lors du téléchargement du fichier';
            throw $fileError;
        }

        return $newFilename;
    }

    public function getTargetDirectory(): string {

        return $this->targetDirectory;
    }
}