<?php

namespace App\helpers;

class FileUploader {

    public static function handleImageUpload($file) {
        // Check if a file was uploaded
        if (!isset($file['name']) || $file['error'] !== UPLOAD_ERR_OK) {
            return [
                'success' => false,
                'message' => 'Error uploading file.'
            ];
        }

        // Define allowed file types (e.g., JPG, JPEG, PNG, GIF)
        $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif'];

        // Get file information
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_file($finfo, $file['tmp_name']);
        finfo_close($finfo);

        // Check file type
        if (!in_array($mimeType, $allowedMimeTypes)) {
            return [
                'success' => false,
                'message' => 'Only JPG, JPEG, PNG, and GIF files are allowed.'
            ];
        }

        // Define the upload directory (relative to the root)
        $uploadDir = 'uploads/images/';

        // Get the absolute path to the root directory
        $rootDir = $_SERVER['DOCUMENT_ROOT'];

        // Construct the full path to the upload directory
        $fullUploadDir = $rootDir . '/youdemy/' . $uploadDir;

        // Create the upload directory if it doesn't exist
        if (!is_dir($fullUploadDir)) {
            if (!mkdir($fullUploadDir, 0755, true)) { // 0755: Read, write, execute for owner, read and execute for group and others
                return [
                    'success' => false,
                    'message' => 'Failed to create upload directory: ' . error_get_last()['message']
                ];
            }
        }

        // Generate a unique filename (optional)
        $fileName = uniqid() . '_' . basename($file['name']);

        // Define the full target path
        $targetFile = $fullUploadDir . $fileName;

        // Move the uploaded file to the destination
        if (move_uploaded_file($file['tmp_name'], $targetFile)) {
            return [
                'success' => true,
                'message' => 'File uploaded successfully.',
                'path' => $uploadDir . $fileName // Return relative path for consistency
            ];
        } else {
            return [
                'success' => false,
                'message' => 'Error moving uploaded file.'
            ];
        }
    }
}
