<?php
/**
 * Selector interface
 *
 * @author Kachit
 * @package Phallout\ServiceLayer\Query
 */
namespace Phallout\ServiceLayer\Query;

interface SelectorInterface {

    const PREDICATE_IN = 'IN';
    const PREDICATE_NOT_IN = 'NOT IN';

    const PREDICATE_EQUAL = '=';
    const PREDICATE_NOT_EQUAL = '!=';
    const PREDICATE_GT = '>';
    const PREDICATE_GTE = '>=';
    const PREDICATE_LT = '<';
    const PREDICATE_LTE = '<=';

    const PREDICATE_LIKE = 'LIKE';
    const PREDICATE_NOT_LIKE = 'NOT LIKE';

    const PREDICATE_BETWEEN = 'BETWEEN';

    const ORDER_BY_ASC = 'ASC';
    const ORDER_BY_DESC = 'DESC';

    /**
     * Get predicates
     *
     * @return array
     */
    public function getPredicates();

    /**
     * Get limit
     *
     * @return int
     */
    public function getLimit();

    /**
     * Set limit
     *
     * @param int $limit
     * @return $this;
     */
    public function setLimit($limit);

    /**
     * Get offset
     *
     * @return int
     */
    public function getOffset();

    /**
     * Set offset
     *
     * @param int $offset
     * @return $this;
     */
    public function setOffset($offset);

    /**
     * Get groupBy
     *
     * @return array
     */
    public function getGroupBy();

    /**
     * Set groupBy
     *
     * @param array $groupBy
     * @return $this;
     */
    public function setGroupBy(array $groupBy);

    /**
     * Get orderBy
     *
     * @return array
     */
    public function getOrderBy();

    /**
     * Set orderBy
     *
     * @param string $field
     * @param bool $desc
     * @return $this;
     */
    public function setOrderBy($field, $desc = false);
}