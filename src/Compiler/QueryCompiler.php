<?php


namespace OZA\Database\Compiler;


use OZA\Database\Query\QueryBuilder;

class QueryCompiler extends SQLCompiler
{
    /**
     * Query parts separator
     *
     * @var string
     */
    protected $separator = ' ';

    /**
     * @var QueryBuilder
     */
    protected $query;

    /**
     * @param  QueryBuilder $query
     * @return string
     */
    public static function compile(QueryBuilder $query)
    {
        $compiler = new self();
        $compiler->query = $query;

        if (!is_null($query->getCommand())) { $compiler->compileCommand();
        }
        if (!is_null($query->getTable())) { $compiler->compileTableName();
        }

        if ($query->getCommand() == 'update') {
            $compiler->addPart('SET')
                ->addPart($query->getUpdateSql());
        }

        if (!empty($query->getWheres())) { $compiler->compileWhereClauses();
        }
        if (!is_null($query->getLimit())) { $compiler->addPart(sprintf("LIMIT %s", $query->getLimit()));
        }

        return $compiler->handle();
    }

    private function compileCommand()
    {
        $command = ucfirst(strtolower($this->query->getCommand()));
        $method = sprintf("compile%s", $command);
        return $this->{$method}();
    }

    private function compileTableName()
    {
        return $this->addPart($this->query->getTable());
    }

    private function compileWhereClauses()
    {
        $clauses = $this->query->getWheres();
        if (!$this->query->isSubQuery()) { $this->addPart('WHERE');
        }
        foreach ($clauses as $key => $clause) {
            if ($key > 0) { $this->addPart(strtoupper($clause['logic']));
            }

            if (is_callable($clause['condition'])) { $this->compileWhereClauseSubQuery($clause);
            } else {
                $sql = $clause['column'] . " " . $clause['operator'] . " " . $clause['condition'];

                if (strtolower($clause['operator']) === 'in') {
                    $sql = sprintf("%s IN (%s)", $clause['column'], $clause['condition']);
                }

                $this->addPart($sql);
            }
        }

        return $this;
    }

    /**
     * @param array $clause
     */
    private function compileWhereClauseSubQuery(array $clause)
    {
        $query = new QueryBuilder();
        $query->setCommand(null);
        $query->setSubQuery(true);
        $callback = $clause['column'];
        $callback($query);
        $this->query->mergeParams($query->getParams());
        $sql = sprintf("( %s )", $query->toSql());
        $this->addPart($sql);
    }

    /**
     * Compile select
     *
     * @return QueryCompiler|SQLCompiler
     */
    private function compileSelect()
    {
        $selects = $this->query->getSelects();

        $selects = empty($selects) ? ['*'] : $selects;

        $distinct = $this->query->getDistinct();
        if (!is_null($distinct)) { $selects[] = sprintf("DISTINCT %s", $distinct);
        }

        $sql = join(', ', $selects);

        return $this
            ->addPart('SELECT')
            ->addPart($sql)
            ->addPart('FROM');
    }

    private function compileInsert()
    {
        return $this->addPart('INSERT INTO');
    }

    private function compileUpdate()
    {
        return $this->addPart('UPDATE ');
    }
}