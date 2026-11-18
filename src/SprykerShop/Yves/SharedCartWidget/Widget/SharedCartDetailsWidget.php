<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerShop\Yves\SharedCartWidget\Widget;

use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Client\SharedCart\Plugin\ReadSharedCartPermissionPlugin;
use Spryker\Client\SharedCart\Plugin\WriteSharedCartPermissionPlugin;
use Spryker\Yves\Kernel\PermissionAwareTrait;
use Spryker\Yves\Kernel\Widget\AbstractWidget;

/**
 * @method \SprykerShop\Yves\SharedCartWidget\SharedCartWidgetFactory getFactory()
 */
class SharedCartDetailsWidget extends AbstractWidget
{
    use PermissionAwareTrait;

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     * @param array<string, mixed> $actions
     * @param array<string>|null $widgetList
     */
    public function __construct(QuoteTransfer $quoteTransfer, array $actions, ?array $widgetList = null)
    {
        $this->addParameter('cart', $quoteTransfer)
            ->addParameter('actions', $this->checkActionsPermission($quoteTransfer, $actions));

        if ($widgetList) {
            /** @deprecated Use global widgets instead. */
            $this->addWidgets($widgetList);
        }
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     * @param array<string, mixed> $actions
     *
     * @return array<string, mixed>
     */
    protected function checkActionsPermission(QuoteTransfer $quoteTransfer, array $actions): array
    {
        $writeAllowed = $this->can(WriteSharedCartPermissionPlugin::KEY, $quoteTransfer->getIdQuote());
        $viewAllowed = $this->can(ReadSharedCartPermissionPlugin::KEY, $quoteTransfer->getIdQuote()) || $writeAllowed;
        $deleteAllowed = $this->isDeleteCartAllowed($quoteTransfer) && $writeAllowed;
        $actions['view'] = $this->isActionAllowed($actions, 'view', $viewAllowed);
        $actions['update'] = $this->isActionAllowed($actions, 'update', $writeAllowed);
        $actions['set_default'] = $this->isActionAllowed($actions, 'set_default', $viewAllowed);
        $actions['delete'] = $this->isActionAllowed($actions, 'delete', $deleteAllowed);

        return $actions;
    }

    /**
     * @param array<string, mixed> $actions
     * @param string $actionName
     * @param bool $isAllowed
     *
     * @return bool
     */
    protected function isActionAllowed(array $actions, string $actionName, bool $isAllowed): bool
    {
        if (!isset($actions[$actionName])) {
            return $isAllowed;
        }

        return $actions[$actionName] && $isAllowed;
    }

    protected function isDeleteCartAllowed(QuoteTransfer $currentQuoteTransfer): bool
    {
        return $this->getFactory()->getSharedCartClient()->isQuoteDeletable($currentQuoteTransfer);
    }

    protected function isQuoteOwner(QuoteTransfer $quoteTransfer, CustomerTransfer $customerTransfer): bool
    {
        return $customerTransfer->getCustomerReference() === $quoteTransfer->getCustomerReference();
    }

    public static function getName(): string
    {
        return 'SharedCartDetailsWidget';
    }

    public static function getTemplate(): string
    {
        return '@SharedCartWidget/views/shared-cart-details/shared-cart-details.twig';
    }
}
