<?php

use App\Category;
use App\Post;
use App\Tag;
use App\User;
use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //


        $category1 = Category::create([
            'name'=>'News'
        ]);
        $category2 = Category::create([
            'name'=>'Marketing'
        ]);
        $category3 = Category::create([
            'name'=>'Partnership'
        ]);
        $category4 = Category::create([
            'name'=>'Design'
        ]);

        $post1 = Post::create([
            'title'=>'We relocated our office to a new designed garage',
            'description'=>'test',
            'content'=>'test',
            'category_id'=>$category1->id,
            'image'=>'/posts/1.jpg',
            'user_id'=> 1
        ]);
        $post2 = Post::create([
            'title'=>'Top 5 brilliant content marketing strategies',
            'description'=>'test',
            'content'=>'test',
            'category_id'=>$category2->id,
            'image'=>'/posts/2.jpg',
            'user_id'=> 2
        ]);
        $post3 = Post::create([
            'title'=>'Best practices for minimalist design with example',
            'description'=>'test',
            'content'=>'test',
            'category_id'=>$category4->id,
            'image'=>'/posts/3.jpg',
            'user_id'=> 1
        ]);
        $post4 = Post::create([
            'title'=>'New published books to read by a product designer',
            'description'=>'test',
            'content'=>'test',
            'category_id'=>$category4->id,
            'image'=>'/posts/4.jpg',
            'user_id'=> 1
        ]);

        $tag1 = Tag::create([
            'name'=>'Job'
        ]);
        $tag2 = Tag::create([
            'name'=>'Customers'
        ]);
        $tag3 = Tag::create([
            'name'=>'Record'
        ]);

        $post1->tags()->attach([$tag1->id, $tag2->id]);
        $post2->tags()->attach([$tag2->id, $tag3->id]);
        $post3->tags()->attach([$tag1->id, $tag3->id]);
    }
}
