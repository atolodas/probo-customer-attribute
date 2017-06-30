<?php

namespace Probo\CustomerAttribute\Setup;

use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\UninstallInterface;

class Uninstall implements UninstallInterface
{
    /**
     * Invoked when remove-data flag is set during module uninstall.
     * magento module:uninstall --remove-data <module_name>
     *
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     *
     * @return void
     */
    public function uninstall(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        // Start setup
        $setup->startSetup();

        // Create a new instance of customer setup
        $customerSetup = $this->customerSetupFactory->create();
        $customerSetup->removeAttribute(Customer::ENTITY, 'debtor_id');

        // End setup
        $setup->endSetup();
    }
}
