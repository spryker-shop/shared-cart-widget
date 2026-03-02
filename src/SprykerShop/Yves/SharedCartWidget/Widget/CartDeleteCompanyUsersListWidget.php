<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerShop\Yves\SharedCartWidget\Widget;

use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Yves\Kernel\Widget\AbstractWidget;

/**
 * @deprecated Use {@link \SprykerShop\Yves\SharedCartWidget\Widget\CartDeleteSharingCompanyUsersListWidget} instead.
 *
 * @method \SprykerShop\Yves\SharedCartWidget\SharedCartWidgetFactory getFactory()
 */
class CartDeleteCompanyUsersListWidget extends AbstractWidget
{
    public function __construct(QuoteTransfer $quoteTransfer)
    {
        $this->addQuoteShareDetailsParameter($quoteTransfer);
    }

    public static function getName(): string
    {
        return 'CartDeleteCompanyUsersListWidget';
    }

    public static function getTemplate(): string
    {
        return '@SharedCartWidget/views/shared-cart-users/shared-cart-users.twig';
    }

    protected function addQuoteShareDetailsParameter(QuoteTransfer $quoteTransfer): void
    {
        $this->addParameter(
            'quoteShareDetails',
            $this->getFactory()->getSharedCartClient()->getShareDetailsByIdQuoteAction($quoteTransfer)->getShareDetails(),
        );
    }
}
