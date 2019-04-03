<?php


namespace OZA\Database\Tests;


use OZA\Database\Facade\Query;
use OZA\Database\Tests\Entities\UserEntity;

class InsertQueryTest extends DatabaseTestCase
{
    use DatabaseMigrations;

    public function insert_sql()
    {
        $attributes = ['name' => 'aboubacar', 'email' => 'abouba181pro@gmail.com'];
        $insert = Query::table('users')->insert($attributes);
        $this->assertEquals('INSERT INTO users ( name, email ) VALUES ( ?, ? )', $insert->toSql());
        $this->assertCount(2, $insert->getParams());
        $this->assertEquals('abouba181pro@gmail.com', $insert->getParams()[1]);
    }

    public function test_insert()
    {
        $attributes = ['name' => 'aboubacar', 'email' => 'abouba181pro@gmail.com'];
        $inserted = Query::table('users')->insert($attributes);
        $this->assertTrue($inserted);
    }

    public function test_insert_with_entity()
    {
        $user = UserEntity::make([
            'name' => 'hello',
            'email' => 'hello@gmail.com'
        ])->save();

        $this->assertInstanceOf(UserEntity::class, $user);
        $this->assertEquals('HELLO', $user->name);

        $user = $user->getQuery()->find($user->id);
        $this->assertInstanceOf(UserEntity::class, $user);
        $this->assertEquals('HELLO', $user->name);

    }

    public function test_save_entity()
    {
        $user = new UserEntity([
            'name' => 'aboubacar',
            'email' => 'Aboubacar Ouattara'
        ]);

        $user->save();
        $this->assertEquals(1, $user->id);
    }
}