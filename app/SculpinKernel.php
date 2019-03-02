<?php

use Sculpin\Bundle\SculpinBundle\HttpKernel\AbstractKernel;

class SculpinKernel extends AbstractKernel {

    public function getAdditionalSculpinBundles()
    {
        return [];
    }

    public function registerBundles() {
        $bundles = parent::registerBundles();
        $bundles[] = new \Perprogramming\Bundle\WebsiteBundle\PerprogrammingWebsiteBundle();
        return $bundles;
    }

}