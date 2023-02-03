<?php


namespace App\Traits;

trait ReturnNameFile {

    public function nameFile (string $file) {

        $position = strpos($file, '.');
        $newName = substr($file, 0, $position);

        return $newName;

    }

}
