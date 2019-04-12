<?php

namespace Aigletter\ModelHistory\Models;


use Illuminate\Database\Eloquent\Model;

class HistoryModel extends Model implements HistoryModelInterface {

    public function getTable() {
        if (! isset($this->table)) {
            // TODO
            return config('model-history.database.table');
        }

        return $this->table;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo|\Illuminate\Foundation\Auth\User
     */
    public function author() {
        return $this->belongsTo('App\User');
    }

    public function getValuesAttribute($value) {
        return json_decode($value);
    }

    public function setValuesAttribute($value) {
        $this->attributes['values'] = json_encode($value, JSON_UNESCAPED_UNICODE);
    }
}