<?php

namespace App\Core;

class DotEnv
{
    public static function load(string $path): bool {
        if (!file_exists($path) || !is_readable($path)) {
            echo "Failed to load config.";
            return false;
        }

        $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach($lines as $line) {
            if (strpos(trim($line), '#') === 0) {
                continue;
            }

            putenv($line);
        }

        return true;
    }
}