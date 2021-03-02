<?php

namespace app\services;

class Autoloader
{


    public function loadClass(string $className): bool
    {
        $rootDir = __DIR__ . "/../";
        $className = str_replace('app\\', $rootDir, $className);
        $filename = realpath($className . ".php");

        if (file_exists($filename)) {
            include $filename;
            return true;
        }

        return false;
    }
}
