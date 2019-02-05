<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PendidikanApsFormal extends Model
{
    use SoftDeletes;
    protected $table='pendidikan_aps_formal';
    protected $fillable=['id_kategori','id_kecamatan','kab_tangerang','kelompok_usia','laki_laki','perempuan','tahun','kuintil_1','kuintil_2','kuintil_3','kuintil_4','kuintil_5','created_at','updated_at','deleted_at'];

    function kategori()
    {
        return $this->belongsTo('App\Models\Kategori','id_kategori');
    }
    function kecamatan()
    {
        return $this->belongsTo('App\Models\Kecamatan','id_kecamatan');
    }
}
