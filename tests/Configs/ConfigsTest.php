<?php

use Caspian\Configs\Config;
use PHPUnit\Framework\TestCase;

class ConfigsTest extends TestCase
{
    /** @test */
    public function ensure_can_load_configs_from_a_single_file()
    {
        $config = new Config($this->getPath('file-only-config'));

        $this->assertEquals(
            [
                'username' => 'test',
                'password' => 'test'
            ], $config->get('host'));
    }

    /** @test */
    public function ensure_can_load_configs_from_a_directory()
    {
        $config = new Config($this->getPath('dir-only-config'));

        $this->assertEquals(
            [
                'logo' => 'mylogo'
            ], $config->get('assets.images'));

        $config = new Config($this->getPath('dir-only-config-2'));

        $this->assertEquals(
            [
                'hello' => 'world'
            ], $config->get('assets.images'));
    }

    /** @test */
    public function ensure_can_load_configs_from_both_file_and_directory()
    {
        $config = new Config($this->getPath('file-and-dir'));

        $this->assertEquals(
            [
                'main-menu' => 'Main Menu',
                'footer-menu' => 'Footer Menu'
            ],
            $config->get('general.menus')
        );

        $this->assertEquals(
            [
                'main' => 'main.js'
            ],
            $config->get('scripts')
        );
    }

    /** @test */
    public function ensure_can_load_configs_from_indexed_arrays()
    {
        $config = new Config($this->getPath('indexed-array'));

        $this->assertEquals(
            [
                'Shortcode1',
                'Shortcode2'
            ],
            $config->get('shortcodes')
        );
    }

    /** @test */
    public function ensure_can_load_configs_from_nested_arrays()
    {
        $config = new Config($this->getPath('nested-array'));

        $this->assertEquals('white.png', $config->get('images.logo.white'));
    }

    /** @test */
    public function ensure_no_error_when_loading_from_empty_directory()
    {
        $config = new Config($this->getPath('empty'));

        $this->assertNull($config->get('empty'));
    }

    public function getPath($path)
    {
        return __DIR__ . '/test/' . $path;
    }
}