<?php

namespace DznRemoveNotepad;

use Shopware\Components\Plugin;
use Shopware\Components\Plugin\Context\InstallContext;
use Shopware\Components\Plugin\Context\UninstallContext;

class DznRemoveNotepad extends Plugin
{

    public static function getSubscribedEvents()
    {
        return [
            'Enlight_Controller_Action_PostDispatch' => 'onFrontendPostDispatch',
            'Enlight_Controller_Action_PreDispatch_Frontend_Note' => 'killRoute'
        ];
    }

    /**
     * @inheritdoc
     */
    public function install(InstallContext $context)
    {
        parent::install($context);
    }

    /**
     * @inheritdoc
     */
    public function uninstall(UninstallContext $context)
    {
        parent::uninstall($context);
    }

    public function killRoute(\Enlight_Controller_ActionEventArgs $args)
    {
        $controller = $args->get('subject');
        $controller->Response()->setHttpResponseCode(404);
    }

    public function onFrontendPostDispatch(\Enlight_Event_EventArgs $args)
    {
        /** @var \Enlight_Controller_Action $controller */
        $controller = $args->get('subject');
        $view = $controller->View();

        $view->addTemplateDir(
            __DIR__ . '/Views'
        );

    }

}