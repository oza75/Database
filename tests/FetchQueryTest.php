<?php


namespace OZA\Database\Tests;


use OZA\Database\Facade\Query;
use OZA\Database\Query\QueryBuilder;
use OZA\Database\Tests\Entities\UserEntity;
use PDO;

class FetchQueryTest extends DatabaseTestCase
{
    use SeedDatabase;

    public function test_get_with_select()
    {
        $query = $this->prepareTest();
        $data = $query->select(['name'])->get();
        $this->assertNotEmpty($data);
        $this->assertCount(1, $data[0]);
    }

    protected function prepareTest()
    {
        return Query::table('users')->setFetchMode(PDO::FETCH_ASSOC);
    }

    public function test_get_with_where_clauses()
    {
        $query = $this->prepareTest();
        $data = $query->select(['email'])->where('email', 'abouba181@gmail.com')->get();
        $this->assertNotEmpty($data);
        $this->assertCount(1, $data);
    }

    public function test_get_with_or_where_clause()
    {
        $query = $this->prepareTest();
        $data = $query->where('email', '=', 'abouba181@gmail.com')
            ->orWhere('email', 'abouba181pro@gmail.com')->get();

        $this->assertNotEmpty($data);
        $this->assertCount(2, $data);
    }

    public function test_get_with_callable_clause()
    {
        $query = $this->prepareTest();
        $data = $query->where('email', '=', 'abouba181@gmail.com')
            ->orWhere(function (QueryBuilder $builder) {
                $builder->where('name', 'aboubacar')
                    ->where('email', 'abouba181pro@gmail.com');
            })->get();

        $this->assertCount(2, $data);
    }

    public function test_find_by_id()
    {
        $query = $this->prepareTest();
        $user = $query->find(2);
        $this->assertNotEmpty($user);
        $this->assertEquals('abouba181pro@gmail.com', $user['email']);
        $user = $query->find(8);
        $this->assertFalse($user);
    }

    public function test_find_with_entity()
    {
        $query = $this->prepareTest();
        $query->setEntity(UserEntity::class);
        $user = $query->find(2);
        $this->assertNotEmpty($user);
        $this->assertInstanceOf(UserEntity::class, $user);
        $this->assertEquals('ABOUBA181PRO@GMAIL.COM', $user->email);
        $this->assertEquals('ABOUBACAR', $user->name);
        $user->name = 'oza';
        $this->assertEquals('OZA', $user->name);
    }

    public function test_find_by_entity_id()
    {
        $user = UserEntity::query()->find(2);
        $this->assertInstanceOf(UserEntity::class, $user);
        $this->assertEquals('ABOUBA181PRO@GMAIL.COM', $user->email);
        $this->assertEquals('ABOUBACAR', $user->name);
    }

    public function test_count()
    {
        $this->assertEquals(4, UserEntity::query()->count());
    }
}