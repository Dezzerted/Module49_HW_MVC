<?php
namespace App\Controllers;

class PageController
{
    private $twig;

    public function __construct(\Twig\Environment $twig)
    {
        $this->twig = $twig;
    }

    private function render(string $view, array $params = [])
    {
        try {
            echo $this->twig->render($view, array_merge([
                'current_path' => parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)
            ], $params));
        } catch (\Twig\Error\LoaderError $e) {
            $this->notFound();
        }
    }

    public function home()
    {
        $this->render('home.twig', [
            'title' => 'Главная'
        ]);
    }

    public function about()
    {
        $this->render('about.twig', [
            'title' => 'О нас'
        ]);
    }

    public function contacts()
    {
        $this->render('contacts.twig', [
            'title' => 'Контакты'
        ]);
    }

    public function gdInfo()
    {
    $this->render('gd-info.twig', [
        'title' => 'GD Info',
        'image_path' => '/assets/images/screen.png'
    ]);

    }

    public function notFound()
    {
        http_response_code(404);
        $this->render('errors/404.twig', [
            'title' => 'Страница не найдена'
        ]);
    }
}