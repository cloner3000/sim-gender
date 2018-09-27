<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/add-slug', function(){
    $data = App\Models\Kategori::all();

    foreach ($data as $item) {
        $check = App\Models\Kategori::find($item->id);
        $check->slug = str_slug($check->judul);
        $check->save();
    }

    return "DONE!";
});

Route::get('/', 'DashboardController@index')->name('dashboard');
Route::get('beranda', 'DashboardController@index')->name('beranda');

Route::get('/home', 'HomeController@index')->name('home');

//--Subyek--
Route::get('subyek/{jenis}','SubyekController@index')->name('subyek.index');

Route::get('/kependudukan/kepadatan/{id_kategori}', 'KependudukanKepadatanController@index')->name('kependudukan-kepadatan.index');
Route::get('/kependudukan/kepadatan/{id_kategori}/create', 'KependudukanKepadatanController@create')->name('kependudukan-kepadatan.create');
Route::get('/kependudukan/kepadatan/{id_kategori}/edit', 'KependudukanKepadatanController@edit')->name('kependudukan-kepadatan.edit');
Route::put('/kependudukan/kepadatan/{id_kategori}/update', 'KependudukanKepadatanController@update')->name('kependudukan-kepadatan.update');
Route::post('/kependudukan/kepadatan/{id_kategori}/store', 'KependudukanKepadatanController@store')->name('kependudukan-kepadatan.store');

//--------Pendidikan Sekolah
Route::get('/pendidikan/sekolah/{jenjang}/{id_kategori}', 'PendidikanSekolahController@index')->name('pendidikan-sekolah.index');
Route::get('/pendidikan/sekolah/{jenjang}/{id_kategori}/create', 'PendidikanSekolahController@create')->name('pendidikan-sekolah.create');
Route::get('/pendidikan/sekolah/{jenjang}/{id_kategori}/edit', 'PendidikanSekolahController@edit')->name('pendidikan-sekolah.edit');
Route::put('/pendidikan/sekolah/{jenjang}/{id_kategori}/update', 'PendidikanSekolahController@update')->name('pendidikan-sekolah.update');
Route::post('/pendidikan/sekolah/{jenjang}/{id_kategori}/store', 'PendidikanSekolahController@store')->name('pendidikan-sekolah.store');

//--------Pendidikan Yang DItamatkan
Route::get('/pendidikan/penduduk/kecamatan/{id_kategori}','PendidikanDitamatkanController@index')->name('pendidikan-ditamatkan.index');
Route::get('/pendidikan/penduduk/kecamatan/{id_kategori}/create', 'PendidikanDitamatkanController@create')->name('pendidikan-ditamatkan.create');
Route::get('/pendidikan/penduduk/kecamatan/{id_kategori}/edit', 'PendidikanDitamatkanController@edit')->name('pendidikan-ditamatkan.edit');
Route::put('/pendidikan/penduduk/kecamatan/{id_kategori}/update', 'PendidikanDitamatkanController@update')->name('pendidikan-ditamatkan.update');
Route::post('/pendidikan/penduduk/kecamatan/{id_kategori}/store', 'PendidikanDitamatkanController@store')->name('pendidikan-ditamatkan.store');

//--------Pendidikan Rasion
Route::get('/pendidikan/rasio/{jenjang}/{id_kategori}', 'PendidikanRasioController@index')->name('pendidikan-rasio.index');
Route::get('/pendidikan/rasio/{jenjang}/{id_kategori}/create', 'PendidikanRasioController@create')->name('pendidikan-rasio.create');
Route::get('/pendidikan/rasio/{jenjang}/{id_kategori}/edit', 'PendidikanRasioController@edit')->name('pendidikan-rasio.edit');
Route::put('/pendidikan/rasio/{jenjang}/{id_kategori}/update', 'PendidikanRasioController@update')->name('pendidikan-rasio.update');
Route::post('/pendidikan/rasio/{jenjang}/{id_kategori}/store', 'PendidikanRasioController@store')->name('pendidikan-rasio.store');

//--------Kesehatan ALH
Route::get('/kesehatan/alh/{id_kategori}', 'KesehatanAlhController@index')->name('kesehatan-alh.index');
Route::get('/kesehatan/alh/{id_kategori}/create', 'KesehatanAlhController@create')->name('kesehatan-alh.create');
Route::get('/kesehatan/alh/{id_kategori}/edit', 'KesehatanAlhController@edit')->name('kesehatan-alh.edit');
Route::put('/kesehatan/alh/{id_kategori}/update', 'KesehatanAlhController@update')->name('kesehatan-alh.update');
Route::post('/kesehatan/alh/{id_kategori}/store', 'KesehatanAlhController@store')->name('kesehatan-alh.store');
//--------Kesehatan Jumlah Dokter
Route::get('/kesehatan/jumlah/doktor-spesialis/{id_kategori}', 'KesehatanJumlahDokterController@index')->name('kesehatan-jumlah-dokter.index');
Route::get('/kesehatan/jumlah/doktor-spesialis/{id_kategori}/create', 'KesehatanJumlahDokterController@create')->name('kesehatan-jumlah-dokter.create');
Route::get('/kesehatan/jumlah/doktor-spesialis/{id_kategori}/edit', 'KesehatanJumlahDokterController@edit')->name('kesehatan-jumlah-dokter.edit');
Route::put('/kesehatan/jumlah/doktor-spesialis/{id_kategori}/update', 'KesehatanJumlahDokterController@update')->name('kesehatan-jumlah-dokter.update');
Route::post('/kesehatan/jumlah/doktor-spesialis/{id_kategori}/store', 'KesehatanJumlahDokterController@store')->name('kesehatan-jumlah-dokter.store');


Route::get('/kependudukan/pmks/{id_kategori}', 'KependudukanPMKSController@index')->name('kependudukan-pmks.index');
Route::get('/kependudukan/pmks/{id_kategori}/create', 'KependudukanPMKSController@create')->name('kependudukan-pmks.create');
Route::get('/kependudukan/pmks/{id_kategori}/edit', 'KependudukanPMKSController@edit')->name('kependudukan-pmks.edit');
Route::put('/kependudukan/pmks/{id_kategori}/update', 'KependudukanPMKSController@update')->name('kependudukan-pmks.update');
Route::post('/kependudukan/pmks/{id_kategori}/store', 'KependudukanPMKSController@store')->name('kependudukan-pmks.store');
Route::get('/kependudukan/pmks/{id_kategori}', 'KependudukanPMKSController@index')->name('kependudukan-pmks.index');

Route::get('/ketenagakerjaan/indikator/{id_kategori}', 'TenagaKerjaIndikatorController@index')->name('tenagakerja-indikator.index');
Route::get('/ketenagakerjaan/indikator/{id_kategori}/create', 'TenagaKerjaIndikatorController@create')->name('tenagakerja-indikator.create');
Route::get('/ketenagakerjaan/indikator/{id_kategori}/edit', 'TenagaKerjaIndikatorController@edit')->name('tenagakerja-indikator.edit');
Route::put('/ketenagakerjaan/indikator/{id_kategori}/update', 'TenagaKerjaIndikatorController@update')->name('tenagakerja-indikator.update');
Route::post('/ketenagakerjaan/indikator/{id_kategori}/store', 'TenagaKerjaIndikatorController@store')->name('tenagakerja-indikator.store');
