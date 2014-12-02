<?php
/**
 * 
 * Plugin Composer pour l'activation du l'installeur des Assets
 * 
 * 
 * @package Olix
 * @subpackage InstallerComposer
 * @author Olivier
 *
 */

namespace OlixInstaller;

use Composer\Composer;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginInterface;


class AssetPlugin implements PluginInterface
{


    /**
     * (non-PHPdoc)
     * @see \Composer\Plugin\PluginInterface::activate()
     */
    public function activate(Composer $composer, IOInterface $io)
    {
        $installer = new AssetInstaller($io, $composer);
        $composer->getInstallationManager()->addInstaller($installer);
    }

}