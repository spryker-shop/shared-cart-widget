<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerShop\Yves\SharedCartWidget\Dependency\Client;

use Generated\Shared\Transfer\QuoteCollectionTransfer;

class SharedCartWidgetToMultiCartClientBridge implements SharedCartWidgetToMultiCartClientInterface
{
    /**
     * @var \Spryker\Client\MultiCart\MultiCartClientInterface
     */
    protected $multiCartClient;

    /**
     * @param \Spryker\Client\MultiCart\MultiCartClientInterface $multiCartClient
     */
    public function __construct($multiCartClient)
    {
        $this->multiCartClient = $multiCartClient;
    }

    public function getQuoteCollection(): QuoteCollectionTransfer
    {
        return $this->multiCartClient->getQuoteCollection();
    }

    public function isQuoteDeletable(): bool
    {
        return $this->multiCartClient->isQuoteDeletable();
    }
}
