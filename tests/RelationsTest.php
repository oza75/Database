<?php


namespace OZA\Database\Tests;


use Exception;
use Faker\Factory;
use Faker\Generator;
use OZA\Database\Tests\Entities\PostEntity;
use OZA\Database\Tests\Entities\UserEntity;

class RelationsTest extends DatabaseTestCase
{
    use DatabaseMigrations {
        DatabaseMigrations::setUp as migrate;
    }

    /**
     * @var Generator
     */
    private $faker;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->faker = Factory::create('fr_FR');
    }

    public function test_it_works()
    {
        $this->assertNotEmpty(UserEntity::all());
        $this->assertTrue(true);
    }

    public function test_post_relation_create_sql()
    {
        $user = UserEntity::query()->find(2);
        $post = $user->posts()->create(['content' => 'Je suis Aboubacar']);
        $this->assertInstanceOf(PostEntity::class, $post);
        $this->assertEquals('Je suis Aboubacar', $post->content);
        $this->assertEquals(2, $post->user_id);
    }

    public function test_post_relation_where_clause_condition()
    {
        $user = UserEntity::query()->find(2);
        $user->posts()->create(['content' => 'Je suis Aboubacar']);

        $posts = $user->posts()
            ->where('content', 'LIKE', '%suis%')
            ->get();

        $this->assertGreaterThanOrEqual(1, count($posts));
    }

    /**
     * @throws Exception
     */
    protected function setUp(): void
    {
        $this->migrate();
        $this->seedUsers();
        $this->seedPosts();
    }

//    public function test_relation_sql()
//    {
//        $user = UserEntity::query()->find(2);
//        $sql = $user->posts()->toSql();
//
//        $this->assertEquals(
//            "SELECT * FROM posts WHERE user_id = ?",
//            $sql
//        );
//        $this->assertEquals(2, $user->posts()->getParams()[0]);
//    }

    /**
     * @param int $n
     * @throws Exception
     */
    protected function seedUsers(int $n = 10)
    {
        for ($i = 0; $i < $n; $i++) {
            $attributes = [
                'name' => $this->faker->name,
                'email' => $this->faker->email
            ];

            UserEntity::make($attributes)->create();
        }
    }

    /**
     * @param int $n
     * @throws Exception
     */
    private function seedPosts(int $n = 20)
    {
        for ($i = 0; $i < $n; $i++) {
            $attributes = [
                'content' => join('<br/>', $this->faker->sentences(30)),
                'user_id' => $this->faker->numberBetween(1, UserEntity::make()->count())
            ];

            PostEntity::make($attributes)->save();
        }
    }

//    public function test_eager_load_in_clause()
//    {
//        $users = UserEntity::query()->eagerLoad(['posts'])->whereIn('id', [1, 2, 4, 5])->get();
//
//        $this->assertCount(4, $users);
//        $this->assertNotEmpty($users[0]->getRelations());
//        $this->assertInstanceOf(PostEntity::class, $users[0]->getRelation('posts'));
//    }


}