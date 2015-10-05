<?php
/**
 * Base query selector
 *
 * @author Kachit
 * @package Phallout\ServiceLayer\Query
 */
namespace Phallout\ServiceLayer\Query;

class Selector implements SelectorInterface {

    /**
     * @var array
     */
    protected $predicates = [];

    /**
     * @var array
     */
    protected $groupBy = [];

    /**
     * @var array
     */
    protected $orderBy = [];

    /**
     * @var int
     */
    protected $limit = 0;

    /**
     * @var int
     */
    protected $offset = 0;

    /**
     * @param string $field
     * @param mixed $value
     * @param string $predicate
     * @return $this
     */
    public function setPredicate($field, $value, $predicate = self::PREDICATE_EQUAL) {
        $this->predicates[$field][$predicate] = $value;
        return $this;
    }

    /**
     * Get predicates
     *
     * @return array
     */
    public function getPredicates() {
        return $this->predicates;
    }

    /**
     * Get limit
     *
     * @return int
     */
    public function getLimit() {
        return $this->limit;
    }

    /**
     * Set limit
     *
     * @param int $limit
     * @return $this;
     */
    public function setLimit($limit) {
        $this->limit = (int)$limit;
        return $this;
    }

    /**
     * Get offset
     *
     * @return int
     */
    public function getOffset() {
        return $this->offset;
    }

    /**
     * Set offset
     *
     * @param int $offset
     * @return $this;
     */
    public function setOffset($offset) {
        $this->offset = (int)$offset;
        return $this;
    }

    /**
     * Get groupBy
     *
     * @return array
     */
    public function getGroupBy() {
        return $this->groupBy;
    }

    /**
     * Set groupBy
     *
     * @param array $groupBy
     * @return $this;
     */
    public function setGroupBy(array $groupBy) {
        $this->groupBy = $groupBy;
        return $this;
    }

    /**
     * Get orderBy
     *
     * @return array
     */
    public function getOrderBy() {
        return $this->orderBy;
    }

    /**
     * Set orderBy
     *
     * @param string $field
     * @param bool $desc
     * @return $this;
     */
    public function setOrderBy($field, $desc = false) {
        $this->orderBy[$field] = ($desc) ? self::ORDER_BY_DESC : self::ORDER_BY_ASC;
        return $this;
    }
}