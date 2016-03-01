<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\Framework\MessageQueue;

/**
 * Class Lock to handle message lock transactions.
 */
class Lock extends \Magento\Framework\Model\AbstractModel
{
    /**
     * Class constructor
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Magento\Framework\MessageQueue\ResourceModel\Lock');
    }

    /**
     * Get message code
     *
     * @return string
     */
    public function getMessageCode()
    {
        return $this->_getData('message_code');
    }

    /**
     * Set message code
     *
     * @param string $value
     * @return $this
     */
    public function setMessageCode($value)
    {
        return $this->setData('message_code', $value);
    }

    /**
     * Get lock date
     *
     * @return string
     */
    public function getCreatedAt()
    {
        return $this->_getData('created_at');
    }

    /**
     * Set lock date
     *
     * @param string $value
     * @return $this
     */
    public function setCreatedAt($value)
    {
        return $this->setData('created_at', $value);
    }
}
