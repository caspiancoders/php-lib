<?php

namespace Caspian\Configs;

class Config
{
    private $configs;
    private $path;

    public function __construct($path)
    {
        $this->configs = [];
        $this->path = rtrim($path, DIRECTORY_SEPARATOR);

        $this->load();
    }

    protected function load()
    {
        $configs = [];

        $files = glob($this->path . '/*');

        foreach ($files as $file) {
            if (is_dir($file)) {
                $dir = $file;
                $dirName = basename($dir);

                $configs[$dirName] = [];

                $filesInDirectory = glob($dir . DIRECTORY_SEPARATOR . '*.php');

                foreach ($filesInDirectory as $file) {
                    $fileName = basename($file, '.php');

                    $configs[$dirName][$fileName] = include($file);
                }

            } elseif ($this->isPhpFile($file)) {
                $fileName = $this->getFileName($file);

                $configs[$fileName] = include $file;
            }
        }

        $this->save($configs);
    }

    public function save(
        array $configs,
        $basename = '',
        $depth = 0,
        $maxDepth = 3
    ) {
        if ($depth > $maxDepth) {
            return;
        }

        foreach ($configs as $key => $value) {
            if (empty($basename)) {
                $name = $key;
            } else {
                $name = $basename . '.' . $key;
            }

            $this->configs[$name] = $value;

            if (is_array($value)) {
                $this->save($value, $name, $depth + 1, $maxDepth);
            }
        }
    }

    public function get($key)
    {
        return $this->configs[$key] ?? null;
    }

    public function has($key)
    {
        return !isset($this->configs[$key]);
    }

    public function all()
    {
        return $this->configs;
    }

    protected function getFileName($path)
    {
        return pathinfo($path, PATHINFO_FILENAME);
    }

    protected function isPhpFile($path)
    {
        return pathinfo($path, PATHINFO_EXTENSION);
    }
}

