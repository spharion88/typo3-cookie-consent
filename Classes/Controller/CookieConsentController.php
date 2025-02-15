<?php

namespace GD\Cookieconsent\Controller;

use GD\Cookieconsent\Domain\Repository\CookiecategoryRepository;
use GD\Cookieconsent\Domain\Repository\ScriptRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Persistence\Generic\Typo3QuerySettings;

/**
 * Class CookieConsentController
 * @since 1.0.0
 */
class CookieConsentController extends ActionController
{
    /**
     * @var CookiecategoryRepository
     */
    protected $cookiecategoryRepository;

    /**
     * @var ScriptRepository
     */
    protected $scriptRepository;

    /**
     * Inject the cookieCategory repository
     *
     * @param CookiecategoryRepository $cookiecategoryRepository
     */
    public function injectCookiecategoryRepository(CookiecategoryRepository $cookiecategoryRepository)
    {
        $this->cookiecategoryRepository = $cookiecategoryRepository;
    }

    /**
     * Inject the script repository
     *
     * @param ScriptRepository $scriptRepository
     */
    public function injectScriptRepository(ScriptRepository $scriptRepository)
    {
        $this->scriptRepository = $scriptRepository;
    }

    /**
     * Initializes the show action.
     */
    public function initializeShowAction()
    {
        $querySettings = new Typo3QuerySettings();

        try {
            $querySettings->setStoragePageIds([$this->settings['storagePid']]);
            $querySettings->setRespectStoragePage(false);
        }
        catch (\TypeError $err) {
            $querySettings->setRespectStoragePage(false);
        }

        $this->cookiecategoryRepository->setDefaultQuerySettings($querySettings);
    }

    public function showAction()
    {
        $this->view->assign('cookieCategories', $this->cookiecategoryRepository->findAll());
    }

    /**
     * Initializes the script action.
     */
    public function initializeScriptAction()
    {
        $querySettings = new Typo3QuerySettings();

        try {
            $querySettings->setStoragePageIds([$this->settings['storagePid']]);
            $querySettings->setRespectStoragePage(false);
        }
        catch (\TypeError $err) {
            $querySettings->setRespectStoragePage(false);
        }

        $this->scriptRepository->setDefaultQuerySettings($querySettings);
    }

    public function scriptAction()
    {
        $this->view->assign('scripts', $this->scriptRepository->findAll());
    }
}