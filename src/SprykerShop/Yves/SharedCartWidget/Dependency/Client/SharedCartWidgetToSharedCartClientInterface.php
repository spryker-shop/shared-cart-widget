<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerShop\Yves\SharedCartWidget\Dependency\Client;

use Generated\Shared\Transfer\CustomerCollectionTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\ShareDetailCollectionTransfer;

interface SharedCartWidgetToSharedCartClientInterface
{
    public function getQuoteAccessLevel(QuoteTransfer $quoteTransfer): ?string;

    public function getShareDetailsByIdQuoteAction(QuoteTransfer $quoteTransfer): ShareDetailCollectionTransfer;

    public function isQuoteDeletable(QuoteTransfer $quoteTransfer): bool;

    public function getCustomerCollectionByQuote(QuoteTransfer $quoteTransfer): CustomerCollectionTransfer;
}
