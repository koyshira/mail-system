<?php
function loadEmailTemplate($template, $data) {
    // Define the path to the templates directory
    $templatesDirectory = __DIR__ . '/../templates/';

    // Construct the full path to the template file
    $templateFile = $templatesDirectory . $template . '.html';

    // Check if the template file exists
    if (file_exists($templateFile)) {
        // Read the HTML content from the template file
        $content = file_get_contents($templateFile);

        // Replace placeholders in the template with actual data
        foreach ($data as $key => $value) {
            $content = str_replace("{{$key}}", $value, $content);
        }

        return $content;
    } else {
        // Template file not found
        return 'Template not found';
    }
}
