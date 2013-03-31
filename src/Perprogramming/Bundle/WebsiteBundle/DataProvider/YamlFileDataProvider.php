<?php

namespace Perprogramming\Bundle\WebsiteBundle\DataProvider;

use Sculpin\Core\DataProvider\DataProviderInterface;
use Sculpin\Core\Event\SourceSetEvent;
use Sculpin\Core\Sculpin;
use Sculpin\Core\Source\SourceInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Yaml\Yaml;

class YamlFileDataProvider implements DataProviderInterface, EventSubscriberInterface {

    protected $name;
    protected $dataFiles = array();

    public function __construct($name) {
        $this->name = $name;
    }

    public static function getSubscribedEvents() {
        return array(
            Sculpin::EVENT_BEFORE_RUN => 'beforeRun',
            Sculpin::EVENT_BEFORE_RUN_AGAIN => 'beforeRunAgain',
        );
    }

    public function beforeRun(SourceSetEvent $sourceSetEvent) {
        foreach ($sourceSetEvent->updatedSources() as $source) {
            /** @var $source SourceInterface */
            if ($source->data()->get($this->name)) {
                $source->setShouldBeSkipped(true);
                $this->dataFiles[$source->sourceId()] = $source;
            }
        }
    }

    public function beforeRunAgain(SourceSetEvent $sourceSetEvent) {
        $hasChanged = false;
        foreach ($this->dataFiles as $file) {
            if ($file->hasChanged()) {
                $hasChanged = true;
                break;
            }
        }
        if ($hasChanged) {
            foreach ($sourceSetEvent->allSources() as $source) {
                if ($source->data()->get('use') and in_array($this->name, $source->data()->get('use'))) {
                    $source->forceReprocess();
                }
            }
        }
    }

    public function provideData() {
        $data = array();
        foreach ($this->dataFiles as $file) {
            $data = array_merge($data, Yaml::parse($file->content()));
        }
        return $data;
    }

}