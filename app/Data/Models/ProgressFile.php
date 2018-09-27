<?php
namespace App\Data\Models;

use Illuminate\Notifications\Notifiable;
use App\Data\Models\Progress as ProgressModel;
use App\Data\Models\File as FileModel;

class ProgressFile extends BaseModel
{
    use Notifiable;

    /**
     * @var array
     */
    protected $fillable = ['file_id', 'progress_id', 'description'];

    public function file()
    {
        return $this->belongsTo(FileModel::class);
    }

    public function progress()
    {
        return $this->belongsTo(ProgressModel::class);
    }
}
