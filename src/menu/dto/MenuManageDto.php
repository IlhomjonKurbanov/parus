<?php

namespace rokorolov\parus\menu\dto;

/**
 * MenuManageDto
 *
 * @author Roman Korolov <rokorolov@gmail.com>
 */
class MenuManageDto
{
    public $id;
    public $title;
    public $category;
    public $status;
    public $user_username;
    public $hits;
    public $created_at;
    public $created_by;
    
    public function __construct(array $data)
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }
}
