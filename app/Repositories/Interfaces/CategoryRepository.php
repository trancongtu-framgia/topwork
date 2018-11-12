<?php

namespace App\Repositories\Interfaces;

interface CategoryRepository extends BaseRepository
{
    public function getAllWithOutPaginate();

    public function getCategoryByBookMark($idCategories);
}
