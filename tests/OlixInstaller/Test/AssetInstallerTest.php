<?php
/**
 *
 * TEST de plugin Composer pour l'activation du l'installeur des Assets
 *
 *
 * @package Olix
 * @subpackage InstallerComposer
 * @author Olivier
 *
 */

namespace OlixInstaller\Test;

use OlixInstaller\AssetInstaller;
use Composer\Test\Installer\LibraryInstallerTest;
use Composer\Package\Loader\ArrayLoader;
use Composer\Package\Package;
use Composer\Composer;
use Composer\Config;


class AssetInstallerTest extends LibraryInstallerTest {


    protected $installDir;


    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        // Run through the Library Installer Test set up.
        parent::setUp();
        // Also be sure to set up the Component directory.
        $this->installDir = realpath(sys_get_temp_dir()).DIRECTORY_SEPARATOR.'test-install-public';
        $this->ensureDirectoryExistsAndClear($this->installDir);
        // Merge the component-dir setting in so that it applies correctly.
        $this->config->merge(array(
                'extra' => array(
                        'olix-assets-dir' => $this->installDir,
                ),
        ));
    }


    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        $this->fs->removeDirectory($this->installDir);
        return parent::tearDown();
    }


    /**
     * Tests that the Installer doesn't create the Component directory.
     */
    public function testInstallerCreationShouldNotCreateInstallDirectory()
    {
        $this->fs->removeDirectory($this->installDir);
        new AssetInstaller($this->io, $this->composer);
        $this->assertFileNotExists($this->installDir);
    }


    /**
     * Test the Installer's support() function.
     *
     * @param string  $type     : type de la librairie
     * @param boolean $expected : si le bon type donné est bien celui qui est supporté par Component Installer.
     *
     * @return void
     *
     * @dataProvider providerSupports
     */
    public function testSupports($type, $expected)
    {
        $installer = new AssetInstaller($this->io, $this->composer, 'olix-asset');
        $this->assertSame($expected, $installer->supports($type), sprintf('Failed to show support for %s', $type));
    }

    /**
     * Data provider for testSupports().
     *
     * @see testSupports()
     */
    public function providerSupports()
    {
        $tests = array();
        // All package types support having Components.
        $tests[] = array('olix-asset', true);
        $tests[] = array('not-a-olix', false);
        $tests[] = array('library', false);
        return $tests;
    }


    /**
     * Test the Installer's testGetPackageBasePath() function.
     *
     * @dataProvider providerGetPackageBasePath
     */
    public function testGetPackageBasePath($expected, $package)
    {
        $installer = new AssetInstaller($this->io, $this->composer);
        $loader = new ArrayLoader();
        // Test the results.
        $result = $installer->getPackageBasePath($loader->load($package));
        $this->assertEquals($expected, $result);
    }

    /**
     * Data provider for testGetPackageBasePath().
     *
     * @see testGetPackageBasePath()
     */
    public function providerGetPackageBasePath()
    {
        $tests = array();
        
        $package = array(
            'name' => 'foo/bar1',
            'type' => 'olix-assset',
            'version' => '1.0.0',
        );
        $tests[] = array('web/public/bar1', $package);
        
        $package = array(
            'name' => 'foo/bar2',
            'type' => 'olix-assset',
            'version' => '1.0.0',
            'extra' => array(
                'olix' => array(
                    'name' => 'toto',
                ),
            ),
        );
        $tests[] = array('web/public/toto', $package);
        
        return $tests;
    }

}