<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerShop\Yves\SharedCartWidget\Plugin\MultiCartWidget;

use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Client\SharedCart\Plugin\ReadSharedCartPermissionPlugin;
use Spryker\Client\SharedCart\Plugin\WriteSharedCartPermissionPlugin;
use Spryker\Yves\Kernel\PermissionAwareTrait;
use Spryker\Yves\Kernel\Widget\AbstractWidgetPlugin;
use SprykerShop\Yves\MultiCartWidget\Dependency\Plugin\SharedCartWidget\SharedCartDetailsWidgetPluginInterface;

class SharedCartDetailsWidgetPlugin extends AbstractWidgetPlugin implements SharedCartDetailsWidgetPluginInterface
{
    use PermissionAwareTrait;

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     * @param array $actions
     *
     * @return void
     */
    public function initialize(QuoteTransfer $quoteTransfer, array $actions): void
    {
        $this->addParameter('cart', $quoteTransfer);
        $this->addParameter('actions', $this->checkActionsPermission($quoteTransfer, $actions));
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     * @param array $actions
     *
     * @return array
     */
    protected function checkActionsPermission(QuoteTransfer $quoteTransfer, array $actions)
    {
        $viewAllowed = $this->can(ReadSharedCartPermissionPlugin::KEY, $quoteTransfer->getIdQuote());
        $writeAllowed = $this->can(WriteSharedCartPermissionPlugin::KEY, $quoteTransfer->getIdQuote());
        $actions['view'] = isset($actions['view']) ? $actions['view'] && $viewAllowed : $viewAllowed;
        $actions['update'] = isset($actions['update']) ? $actions['update'] && $writeAllowed : $writeAllowed;
        $actions['set_default'] = isset($actions['set_default']) ? $actions['set_default'] && $viewAllowed : $viewAllowed;
        $actions['delete'] = isset($actions['delete']) ? $actions['delete'] && $writeAllowed : $writeAllowed;

        return $actions;
    }

    /**
     * Specification:
     * - Returns the name of the widget as it's used in templates.
     *
     * @api
     *
     * @return string
     */
    public static function getName()
    {
        return static::NAME;
    }

    /**
     * Specification:
     * - Returns the the template file path to render the widget.
     *
     * @api
     *
     * @return string
     */
    public static function getTemplate()
    {
        return '@SharedCartWidget/_multi-cart-widget/shared-cart-details.twig';
    }
}
