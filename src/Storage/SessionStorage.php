<?php

namespace devtoolboxuk\styx\Storage;

class SessionStorage implements StorageInterface
{
    /**
     * The namespace used to store values in the session.
     */
    const SESSION_NAMESPACE = 'antiflood';
    const SESSION_DELAY = 60;

    private $storage = null;
    private $namespace;

    public function storeNameSpace($namespace)
    {
        $this->namespace = self::SESSION_NAMESPACE . "." . $namespace;
        if ($this->hasSessionStarted()) {
            $this->storage = isset($_SESSION[$this->namespace]) ? $_SESSION[$this->namespace] : null;
        }
    }

    private function hasSessionStarted()
    {
        if (php_sapi_name() !== 'cli') {
            if (version_compare(phpversion(), '5.4.0', '>=')) {
                return session_status() === PHP_SESSION_ACTIVE ? true : false;
            }
        }
        return false;
    }

    public function getStorage()
    {
        return $this->storage;
    }

    protected function setStorageItem($key, $value)
    {
        $this->storage[$key] = $value;
        if ($this->hasSessionStarted()) {
            $_SESSION[$this->namespace] = $this->storage;
        }
    }

    protected function getStorageItem($key)
    {
        if ($this->hasSessionStarted()) {
            $this->storage = isset($_SESSION[$this->namespace]) ? $_SESSION[$this->namespace] : null;
        }
        if (isset($this->storage[$key])) {
            return $this->storage[$key];
        }
        return null;
    }

    public function getNameSpace()
    {
        return $this->namespace;
    }

    public function storeTime()
    {
        $this->setStorageItem('time', time());
    }

    public function getTime()
    {
        return $this->getStorageItem('time');
    }

    public function storeDelay($delay)
    {
        $this->setStorageItem('delay', (int)$delay);
    }

    public function getDelay()
    {
        if ($this->getStorageItem('delay')) {
            return $this->getStorageItem('delay');
        }
        return self::SESSION_DELAY;
    }

    public function clear()
    {
        if ($this->hasSessionStarted()) {
            unset($_SESSION[$this->namespace]);
        }
    }
}
