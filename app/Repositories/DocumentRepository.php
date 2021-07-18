<?php

namespace App\Repositories;

use App\Models\Document;

class DocumentRepository extends BaseRepository
{
    public function model()
    {
        return Document::class;
    }
}
