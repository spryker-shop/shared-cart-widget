<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerShop\Yves\SharedCartWidget;

use Spryker\Yves\Kernel\AbstractFactory;
use SprykerShop\Yves\SharedCartWidget\Dependency\Client\SharedCartWidgetToCustomerClientInterface;
use SprykerShop\Yves\SharedCartWidget\Dependency\Client\SharedCartWidgetToMultiCartClientInterface;
use SprykerShop\Yves\SharedCartWidget\Dependency\Client\SharedCartWidgetToQuoteClientInterface;
use SprykerShop\Yves\SharedCartWidget\Dependency\Client\SharedCartWidgetToSharedCartClientInterface;

class SharedCartWidgetFactory extends AbstractFactory
{
    public function getCustomerClient(): SharedCartWidgetToCustomerClientInterface
    {
        return $this->getProvidedDependency(SharedCartWidgetDependencyProvider::CLIENT_CUSTOMER);
    }

    public function getMultiCartClient(): SharedCartWidgetToMultiCartClientInterface
    {
        return $this->getProvidedDependency(SharedCartWidgetDependencyProvider::CLIENT_MULTI_CART);
    }

    public function getQuoteClient(): SharedCartWidgetToQuoteClientInterface
    {
        return $this->getProvidedDependency(SharedCartWidgetDependencyProvider::CLIENT_QUOTE);
    }

    public function getSharedCartClient(): SharedCartWidgetToSharedCartClientInterface
    {
        return $this->getProvidedDependency(SharedCartWidgetDependencyProvider::CLIENT_SHARED_CART);
    }
}
