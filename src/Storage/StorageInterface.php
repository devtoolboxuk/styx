<?php

namespace devtoolboxuk\styx\Storage;

interface StorageInterface
{
    public function getTime();

    public function storeTime();

    public function storeNameSpace($namespace);

    public function getNameSpace();

    public function storeDelay($delay);

    public function getDelay();

    public function clear();

}