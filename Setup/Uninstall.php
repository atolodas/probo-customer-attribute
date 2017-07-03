<?php

namespace Probo\CustomerAttribute\Setup;

use Magento\Customer\Model\Customer;
use Magento\Customer\Setup\CustomerSetupFactory;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\UninstallInterface;

class Uninstall implements UninstallInterface
{
    /**
     * Customer setup factory
     *
     * @var CustomerSetupFactory
     */
    private $customerSetupFactory;

    /**
     * Init
     *
     * @param CustomerSetupFactory $customerSetupFactory
     */
    public function __construct(CustomerSetupFactory $customerSetupFactory)
    {
        $this->customerSetupFactory = $customerSetupFactory;
    }

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

        /**
         * Remove all used attributes for the customer entity
         */
        $customerSetup = $this->customerSetupFactory->create();
        if ($customerSetup->getAttributeId(Customer::ENTITY, 'debtor_id') !== false) {
            $customerSetup->removeAttribute(Customer::ENTITY, 'debtor_id');
            echo "Debtor ID is successfully removed.\n";
        } else {
            echo 'The attribute "Debtor ID" does not exist.';
            echo "\n";
        }

        // End setup
        $setup->endSetup();
    }
}
