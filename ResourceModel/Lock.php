<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\Framework\MessageQueue\ResourceModel;

/**
 * Class Lock to handle database lock table db transactions.
 */
class Lock extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * @var \Magento\Framework\Stdlib\DateTime\DateTime
     */
    private $dateTime;

    /**
     * Inject dependencies.
     *
     * @param \Magento\Framework\Model\ResourceModel\Db\Context $context
     * @param \Magento\Framework\Stdlib\DateTime\DateTime $dateTime
     * @param string $connectionName
     */
    public function __construct(
        \Magento\Framework\Model\ResourceModel\Db\Context $context,
        \Magento\Framework\Stdlib\DateTime\DateTime $dateTime,
        $connectionName = null
    ) {
        $this->dateTime = $dateTime;
        parent::__construct($context, $connectionName);
    }

    /**
     * {@inheritDoc}
     */
    protected function _construct()
    {
        $this->_init('queue_lock', 'id');
    }

    /**
     * @param $interval
     * @return void
     */
    public function cleanupOutdated($interval)
    {
        $date = (new \DateTime())->setTimestamp($this->dateTime->gmtTimestamp());
        $date->add(new \DateInterval('PT' . $interval . 'S'));
        $selectObject = $this->getConnection()->select();
        $selectObject
            ->from(['queue_lock' => $this->getTable('queue_lock')])
            ->where(
                'created_at <= ?',
                $date
            );
        $this->getConnection()->delete($selectObject);
    }
}
