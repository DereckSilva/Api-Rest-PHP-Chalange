<?php


namespace App\Traits;

trait ReturnNameFile {

    public function nameFile (string $file, $delimiter) {

        $position = strpos($file, $delimiter);
        $newName = substr($file, 0, $position);

        return $newName;

    }

}
