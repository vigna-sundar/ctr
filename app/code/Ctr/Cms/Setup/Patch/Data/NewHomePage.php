<?php
namespace Ctr\Cms\Setup\Patch\Data;

use Magento\Cms\Model\PageFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;

class NewHomePage implements DataPatchInterface
{
    /**
     * @var PageFactory
     */
    private $pageFactory;

    /**
     * @var ModuleDataSetupInterface
     */
    private $moduleDataSetup;

    /**
     * NewHomePage constructor.
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param PageFactory $pageFactory
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        PageFactory $pageFactory
    ) {
        $this->pageFactory = $pageFactory;
        $this->moduleDataSetup = $moduleDataSetup;
    }

    /**
     * @inheritDoc
     */
    public static function getDependencies()
    {
        return [];
    }

    /**
     * @inheritDoc
     */
    public function getAliases()
    {
        return [];
    }

    /**
     * @inheritDoc
     */
    public function apply()
    {
        $cmsPage = [
            'title' => 'New Home page',
            'page_layout' => '1column',
            'identifier' => 'new-home-page',
            'content_heading' => 'New Home Page',
            'content' => "<p>New CMS homepage content goes here.</p>\r\n",
            'is_active' => 1,
            'stores' => [0],
            'sort_order' => 0
        ];
        $this->createPage()->setData($cmsPage)->save();
    }

    /**
     * Create page model instance
     *
     * @return \Magento\Cms\Model\Page
     */
    private function createPage()
    {
        return $this->pageFactory->create();
    }
}
