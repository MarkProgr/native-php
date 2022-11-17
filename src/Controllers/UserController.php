<?php

namespace App\Controllers;

use App\Repository\UserRepository;
use App\Views\View;
use Laminas\Diactoros\Response;
use Laminas\Diactoros\ServerRequest;
use Laminas\Diactoros\UploadedFile;
use Psr\Http\Message\ServerRequestInterface;

class UserController
{
    private View $view;
    private UserRepository $user;

    public function __construct(View $view, UserRepository $user)
    {
        $this->view = $view;
        $this->user = $user;
    }

    public function createForm(): Response
    {
        return new Response\HtmlResponse($this->view->render('create-form'));
    }

    public function showOne(ServerRequest $request, array $params): Response\HtmlResponse
    {
        $user = $this->user->selectById($params);

        if (!$user) {
            return new Response\HtmlResponse($this->view->render('not-found'), 404);
        }

        return new Response\HtmlResponse($this->view->render('show-one', compact('user')));
    }

    public function editForm(ServerRequest $request, array $params): Response\HtmlResponse
    {
        $user = $this->user->selectById($params);

        if (!$user) {
            return new Response\HtmlResponse($this->view->render('not-found'), 404);
        }

        return new Response\HtmlResponse($this->view->render('edit-form', compact('user')));
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
