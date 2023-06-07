<?php
namespace Modules\Community\Models;

use App\BaseModel;

class CommunityCategoryTranslation extends BaseModel
{
    protected $table = 'bravo_community_category_translations';
    protected $fillable = [
        'name',
        'content',
    ];
    protected $cleanFields = [
        'content'
    ];
}