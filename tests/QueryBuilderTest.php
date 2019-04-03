<?php

namespace OZA\Database\Tests;

use OZA\Database\Facade\Query;
use OZA\Database\Query\QueryBuilder;

class QueryBuilderTest extends TestCase
{
    public function test_table_is_set()
    {
        $query = new QueryBuilder();
        $table = $query->table('users');
        $this->assertInstanceOf(QueryBuilder::class, $table);
        $this->assertEquals('users', $table->getTable());
    }

    public function test_table_is_set_in_static_call()
    {
        $table = Query::table('users');
        $this->assertInstanceOf(QueryBuilder::class, $table);
        $this->assertEquals('users', $table->getTable());
    }

    public function test_select()
    {
        $table = $this->prepareTest()->select(['name', 'username']);
        $this->assertNotEmpty($table->getSelects());
        $this->assertCount(2, $table->getSelects());
    }

    protected function prepareTest()
    {
        return Query::table('users');
    }

    public function test_where()
    {
        $query = $this->prepareTest()
            ->where('name', '=', 'oza')
            ->where('email', '=', 'oza@email.com');

        $this->assertNotEmpty($query->getWheres());
        $this->assertCount(2, $query->getWheres());
    }

    public function test_or_where()
    {
        $query = $this->prepareTest()
            ->where('name', '=', 'oza')
            ->orWhere('name', '=', 'hello')
            ->where('email', '=', 'oza@email.com');

        $this->assertNotEmpty($query->getWheres());
        $this->assertCount(3, $query->getWheres());

        $query = Query::table('users')->orWhere('name', '=', 'oea');
        $this->assertEquals('OR', $query->getWheres()[0]['logic']);
    }

    public function test_where_equals()
    {
        $query = $this->prepareTest()->where('name', 'hello');
        $this->assertCount(1, $query->getWheres());
        $this->assertEquals('?', $query->getWheres()[0]['condition']);
        $this->assertEquals('hello', $query->getParams()[0]);
    }

    public function test_where_with_callable()
    {
        $query = $this->prepareTest()->where(function (QueryBuilder $builder) {
            $builder->where('name', 'hello');
        });

        $this->assertCount(1, $query->getWheres());

        $this->assertIsCallable($query->getWheres()[0]['condition']);
    }

    public function test_orWhere_equals()
    {
        $query = $this->prepareTest()->orWhere('name', 'hello');
        $this->assertCount(1, $query->getWheres());
        $this->assertEquals('hello', $query->getParams()[0]);
    }

    public function test_orWhere_with_callable()
    {
        $query = $this->prepareTest()->orWhere(function (QueryBuilder $builder) {
            $builder->where('name', 'hello');
        });

        $this->assertCount(1, $query->getWheres());

        $this->assertIsCallable($query->getWheres()[0]['condition']);
    }

    public function test_select_sql()
    {
        $query = $this->prepareTest()->select(['name', 'username']);
        $this->assertEquals('SELECT name, username FROM users', $query->toSql());
    }


    public function test_where_sql()
    {
        $query = $this->prepareTest();
        $query->where('name', '=', 'hello');

        $this->assertEquals('SELECT * FROM users WHERE name = ?', $query->toSql());
        $this->assertCount(1, $query->getParams());
        $this->assertEquals('hello', $query->getParams()[0]);
    }

    public function test_where_with_orwhere_sql()
    {
        $query = $this->prepareTest();
        $query->where('name', '=', 'hello')
            ->where('lastname', 'pity')
            ->orWhere('name', 'pita');

        $this->assertEquals('SELECT * FROM users WHERE name = ? AND lastname = ? OR name = ?', $query->toSql());
        $this->assertCount(3, $query->getParams());
        $this->assertEquals('hello', $query->getParams()[0]);
        $this->assertEquals('pity', $query->getParams()[1]);
        $this->assertEquals('pita', $query->getParams()[2]);
    }

    public function test_select_raw_sql()
    {
        $query = $this->prepareTest();
        $query->selectRaw('COUNT(*) AS count')->where('name', 'hello');

        $this->assertEquals('SELECT COUNT(*) AS count FROM users WHERE name = ?', $query->toSql());
        $this->assertCount(1, $query->getParams());
        $this->assertEquals('hello', $query->getParams()[0]);
    }

    public function test_select_distinct()
    {
        $query = $this->prepareTest();
        $query->select(['name', 'last_name'])->where('name', 'hello')->distinct('name');

        $this->assertEquals('SELECT name, last_name, DISTINCT name FROM users WHERE name = ?', $query->toSql());
    }

    public function test_where_with_callable_sql()
    {
        $query = $this->prepareTest();
        $query->where('name', '=', 'hello')
            ->where(function (QueryBuilder $builder) {
                $builder->where('name', 'yes')
                    ->orWhere('lastname', 'op');
            });

        $this->assertEquals('SELECT * FROM users WHERE name = ? AND ( name = ? OR lastname = ? )', $query->toSql());
        $this->assertCount(3, $query->getParams());
        $this->assertEquals('hello', $query->getParams()[0]);
        $this->assertEquals('yes', $query->getParams()[1]);
        $this->assertEquals('op', $query->getParams()[2]);
    }

    public function test_where_in_clauses()
    {
        $query = $this->prepareTest();
        $query->whereIn('id', [1, 2, 3, 4]);
        $this->assertEquals('SELECT * FROM users WHERE id IN (?, ?, ?, ?)', $query->toSql());
        $this->assertCount(4, $query->getParams());
    }
}
