<?php

namespace App\Models;

class UserGroup extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
    ];

    public $_acl = null;

    public function acl()
    {
        if ($this->_acl === null) {
            $this->_acl = [];
            $rows = UserGroupAccess::get()->where('group_id', '=', $this->id);
            foreach ($rows as $row) {
                $this->_acl[$row->resource] = $row->allow;
            }
        }
        return $this->_acl;
    }

}
