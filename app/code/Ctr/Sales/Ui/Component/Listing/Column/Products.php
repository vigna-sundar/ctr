<?php
namespace Ctr\Sales\Ui\Component\Listing\Column;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Sales\Api\OrderRepositoryInterface;

class Products extends Column
{
    /**
     * @var OrderRepositoryInterface
     */
    private $orderRepositoryInterface;

    /**
     * Products constructor.
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param OrderRepositoryInterface $orderRepositoryInterface
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        OrderRepositoryInterface $orderRepositoryInterface,
        array $components = [],
        array $data = []
    ) {
        $this->orderRepositoryInterface = $orderRepositoryInterface;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * @inheritDoc
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$items) {
                $products = [];
                $order  = $this->orderRepositoryInterface->get($items["entity_id"]);
                foreach ($order->getAllVisibleItems() as $item) {
                    $products[] = $item->getSku();
                }
                $items['products'] = implode(' | ', $products);
                //unset($productArr);
            }
        }
        return $dataSource;
    }
}
