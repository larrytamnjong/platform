<?php


namespace Ushahidi\Modules\V5\Http\Resources\Post;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PostGeometryCollection extends ResourceCollection
{
    public static $wrap = 'results';

    /**
     * The resource that this resource collects.
     *
     * @var string
     */
    public $collects = 'Ushahidi\Modules\V5\Http\Resources\Post\PostGeometryResource';
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'count' => $this->count(),
            'results' => $this->collection
        ];
    }

    public function count()
    {
        return count($this->collection);
    }
}
