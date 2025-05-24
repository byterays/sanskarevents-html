<?php

function listFilesWithDetails($directory)
{
	$result = [];

	// Normalize base path
	$basePath = rtrim($directory, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;

	$iterator = new RecursiveIteratorIterator(
		new RecursiveDirectoryIterator($directory, RecursiveDirectoryIterator::SKIP_DOTS)
	);

	foreach ($iterator as $fileInfo) {
		if ($fileInfo->isFile()) {
			$fullPath = $fileInfo->getPathname();
			$relativePath = str_replace($basePath, '', $fullPath);
			$fileName = $fileInfo->getFilename();
			$category = dirname($relativePath);

			$result[] = [
				'file_path' => str_replace('\\', '/', $relativePath), // Normalize for Windows
				'file_name' => $fileName,
				'category' => str_replace('\\', '/', $category)
			];
		}
	}

	return $result;
}

// Example usage
$folder = '../gallery/'; // replace with your actual folder
$files = listFilesWithDetails($folder);


// Output as JSON (optional)
header('Content-Type: application/json');
echo json_encode($files, JSON_PRETTY_PRINT);
?>