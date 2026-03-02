<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerShop\Yves\SharedCartWidget\Widget;

use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Yves\Kernel\Widget\AbstractWidget;

/**
 * @method \SprykerShop\Yves\SharedCartWidget\SharedCartWidgetFactory getFactory()
 */
class SharedCartShareWidget extends AbstractWidget
{
    public function __construct(QuoteTransfer $quoteTransfer)
    {
        $this->addParameter('cart', $quoteTransfer)
            ->addParameter('isQuoteOwner', $this->isQuoteOwner($quoteTransfer));
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return bool
     */
    protected function isQuoteOwner(QuoteTransfer $quoteTransfer)
    {
        $customer = $this->getFactory()->getCustomerClient()->getCustomer();

        return $customer->getCustomerReference() === $quoteTransfer->getCustomerReference();
    }

    public static function getName(): string
    {
        return 'SharedCartShareWidget';
    }

    public static function getTemplate(): string
    {
        return '@SharedCartWidget/views/shared-cart-share/shared-cart-share.twig';
    }
}
