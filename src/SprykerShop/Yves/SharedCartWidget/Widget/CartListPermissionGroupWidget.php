<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerShop\Yves\SharedCartWidget\Widget;

use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Yves\Kernel\Widget\AbstractWidget;

/**
 * @method \SprykerShop\Yves\SharedCartWidget\SharedCartWidgetFactory getFactory()
 */
class CartListPermissionGroupWidget extends AbstractWidget
{
    public function __construct(QuoteTransfer $quoteTransfer, bool $isQuoteDeletable)
    {
        $customerTransfer = $this->getFactory()->getCustomerClient()->getCustomer();

        $this->addCartParameter($quoteTransfer);
        $this->addAccessTypeParameter($quoteTransfer);
        $this->addIsSharingAllowedParameter($customerTransfer);
        $this->addIsQuoteDeletableParameter($isQuoteDeletable, $quoteTransfer);
    }

    protected function addAccessTypeParameter(QuoteTransfer $quoteTransfer): void
    {
        $this->addParameter(
            'accessType',
            $this->getFactory()
                ->getSharedCartClient()
                ->getQuoteAccessLevel($quoteTransfer),
        );
    }

    protected function addCartParameter(QuoteTransfer $quoteTransfer): void
    {
        $this->addParameter('cart', $quoteTransfer);
    }

    protected function addIsQuoteDeletableParameter(bool $isQuoteDeletable, QuoteTransfer $quoteTransfer): void
    {
        $this->addParameter(
            'isQuoteDeletable',
            $isQuoteDeletable && $this->getFactory()->getSharedCartClient()->isQuoteDeletable($quoteTransfer),
        );
    }

    protected function addIsSharingAllowedParameter(CustomerTransfer $customerTransfer): void
    {
        $this->addParameter('isSharingAllowed', $this->isSharingAllowed($customerTransfer));
    }

    protected function isSharingAllowed(CustomerTransfer $customerTransfer): bool
    {
        return $customerTransfer->getCompanyUserTransfer() && $customerTransfer->getCompanyUserTransfer()->getIdCompanyUser();
    }

    public static function getName(): string
    {
        return 'CartListPermissionGroupWidget';
    }

    public static function getTemplate(): string
    {
        return '@SharedCartWidget/views/multi-cart-permission/multi-cart-permission.twig';
    }
}
