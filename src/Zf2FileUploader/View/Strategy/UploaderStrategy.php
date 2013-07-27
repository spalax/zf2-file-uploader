<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Zf2FileUploader\View\Strategy;

use Zend\EventManager\AbstractListenerAggregate;
use Zend\EventManager\EventManagerInterface;
use Zend\Http\Request as HttpRequest;
use Zf2FileUploader\View\Model;
use Zf2FileUploader\View\Renderer\UploaderRenderer;
use Zend\View\ViewEvent;

class UploaderStrategy extends AbstractListenerAggregate
{
    /**
     * Character set for associated content-type
     *
     * @var string
     */
    protected $charset = 'utf-8';

    /**
     * Multibyte character sets that will trigger a binary content-transfer-encoding
     *
     * @var array
     */
    protected $multibyteCharsets = array(
        'UTF-16',
        'UTF-32',
    );

    /**
     * @var UploaderRenderer
     */
    protected $renderer;

    /**
     * Constructor
     *
     * @param  UploaderRenderer $renderer
     */
    public function __construct(UploaderRenderer $renderer)
    {
        $this->renderer = $renderer;
    }

    /**
     * {@inheritDoc}
     */
    public function attach(EventManagerInterface $events, $priority = -1)
    {
        $this->listeners[] = $events->attach(ViewEvent::EVENT_RENDERER, array($this, 'selectRenderer'), $priority);
        $this->listeners[] = $events->attach(ViewEvent::EVENT_RESPONSE, array($this, 'injectResponse'), $priority);
    }

    /**
     * Set the content-type character set
     *
     * @param  string $charset
     * @return UploaderStrategy
     */
    public function setCharset($charset)
    {
        $this->charset = (string) $charset;
        return $this;
    }

    /**
     * Retrieve the current character set
     *
     * @return string
     */
    public function getCharset()
    {
        return $this->charset;
    }

    /**
     * Detect if we should use the UploaderRenderer based on model type and/or
     * Accept header
     *
     * @param  ViewEvent $e
     * @return null | UploaderRenderer
     */
    public function selectRenderer(ViewEvent $e)
    {
        $model = $e->getModel();

        if (!$model instanceof Model\UploaderModel) {
            return null;
        }
        // JsonModel found
        return $this->renderer;
    }

    /**
     * Inject the response with the "Uploader" behavior and appropriate Content-Type header
     *
     * @param  ViewEvent $e
     * @return void
     */
    public function injectResponse(ViewEvent $e)
    {
        $renderer = $e->getRenderer();

        if ($renderer !== $this->renderer) {
            return;
        }

        $result   = $e->getResult();
        if (!is_string($result)) {
            return;
        }
        
        // Populate response
        $response = $e->getResponse();

        $result = "<html><head></head><body>".$result."</body></html>";
        $response->setContent($result);


        $headers = $response->getHeaders();

        $headers->addHeaderLine('content-type', 'text/html; charset=' . $this->charset);
        if (in_array(strtoupper($this->charset), $this->multibyteCharsets)) {
            $headers->addHeaderLine('content-transfer-encoding', 'BINARY');
        }
    }
}
