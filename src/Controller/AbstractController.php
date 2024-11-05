<?php

namespace App\Controller;

abstract class AbstractController
{
    public function __construct()
    {
    }

    private const TEMPLATE_DIR = __DIR__ .'/../../views';
    
    /**
     * @throws \Exception
     */
    public function render(string $template, array $parameters = []): string
    {
        $templateFile = realpath(self::TEMPLATE_DIR).'/'.$template;

        if (!file_exists($templateFile)) {
            throw new \Exception(sprintf('No view found to render "%s"', $template));
        }

        // Import variables to access in the view
        extract($parameters);

        // Start output buffering
        ob_start();
        
        // Include the template
        require $templateFile;
        
        // Get the content and clean the buffer
        return ob_get_clean();
    }

    public function redirectToUrl(string $url, array $parameters = []): void
    {
        if (!empty($parameters)) {
            $query = http_build_query($parameters);
            $url .= '?' . $query;
        }

        header('Location: ' . $url);
        exit(); // Important pour arrêter l'exécution après la redirection
    }
}