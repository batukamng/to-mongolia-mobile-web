<?php
namespace Modules\Community\Models;

use App\BaseModel;

class CommunityTranslation extends BaseModel
{
    protected $table = 'bravo_community_translations';
    protected $fillable = [
        'title',
        'content',
        'short_desc',
        'address',
        'faqs',
        'include',
        'exclude',
        'itinerary',
        'surrounding',
    ];
    protected $slugField     = false;
    protected $seo_type = 'community_translation';
    protected $cleanFields = [
        'content'
    ];
    protected $casts = [
        'faqs' => 'array',
        'include' => 'array',
        'exclude' => 'array',
        'itinerary' => 'array',
        'surrounding' => 'array',
    ];
    public function getSeoType(){
        return $this->seo_type;
    }
    public function getRecordRoot(){
        return $this->belongsTo(Community::class,'origin_id');
    }
}