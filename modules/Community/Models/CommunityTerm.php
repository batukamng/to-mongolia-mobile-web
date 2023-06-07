<?php
namespace Modules\Community\Models;

use App\BaseModel;

class CommunityTerm extends BaseModel
{
    protected $table = 'bravo_community_term';
    protected $fillable = [
        'term_id',
        'community_id'
    ];
}