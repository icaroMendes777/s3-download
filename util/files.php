<?php

function createDirectoryIfNotExists($dirPath)
{
    // Check if the directory exists
    if (!file_exists($dirPath)) {
        // Directory does not exist, create it
        if (!mkdir($dirPath, 0777, true)) {
            // Failed to create directory
            return "Failed to create directory: $dirPath";
        }
        return "Directory created: $dirPath";
    } else {
        // Directory already exists
        return "Directory already exists: $dirPath";
    }
}
