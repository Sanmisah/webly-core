<?php

namespace Webly\Core\Models;

class Products extends BaseModel
{
    protected $table            = 'products';
    protected $returnType       = \Webly\Core\Entities\Page::class;
    protected $allowedFields    = ['id', 'product', 'content', 'page_title', 'meta_description', 'layout', 'visible', 'collection_id', 'featured_image', 'rate'];

    public function get($collection_id = null) {
        $db = \Config\Database::connect();
        $builder = $db->table('products');

        if(!empty($collection_id)) {
            $this->builder()
                ->select(['products.*', 'collections.collection'])
                ->join('collections', 'products.collection_id = collections.id')
                ->where('collection_id', $collection_id);
        } else {
            $this->builder()
                ->select(['products.*', 'collections.collection'])
                ->join('collections', 'products.collection_id = collections.id');
        }

        return $this;
    }    
}
