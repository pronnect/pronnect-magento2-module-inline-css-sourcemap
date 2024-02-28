<?php
declare(strict_types=1);

namespace Pronnect\CssInlineSourceMap\Model\Css\PreProcessor\File;

use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\Exception\FileSystemException;
use Magento\Framework\Filesystem;
use Magento\Framework\Css\PreProcessor\Config;
use Magento\Framework\Filesystem\Directory\WriteInterface;

/**
 * Class Temporary
 */
class Temporary extends \Magento\Framework\Css\PreProcessor\File\Temporary
{
    private Config $config;
    private WriteInterface $tmpDirectory;

    /**
     * Constructor Temporary
     *
     * @param Filesystem $filesystem
     * @param Config     $config
     *
     * @throws FileSystemException
     */
    public function __construct (
        Filesystem $filesystem,
        Config     $config
    )
    {
        parent::__construct($filesystem, $config);
        $this->tmpDirectory = $filesystem->getDirectoryWrite(DirectoryList::VAR_DIR);
        $this->config = $config;
    }

    /**
     * @return string
     */
    public function getMaterializationAbsolutePath (): string
    {
        return $this->tmpDirectory->getAbsolutePath($this->config->getMaterializationRelativePath());
    }
}
