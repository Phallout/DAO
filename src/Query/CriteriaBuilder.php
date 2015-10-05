<?php
/**
 * CriteriaBuilder
 *
 * @author Kachit
 * @package Galaxygirl\Common\Models\Condition
 */
namespace Phallout\ServiceLayer\Query;

use Phalcon\Mvc\Model\CriteriaInterface;

class CriteriaBuilder {

    /**
     * @var CriteriaInterface
     */
    protected $criteria;

    /**
     * @var SelectorInterface
     */
    protected $condition;

    /**
     * @param CriteriaInterface $criteria
     * @param SelectorInterface $condition
     */
    public function __construct(CriteriaInterface $criteria, SelectorInterface $condition) {
        $this->condition = $condition;
        $this->criteria = $criteria;
    }

    /**
     * @return CriteriaInterface
     */
    public function build() {
        $this->buildWhereCondition();
        $this->buildOrderByCondition();
        $this->buildGroupByCondition();
        $this->buildLimitCondition();
        return $this->criteria;
    }

    /**
     * Build where condition
     */
    protected function buildWhereCondition() {
        foreach ($this->condition->getPredicates() as $field => $predicates) {
            foreach ($predicates as $predicate => $value) {
                switch($predicate) {
                    case SelectorInterface::PREDICATE_IN:
                        $this->criteria->inWhere($field, $value);
                        break;
                    case SelectorInterface::PREDICATE_NOT_IN:
                        $this->criteria->notInWhere($field, $value);
                        break;
                    case SelectorInterface::PREDICATE_BETWEEN:
                        $this->criteria->betweenWhere($field, $value[0], $value[1]);
                        break;
                    case SelectorInterface::PREDICATE_LIKE:
                    case SelectorInterface::PREDICATE_NOT_LIKE:
                        $whereString = $field . ' ' . $predicate . ' :' . $field . ':';
                        $this->criteria->andWhere($whereString, [$field => '%' . $value . '%']);
                        break;
                    default:
                        $whereString = $field . ' ' . $predicate . ' :' . $field . ':';
                        $this->criteria->andWhere($whereString, [$field => $value]);
                        break;
                }
            }
        }
    }

    /**
     * Build limit condition
     */
    protected function buildLimitCondition() {
        if ($this->condition->getLimit()) {
            $this->criteria->limit($this->condition->getLimit(), $this->condition->getOffset());
        }
    }

    /**
     * Build order by condition
     */
    protected function buildOrderByCondition() {
        if ($this->condition->getOrderBy()) {
            $orderBy = [];
            foreach ($this->condition->getOrderBy() as $field => $type) {
                $orderBy[] = $field . ' ' . $type;
            }
            $this->criteria->orderBy(implode(', ', $orderBy));
        }
    }

    /**
     * Build group by condition
     */
    protected function buildGroupByCondition() {
        if ($this->condition->getGroupBy()) {
            $this->criteria->groupBy($this->condition->getGroupBy());
        }
    }
}