<?php

namespace Tests\Unit;

use App\Models\School;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\TestCase;

class SchoolTest extends TestCase
{
    use RefreshDatabase;

    // 一覧表示のテスト
    public function test_index_school()
    {
        // テストデータの作成
        School::factory()->count(10)->create();

        // テストデータの取得
        $schools = School::all();

        // テストデータの数が10件であることを確認
        $this->assertEquals(10, $schools->count());
    }

    // 学校登録のテスト
    public function test_store_school()
    {
        // テストデータの作成
        $school = School::factory()->make();

        // テストデータの登録
        $school->save();

        // テストデータが登録されていることを確認
        $this->assertDatabaseHas('schools', $school->toArray());
    }

    // 学校取得のテスト
    public function test_show_school()
    {
        // テストデータの作成
        $school = School::factory()->create();

        // テストデータの取得
        $school = School::find($school->id);

        // テストデータが取得できていることを確認
        $this->assertNotNull($school);
    }

    // 学校更新のテスト
    public function test_school_update()
    {
        // テストデータの作成
        $school = School::factory()->create();

        // テストデータの更新
        $school->name = 'テスト学校';
        $school->save();

        // テストデータが更新されていることを確認
        $this->assertDatabaseHas('schools', $school->toArray());
    }

    // 学校削除のテスト
    public function test_school_delete()
    {
        // テストデータの作成
        $school = School::factory()->create();

        // テストデータの削除
        $school->delete();

        // テストデータが削除されていることを確認
        $this->assertDeleted($school);
    }
}
