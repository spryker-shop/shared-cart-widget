<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerShop\Yves\SharedCartWidget\Dependency\Client;

use Generated\Shared\Transfer\CustomerCollectionTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\ShareDetailCollectionTransfer;

class SharedCartWidgetToSharedCartClientBridge implements SharedCartWidgetToSharedCartClientInterface
{
    /**
     * @var \Spryker\Client\SharedCart\SharedCartClientInterface
     */
    protected $sharedCartClient;

    /**
     * @param \Spryker\Client\SharedCart\SharedCartClientInterface $sharedCartClient
     */
    public function __construct($sharedCartClient)
    {
        $this->sharedCartClient = $sharedCartClient;
    }

    public function getQuoteAccessLevel(QuoteTransfer $quoteTransfer): ?string
    {
        return $this->sharedCartClient->getQuoteAccessLevel($quoteTransfer);
    }

    public function getShareDetailsByIdQuoteAction(QuoteTransfer $quoteTransfer): ShareDetailCollectionTransfer
    {
        return $this->sharedCartClient->getShareDetailsByIdQuoteAction($quoteTransfer);
    }

    public function isQuoteDeletable(QuoteTransfer $quoteTransfer): bool
    {
        return $this->sharedCartClient->isQuoteDeletable($quoteTransfer);
    }

    public function getCustomerCollectionByQuote(QuoteTransfer $quoteTransfer): CustomerCollectionTransfer
    {
        return $this->sharedCartClient->getCustomerCollectionByQuote($quoteTransfer);
    }
}
