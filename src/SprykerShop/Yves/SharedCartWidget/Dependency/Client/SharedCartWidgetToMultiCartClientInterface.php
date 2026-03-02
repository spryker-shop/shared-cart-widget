<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerShop\Yves\SharedCartWidget\Dependency\Client;

use Generated\Shared\Transfer\QuoteCollectionTransfer;

interface SharedCartWidgetToMultiCartClientInterface
{
    public function getQuoteCollection(): QuoteCollectionTransfer;

    public function isQuoteDeletable(): bool;
}
