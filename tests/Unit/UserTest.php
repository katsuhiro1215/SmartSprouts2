<?php

namespace Tests\Unit;

use App\Models\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    // 一覧取得のテスト
    public function test_index_user()
    {
        User::factory()->count(10)->create();

        $response = $this->get('/api/users');

        $response->assertStatus(200)
            ->assertJsonCount(10);
    }

    // ユーザー登録のテスト
    public function test_store_user()
    {
        
    }
    
    // ユーザー更新のテスト
    public function test_update_user()
    {

    }

    // ユーザー削除のテスト
    public function test_delete_user()
    {

    }

    // ユーザー検索のテスト

}
