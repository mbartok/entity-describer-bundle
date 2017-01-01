<?php
/**
 * Created by PhpStorm.
 * User: mbartok
 * Date: 30.12.16
 * Time: 15:17
 */

namespace mbartok\EntityDescriberBundle\Model;

class EntityDescriberActionGroup extends EntityDescriberAction
{
    /**
     * @var EntityDescriberActionItem[]
     */
    private $items;

    public function __construct($label, array $attributes = [])
    {
        parent::__construct($label, $attributes);
        $this->items = [];
    }

    /**
     * @return EntityDescriberActionItem[]
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * @param EntityDescriberActionItem $item
     */
    public function addItem(EntityDescriberActionItem $item)
    {
        $this->items[] = $item;
    }
}