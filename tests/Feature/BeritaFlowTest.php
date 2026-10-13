<?php

namespace Tests\Feature;

use App\Models\Berita;
use App\Models\Kategori;
use App\Models\Tag;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class BeritaFlowTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(DatabaseSeeder::class);
    }

    public function test_publik_melihat_daftar_tanpa_tombol_kelola(): void
    {
        $this->get('/berita')->assertOk()->assertSee('Turnamen Voli')
            ->assertDontSee('+ Tambah Berita')->assertDontSee('Hapus');
    }

    public function test_tamu_dialihkan_ke_login(): void
    {
        $this->get('/berita/create')->assertRedirect('/login');
    }

    public function test_filter_tag_dan_detail(): void
    {
        $tag = Tag::where('nama', 'ekonomi')->first();
        $this->get('/berita?tag='.$tag->id)->assertSee('Panen Raya')->assertDontSee('Turnamen Voli');
        $this->get('/berita/'.Berita::first()->id)->assertOk()->assertSee('Admin Desa');
    }

    public function test_editor_tambah_dengan_gambar_tapi_tidak_bisa_hapus(): void
    {
        Storage::fake('public');
        $editor = User::where('email', 'editor@desa.test')->first();
        $this->actingAs($editor)->post('/berita', [
            'judul' => 'Berita Baru', 'kategori_id' => Kategori::first()->id,
            'isi' => 'Isi berita yang cukup panjang.', 'tags' => [Tag::first()->id],
            'gambar' => UploadedFile::fake()->image('a.jpg'),
        ])->assertRedirect('/berita');

        $b = Berita::where('judul', 'Berita Baru')->first();
        $this->assertSame($editor->id, $b->user_id);
        Storage::disk('public')->assertExists($b->gambar);
        $this->actingAs($editor)->get('/berita')->assertSee('Edit')->assertDontSee('Hapus');
        $this->actingAs($editor)->delete('/berita/'.$b->id)->assertForbidden();

        $admin = User::where('email', 'admin@desa.test')->first();
        $this->actingAs($admin)->delete('/berita/'.$b->id)->assertRedirect('/berita');
        Storage::disk('public')->assertMissing($b->gambar);
    }

    public function test_login(): void
    {
        $this->post('/login', ['email' => 'admin@desa.test', 'password' => 'salah'])
            ->assertSessionHasErrors('email');
        $this->post('/login', ['email' => 'admin@desa.test', 'password' => 'password'])
            ->assertRedirect('/berita');
        $this->get('/login')->assertRedirect('/');
    }

    public function test_edit_form(): void
    {
        $editor = User::where('email', 'editor@desa.test')->first();
        $this->actingAs($editor)->get('/berita/'.Berita::first()->id.'/edit')->assertOk();
    }
}
