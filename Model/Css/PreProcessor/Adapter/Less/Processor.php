<?php
declare(strict_types=1);

namespace Pronnect\CssInlineSourceMap\Model\Css\PreProcessor\Adapter\Less;

use Exception;
use Less_Parser;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\State;
use Magento\Framework\Phrase;
use Magento\Framework\View\Asset\ContentProcessorException;
use Magento\Framework\View\Asset\ContentProcessorInterface;
use Magento\Framework\View\Asset\File;
use Magento\Framework\View\Asset\Source;
use Magento\Store\Model\ScopeInterface;
use Pronnect\CssInlineSourceMap\Model\Css\PreProcessor\File\Temporary;
use Psr\Log\LoggerInterface;

/**
 * Class Processor
 */
class Processor implements ContentProcessorInterface
{
    private const XML_PATH_USE_CSS_INLINE_SOURCEMAP = 'dev/css/use_css_inline_sourcemap';

    private LoggerInterface $logger;
    private State $appState;
    private Source $assetSource;
    private Temporary $temporaryFile;
    private ScopeConfigInterface $scopeConfig;

    /**
     * Constructor
     *
     * @param LoggerInterface      $logger
     * @param State                $appState
     * @param Source               $assetSource
     * @param Temporary            $temporaryFile
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct (
        LoggerInterface      $logger,
        State                $appState,
        Source               $assetSource,
        Temporary            $temporaryFile,
        ScopeConfigInterface $scopeConfig
    )
    {
        $this->logger = $logger;
        $this->appState = $appState;
        $this->assetSource = $assetSource;
        $this->temporaryFile = $temporaryFile;
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * @inheritdoc
     */
    public function processContent (File $asset)
    {
        try {
            $parserOptions = [
                'relativeUrls' => false,
                'compress' => $this->appState->getMode() !== State::MODE_DEVELOPER,
            ];

            if ($this->canUseCssInlineSourceMap()) {
                $parserOptions['sourceMap'] = $this->appState->getMode() === State::MODE_DEVELOPER;
                $parserOptions['outputSourceFiles'] = true;
                $parserOptions['sourceMapBasepath'] = $this->temporaryFile->getMaterializationAbsolutePath();
            }

            $parser = new Less_Parser($parserOptions);
            $path = $asset->getPath();
            $content = $this->assetSource->getContent($asset);

            if (trim($content) === '') {
                throw new ContentProcessorException(
                    new Phrase('Compilation from source: LESS file is empty: ' . $path)
                );
            }

            $tmpFilePath = $this->temporaryFile->createFile($path, $content);

            gc_disable();
            $parser->parseFile($tmpFilePath, '');
            $content = $parser->getCss();
            gc_enable();

            if (trim($content) === '') {
                throw new ContentProcessorException(
                    new Phrase('Compilation from source: LESS file is empty: ' . $path)
                );
            } else {
                return $content;
            }
        } catch (Exception $e) {
            throw new ContentProcessorException(new Phrase($e->getMessage()));
        }
    }

    /**
     * @return bool
     */
    private function canUseCssInlineSourceMap (): bool
    {
        return (bool)$this->scopeConfig->isSetFlag(self::XML_PATH_USE_CSS_INLINE_SOURCEMAP, ScopeInterface::SCOPE_STORE);
    }
}
