<?php

namespace Perprogramming\Bundle\WebsiteBundle\DataProvider;

use Sculpin\Core\DataProvider\DataProviderInterface;
use Symfony\Component\Yaml\Yaml;

class YamlFileDataProvider implements DataProviderInterface {

    protected $file;

    public function __construct($file) {
        $this->file = $file;
    }

    public function provideData() {
        return Yaml::parse(file_get_contents($this->file));
    }

}