<?php

namespace cachebuster\cachebuster;

use craft\base\Model;
use craft\base\Plugin;
use craft\elements\Entry;
use cachebuster\cachebuster\services\CachebusterService;
use cachebuster\cachebuster\variables\CachebusterVariable;
use yii\base\Event;
use craft\controllers\AssetsController;
use yii\base\ActionEvent;
use craft\web\twig\variables\CraftVariable;
use yii\db\Exception;
use yii\db\Query;
use craft\elements\Asset;
use craft\elements\db\ElementQuery;
use craft\elements\db\ElementQueryInterface;


class Cachebuster extends Plugin
{

    public bool $hasCpSettings = false;

    public function init()
    {
        parent::init();
        
        Event::on(CraftVariable::class, CraftVariable::EVENT_INIT, function(Event $event) {
            /** @var CraftVariable $variable */
            $variable = $event->sender;
            // set the cachebustervariable
            $variable->set('cachebustervariable', CachebusterVariable::class);
        });
        
    }

    /**
     * @return Model|null
     */
    protected function createSettingsModel(): ?Model
    {
        return new \cachebuster\cachebuster\models\Settings();
    }

    protected function settingsHtml(): ?string
    {
        return \Craft::$app->getView()->renderTemplate(
            'flowsa-cachebuster/settings',
            [ 'settings' => $this->getSettings() ]
        );
    }

}