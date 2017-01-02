<?php

namespace mbartok\EntityDescriberBundle\Model;

use mbartok\EntityDescriberBundle\Factory\ActionFactoryInterface;

/**
 * Default implementation of the ItemInterface
 */
class Action implements ActionInterface
{
    /**
     * Name of this item (used for id by parent item)
     * @var string
     */
    protected $name = null;

    /**
     * Label to output, name is used by default
     * @var string
     */
    protected $label = null;

    /**
     * @var string
     */
    protected $routeName = null;

    /**
     * @var array
     */
    protected $routeParams = array();

    /**
     * Attributes for the item link
     * @var array
     */
    protected $linkAttributes = array();

    /**
     * Whether the item is displayed
     * @var boolean
     */
    protected $display = true;

    /**
     * Whether the children of the item are displayed
     * @var boolean
     */
    protected $displayChildren = true;

    /**
     * Child items
     * @var ActionInterface[]
     */
    protected $children = array();

    /**
     * Parent item
     * @var ActionInterface|null
     */
    protected $parent = null;

    /**
     * @var ActionFactoryInterface
     */
    protected $factory;

    protected $color = null;

    /**
     * Extra stuff associated to the item
     * @var array
     */
    protected $extras = array();

    /**
     * Class constructor
     *
     * @param string $name The name of this menu, which is how its parent will
     *                                  reference it. Also used as label if label not specified
     * @param ActionFactoryInterface $factory
     */
    public function __construct($name, ActionFactoryInterface $factory)
    {
        $this->name = (string)$name;
        $this->factory = $factory;
    }

    /**
     * setFactory
     *
     * @param ActionFactoryInterface $factory
     * @return self
     */
    public function setFactory(ActionFactoryInterface $factory)
    {
        $this->factory = $factory;

        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        if ($this->name == $name) {
            return $this;
        }

        $parent = $this->getParent();
        if (null !== $parent && isset($parent[$name])) {
            throw new \InvalidArgumentException('Cannot rename item, name is already used by sibling.');
        }

        $oldName = $this->name;
        $this->name = $name;

        if (null !== $parent) {
            $names = array_keys($parent->getChildren());
            $items = array_values($parent->getChildren());

            $offset = array_search($oldName, $names);
            $names[$offset] = $name;

            $parent->setChildren(array_combine($names, $items));
        }

        return $this;
    }

    public function getLabel()
    {
        return ($this->label !== null) ? $this->label : $this->name;
    }

    public function setLabel($label)
    {
        $this->label = $label;

        return $this;
    }

    public function getLinkAttributes()
    {
        return $this->linkAttributes;
    }

    public function setLinkAttributes(array $linkAttributes)
    {
        $this->linkAttributes = $linkAttributes;

        return $this;
    }

    public function getLinkAttribute($name, $default = null)
    {
        if (isset($this->linkAttributes[$name])) {
            return $this->linkAttributes[$name];
        }

        return $default;
    }

    public function setLinkAttribute($name, $value)
    {
        $this->linkAttributes[$name] = $value;

        return $this;
    }

    public function getDisplayChildren()
    {
        return $this->displayChildren;
    }

    public function setDisplayChildren($bool)
    {
        $this->displayChildren = (bool)$bool;

        return $this;
    }

    public function isDisplayed()
    {
        return $this->display;
    }

    public function setDisplay($bool)
    {
        $this->display = (bool)$bool;

        return $this;
    }

    public function addChild($child, array $options = array())
    {
        if (!$child instanceof ActionInterface) {
            $child = $this->factory->createAction($child, $options);
        } elseif (null !== $child->getParent()) {
            throw new \InvalidArgumentException('Cannot add menu item as child, it already belongs to another menu (e.g. has a parent).');
        }

        $child->setParent($this);

        $this->children[$child->getName()] = $child;

        return $child;
    }

    public function getChild($name)
    {
        return isset($this->children[$name]) ? $this->children[$name] : null;
    }

    public function reorderChildren($order)
    {
        if (count($order) != $this->count()) {
            throw new \InvalidArgumentException('Cannot reorder children, order does not contain all children.');
        }

        $newChildren = array();

        foreach ($order as $name) {
            if (!isset($this->children[$name])) {
                throw new \InvalidArgumentException('Cannot find children named ' . $name);
            }

            $child = $this->children[$name];
            $newChildren[$name] = $child;
        }

        $this->setChildren($newChildren);

        return $this;
    }

    public function getLevel()
    {
        return $this->parent ? $this->parent->getLevel() + 1 : 0;
    }

    public function getRoot()
    {
        $obj = $this;
        do {
            $found = $obj;
        } while ($obj = $obj->getParent());

        return $found;
    }

    public function isRoot()
    {
        return null === $this->parent;
    }

    public function getParent()
    {
        return $this->parent;
    }

    public function setParent(ActionInterface $parent = null)
    {
        if ($parent === $this) {
            throw new \InvalidArgumentException('Item cannot be a child of itself');
        }

        $this->parent = $parent;

        return $this;
    }

    public function getChildren()
    {
        return $this->children;
    }

    public function setChildren(array $children)
    {
        $this->children = $children;

        return $this;
    }

    public function removeChild($name)
    {
        $name = $name instanceof ActionInterface ? $name->getName() : $name;

        if (isset($this->children[$name])) {
            // unset the child and reset it so it looks independent
            $this->children[$name]->setParent(null);
            unset($this->children[$name]);
        }

        return $this;
    }

    public function getFirstChild()
    {
        return reset($this->children);
    }

    public function getLastChild()
    {
        return end($this->children);
    }

    public function hasChildren()
    {
        foreach ($this->children as $child) {
            if ($child->isDisplayed()) {
                return true;
            }
        }

        return false;
    }

    public function isLast()
    {
        // if this is root, then return false
        if ($this->isRoot()) {
            return false;
        }

        return $this->getParent()->getLastChild() === $this;
    }

    public function isFirst()
    {
        // if this is root, then return false
        if ($this->isRoot()) {
            return false;
        }

        return $this->getParent()->getFirstChild() === $this;
    }

    /**
     * Implements Countable
     */
    public function count()
    {
        return count($this->children);
    }

    /**
     * Implements IteratorAggregate
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->children);
    }

    /**
     * Implements ArrayAccess
     * @param mixed $name
     * @return bool
     */
    public function offsetExists($name)
    {
        return isset($this->children[$name]);
    }

    /**
     * Implements ArrayAccess
     * @param mixed $name
     * @return ActionInterface|mixed|null
     */
    public function offsetGet($name)
    {
        return $this->getChild($name);
    }

    /**
     * Implements ArrayAccess
     * @param mixed $name
     * @param mixed $value
     * @return ActionInterface
     */
    public function offsetSet($name, $value)
    {
        return $this->addChild($name)->setLabel($value);
    }

    /**
     * Implements ArrayAccess
     * @param mixed $name
     */
    public function offsetUnset($name)
    {
        $this->removeChild($name);
    }

    public function getRouteName()
    {
        return $this->routeName;
    }

    public function setRouteName($name)
    {
        $this->routeName = $name;
        return $this;
    }

    public function getRouteParams()
    {
        return $this->routeParams;
    }

    public function setRouteParams(array $params)
    {
        $this->routeParams = $params;
        return $this;
    }

    public function setColor($color)
    {
        $this->color = $color;
        return $this;
    }

    public function getColor()
    {
        return $this->color;
    }

    public function getExtras()
    {
        return $this->extras;
    }

    public function setExtras(array $extras)
    {
        $this->extras = $extras;

        return $this;
    }

    public function getExtra($name, $default = null)
    {
        if (isset($this->extras[$name])) {
            return $this->extras[$name];
        }

        return $default;
    }

    public function setExtra($name, $value)
    {
        $this->extras[$name] = $value;

        return $this;
    }
}
