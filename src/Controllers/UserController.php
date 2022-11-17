<?php

namespace App\Controllers;

use App\Repository\UserRepository;
use Laminas\Diactoros\Response;
use Laminas\Diactoros\ServerRequest;
use Twig\Environment;

class UserController
{
    private Environment $twig;
    private UserRepository $user;

    public function __construct(Environment $twig, UserRepository $user)
    {
        $this->twig = $twig;
        $this->user = $user;
    }

    public function createForm(): Response
    {
        return new Response\HtmlResponse($this->twig->render('create-form.php'));
    }

    public function showOne(ServerRequest $request, array $params): Response\HtmlResponse
    {
        $user = $this->user->selectById($params);

        if (!$user) {
            return new Response\HtmlResponse($this->twig->render('not-found.php'), 404);
        }

        return new Response\HtmlResponse($this->twig->render('show-one.php', compact('user')));
    }

    public function editForm(ServerRequest $request, array $params): Response\HtmlResponse
    {
        $user = $this->user->selectById($params);

        if (!$user) {
            return new Response\HtmlResponse($this->twig->render('not-found.php'), 404);
        }

        return new Response\HtmlResponse($this->twig->render('edit-form.php', compact('user')));
    }

    public function createUser(ServerRequest $request): Response\RedirectResponse
    {
        $uniqueImageName = $this->generateImageName($request);

        $this->user->create($request->getParsedBody(), $uniqueImageName);

        return new Response\RedirectResponse('/');
    }

    public function editUser(ServerRequest $request, array $params): Response\RedirectResponse
    {
        $uniqueImageName = $this->generateImageName($request);

        $this->user->update($params['id'], $request->getParsedBody(), $uniqueImageName);

        return new Response\RedirectResponse('/');
    }

    public function deleteUser(ServerRequest $request, array $params): Response\RedirectResponse
    {
        $this->user->delete($params);

        return new Response\RedirectResponse('/');
    }

    public function generateImageName(ServerRequest $request): ?string
    {
        $uploadedFile = $request->getUploadedFiles();
        $file = $uploadedFile['image'];

        if (!$file->getClientFilename()) {
            return null;
        }

        $imageName = $file->getClientFilename();
        $uniqueImageName = md5(uniqid($imageName)) . strstr($imageName, '.');

        $newTmpName = __DIR__ . '/../../public/uploads/' . $uniqueImageName;
        $file->moveTo($newTmpName);

        return $uniqueImageName;
    }
}
