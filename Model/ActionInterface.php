<?php

namespace mbartok\EntityDescriberBundle\Model;

use mbartok\EntityDescriberBundle\Factory\ActionFactoryInterface;

interface ActionInterface extends \ArrayAccess, \Countable, \IteratorAggregate
{
    /**
     * @param ActionFactoryInterface $factory
     *
     * @return ActionInterface
     */
    public function setFactory(ActionFactoryInterface $factory);

    /**
     * @return string
     */
    public function getName();

    /**
     * Renames the item.
     *
     * This method must also update the key in the parent.
     *
     * Provides a fluent interface
     *
     * @param string $name
     *
     * @return ActionInterface
     *
     * @throws \InvalidArgumentException if the name is already used by a sibling
     */
    public function setName($name);

    /**
     * Get the uri for a item
     *
     * @return string
     */
    public function getRouteName();

    /**
     * @param $name
     * @return ActionInterface
     */
    public function setRouteName($name);

    public function getRouteParams();

    /**
     * @param array $params
     * @return ActionInterface
     */
    public function setRouteParams(array $params);

    /**
     * @param string $color
     * @return ActionInterface
     */
    public function setColor($color);

    /**
     * @return string
     */
    public function getColor();

    /**
     * Returns the label that will be used to render this item
     *
     * Defaults to the name of no label was specified
     *
     * @return string
     */
    public function getLabel();

    /**
     * Provides a fluent interface
     *
     * @param string $label The text to use when rendering this item
     *
     * @return ActionInterface
     */
    public function setLabel($label);

    /**
     * @return array
     */
    public function getLinkAttributes();

    /**
     * Provides a fluent interface
     *
     * @param array $linkAttributes
     *
     * @return ActionInterface
     */
    public function setLinkAttributes(array $linkAttributes);

    /**
     * @param string $name The name of the attribute to return
     * @param mixed $default The value to return if the attribute doesn't exist
     *
     * @return mixed
     */
    public function getLinkAttribute($name, $default = null);

    /**
     * Provides a fluent interface
     *
     * @param string $name
     * @param string $value
     *
     * @return ActionInterface
     */
    public function setLinkAttribute($name, $value);

    /**
     * Whether or not this menu item should show its children.
     *
     * @return boolean
     */
    public function getDisplayChildren();

    /**
     * Set whether or not this menu item should show its children
     *
     * Provides a fluent interface
     *
     * @param boolean $bool
     *
     * @return ActionInterface
     */
    public function setDisplayChildren($bool);

    /**
     * Whether or not to display this menu item
     *
     * @return boolean
     */
    public function isDisplayed();

    /**
     * Set whether or not this menu should be displayed
     *
     * Provides a fluent interface
     *
     * @param boolean $bool
     *
     * @return ActionInterface
     */
    public function setDisplay($bool);

    /**
     * Add a child menu item to this menu
     *
     * Returns the child item
     *
     * @param ActionInterface|string $child An ItemInterface instance or the name of a new item to create
     * @param array $options If creating a new item, the options passed to the factory for the item
     *
     * @return ActionInterface
     * @throws \InvalidArgumentException if the item is already in a tree
     */
    public function addChild($child, array $options = array());

    /**
     * Returns the child menu identified by the given name
     *
     * @param string $name Then name of the child menu to return
     *
     * @return ActionInterface|null
     */
    public function getChild($name);

    /**
     * Reorder children.
     *
     * Provides a fluent interface
     *
     * @param array $order New order of children.
     *
     * @return ActionInterface
     */
    public function reorderChildren($order);

    /**
     * Returns the level of this item
     *
     * The root item is 0, followed by 1, 2, etc
     *
     * @return integer
     */
    public function getLevel();

    /**
     * Returns the root ItemInterface of this item
     *
     * @return ActionInterface
     */
    public function getRoot();

    /**
     * Returns whether or not this item is the root item
     *
     * @return boolean
     */
    public function isRoot();

    /**
     * @return ActionInterface|null
     */
    public function getParent();

    /**
     * Used internally when adding and removing children
     *
     * Provides a fluent interface
     *
     * @param ActionInterface|null $parent
     *
     * @return ActionInterface
     */
    public function setParent(ActionInterface $parent = null);

    /**
     * Return the children as an array of ItemInterface objects
     *
     * @return ActionInterface[]
     */
    public function getChildren();

    /**
     * Provides a fluent interface
     *
     * @param array $children An array of ItemInterface objects
     *
     * @return ActionInterface
     */
    public function setChildren(array $children);

    /**
     * Removes a child from this item
     *
     * Provides a fluent interface
     *
     * @param ActionInterface|string $name The name of ItemInterface instance or the ItemInterface to remove
     *
     * @return ActionInterface
     */
    public function removeChild($name);


    /**
     * Returns whether or not this items has viewable children
     *
     * This item MAY have children, but this will return false if the current
     * user does not have access to view any of those items
     *
     * @return boolean
     */
    public function hasChildren();

    public function getFirstChild();

    public function getLastChild();

    /**
     * @return array
     */
    public function getExtras();

    /**
     * Provides a fluent interface
     *
     * @param array $extras
     *
     * @return ActionInterface
     */
    public function setExtras(array $extras);

    /**
     * @param string $name The name of the extra to return
     * @param mixed $default The value to return if the extra doesn't exist
     *
     * @return mixed
     */
    public function getExtra($name, $default = null);

    /**
     * Provides a fluent interface
     *
     * @param string $name
     * @param mixed $value
     *
     * @return ActionInterface
     */
    public function setExtra($name, $value);
}
