<?php

declare(strict_types=1);

namespace Tp3\Tp3Openhours\Controller;

use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Core\Type\ContextualFeedbackSeverity;
use Tp3\Tp3Openhours\Domain\Model\OpenHour;
use Tp3\Tp3Openhours\Domain\Repository\OpenHourRepository;

class OpenHourController extends ActionController
{
    private OpenHourRepository $openHourRepository;

    public function __construct(OpenHourRepository $openHourRepository)
    {
        $this->openHourRepository = $openHourRepository;
    }

    public function listAction(): ResponseInterface
    {
        $openHours = $this->openHourRepository->findAll();
        $this->view->assign('openHours', $openHours);
        return $this->htmlResponse();
    }

    public function showAction(OpenHour $openHour): ResponseInterface
    {
        $this->view->assign('openHour', $openHour);
        return $this->htmlResponse();
    }

    public function newAction(): ResponseInterface
    {
        return $this->htmlResponse();
    }

    public function createAction(OpenHour $newOpenHour): ResponseInterface
    {
        $this->addFlashMessage(
            'The object was created.',
            '',
            ContextualFeedbackSeverity::WARNING
        );
        $this->openHourRepository->add($newOpenHour);
        return $this->redirect('list');
    }

    public function editAction(OpenHour $openHour): ResponseInterface
    {
        $this->view->assign('openHour', $openHour);
        return $this->htmlResponse();
    }

    public function updateAction(OpenHour $openHour): ResponseInterface
    {
        $this->addFlashMessage(
            'The object was updated.',
            '',
            ContextualFeedbackSeverity::WARNING
        );
        $this->openHourRepository->update($openHour);
        return $this->redirect('list');
    }

    public function deleteAction(OpenHour $openHour): ResponseInterface
    {
        $this->addFlashMessage(
            'The object was deleted.',
            '',
            ContextualFeedbackSeverity::WARNING
        );
        $this->openHourRepository->remove($openHour);
        return $this->redirect('list');
    }
}
